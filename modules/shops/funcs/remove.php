<?php
if (!defined('NV_IS_MOD_SHOPS')) die('Stop!!!');

global $module_data, $module_name;

$id = $nv_Request->get_int('id', 'post,get', 0);

$response = ['status' => 'error', 'message' => 'Sản phẩm không tồn tại trong giỏ'];

// Xóa sản phẩm khỏi session
if ($id > 0 && isset($_SESSION[$module_data . '_cart'][$id])) {
    unset($_SESSION[$module_data . '_cart'][$id]);
}

// Chuẩn bị dữ liệu cart để trả về, giống loadCart
$cart = $_SESSION[$module_data . '_cart'] ?? [];
$items = [];
$total = 0;
//error_log('clicked delete item from cart');
foreach ($cart as $pid => $row) {
    $qty = intval($row['num'] ?? 1);
    $price = floatval($row['price'] ?? 0);
    $subtotal = $qty * $price;
    $total += $subtotal;
    $items[] = [
        'id' => $pid,
        'title_pro' => $row['title_pro'] ?? "Sản phẩm $pid",
        'qty' => $qty,
        'img_pro' => $row['img_pro'] ? $row['img_pro'] : '#',
        'link_pro' => isset($row['link_pro']) ? $row['link_pro'] : '#',
        'price' => number_format($price, 0, ',', '.'),
        'subtotal' => number_format($subtotal, 0, ',', '.')
    ];
}

$response = [
    'status' => 'success',
    'message' => 'Đã xóa sản phẩm',
    'items' => $items,
    'cart_count' => count($cart),
    'total' => number_format($total, 0, ',', '.')
];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit();
