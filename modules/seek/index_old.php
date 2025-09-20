<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Bạn :)
 * @Createdate 2025
 */

if (!defined('NV_IS_MOD_SEEK')) {
    define('NV_IS_MOD_SEEK', true);
}

$q = isset($array_op[0]) ? urldecode($array_op[0]) : '';
$contents = '';

if (!empty($q)) {
    $contents .= '<h2>Kết quả tìm kiếm cho từ khóa: <em>' . htmlspecialchars($q) . '</em></h2>';

    // Ví dụ kết quả đơn giản:
    $contents .= '<p>Hiển thị kết quả tại đây (bạn có thể thêm xử lý tìm kiếm tùy theo nhu cầu).</p>';

    // Nếu muốn tích hợp tìm kiếm thực sự từ các module khác, cần viết thêm phần gọi module tương ứng
} else {
    $contents .= '<p>Không có từ khóa tìm kiếm</p>';
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
