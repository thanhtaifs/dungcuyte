<?php

if (!defined('NV_IS_MOD_SHOPS')) die('Stop!!!');
//error_log('=== setcart.php shop loaded OK ===');
$id  = $nv_Request->get_int('id', 'post,get', 0);
$num = $nv_Request->get_int('num', 'post,get', 1);
$type = $nv_Request->get_string('t', 'get', 'text'); // text | json
$buy_now = $nv_Request->get_int('buy_now', 'post,get', 0); // 0 = thêm giỏ, 1 = mua ngay
$variant_id = $nv_Request->get_title('variant_id', 'post,get', '');
$variant_label = $nv_Request->get_title('variant_label', 'post,get', '');
$variant_price = $nv_Request->get_float('variant_price', 'post,get', 0);
$contents_msg = '';

//error_log("=== setcart.php called ===");
//error_log("id: $id, num: $num, buy_now: $buy_now, variant_id: $variant_id, variant_price: $variant_price");

$row = $db->query("
    SELECT id, listcatid, " . NV_LANG_DATA . "_title AS title," . NV_LANG_DATA . "_alias AS alias,homeimgfile, product_price, money_unit, discount_id, contact_price
    FROM " . $db_config['prefix'] . "_" . $module_data . "_rows 
    WHERE id = " . intval($id)
)->fetch();

// if ($id > 0) {
//     // Lấy sản phẩm
//     $row = $db->query("
//         SELECT id, listcatid, " . NV_LANG_DATA . "_title AS title," . NV_LANG_DATA . "_alias AS alias,homeimgfile, product_price, money_unit, discount_id, contact_price
//         FROM " . $db_config['prefix'] . "_" . $module_data . "_rows 
//         WHERE id = " . intval($id)
//     )->fetch();

//     if ($row) {
//         $price = $row['product_price'];

//         if (!empty($row['contact_price']) || intval($price) < 101) {
//             $contents_msg = 'ERR_Sản phẩm cần liên hệ để đặt hàng.';
            
//             if ($type == 'json') {
//                 $response = [
//                     'status' => 'error',
//                     'message' => 'Sản phẩm này không có giá. Vui lòng liên hệ để được tư vấn.',
//                     'cart_count' => !empty($_SESSION[$module_data . '_cart']) ? count($_SESSION[$module_data . '_cart']) : 0,
//                 ];
//                 header('Content-Type: application/json; charset=utf-8');
//                 echo json_encode($response, JSON_UNESCAPED_UNICODE);
//                 exit();
//             }

//             include NV_ROOTDIR . '/includes/header.php';
//             echo nv_unhtmlspecialchars($contents_msg);
//             include NV_ROOTDIR . '/includes/footer.php';
//             exit();
//         }
        

//         $img = $row['homeimgfile'] 
//         ? NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $row['homeimgfile']
//         : NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $row['homeimgthumb'] ?? '';
//        $listcatid = $row['listcatid'];
//        $alias = $row['alias'];
//        $link = NV_BASE_SITEURL
//         . 'index.php?'
//         . NV_LANG_VARIABLE . '=' . NV_LANG_DATA
//         . '&' . NV_NAME_VARIABLE . '=' . $module_name
//         . '&' . NV_OP_VARIABLE . '='
//         . $global_array_shops_cat[$listcatid]['alias'] . '/' 
//         . $alias
//         . $global_config['rewrite_exturl'];
//         // Áp dụng giảm giá nếu có
//         if (!empty($row['discount_id'])) {
//             $discount = $db->query("
//                 SELECT discount_percent 
//                 FROM " . $db_config['prefix'] . "_" . $module_data . "_discounts 
//                 WHERE id = " . intval($row['discount_id'])
//             )->fetchColumn();
//             if ($discount > 0) {
//                 $price -= ($price * $discount / 100);
//             }
//         }

//         // Cập nhật session giỏ hàng
//         if (!isset($_SESSION[$module_data . '_cart'][$id])) {
//             $_SESSION[$module_data . '_cart'][$id] = [
//                 'num' => $num,
//                 'price' => $price,
//                 'money_unit' => $row['money_unit'],
//                 'title_pro' => $row['title'],
//                 'img_pro' =>  $img,
//                 'link_pro' => $link,
//                 'group' => [],
//                 'order' => $buy_now ? 1 : 0
//             ];
//         } else {
//             $_SESSION[$module_data . '_cart'][$id]['num'] += $num;
//             if (!isset($_SESSION[$module_data . '_cart'][$id]['group'])) {
//                 $_SESSION[$module_data . '_cart'][$id]['group'] = [];
//             }
//             if ($buy_now) {
//                 $_SESSION[$module_data . '_cart'][$id]['order'] = 1;
//             }
//         }

//         $contents_msg = 'OK_Đã thêm ' . $row['title'] . ' vào giỏ hàng';
//     } else {
//         $contents_msg = 'ERR_Sản phẩm không tồn tại';
//     }
// } else {
//     $contents_msg = 'ERR_Tham số không hợp lệ';
// }

// // Xuất JSON khi gọi ?t=json
// if ($type == 'json') {
//     $cart_count = !empty($_SESSION[$module_data . '_cart']) ? count($_SESSION[$module_data . '_cart']) : 0;
//     $response = [
//         'status' => (strpos($contents_msg, 'OK_') === 0) ? 'success' : 'error',
//         'message' => substr($contents_msg, 3), // bỏ tiền tố OK_/ERR_
//         'cart_count' => $cart_count,       
//     ];

//     header('Content-Type: application/json; charset=utf-8');
//     //error_log("== DEBUG setcart.php == ID: $id | num: $num | POST: " . json_encode($_POST) . " | GET: " . json_encode($_GET));
//     echo json_encode($response, JSON_UNESCAPED_UNICODE);
//     exit();
// }

// // Mặc định trả về HTML text
// include NV_ROOTDIR . '/includes/header.php';
// echo nv_unhtmlspecialchars($contents_msg);
// include NV_ROOTDIR . '/includes/footer.php';


if (!$row) {
    $contents_msg = 'ER_Sản phẩm không tồn tại';
    return_output($contents_msg, $type);
}

if (!empty($variant_id) && empty($variant_label)) {
    $variant = $db->query("
        SELECT option_1, option_2
        FROM " . $db_config['prefix'] . "_" . $module_data . "_product_variants
        WHERE id = " . intval($variant_id) . " AND product_id = " . intval($id)
    )->fetch();

    if ($variant) {
        $parts = array_filter(array(
            trim($variant['option_1']),
            trim($variant['option_2'])
        ));
        $variant_label = implode(' - ', $parts);
    }
}

// ==========================
//  CHẶN SẢN PHẨM LIÊN HỆ
// ==========================
// Sử dụng hàm nv_get_price() để lấy giá đã áp dụng discount
$price_info = nv_get_price($id, $row['money_unit'], $num);

// $price_info trả về:
// - 'price' = giá gốc (original)
// - 'sale' = giá bán thực (sale price) 
// - 'discount_percent' = % hoặc số tiền giảm
// - 'discount_unit' = '%' hoặc currency

// Lưu giá bán vào giỏ hàng (đây là giá người dùng trả)
$price = $price_info['sale'];

if (!empty($variant_id) && $variant_price > 0) {
    $price = $variant_price;
}

if (!empty($row['contact_price']) || intval($price) < 101) {
    $contents_msg = 'ER_Sản phẩm cần liên hệ để được tư vấn.';
    return_output($contents_msg, $type);
}

// ==========================
//  LẤY THÔNG TIN ẢNH & LINK
// ==========================
$img = !empty($row['homeimgfile'])
    ? NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $row['homeimgfile']
    : NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . ($row['homeimgthumb'] ?? '');

$listcatid = $row['listcatid'];
$alias     = $row['alias'];

$link = NV_BASE_SITEURL
    . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA
    . '&' . NV_NAME_VARIABLE . '=' . $module_name
    . '&' . NV_OP_VARIABLE . '='
    . $global_array_shops_cat[$listcatid]['alias'] . '/' 
    . $alias
    . $global_config['rewrite_exturl'];

// ==========================
//  CẬP NHẬT SESSION GIỎ HÀNG
// ==========================
$cart_key = $module_data . '_cart';
$cart_item_key = $id;
if (!empty($variant_id)) {
    $cart_item_key = $id . '_' . preg_replace('/[^a-zA-Z0-9_\-]/', '', $variant_id);
}

if (!isset($_SESSION[$cart_key][$cart_item_key])) {
    $_SESSION[$cart_key][$cart_item_key] = [
        'proid'         => $id,
        'num'           => $num,
        'price'         => $price,
        'money_unit'    => $row['money_unit'],
        'title_pro'     => $row['title'],
        'img_pro'       => $img,
        'link_pro'      => $link,
        'variant_id'    => $variant_id,
        'variant_label' => $variant_label,
        'group'         => [],
        'order'         => $buy_now ? 1 : 0
    ];
} else {
    $_SESSION[$cart_key][$cart_item_key]['num'] += $num;
    $_SESSION[$cart_key][$cart_item_key]['price'] = $price;
    $_SESSION[$cart_key][$cart_item_key]['variant_id'] = $variant_id;
    $_SESSION[$cart_key][$cart_item_key]['variant_label'] = $variant_label;
    if ($buy_now) {
        $_SESSION[$cart_key][$cart_item_key]['order'] = 1;
    }
    //error_log("Updated cart: $cart_item_key, new num: " . $_SESSION[$cart_key][$cart_item_key]['num'] . ", price: $price");
}

$contents_msg = 'OK_Đã thêm ' . $row['title'] . ' vào giỏ hàng';

// ==========================
//  TRẢ OUTPUT (JSON / HTML)
// ==========================
return_output($contents_msg, $type);



function return_output($contents_msg, $type = '')
{
    global $module_data;

    $cart_count = !empty($_SESSION[$module_data . '_cart'])
        ? count($_SESSION[$module_data . '_cart'])
        : 0;

    if ($type === 'json') {
        $response = [
            'status' => (strpos($contents_msg, 'OK_') === 0) ? 'success' : 'error',
            'message' => substr($contents_msg, 3),
            'cart_count' => $cart_count
        ];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    include NV_ROOTDIR . '/includes/header.php';
    echo nv_unhtmlspecialchars($contents_msg);
    include NV_ROOTDIR . '/includes/footer.php';
    exit();
}
