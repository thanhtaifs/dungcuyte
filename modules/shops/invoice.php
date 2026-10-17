<?php
if (!defined('NV_IS_MOD_SHOPS')) die('Stop!!!');

function nv_shops_invoice_fields()
{
    return array(
        'invoice_name' => array('Tên đơn vị / người mua', 200),
        'invoice_tax_code' => array('Mã số thuế', 30),
        'invoice_address' => array('Địa chỉ xuất hóa đơn', 500),
        'invoice_email' => array('Email nhận hóa đơn', 250)
    );
}

function nv_shops_invoice_read($request)
{
    $data = array('invoice_requested' => $request->get_int('invoice_requested', 'post', 0) === 1);
    foreach (nv_shops_invoice_fields() as $key => $field) {
        $data[$key] = $data['invoice_requested']
            ? trim($request->get_title($key, 'post', '', 1)) : '';
    }
    return $data;
}

function nv_shops_invoice_validate($data)
{
    $errors = array();
    if (empty($data['invoice_requested'])) return $errors;
    foreach (nv_shops_invoice_fields() as $key => $field) {
        $value = $data[$key] ?? '';
        if ($value === '') {
            $errors[$key] = 'Vui lòng nhập ' . $field[0] . '.';
        } elseif (nv_strlen($value) > $field[1]) {
            $errors[$key] = $field[0] . ' không được vượt quá ' . $field[1] . ' ký tự.';
        }
    }
    if (!empty($data['invoice_email']) && nv_check_valid_email($data['invoice_email']) !== '') {
        $errors['invoice_email'] = 'Email nhận hóa đơn không hợp lệ.';
    }
    return $errors;
}

function nv_shops_invoice_note($note, $data)
{
    // Keep invoice information in the order note so existing admin, email and print views include it.
    $note = preg_replace('/\[Thông tin xuất hóa đơn\]\R.*?\[\/Thông tin xuất hóa đơn\]/su', '', $note);
    $note = trim(str_replace('Yêu cầu xuất hóa đơn mua hàng.', '', $note));
    $lines = array('[Thông tin xuất hóa đơn]', 'Yêu cầu xuất hóa đơn: ' . (!empty($data['invoice_requested']) ? 'Có' : 'Không'));
    if (!empty($data['invoice_requested'])) {
        foreach (nv_shops_invoice_fields() as $key => $field) {
            $lines[] = $field[0] . ': ' . preg_replace('/[\r\n]+/', ' ', $data[$key] ?? '');
        }
    }
    $lines[] = '[/Thông tin xuất hóa đơn]';
    return ($note !== '' ? $note . "\n" : '') . implode("\n", $lines);
}

function nv_shops_invoice_from_note($note)
{
    $data = array('invoice_requested' => strpos($note, 'Yêu cầu xuất hóa đơn mua hàng.') !== false);
    if (preg_match('/\[Thông tin xuất hóa đơn\]\R(.*?)\[\/Thông tin xuất hóa đơn\]/su', $note, $match)) {
        $data['invoice_requested'] = strpos($match[1], 'Yêu cầu xuất hóa đơn: Có') !== false;
        foreach (nv_shops_invoice_fields() as $key => $field) {
            if (preg_match('/^' . preg_quote($field[0], '/') . ': (.*)$/mu', $match[1], $value)) {
                $data[$key] = trim($value[1]);
            }
        }
    }
    return $data;
}

function nv_shops_invoice_form($data = array(), $errors = array())
{
    global $module_info, $module_file;
    $xtpl = new XTemplate('invoice_form.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
    $xtpl->assign('INVOICE_CHECKED', !empty($data['invoice_requested']) ? 'checked' : '');
    foreach (nv_shops_invoice_fields() as $key => $field) {
        $xtpl->assign('FIELD', array(
            'name' => $key,
            'label' => $field[0],
            'maxlength' => $field[1],
            'type' => $key === 'invoice_email' ? 'email' : 'text',
            'value' => htmlspecialchars($data[$key] ?? '', ENT_QUOTES, 'UTF-8', false)
        ));
        $xtpl->parse('main.field');
    }
    foreach ($errors as $key => $message) {
        if (strpos($key, 'invoice_') === 0) {
            $xtpl->assign('MESSAGE', htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
            $xtpl->parse('main.error');
        }
    }
    $xtpl->parse('main');
    return $xtpl->text('main');
}
