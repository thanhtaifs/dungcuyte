<?php
if (!defined('NV_IS_MOD_SHOPS')) die('Stop!!!');

// Evaluate both thresholds in VND, regardless of the storefront currency.
function nv_shops_low_order($total, $item_count)
{
    global $pro_config;
    if (empty($item_count) || empty($pro_config['active_price'])) return false;
    $amount = nv_currency_conversion(max(0, (float)$total), $pro_config['money_unit'], 'VND');
    return round($amount) <= 200000;
}

function nv_shops_cart_suggestions($total, $item_count, $checkout_product_ids = null)
{
    global $db, $db_config, $module_data, $module_name, $module_file, $module_upload;
    global $module_info, $pro_config, $global_array_shops_cat, $global_config;

    if (!nv_shops_low_order($total, $item_count)) return '';
    $template_dir = NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file;
    if (!file_exists($template_dir . '/cart_suggestions.tpl')) {
        $template_dir = NV_ROOTDIR . '/modules/' . $module_file . '/templates';
    }
    $xtpl = new XTemplate('cart_suggestions.tpl', $template_dir);
    $remaining = 200001 - round(nv_currency_conversion(max(0, (float)$total), $pro_config['money_unit'], 'VND'));
    $xtpl->assign('REMAINING', nv_number_format(max(1, $remaining)) . 'đ');
    $exclude = array();
    foreach (($_SESSION[$module_data . '_cart'] ?? array()) as $key => $line) {
        $exclude[] = (int)($line['proid'] ?? $key);
    }
    $checkout_product_ids = $checkout_product_ids === null ? $exclude : $checkout_product_ids;
    $checkout_product_ids = array_unique(array_filter(array_map('intval', $checkout_product_ids), function ($id) { return $id > 0; }));
    $categories = array();
    if ($checkout_product_ids) {
        $category_rows = $db->query('SELECT DISTINCT listcatid FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows WHERE id IN (' . implode(',', $checkout_product_ids) . ')');
        while ($category = $category_rows->fetch()) $categories[] = (int)$category['listcatid'];
    }
    if (!$categories) {
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
    $where = 'status = 1 AND showprice = 1 AND contact_price = 0';
    $where .= ' AND listcatid IN (' . implode(',', array_unique($categories)) . ')';
    if ($exclude) $where .= ' AND id NOT IN (' . implode(',', $exclude) . ')';
    $rows = $db->query('SELECT id, listcatid, product_number, money_unit, ' . NV_LANG_DATA . '_title AS title, ' . NV_LANG_DATA . '_alias AS alias, homeimgfile, homeimgthumb FROM '
        . $db_config['prefix'] . '_' . $module_data . '_rows WHERE ' . $where . ' ORDER BY product_price ASC, id DESC');
    $count = 0;
    $variants_supported = true;
    while ($row = $rows->fetch()) {
        if (empty($global_array_shops_cat[$row['listcatid']])) continue;
        if (!nv_user_in_groups($global_array_shops_cat[$row['listcatid']]['groups_view'])) continue;
        $variants = array();
        if ($variants_supported) {
            try {
                $variant_rows = $db->query('SELECT price, stock FROM ' . $db_config['prefix'] . '_' . $module_data
                    . '_product_variants WHERE product_id = ' . (int)$row['id'] . ' AND status = 1 ORDER BY price ASC');
                while ($variant = $variant_rows->fetch()) $variants[] = $variant;
            } catch (Exception $error) {
                // Older installations may not have a variants table.
                $variants_supported = false;
            }
        }
        if (!$variants && (int)$row['product_number'] <= 0) continue;
        $price = nv_get_price((int)$row['id'], $pro_config['money_unit'], 1, true);
        if ($variants) {
            // Variant stock is authoritative; the parent quantity can remain zero.
            $variant_sale = null;
            $discount = (float)str_replace(array(',', ' '), array('.', ''), $price['discount_percent']);
            foreach ($variants as $variant) {
                if ((int)$variant['stock'] <= 0 || (float)$variant['price'] <= 0) continue;
                $sale = nv_currency_conversion((float)$variant['price'], $row['money_unit'], $pro_config['money_unit']);
                if ($discount > 0) {
                    $sale = $price['discount_unit'] === '%' ? $sale * (1 - $discount / 100) : $sale - $discount;
                }
                $sale_vnd = nv_currency_conversion($sale, $pro_config['money_unit'], 'VND');
                if ($sale_vnd < 100 || round($sale_vnd) >= 100000) continue;
                if ($variant_sale === null || $sale < $variant_sale) $variant_sale = $sale;
            }
            if ($variant_sale === null) continue;
            $price['sale'] = $variant_sale;
            $price['sale_format'] = nv_number_format($variant_sale, nv_get_decimals($pro_config['money_unit']));
        }
        $vnd = nv_currency_conversion($price['sale'], $pro_config['money_unit'], 'VND');
        if ($vnd < 100 || round($vnd) >= 100000) continue;
        nv_shops_apply_variant_image($row['id'], $row['homeimgfile'], $row['homeimgthumb']);
        $image = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
        if ($row['homeimgthumb'] == 1) $image = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $row['homeimgfile'];
        elseif ($row['homeimgthumb'] == 2) $image = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['homeimgfile'];
        elseif ($row['homeimgthumb'] == 3) $image = $row['homeimgfile'];
        $url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '='
            . $global_array_shops_cat[$row['listcatid']]['alias'] . '/' . $row['alias'] . $global_config['rewrite_exturl'];
        $xtpl->assign('PRODUCT', array(
            'title' => htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'),
            'image' => htmlspecialchars($image, ENT_QUOTES, 'UTF-8'),
            'url' => htmlspecialchars(nv_url_rewrite($url, true), ENT_QUOTES, 'UTF-8'),
            'price' => $price['sale_format'] . ' ' . $price['unit']
        ));
        $xtpl->parse('main.products.item');
        if (++$count >= 6) break;
    }
    if ($count) $xtpl->parse('main.products');
    $xtpl->parse('main');
    return $xtpl->text('main');
}

// Reuse the same coupon calculation as the cart and checkout pages.
function nv_shops_cart_totals($cart)
{
    global $module_data, $pro_config;
    $subtotal = $eligible = 0;
    $session = $_SESSION[$module_data . '_coupons'] ?? array();
    $coupon = !empty($session['check']) && !empty($session['code']) ? nv_shops_get_coupon_info($session['code']) : array();
    foreach ($cart as $key => $line) {
        $pid = (int)($line['proid'] ?? $key);
        $qty = max(0, (int)($line['num'] ?? 1));
        $price = (float)($line['price'] ?? 0);
        if ($price <= 0) $price = nv_get_price($pid, $pro_config['money_unit'], $qty, true)['sale'];
        $amount = $qty * $price;
        $subtotal += $amount;
        if (!empty($coupon['product']) && in_array($pid, $coupon['product'])) $eligible += $amount;
    }
    $discount = nv_shops_get_coupon_discount($coupon, $subtotal, $eligible);
    $total = $discount['is_valid'] ? $discount['final_total'] : $subtotal;
    if ($pro_config['money_unit'] === 'VND') $total = round($total);
    return array('subtotal' => $subtotal, 'discount' => $discount['is_valid'] ? $discount['discount_amount'] : 0, 'total' => $total);
}
