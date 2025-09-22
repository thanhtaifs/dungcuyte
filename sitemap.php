<?php
// sitemap.php - robust version for NukeViet 4.0
// SAVE AS UTF-8 WITHOUT BOM

// Không hiển thị lỗi ra trình duyệt
// error_reporting(E_ALL);
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);
// ini_set('error_log', __DIR__ . '/sitemap_error.log');

// Bật output buffering (để tránh output đứt đoạn)
ob_start();

// Đăng ký shutdown function: nếu thiếu </urlset> vẫn bổ sung để tránh "Premature end"
register_shutdown_function(function () {
    // Lấy nội dung buffer hiện tại (nếu có)
    $buf = @ob_get_contents();
    if ($buf === false) return;
    if (strpos($buf, '</urlset>') === false) {
        // cố gắng thêm đóng tag
        echo "\n</urlset>";
    }
    // flush (PHP sẽ flush buffer sau khi shutdown)
});

// Thử include mainfile (nhưng chặn mọi output do include gây ra)
$included = false;
$paths = [
    __DIR__ . '/mainfile.php',
    __DIR__ . '/includes/mainfile.php',
    __DIR__ . '/nukeviet/includes/mainfile.php',
    $_SERVER['DOCUMENT_ROOT'] . '/mainfile.php',
    $_SERVER['DOCUMENT_ROOT'] . '/includes/mainfile.php',
];

foreach ($paths as $p) {
    if (file_exists($p)) {
        // chặn output tạm thời từ mainfile
        ob_start();
        include_once $p;
        ob_end_clean();
        $included = true;
        break;
    }
}

// Xác định domain: ưu tiên NV_MY_DOMAIN / global_config / fallback từ HTTP_HOST
$domain = 'https://dungcutheduccantho.com';
if (defined('NV_MY_DOMAIN') && NV_MY_DOMAIN) {
    $domain = rtrim(NV_MY_DOMAIN, '/');
} elseif (isset($global_config['site_url']) && $global_config['site_url']) {
    $domain = rtrim($global_config['site_url'], '/');
} elseif (!empty($_SERVER['HTTP_HOST'])) {
    $proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $domain = $proto . '://' . $_SERVER['HTTP_HOST'];
}

// Bắt đầu tạo XML trong biến (không echo ngay)
$out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// Trang chủ
$out .= "  <url>\n";
$out .= "    <loc>" . htmlspecialchars($domain . '/') . "</loc>\n";
$out .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
$out .= "    <changefreq>daily</changefreq>\n";
$out .= "    <priority>1.0</priority>\n";
$out .= "  </url>\n";

// Nếu DB của NukeViet đã sẵn sàng thì lấy data động
if (isset($db) && defined('NV_PREFIXLANG')) {
    // News
    try {
        $sql = "SELECT alias, publtime FROM " . NV_PREFIXLANG . "_news_rows WHERE status=1 ORDER BY publtime DESC LIMIT 5000";
        $res = $db->query($sql);
        while ($row = $res->fetch()) {
            $loc = $domain . '/news/' . $row['alias'];
            $last = date('Y-m-d', $row['publtime']);
            $out .= "  <url>\n";
            $out .= "    <loc>" . htmlspecialchars($loc) . "</loc>\n";
            $out .= "    <lastmod>" . $last . "</lastmod>\n";
            $out .= "    <changefreq>weekly</changefreq>\n";
            $out .= "    <priority>0.8</priority>\n";
            $out .= "  </url>\n";
        }
    } catch (Throwable $e) {
        error_log('sitemap: news query error: ' . $e->getMessage());
    }

    // Shops
    try {
        $sql = "SELECT alias, publtime FROM " . NV_PREFIXLANG . "_shops_rows WHERE status=1 ORDER BY publtime DESC LIMIT 5000";
        $res = $db->query($sql);
        while ($row = $res->fetch()) {
            $loc = $domain . '/san-pham/' . $row['alias'];
            $last = date('Y-m-d', $row['publtime']);
            $out .= "  <url>\n";
            $out .= "    <loc>" . htmlspecialchars($loc) . "</loc>\n";
            $out .= "    <lastmod>" . $last . "</lastmod>\n";
            $out .= "    <changefreq>weekly</changefreq>\n";
            $out .= "    <priority>0.7</priority>\n";
            $out .= "  </url>\n";
        }
    } catch (Throwable $e) {
        error_log('sitemap: shops query error: ' . $e->getMessage());
    }

} else {
    // Fallback: báo trong log nếu không có DB
    if (!$included) error_log('sitemap: mainfile not included; DB not available.');
    $out .= "<!-- DB not loaded; sitemap contains only minimal static URLs -->\n";
    // Bạn có thể thêm các URL tĩnh ở đây nếu muốn
}

$out .= "</urlset>\n";

// Gửi header và xuất XML (một lần)
header('Content-Type: application/xml; charset=utf-8');
echo $out;

// Flush và kết thúc
@ob_end_flush();
exit;
