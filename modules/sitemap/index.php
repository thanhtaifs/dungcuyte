<?php

if (!defined('NV_SYSTEM')) {
    die('Stop!!!');
}

$contents = sitemap_generate();

nv_xmlOutput($contents);

function sitemap_generate()
{
    global $db, $nv_Cache, $global_config;

    $base_url = NV_MY_DOMAIN . NV_BASE_SITEURL;

    $items = [];

    // Ví dụ: lấy các module có rewrite link
    $sql = "SELECT title, module_file FROM " . NV_MODULES_TABLE . " WHERE act=1";
    $result = $db->query($sql);

    while ($row = $result->fetch()) {
        $items[] = [
            'loc' => $base_url . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $row['title'],
            'lastmod' => date('Y-m-d')
        ];
    }

    // Bắt đầu build XML
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

    foreach ($items as $item) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($item['loc']) . "</loc>\n";
        $xml .= "    <lastmod>" . $item['lastmod'] . "</lastmod>\n";
        $xml .= "    <changefreq>daily</changefreq>\n";
        $xml .= "    <priority>0.8</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= "</urlset>";

    return $xml;
}
