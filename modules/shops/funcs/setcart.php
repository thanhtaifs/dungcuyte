<?php

if (!defined('NV_IS_MOD_SHOPS')) die('Stop!!!');
//error_log('=== setcart.php shop loaded OK ===');
$id  = $nv_Request->get_int('id', 'post,get', 0);
$num = $nv_Request->get_int('num', 'post,get', 1);
$type = $nv_Request->get_string('t', 'get', 'text'); // text | json

$contents_msg = '';

if ($id > 0) {
    // Lấy sản phẩm
    $row = $db->query("
        SELECT id, listcatid, " . NV_LANG_DATA . "_title AS title," . NV_LANG_DATA . "_alias AS alias,homeimgfile, product_price, money_unit, discount_id
        FROM " . $db_config['prefix'] . "_" . $module_data . "_rows 
        WHERE id = " . intval($id)
    )->fetch();

    if ($row) {
        $price = $row['product_price'];
        $img = $row['homeimgfile'] 
        ? NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $row['homeimgfile']
        : NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $row['homeimgthumb'] ?? '';
       $listcatid = $row['listcatid'];
       $alias = $row['alias'];
       $link = NV_BASE_SITEURL
        . 'index.php?'
        . NV_LANG_VARIABLE . '=' . NV_LANG_DATA
        . '&' . NV_NAME_VARIABLE . '=' . $module_name
        . '&' . NV_OP_VARIABLE . '='
        . $global_array_shops_cat[$listcatid]['alias'] . '/' 
        . $alias
        . $global_config['rewrite_exturl'];
        // Áp dụng giảm giá nếu có
        if (!empty($row['discount_id'])) {
            $discount = $db->query("
                SELECT discount_percent 
                FROM " . $db_config['prefix'] . "_" . $module_data . "_discounts 
                WHERE id = " . intval($row['discount_id'])
            )->fetchColumn();
            if ($discount > 0) {
                $price -= ($price * $discount / 100);
            }
        }

        // Cập nhật session giỏ hàng
        if (!isset($_SESSION[$module_data . '_cart'][$id])) {
            $_SESSION[$module_data . '_cart'][$id] = [
                'num' => $num,
                'price' => $price,
                'money_unit' => $row['money_unit'],
                'title' => $row['title'],
                'image' => $img, 
                'link' => $link,
            ];
        } else {
            $_SESSION[$module_data . '_cart'][$id]['num'] += $num;
        }

        $contents_msg = 'OK_Đã thêm ' . $row['title'] . ' vào giỏ hàng';
    } else {
        $contents_msg = 'ERR_Sản phẩm không tồn tại';
    }
} else {
    $contents_msg = 'ERR_Tham số không hợp lệ';
}

// Xuất JSON khi gọi ?t=json
if ($type == 'json') {
    $cart_count = !empty($_SESSION[$module_data . '_cart']) ? count($_SESSION[$module_data . '_cart']) : 0;

    $response = [
        'status' => (strpos($contents_msg, 'OK_') === 0) ? 'success' : 'error',
        'message' => substr($contents_msg, 3), // bỏ tiền tố OK_/ERR_
        'cart_count' => $cart_count,
        'image' => $img, // lưu URL đầy đủ
    ];

    header('Content-Type: application/json; charset=utf-8');
    error_log("== DEBUG setcart.php == ID: $id | num: $num | POST: " . json_encode($_POST) . " | GET: " . json_encode($_GET));
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit();
}

// Mặc định trả về HTML text
include NV_ROOTDIR . '/includes/header.php';
echo nv_unhtmlspecialchars($contents_msg);
include NV_ROOTDIR . '/includes/footer.php';
