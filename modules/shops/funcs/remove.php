<?php
if (!defined('NV_IS_MOD_SHOPS')) die('Stop!!!');

global $module_data, $module_name;

$id = $nv_Request->get_title('id', 'post,get', '');

$response = ['status' => 'error', 'message' => 'Sản phẩm không tồn tại trong giỏ'];

// Xóa sản phẩm khỏi session
if ($id !== '' && isset($_SESSION[$module_data . '_cart'][$id])) {
    unset($_SESSION[$module_data . '_cart'][$id]);
}

// Chuẩn bị dữ liệu cart để trả về, giống loadCart
$cart = $_SESSION[$module_data . '_cart'] ?? [];
$items = [];
$total = 0;
//error_log('clicked delete item from cart');
foreach ($cart as $pid => $row) {
    $cart_id = $pid;
    $pid = (int)($row['proid'] ?? $pid);
    $qty = intval($row['num'] ?? 1);
    $price = floatval($row['price'] ?? 0);
    if ($price <= 0) $price = nv_get_price($pid, $pro_config['money_unit'], $qty, true)['sale'];
    $subtotal = $qty * $price;
    $total += $subtotal;
    $items[] = [
        'id' => $cart_id,
        'title_pro' => $row['title_pro'] ?? "Sản phẩm $pid",
        'qty' => $qty,
        'img_pro' => !empty($row['img_pro']) ? $row['img_pro'] : '#',
        'link_pro' => isset($row['link_pro']) ? $row['link_pro'] : '#',
        'price' => number_format($price, 0, ',', '.'),
        'price_raw' => $price,
        'subtotal' => number_format($subtotal, 0, ',', '.'),
        'variant_label' => $row['variant_label'] ?? ''
    ];
}

$totals = nv_shops_cart_totals($cart);
$total = $totals['total'];
$response = [
    'status' => 'success',
    'message' => 'Đã xóa sản phẩm',
    'items' => $items,
    'cart_count' => count($cart),
    'total' => number_format($total, 0, ',', '.'),
    'subtotal' => number_format($totals['subtotal'], 0, ',', '.'),
    'discount' => number_format($totals['discount'], 0, ',', '.')
];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit();
