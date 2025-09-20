<?php
if (!defined('NV_IS_MOD_SITEMAP')) {
    define('NV_IS_MOD_SITEMAP', true);
}

global $db, $db_config, $global_config;

header('Content-Type: text/xml; charset=utf-8');

$today = date('Y-m-d');
$baseUrl = NV_MY_DOMAIN;

// --------------------
// Hàm xuất sitemap XML cho module
// --------------------
function buildSitemap($urls = []) {
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $link) {
        $xml .= '<url><loc>' . htmlspecialchars($link) . '</loc></url>';
    }
    $xml .= '</urlset>';
    return $xml;
}

// --------------------
// 1. Trang chủ
// --------------------
$homeUrls = [$baseUrl];

// --------------------
// 2. Module SHOPS (sản phẩm)
// --------------------
$shopUrls = [];
if (isset($site_mods['shops'])) {
    $mod = $site_mods['shops'];
    $sql = "SELECT r.id, r.vi_alias AS product_alias, c.vi_alias AS cat_alias
            FROM " .  $db_config['prefix'] . "_" . $mod['module_data'] . "_rows r
            INNER JOIN " .  $db_config['prefix'] . "_" . $mod['module_data'] . "_catalogs c 
                ON r.listcatid = c.catid
            WHERE r.status=1
            ORDER BY r.id DESC";
    $result = $db->query($sql);
    while ($row = $result->fetch()) {
        $shopUrls[] = $baseUrl . '/' . $mod['module_file'] . '/' . $row['cat_alias'] . '/' . $row['product_alias'] . '.html';
    }
}

// --------------------
// 3. Module NEWS (tin tức)
// --------------------
$newsUrls = [];
if (isset($site_mods['news'])) {
    $mod = $site_mods['news'];
    $sql = "SELECT id, alias FROM " . NV_PREFIXLANG . "_" . $mod['module_data'] . "_rows WHERE status=1 ORDER BY id DESC";
    $result = $db->query($sql);
    while ($row = $result->fetch()) {
        $newsUrls[] = $baseUrl . '/' . $mod['module_file'] . '/' . $row['alias'];
    }
}

// --------------------
// 4. Module PAGE (trang tĩnh)
// --------------------
$pageUrls = [];
if (isset($site_mods['page'])) {
    $mod = $site_mods['page'];
    $sql = "SELECT id, alias FROM " . NV_PREFIXLANG . "_" . $mod['module_data'] . " WHERE status=1 ORDER BY id DESC";
    $result = $db->query($sql);
    while ($row = $result->fetch()) {
        $pageUrls[] = $baseUrl . '/' . $mod['module_file'] . '/' . $row['alias'];
    }
}

// --------------------
// Ghi các sitemap con
// --------------------
file_put_contents(NV_ROOTDIR . '/sitemap_news.xml', buildSitemap($newsUrls));
file_put_contents(NV_ROOTDIR . '/sitemap_shops.xml', buildSitemap($shopUrls));
file_put_contents(NV_ROOTDIR . '/sitemap_pages.xml', buildSitemap($pageUrls));
file_put_contents(NV_ROOTDIR . '/sitemap_home.xml', buildSitemap($homeUrls));

// --------------------
// Tạo sitemap_index.xml
// --------------------
$xmlIndex  = '<?xml version="1.0" encoding="UTF-8"?>';
$xmlIndex .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

$xmlIndex .= '<sitemap><loc>' . $baseUrl . '/sitemap_home.xml</loc><lastmod>' . $today . '</lastmod></sitemap>';
$xmlIndex .= '<sitemap><loc>' . $baseUrl . '/sitemap_news.xml</loc><lastmod>' . $today . '</lastmod></sitemap>';
$xmlIndex .= '<sitemap><loc>' . $baseUrl . '/sitemap_shops.xml</loc><lastmod>' . $today . '</lastmod></sitemap>';
$xmlIndex .= '<sitemap><loc>' . $baseUrl . '/sitemap_pages.xml</loc><lastmod>' . $today . '</lastmod></sitemap>';

$xmlIndex .= '</sitemapindex>';

file_put_contents(NV_ROOTDIR . '/sitemap_index.xml', $xmlIndex);

// --------------------
// Xuất sitemap_index khi truy cập module
// --------------------
echo $xmlIndex;
exit();
