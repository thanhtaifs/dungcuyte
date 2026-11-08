<?php
/** Local, cached product thumbnails. Originals remain available for zoom and detail pages. */
if (!defined('NV_MAINFILE') && !defined('NV_IS_MOD_SHOPS')) {
    die('Stop!!!');
}

function nv_shops_card_image($url)
{
    global $global_config;
    static $memo = array();

    $fallback = array('src' => $url, 'srcset' => '');
    if (!is_string($url) || $url === '') {
        return $fallback;
    }
    $parts = parse_url(html_entity_decode($url, ENT_QUOTES, 'UTF-8'));
    if ($parts === false || empty($parts['path'])) {
        return $fallback;
    }
    // Resolve same-site URLs locally; never download remote or user-supplied URLs.
    if (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), array('http', 'https'), true)) {
        return $fallback;
    }
    if (isset($parts['host'])) {
        $site_host = parse_url(isset($global_config['site_url']) ? $global_config['site_url'] : '', PHP_URL_HOST);
        if (!$site_host || strcasecmp($parts['host'], $site_host) !== 0) {
            return $fallback;
        }
    }
    $path = rawurldecode($parts['path']);
    $base = '/' . trim(NV_BASE_SITEURL, '/') . '/';
    $base = $base === '//' ? '/' : $base;
    if ($base !== '/' && strpos($path, $base) === 0) {
        $path = substr($path, strlen($base));
    }
    $relative = ltrim($path, '/');
    if (strpos($relative, "\0") !== false || strpos($relative, '\\') !== false || preg_match('#(^|/)\.\.?(/|$)#', $relative)) {
        return $fallback;
    }
    $uploads = trim(NV_UPLOADS_DIR, '/') . '/';
    $files = trim(NV_FILES_DIR, '/') . '/';
    if (strpos($relative, $uploads) !== 0 && strpos($relative, $files) !== 0) {
        return $fallback;
    }
    if (strpos($relative, $files . 'shops/responsive/') === 0) {
        return $fallback;
    }
    // Old CMS thumbnails can be too small for 2x displays. Prefer their original.
    if (strpos($relative, $files) === 0 && is_file(NV_ROOTDIR . '/' . $uploads . substr($relative, strlen($files)))) {
        $relative = $uploads . substr($relative, strlen($files));
    }
    $source = realpath(NV_ROOTDIR . '/' . $relative);
    $allowed = realpath(NV_ROOTDIR . '/' . (strpos($relative, $uploads) === 0 ? NV_UPLOADS_DIR : NV_FILES_DIR));
    if (!$source || !$allowed || strpos(str_replace('\\', '/', $source), str_replace('\\', '/', $allowed) . '/') !== 0 || !is_file($source)) {
        return $fallback;
    }
    $key = sha1('card-v1|' . $relative . '|' . filemtime($source) . '|' . filesize($source));
    if (isset($memo[$key])) {
        return $memo[$key];
    }
    $directory = NV_ROOTDIR . '/' . NV_FILES_DIR . '/shops/responsive/' . $key;
    $public = NV_BASE_SITEURL . NV_FILES_DIR . '/shops/responsive/' . $key . '/';
    $manifest = $directory . '/images.json';
    if (is_file($manifest)) {
        $images = json_decode(file_get_contents($manifest), true);
        if (is_array($images) && !empty($images)) {
            $valid = true;
            foreach ($images as $entry) {
                if (!isset($entry['file'], $entry['width']) || basename($entry['file']) !== $entry['file'] || !is_file($directory . '/' . $entry['file'])) {
                    $valid = false;
                    break;
                }
            }
            if ($valid) {
                return $memo[$key] = nv_shops_card_image_result($images, $public);
            }
        }
    }
    if (!function_exists('imagecreatetruecolor') || (!is_dir($directory) && !@mkdir($directory, 0755, true))) {
        return $memo[$key] = $fallback;
    }
    // A concurrent request can use its original while the first builds the cache.
    $lock = @fopen($directory . '/build.lock', 'c');
    if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) {
        if ($lock) {
            fclose($lock);
        }
        return $fallback;
    }
    $source_image = false;
    try {
        $info = @getimagesize($source);
        // Do not flatten animated GIFs or decode exceptionally large uploads here.
        $readers = array(IMAGETYPE_JPEG => 'imagecreatefromjpeg', IMAGETYPE_PNG => 'imagecreatefrompng');
        if (defined('IMAGETYPE_WEBP')) {
            $readers[IMAGETYPE_WEBP] = 'imagecreatefromwebp';
        }
        if (!$info || empty($info[0]) || empty($info[1]) || $info[0] * $info[1] > 16000000 || !isset($readers[$info[2]]) || !function_exists($readers[$info[2]])) {
            return $memo[$key] = $fallback;
        }
        $memory_limit = trim(ini_get('memory_limit'));
        $memory_bytes = (int)$memory_limit;
        $unit = strtolower(substr($memory_limit, -1));
        if (in_array($unit, array('k', 'm', 'g'), true)) {
            $memory_bytes *= pow(1024, strpos('kmg', $unit) + 1);
        }
        if ($memory_bytes > 0 && memory_get_usage(true) + $info[0] * $info[1] * 8 + 8388608 > $memory_bytes) {
            return $memo[$key] = $fallback;
        }
        $source_image = @$readers[$info[2]]($source);
        if (!$source_image) {
            return $memo[$key] = $fallback;
        }
        $webp = function_exists('imagewebp') && (imagetypes() & IMG_WEBP);
        $extension = $webp ? 'webp' : ($info[2] === IMAGETYPE_JPEG ? 'jpg' : 'png');
        $images = array();
        $widths = array(180, 270, 360, 540);
        // No upscaling; small sources retain their true width in srcset.
        $widths = array_unique(array_map(function ($width) use ($info) { return min($width, $info[0]); }, $widths));
        foreach ($widths as $width) {
            $height = max(1, (int)round($info[1] * $width / $info[0]));
            $image = imagecreatetruecolor($width, $height);
            imagealphablending($image, false);
            imagesavealpha($image, true);
            imagefill($image, 0, 0, imagecolorallocatealpha($image, 0, 0, 0, 127));
            imagecopyresampled($image, $source_image, 0, 0, 0, 0, $width, $height, $info[0], $info[1]);
            $filename = $width . '.' . $extension;
            $temporary = tempnam($directory, 'build-');
            $saved = false;
            if ($temporary !== false) {
                if ($webp) {
                    $saved = imagewebp($image, $temporary, 80);
                } elseif ($extension === 'jpg') {
                    imageinterlace($image, true);
                    $saved = imagejpeg($image, $temporary, 82);
                } else {
                    $saved = imagepng($image, $temporary, 6);
                }
                if ($saved) {
                    @chmod($temporary, 0644);
                    $saved = @rename($temporary, $directory . '/' . $filename);
                }
                if (is_file($temporary)) {
                    unlink($temporary);
                }
            }
            imagedestroy($image);
            if ($saved) {
                $images[] = array('file' => $filename, 'width' => $width);
            }
        }
        if (!$images) {
            return $memo[$key] = $fallback;
        }
        $temporary = tempnam($directory, 'manifest-');
        if ($temporary !== false) {
            file_put_contents($temporary, json_encode($images));
            @chmod($temporary, 0644);
            @rename($temporary, $manifest);
            if (is_file($temporary)) {
                unlink($temporary);
            }
        }
        return $memo[$key] = nv_shops_card_image_result($images, $public);
    } finally {
        if ($source_image) {
            imagedestroy($source_image);
        }
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

function nv_shops_card_image_result($images, $public)
{
    $srcset = array();
    $default = end($images);
    foreach ($images as $entry) {
        $srcset[] = $public . $entry['file'] . ' ' . $entry['width'] . 'w';
        if ($entry['width'] === 270) {
            $default = $entry;
        }
    }
    return array('src' => $public . $default['file'], 'srcset' => implode(', ', $srcset));
}

function nv_shops_assign_card_image($xtpl, $url, $variable = 'IMG_SRC')
{
    global $op;
    static $count = 0;
    $image = nv_shops_card_image($url);
    $is_detail = isset($op) && $op === 'detail';
    if (!$is_detail) {
        ++$count;
    }
    $xtpl->assign($variable, $image['src']);
    $xtpl->assign('CARD_IMAGE', array(
        'srcset' => htmlspecialchars($image['srcset'], ENT_QUOTES, 'UTF-8'),
        'sizes' => $is_detail
            ? '(max-width: 375px) calc(100vw - 30px), (max-width: 991px) calc((100vw - 40px) / 2), 270px'
            : '(max-width: 767px) calc((100vw - 40px) / 2), (max-width: 1399px) 25vw, 270px',
        'loading' => !$is_detail && $count <= 2 ? 'eager' : 'lazy'
    ));
}
