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

/** Remove only media blocks that cannot match a viewport below 768px.
 * All other rules (including unknown media syntax) retain their cascade order.
 */
function dungcuyte_mobile_css($css)
{
    preg_match_all('~"(?:\\\\.|[^"\\\\])*"|\'(?:\\\\.|[^\'\\\\])*\'|/\*[\s\S]*?\*/|\\\\.|@media\\b|[{}]~i', $css, $tokens, PREG_OFFSET_CAPTURE);
    $stack = array();
    $ranges = array();
    $pending = null;
    foreach ($tokens[0] as $token) {
        $value = $token[0];
        $offset = $token[1];
        if (strtolower($value) === '@media') {
            $brace = strpos($css, '{', $offset);
            if ($brace === false) { return $css; }
            $query = preg_replace('~/\*[\s\S]*?\*/~', ' ', substr($css, $offset + 6, $brace - $offset - 6));
            // A conjunction with a minimum >= 768px is impossible on mobile.
            // Keep lists, negation, range syntax and unfamiliar queries unchanged.
            if (!preg_match('~[,;{}]|\\b(?:not|or)\\b~i', $query)
                && preg_match('~\\(\\s*min-width\\s*:\\s*([0-9]+(?:\\.[0-9]+)?)px\\s*\\)~i', $query, $width)
                && (float) $width[1] >= 768) {
                $pending = $offset;
            }
        } elseif ($value === '{') {
            $stack[] = $pending;
            $pending = null;
        } elseif ($value === '}') {
            if (!$stack) { return $css; }
            $start = array_pop($stack);
            if ($start !== null) { $ranges[] = array($start, $offset + 1); }
        }
    }
    if ($stack) { return $css; }
    usort($ranges, function ($a, $b) { return $a[0] - $b[0]; });
    $result = '';
    $cursor = 0;
    foreach ($ranges as $range) {
        if ($range[0] < $cursor) { continue; }
        $result .= substr($css, $cursor, $range[0] - $cursor);
        $cursor = $range[1];
    }
    return $result . substr($css, $cursor);
}

function dungcuyte_save_css($target, $content)
{
    $temporary = @tempnam(dirname($target), 'css-build-');
    if ($temporary === false) { return false; }
    $written = file_put_contents($temporary, $content);
    @chmod($temporary, 0644);
    $saved = $written === strlen($content) && @rename($temporary, $target);
    if (is_file($temporary)) { unlink($temporary); }
    return $saved;
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
    $mobile_filename = str_replace('dungcuyte-base-', 'dungcuyte-mobile-', $filename);
    $mobile_target = $directory . '/' . $mobile_filename;
    if (!is_file($target) || !is_file($mobile_target)) {
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
        if (!is_file($target) && !dungcuyte_save_css($target, $content)) { return $fallback; }
        if (!is_file($mobile_target) && !dungcuyte_save_css($mobile_target, dungcuyte_mobile_css($content))) { return $fallback; }
    }
    // Nonmatching stylesheets download at lower priority and do not block paint.
    // At 768px and above the original, complete stylesheet preserves desktop styling.
    return '<link rel="stylesheet" media="not all and (min-width: 768px)" href="' . NV_BASE_SITEURL . $files . '/css/' . $mobile_filename . '" />' . PHP_EOL
        . '<link rel="stylesheet" media="(min-width: 768px)" href="' . NV_BASE_SITEURL . $files . '/css/' . $filename . '" />' . PHP_EOL;
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
