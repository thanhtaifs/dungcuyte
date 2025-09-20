<?php

/**
 * Admin Module - Sitemap Generator
 * Tạo folder: admin/modules/seotools/
 * File: admin/modules/seotools/sitemap.php
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = 'Tạo Sitemap XML';

// Xử lý tạo sitemap
if ($nv_Request->isset_request('generate', 'post')) {
    
    // Tạo sitemap content
    $sitemap_content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $sitemap_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    
    // 1. Trang chủ
    $sitemap_content .= "  <url>\n";
    $sitemap_content .= "    <loc>" . htmlspecialchars(NV_BASE_SITEURL) . "</loc>\n";
    $sitemap_content .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
    $sitemap_content .= "    <changefreq>daily</changefreq>\n";
    $sitemap_content .= "    <priority>1.0</priority>\n";
    $sitemap_content .= "  </url>\n";
    
    // 2. Các module
    $sql = "SELECT title, module_file FROM " . NV_MODULES_TABLE . " WHERE act = 1 ORDER BY weight";
    $result = $db->query($sql);
    
    while ($module = $result->fetch()) {
        if ($module['module_file'] != 'page') {
            $module_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module['title'];
            
            $sitemap_content .= "  <url>\n";
            $sitemap_content .= "    <loc>" . htmlspecialchars($module_url) . "</loc>\n";
            $sitemap_content .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $sitemap_content .= "    <changefreq>weekly</changefreq>\n";
            $sitemap_content .= "    <priority>0.8</priority>\n";
            $sitemap_content .= "  </url>\n";
        }
    }
    
    // 3. Bài viết News
    $news_table = NV_PREFIXLANG . "_news_rows";
    $check_news = $db->query("SHOW TABLES LIKE '" . $news_table . "'");
    
    if ($check_news->rowCount() > 0) {
        $sql = "SELECT id, alias, publtime, edittime FROM " . $news_table . " WHERE status = 1 ORDER BY publtime DESC LIMIT 2000";
        $result = $db->query($sql);
        
        while ($row = $result->fetch()) {
            $news_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=news&amp;' . NV_OP_VARIABLE . '=' . $row['alias'] . '-' . $row['id'] . $global_config['rewrite_exturl'];
            $lastmod = !empty($row['edittime']) ? date('Y-m-d', $row['edittime']) : date('Y-m-d', $row['publtime']);
            
            $sitemap_content .= "  <url>\n";
            $sitemap_content .= "    <loc>" . htmlspecialchars($news_url) . "</loc>\n";
            $sitemap_content .= "    <lastmod>" . $lastmod . "</lastmod>\n";
            $sitemap_content .= "    <changefreq>monthly</changefreq>\n";
            $sitemap_content .= "    <priority>0.7</priority>\n";
            $sitemap_content .= "  </url>\n";
        }
    }
    
    // 4. Trang Page
    $page_table = NV_PREFIXLANG . "_page";
    $check_page = $db->query("SHOW TABLES LIKE '" . $page_table . "'");
    
    if ($check_page->rowCount() > 0) {
        $sql = "SELECT id, alias, add_time, edit_time FROM " . $page_table . " WHERE status = 1";
        $result = $db->query($sql);
        
        while ($row = $result->fetch()) {
            $page_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=page&amp;' . NV_OP_VARIABLE . '=' . $row['alias'];
            $lastmod = !empty($row['edit_time']) ? date('Y-m-d', $row['edit_time']) : date('Y-m-d', $row['add_time']);
            
            $sitemap_content .= "  <url>\n";
            $sitemap_content .= "    <loc>" . htmlspecialchars($page_url) . "</loc>\n";
            $sitemap_content .= "    <lastmod>" . $lastmod . "</lastmod>\n";
            $sitemap_content .= "    <changefreq>monthly</changefreq>\n";
            $sitemap_content .= "    <priority>0.6</priority>\n";
            $sitemap_content .= "  </url>\n";
        }
    }
    
    // 5. Danh mục News
    $news_cat_table = NV_PREFIXLANG . "_news_cat";
    $check_news_cat = $db->query("SHOW TABLES LIKE '" . $news_cat_table . "'");
    
    if ($check_news_cat->rowCount() > 0) {
        $sql = "SELECT catid, alias FROM " . $news_cat_table . " WHERE status = 1";
        $result = $db->query($sql);
        
        while ($row = $result->fetch()) {
            $cat_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=news&amp;' . NV_OP_VARIABLE . '=' . $row['alias'];
            
            $sitemap_content .= "  <url>\n";
            $sitemap_content .= "    <loc>" . htmlspecialchars($cat_url) . "</loc>\n";
            $sitemap_content .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $sitemap_content .= "    <changefreq>weekly</changefreq>\n";
            $sitemap_content .= "    <priority>0.6</priority>\n";
            $sitemap_content .= "  </url>\n";
        }
    }
    
    $sitemap_content .= '</urlset>';
    
    // Lưu sitemap
    $sitemap_file = NV_ROOTDIR . '/sitemap.xml';
    
    if (file_put_contents($sitemap_file, $sitemap_content)) {
        $info = 'Tạo sitemap thành công! File đã được lưu: sitemap.xml';
        $info .= '<br>Kích thước: ' . round(strlen($sitemap_content)/1024, 2) . ' KB';
        $info .= '<br>Số URL: ' . substr_count($sitemap_content, '<loc>');
        
        // Ping Google
        $ping_url = 'http://www.google.com/ping?sitemap=' . urlencode(NV_BASE_SITEURL . 'sitemap.xml');
        @file_get_contents($ping_url);
        $info .= '<br>Đã ping Google Search Console!';
        
        // Log
        nv_insert_logs(NV_LANG_DATA, 'seotools', 'Tạo sitemap', 'sitemap.xml', 0);
        
    } else {
        $error = 'Không thể tạo file sitemap.xml! Kiểm tra quyền ghi thư mục.';
    }
}

// Kiểm tra sitemap hiện tại
$sitemap_info = '';
$sitemap_file = NV_ROOTDIR . '/sitemap.xml';
if (file_exists($sitemap_file)) {
    $file_time = date('d/m/Y H:i:s', filemtime($sitemap_file));
    $file_size = round(filesize($sitemap_file)/1024, 2);
    $sitemap_info = "File sitemap.xml đã tồn tại<br>Cập nhật: {$file_time}<br>Kích thước: {$file_size} KB";
}

// Thống kê dữ liệu
$stats = array();

// Đếm modules
$sql = "SELECT COUNT(*) as total FROM " . NV_MODULES_TABLE . " WHERE act = 1";
$result = $db->query($sql);
$row = $result->fetch();
$stats['modules'] = $row['total'];

// Đếm news
$news_table = NV_PREFIXLANG . "_news_rows";
$check_news = $db->query("SHOW TABLES LIKE '" . $news_table . "'");
if ($check_news->rowCount() > 0) {
    $sql = "SELECT COUNT(*) as total FROM " . $news_table . " WHERE status = 1";
    $result = $db->query($sql);
    $row = $result->fetch();
    $stats['news'] = $row['total'];
} else {
    $stats['news'] = 0;
}

// Đếm pages
$page_table = NV_PREFIXLANG . "_page";
$check_page = $db->query("SHOW TABLES LIKE '" . $page_table . "'");
if ($check_page->rowCount() > 0) {
    $sql = "SELECT COUNT(*) as total FROM " . $page_table . " WHERE status = 1";
    $result = $db->query($sql);
    $row = $result->fetch();
    $stats['pages'] = $row['total'];
} else {
    $stats['pages'] = 0;
}

$contents = '';
$contents .= '<div class="well">';
$contents .= '<h3>🗺️ Sitemap Generator</h3>';

// Hiển thị thông báo
if (isset($info)) {
    $contents .= '<div class="alert alert-success">' . $info . '</div>';
}
if (isset($error)) {
    $contents .= '<div class="alert alert-danger">' . $error . '</div>';
}

// Form tạo sitemap
$contents .= '<form method="post" class="form-inline">';
$contents .= '<input type="hidden" name="generate" value="1" />';
$contents .= '<button type="submit" class="btn btn-primary btn-lg">';
$contents .= '<i class="fa fa-refresh"></i> Tạo Sitemap XML';
$contents .= '</button>';
$contents .= '</form>';

$contents .= '<hr>';

// Thông tin sitemap hiện tại
if ($sitemap_info) {
    $contents .= '<h4>📄 Sitemap hiện tại:</h4>';
    $contents .= '<div class="alert alert-info">' . $sitemap_info . '</div>';
    $contents .= '<p><a href="' . NV_BASE_SITEURL . 'sitemap.xml" target="_blank" class="btn btn-info">Xem sitemap.xml</a></p>';
}

// Thống kê
$contents .= '<h4>📊 Thống kê dữ liệu:</h4>';
$contents .= '<ul>';
$contents .= '<li>Modules active: <strong>' . $stats['modules'] . '</strong></li>';
$contents .= '<li>Bài viết News: <strong>' . $stats['news'] . '</strong></li>';
$contents .= '<li>Trang Page: <strong>' . $stats['pages'] . '</strong></li>';
$contents .= '<li>Ước tính tổng URL: <strong>' . (1 + $stats['modules'] + $stats['news'] + $stats['pages']) . '</strong></li>';
$contents .= '</ul>';

// Hướng dẫn
$contents .= '<h4>📋 Hướng dẫn sử dụng:</h4>';
$contents .= '<ol>';
$contents .= '<li>Nhấn <strong>"Tạo Sitemap XML"</strong> để tạo/cập nhật sitemap</li>';
$contents .= '<li>Thêm URL này vào Google Search Console:</li>';
$contents .= '</ol>';
$contents .= '<div class="well well-sm"><code>' . NV_BASE_SITEURL . 'sitemap.xml</code></div>';

$contents .= '</div>';

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';

?>