<?php
if (!defined('NV_IS_MOD_SHOPS')) die('Stop!!!');

function nv_shops_transfer_reference()
{
    global $module_data;
    $key = $module_data . '_bank_reference';
    if (empty($_SESSION[$key]) || !preg_match('/^HG[A-F0-9]{12}$/D', $_SESSION[$key])) {
        $_SESSION[$key] = 'HG' . strtoupper(bin2hex(random_bytes(6)));
    }
    return $_SESSION[$key];
}

function nv_shops_transfer_note($method, $note, $reference = '')
{
    // Replace the previous checkout marker when an order is edited.
    $note = preg_replace('/^Thanh toan: (?:COD|Chuyen khoan MB Bank\. Noi dung: HG[A-F0-9]{12})\.\s*/', '', $note);
    $prefix = 'Thanh toan: COD.';
    if ($method === 'banking' && preg_match('/^HG[A-F0-9]{12}$/D', $reference)) {
        $prefix = 'Thanh toan: Chuyen khoan MB Bank. Noi dung: ' . $reference . '.';
    }
    return $prefix . ($note !== '' ? "\n" . $note : '');
}

function nv_shops_transfer_from_note($note)
{
    return preg_match('/^Thanh toan: Chuyen khoan MB Bank\. Noi dung: (HG[A-F0-9]{12})\./', $note, $match) ? $match[1] : '';
}

function nv_shops_transfer_data($amount, $reference, $currency = 'VND')
{
    if (!is_numeric($amount) || !is_finite((float)$amount) || $amount < 1 || $amount > 9999999999999
        || strtoupper($currency) !== 'VND' || !preg_match('/^HG[A-F0-9]{12}$/D', $reference)) return array();
    $amount = number_format(round((float)$amount), 0, '.', '');
    $query = http_build_query(array('amount' => $amount, 'addInfo' => $reference,
        'accountName' => 'CONG TY TNHH HUYNH GIA ALPHA'), '', '&', PHP_QUERY_RFC3986);
    return array('account' => '9193979799', 'account_display' => '9 19 39 79 799',
        'owner' => 'Công Ty TNHH Huỳnh Gia Alpha', 'bank' => 'MB Bank (Quân Đội) – Cần Thơ',
        'amount' => $amount, 'amount_display' => number_format((float)$amount, 0, ',', '.'),
        'reference' => $reference, 'qr_url' => 'https://img.vietqr.io/image/mbbank-9193979799-compact2.png?' . $query);
}

function nv_shops_transfer_panel($amount, $reference, $currency = 'VND')
{
    global $module_info, $module_file;
    $data = nv_shops_transfer_data($amount, $reference, $currency);
    if (!$data) return '<p class="alert alert-info">Đơn hàng này chưa hỗ trợ QR chuyển khoản. Vui lòng liên hệ cửa hàng.</p>';
    foreach ($data as &$value) $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    unset($value);
    $xtpl = new XTemplate('bank_transfer.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('BANK', $data);
    $xtpl->assign('ASSET_BASE', NV_BASE_SITEURL . 'themes/' . $module_info['template']);
    $xtpl->parse('main');
    return $xtpl->text('main');
}
