<?php
/** Small, theme-local optimizations; no change to the CMS admin asset pipeline. */
if (!defined('NV_MAINFILE')) { die('Stop!!!'); }

function dungcuyte_compact_css($css)
{
    // Tokenize strings first. In particular, retain calc() spaces, custom properties,
    // selector descendant spaces, escaped characters and whitespace inside content.
    return trim(preg_replace_callback('~"(?:\\\\.|[^"\\\\])*"|\'(?:\\\\.|[^\'\\\\])*\'|/\*[\s\S]*?\*/|[\s]+~', function ($match) {
        $token = $match[0];
        if ($token[0] === '"' || $token[0] === "'") { return $token; }
        if (substr($token, 0, 2) === '/*') {
            // Retain license comments and a token separator for other comments.
            return substr($token, 0, 3) === '/*!' ? $token : '/**/';
        }
        return ' ';
    }, $css));
}

function dungcuyte_rebase_css_urls($css, $prefix)
{
    // Skip comments and quoted content; only rewrite actual url() tokens.
    return preg_replace_callback('~"(?:\\\\.|[^"\\\\])*"|\'(?:\\\\.|[^\'\\\\])*\'|/\*[\s\S]*?\*/|url\(\s*([\'\"]?)([^)\'\"]+)\1\s*\)~i', function ($match) use ($prefix) {
        if (!isset($match[2])) { return $match[0]; }
        $url = trim($match[2]);
        if ($url === '' || preg_match('~^(?:[a-z][a-z0-9+.-]*:|/|\#)~i', $url)) { return $match[0]; }
        return 'url(' . $match[1] . $prefix . $url . $match[1] . ')';
    }, $css);
}

function dungcuyte_base_css_links()
{
    $source_directory = NV_ROOTDIR . '/themes/dungcuytecantho/css/';
    $sources = array('bootstrap.min.css', 'style.css', 'style.responsive.css');
    $fallback = '';
    $fingerprint = 'base-css-v1|' . filemtime(__FILE__) . '|' . filesize(__FILE__);
    foreach ($sources as $source) {
        if (!is_file($source_directory . $source)) { return ''; }
        $version = filemtime($source_directory . $source) . '-' . filesize($source_directory . $source);
        $fingerprint .= '|' . $source . '|' . $version;
        $fallback .= '<link rel="stylesheet" href="' . NV_BASE_SITEURL . 'themes/dungcuytecantho/css/' . $source . '?v=' . $version . '" />' . PHP_EOL;
    }
    // The CMS already uses files/css for writable, generated theme styles.
    $files = defined('SYSTEM_FILES_DIR') ? SYSTEM_FILES_DIR : NV_FILES_DIR;
    $directory = NV_ROOTDIR . '/' . $files . '/css';
    $filename = 'dungcuyte-base-' . substr(sha1($fingerprint), 0, 20) . '.css';
    $target = $directory . '/' . $filename;
    if (!is_file($target)) {
        if ((!is_dir($directory) && !@mkdir($directory, 0755, true)) || !is_writable($directory)) {
            return $fallback;
        }
        $content = '';
        // Keep URLs relative to the generated CSS, so subdirectory installs and CDNs work.
        $prefix = str_repeat('../', count(explode('/', trim($files . '/css', '/')))) . 'themes/dungcuytecantho/css/';
        foreach ($sources as $source) {
            $css = file_get_contents($source_directory . $source);
            if ($css === false || preg_match('/@import\s/i', $css)) { return $fallback; }
            $css = dungcuyte_rebase_css_urls($css, $prefix);
            $content .= '/*! ' . $source . ' */' . PHP_EOL . dungcuyte_compact_css($css) . PHP_EOL;
        }
        $temporary = @tempnam($directory, 'css-build-');
        if ($temporary === false) { return $fallback; }
        $written = file_put_contents($temporary, $content);
        @chmod($temporary, 0644);
        $saved = $written === strlen($content) && @rename($temporary, $target);
        if (is_file($temporary)) { unlink($temporary); }
        if (!$saved) { return $fallback; }
    }
    return '<link rel="stylesheet" href="' . NV_BASE_SITEURL . $files . '/css/' . $filename . '" />' . PHP_EOL;
}

function dungcuyte_defer_catalog_scripts($html, $module_file, $op)
{
    // Other modules, editors, and the admin toolbar keep their original loading order.
    if ($module_file !== 'shops' || !in_array($op, array('main', 'viewcat', 'detail'), true) || defined('NV_IS_ADMIN') || defined('NV_EDITOR')) {
        return $html;
    }
    return preg_replace_callback('~<script\b([^>]*\bsrc="([^"]+)"[^>]*)>\s*</script>~i', function ($match) {
        $path = parse_url(html_entity_decode($match[2], ENT_QUOTES, 'UTF-8'), PHP_URL_PATH);
        $base = preg_quote(NV_BASE_SITEURL, '~');
        if (!is_string($path) || !preg_match('~^' . $base . '(?:js/language/[a-z_-]+\.js|js/global\.js|modules/shops/js/user\.js)$~i', $path) || preg_match('/\s(?:defer|async)\b/i', $match[1])) {
            return $match[0];
        }
        return '<script defer' . $match[1] . '></script>';
    }, $html);
}
