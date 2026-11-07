<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3-6-2010 0:14
 */

// if( ! defined( 'NV_IS_MOD_SHOPS' ) ) die( 'Stop!!!' );

// $page_title = $lang_module['order_view'];

// $order_id = $nv_Request->get_int( 'order_id', 'get', 0 );
// $checkss = $nv_Request->get_string( 'checkss', 'get', '' );
// if( $order_id > 0 and $checkss == md5( $order_id . $global_config['sitekey'] . session_id() ) )
// {
// 	$data_pro = array();
// 	$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=';

// 	// Thong tin don hang
// 	$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders WHERE order_id=' . $order_id );
// 	if( $result->rowCount() == 0 )
// 	{
// 		Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
// 		die();
// 	}
// 	$data = $result->fetch();

// 	// Thong tin van chuyen
// 	$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_shipping WHERE order_id = ' . $data['order_id'] );
// 	$data_shipping = $result->fetch();

// 	$result = $db->query( 'SELECT amount FROM ' . $db_config['prefix'] . '_' . $module_data . '_coupons_history WHERE order_id=' . $data['order_id'] );
// 	$data['coupons'] = $result->fetch();

// 	if( empty( $data ) )
// 	{
// 		Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=cart', true ) );
// 		die();
// 	}

// 	// Sua don hang
// 	if( $nv_Request->isset_request( 'edit', 'get' ) )
// 	{
// 		if( $data['transaction_status'] != 4 )
// 		{
// 			$_SESSION[$module_data . '_order_info'] = array(
// 				'order_id' => $data['order_id'],
// 				'order_code' => $data['order_code'],
// 				'money_unit' => $data['unit_total'],
// 				'order_name' => $data['order_name'],
// 				'order_email' => $data['order_email'],
// 				'order_address' => $data['order_address'],
// 				'order_phone' => $data['order_phone'],
// 				'order_note' => $data['order_note'],
// 				'unit_total' => $data['unit_total'],
// 				'order_url' => $link . 'payment&amp;order_id=' . $data['order_id'] . '&amp;checkss=' . $checkss,
// 				'order_edit' => $link . 'payment&amp;unedit&amp;order_id=' . $data['order_id'] . '&amp;checkss=' . $checkss,
// 				'checked' => 1 );
// 		}
// 		Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=cart', true ) );
// 		die();
// 	}

// 	// Huy sua don hang
// 	if( $nv_Request->isset_request( 'unedit', 'get' ) )
// 	{
// 		if( isset( $_SESSION[$module_data . '_cart'] ) )
// 		{
// 			unset( $_SESSION[$module_data . '_cart'] );
// 		}

// 		if( isset( $_SESSION[$module_data . '_order_info'] ) )
// 		{
// 			unset( $_SESSION[$module_data . '_order_info'] );
// 		}
// 		Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=payment&order_id=' . $data['order_id'] . '&checkss=' . $checkss );
// 		die();
// 	}

// 	if( ! empty( $_SESSION[$module_data . '_order_info'] ) )
// 	{
// 		$lang_module['order_edit'] = $lang_module['order_unedit'];
// 	}

// 	// Thong tin chi tiet mat hang trong don hang
// 	$listid = $listnum = $listprice = $listgroup = array();
// 	$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_id WHERE order_id=' . $order_id );
// 	while( $row = $result->fetch() )
// 	{
// 		$listid[] = $row['proid'];
// 		$listnum[] = $row['num'];
// 		$listprice[] = $row['price'];

// 		$result_group = $db->query( 'SELECT group_id FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_id_group WHERE order_i=' . $row['id'] );
// 		$group = array();
// 		while( list( $group_id ) = $result_group->fetch( 3 ) )
// 		{
// 			$group[] = $group_id;
// 		}
// 		$listgroup[] = $group;
// 	}

// 	$i = 0;
// 	foreach( $listid as $proid )
// 	{
// 		if( empty( $listprice[$i] ) ) $listprice[$i] = 0;
// 		if( empty( $listnum[$i] ) ) $listnum[$i] = 0;
// 		if( ! isset( $listgroup[$i] ) ) $listgroup[$i] = '';

// 		$temppro[$proid] = array( 'price' => $listprice[$i], 'num' => $listnum[$i], 'group' => $listgroup[$i] );

// 		$arrayid[] = $proid;
// 		$i++;
// 	}

// 	if( ! empty( $arrayid ) )
// 	{
// 		$templistid = implode( ',', $arrayid );

// 		$sql = 'SELECT t1.id, t1.listcatid, t1.publtime, t1.' . NV_LANG_DATA . '_title, t1.' . NV_LANG_DATA . '_alias, t1.' . NV_LANG_DATA . '_hometext, t2.' . NV_LANG_DATA . '_title, t1.money_unit, t1.discount_id FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows AS t1 LEFT JOIN ' . $db_config['prefix'] . '_' . $module_data . '_units AS t2 ON t1.product_unit = t2.id WHERE t1.id IN (' . $templistid . ') AND t1.status =1';
// 		$result = $db->query( $sql );
// 		while( list( $id, $listcatid, $publtime, $title, $alias, $hometext, $unit, $money_unit, $discount_id ) = $result->fetch( 3 ) )
// 		{
// 			$price = nv_get_price( $id, $pro_config['money_unit'], $temppro[$id]['num'], true );
// 			$data_pro[] = array(
// 				'id' => $id,
// 				'publtime' => $publtime,
// 				'title' => $title,
// 				'alias' => $alias,
// 				'hometext' => $hometext,
// 				'product_price' => $price['sale'],
// 				'product_unit' => $unit,
// 				'money_unit' => $money_unit,
// 				'discount_id' => $discount_id,
// 				'product_group' => $temppro[$id]['group'],
// 				'link_pro' => $link . $global_array_shops_cat[$listcatid]['alias'] . '/' . $alias . $global_config['rewrite_exturl'],
// 				'product_number' => $temppro[$id]['num']
// 			);
// 		}
// 	}

// 	// Xay dung cac url thanh toan truc tuyen
// 	$url_checkout = array();
// 	$intro_pay = '';

// 	if( intval( $data['transaction_status'] ) == - 1 )
// 	{
// 		$intro_pay = $lang_module['payment_none_pay'];
// 	}
// 	elseif( $data['transaction_status'] == 0 )
// 	{
// 		$sql = 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_payment WHERE active=1 ORDER BY weight ASC';
// 		$result = $db->query( $sql );

// 		while( $row = $result->fetch() )
// 		{
// 			if( file_exists( NV_ROOTDIR . '/modules/' . $module_file . '/payment/' . $row['payment'] . '.checkout_url.php' ) )
// 			{
// 				$payment_config = unserialize( nv_base64_decode( $row['config'] ) );
// 				$payment_config['paymentname'] = $row['paymentname'];
// 				$payment_config['domain'] = $row['domain'];

// 				$images_button = $row['images_button'];

// 				$url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;order_id=' . $order_id . '&amp;payment=' . $row['payment'] . '&amp;checksum=' . md5( $order_id . $row['payment'] . $global_config['sitekey'] . session_id() );

// 				if( ! empty( $images_button ) and file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $images_button ) )
// 				{
// 					$images_button = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $images_button;
// 				}

// 				$url_checkout[] = array(
// 					'name' => $row['paymentname'],
// 					'url' => $url,
// 					'images_button' => $images_button
// 				);
// 			}
// 		}

// 		// Get content intro
// 		$content_file = NV_ROOTDIR . '/' . NV_DATADIR . '/' . NV_LANG_DATA . '_' . $module_data . '_docpay_content.txt';
// 		if( file_exists( $content_file ) )
// 		{
// 			$intro_pay = file_get_contents( $content_file );
// 			$intro_pay = nv_editor_br2nl( $intro_pay );
// 		}
// 	}
// 	elseif( $data['transaction_status'] == 1 and $data['transaction_id'] > 0 )
// 	{
// 		if( $nv_Request->isset_request( 'cancel', 'get' ) )
// 		{
// 			$db->query( 'DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_transaction WHERE transaction_id = ' . $data['transaction_id'] );
// 			$db->query( 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_orders SET transaction_status=0, transaction_id = 0, transaction_count = 0 WHERE order_id=' . $order_id );
// 			Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=payment&order_id=' . $order_id . '&checkss=' . $checkss );
// 			die();
// 		}

// 		$payment = $db->query( 'SELECT payment FROM ' . $db_config['prefix'] . '_' . $module_data . '_transaction WHERE transaction_id=' . $data['transaction_id'] )->fetchColumn();
// 		$config = $db->query( "SELECT * FROM " . $db_config['prefix'] . "_" . $module_data . "_payment WHERE payment = '" . $payment . "'" )->fetch();
// 		$intro_pay = sprintf( $lang_module['order_by_payment'], $config['domain'], $config['paymentname'] );
// 	}
// 	if( $data['transaction_status'] == 4 )
// 	{
// 		$data['transaction_name'] = $lang_module['history_payment_yes'];
// 	}
// 	elseif( $data['transaction_status'] == 3 )
// 	{
// 		$data['transaction_name'] = $lang_module['history_payment_cancel'];
// 	}
// 	elseif( $data['transaction_status'] == 2 )
// 	{
// 		$data['transaction_name'] = $lang_module['history_payment_check'];
// 	}
// 	elseif( $data['transaction_status'] == 1 )
// 	{
// 		$data['transaction_name'] = $lang_module['history_payment_send'];
// 	}
// 	elseif( $data['transaction_status'] == 0 )
// 	{
// 		$data['transaction_name'] = $lang_module['history_payment_no'];
// 	}
// 	elseif( $data['transaction_status'] == - 1 )
// 	{
// 		$data['transaction_name'] = $lang_module['history_payment_wait'];
// 	}
// 	else
// 	{
// 		$data['transaction_name'] = 'ERROR';
// 	}

// 	// Lay so diem tich luy cua khach
// 	$point = 0;
// 	if( !empty( $user_info ) )
// 	{
// 		$result = $db->query( 'SELECT point_total FROM ' . $db_config['prefix'] . '_' . $module_data . '_point WHERE userid = ' . $user_info['userid'] );
// 		if( $result )
// 		{
// 			$point = $result->fetchColumn();
// 		}
// 	}

// 	$contents = call_user_func( 'payment', $data, $data_pro, $data_shipping, $url_checkout, $intro_pay, $point );

// 	include NV_ROOTDIR . '/includes/header.php';
// 	echo nv_site_theme( $contents );
// 	include NV_ROOTDIR . '/includes/footer.php';
// }
// elseif( $order_id > 0 and $nv_Request->isset_request( 'payment', 'get' ) and $nv_Request->isset_request( 'checksum', 'get' ) )
// {
// 	$checksum = $nv_Request->get_string( 'checksum', 'get' );
// 	$payment = $nv_Request->get_string( 'payment', 'get' );

// 	// Thong tin don hang
// 	$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders WHERE order_id=' . $order_id );
// 	$data = $result->fetch();

// 	if( empty( $data ) )
// 	{
// 		Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=cart', true ) );
// 		die();
// 	}

// 	// Thong tin chi tiet mat hang trong don hang
// 	$listid = $listnum = $listprice = $listgroup = array();
// 	$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_id WHERE order_id=' . $order_id );
// 	while( $row = $result->fetch() )
// 	{
// 		$listid[] = $row['proid'];
// 		$listnum[] = $row['num'];
// 		$listprice[] = $row['price'];
// 		$listgroup[] = $row['group_id'];
// 	}

// 	if( isset( $data['transaction_status'] ) and intval( $data['transaction_status'] ) == 0 and preg_match( '/^[a-zA-Z0-9]+$/', $payment ) and $checksum == md5( $order_id . $payment . $global_config['sitekey'] . session_id() ) and file_exists( NV_ROOTDIR . '/modules/' . $module_file . '/payment/' . $payment . '.checkout_url.php' ) )
// 	{
// 		$config = $db->query( "SELECT * FROM " . $db_config['prefix'] . "_" . $module_data . "_payment WHERE payment = '" . $payment . "'" )->fetch();
// 		$payment_config = unserialize( nv_base64_decode( $config['config'] ) );

// 		// Cap nhat cong thanh toan
// 		$transaction_status = 1;
// 		$payment_id = 0;
// 		$payment_amount = 0;
// 		$payment_data = '';

// 		$userid = ( defined( 'NV_IS_USER' ) ) ? $user_info['userid'] : 0;

// 		$transaction_id = $db->insert_id( "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_transaction (transaction_id, transaction_time, transaction_status, order_id, userid, payment, payment_id, payment_time, payment_amount, payment_data) VALUES (NULL, " . NV_CURRENTTIME . ", '" . $transaction_status . "', '" . $order_id . "', '" . $userid . "', '" . $payment . "', '" . $payment_id . "', " . NV_CURRENTTIME . ", '" . $payment_amount . "', '" . $payment_data . "')" );

// 		$db->query( 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_orders SET transaction_status=' . $transaction_status . ' , transaction_id = ' . $transaction_id . ' , transaction_count = 1 WHERE order_id=' . $order_id );

// 		require_once NV_ROOTDIR . '/modules/' . $module_file . '/payment/' . $payment . '.checkout_url.php';
// 	}
// 	else if( $result->rowCount() > 0 )
// 	{
// 		$url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&order_id=' . $order_id . '&checkss=' . md5( $order_id . $global_config['sitekey'] . session_id() );
// 	}
// 	else
// 	{
// 		$url = NV_BASE_SITEURL;
// 	}
// 	Header( 'Location: ' . $url );
// 	die();
// }
// else
// {
// 	Header( 'Location: ' . NV_BASE_SITEURL );
// 	die();
// }


if (!defined('NV_IS_MOD_SHOPS')) die('Stop!!!');

global $module_data, $module_name, $pro_config;

// Existing order links must work after checkout has cleared the cart.
if ($nv_Request->get_int('order_id', 'get', 0) > 0) {
    require NV_ROOTDIR . '/modules/' . $module_file . '/funcs/order.php';
    exit();
}

// Kiểm tra giỏ hàng rỗng → chuyển hướng về giỏ hàng
if (empty($_SESSION[$module_data . '_cart'])) {
    header('Location: ' . NV_BASE_SITEURL . 'index.php?' 
        . NV_LANG_VARIABLE . '=vi&' . NV_NAME_VARIABLE . '=' . $module_name 
        . '&' . NV_OP_VARIABLE . '=cart');
    exit();
}
// error_log(NV_BASE_SITEURL . 'index.php?' 
//         . NV_LANG_VARIABLE . '=vi&' . NV_NAME_VARIABLE . '=' . $module_name 
//         . '&' . NV_OP_VARIABLE . '=cart');

$payment_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=payment';
$payment_checkss = md5($client_info['session_id'] . $global_config['sitekey'] . 'payment');
$payment_profile_ready = false;
$payment_submit_error = false;
$payment_invoice = nv_shops_invoice_read($nv_Request);
$payment_invoice_errors = array();
if (defined('NV_IS_USER')) {
    // Allow legacy databases to render checkout before delivery fields are migrated.
    $nv_frontend_diagnostic_stage = 'checkout_profile:before';
    $payment_profile = $db->query('SELECT * FROM ' . NV_USERS_GLOBALTABLE . '_info WHERE userid=' . intval($user_info['userid']))->fetch();
    if ($payment_profile && (!array_key_exists('phone', $payment_profile) || !array_key_exists('address', $payment_profile))) {
        error_log('[shops-checkout] Missing delivery profile columns phone/address; run tools/setup_checkout_profile.php on hosting.');
    }
    $nv_frontend_diagnostic_stage = 'checkout_profile:done';
    $payment_customer = array(
        'order_name' => nv_show_name_user($user_info['first_name'], $user_info['last_name'], $user_info['username']),
        'order_email' => $user_info['email'],
        'order_phone' => trim($payment_profile['phone'] ?? ''),
        'order_address' => trim($payment_profile['address'] ?? '')
    );
    $payment_profile_ready = $payment_customer['order_name'] !== ''
        && nv_check_valid_email($payment_customer['order_email']) === ''
        && preg_match('/^\+?[0-9][0-9\s().-]{8,19}$/', $payment_customer['order_phone'])
        && $payment_customer['order_address'] !== '';

    if ($nv_Request->get_int('postorder', 'post', 0) === 1 && $payment_profile_ready) {
        if (hash_equals($payment_checkss, $nv_Request->get_title('payment_checkss', 'post', ''))) {
            $payment_invoice_errors = nv_shops_invoice_validate($payment_invoice);
            if (empty($payment_invoice_errors)) {
                // Use saved account details instead of customer-supplied checkout fields.
                foreach ($payment_customer as $field => $value) {
                    $_POST[$field] = $value;
                }
                // The current checkout has no separate shipping form.
                $_POST['order_shipping'] = 0;
                require NV_ROOTDIR . '/modules/' . $module_file . '/funcs/order.php';
                exit();
            }
        } else {
            $payment_submit_error = true;
        }
    }
}

// Lấy giỏ hàng từ session
$cart = $_SESSION[$module_data . '_cart'] ?? [];
$items = [];
$total = 0;
$eligible_total = 0;
$coupon = array();
$coupon_session = $_SESSION[$module_data . '_coupons'] ?? array();
if (!empty($coupon_session['check']) && !empty($coupon_session['code'])) {
    $coupon = nv_shops_get_coupon_info($coupon_session['code']);
}

// Fetch fallback images together instead of querying once per cart line.
$payment_image_ids = array();
foreach ($cart as $cart_key => $cart_row) {
    if (!empty($cart_row['order']) && empty($cart_row['variant_image']) && empty($cart_row['img_pro'])) {
        $image_pid = isset($cart_row['proid']) ? intval($cart_row['proid']) : intval($cart_key);
        if ($image_pid > 0) $payment_image_ids[$image_pid] = $image_pid;
    }
}
$payment_images = $payment_variant_images = array();
if ($payment_image_ids) {
    $image_ids_sql = implode(',', $payment_image_ids);
    try {
        $image_result = $db->query('SELECT id, homeimgfile, homeimgthumb FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows WHERE id IN (' . $image_ids_sql . ')');
        while ($image_row = $image_result->fetch()) $payment_images[$image_row['id']] = $image_row;
    } catch (Exception $e) {
        $payment_images = array();
    }
    try {
        $image_result = $db->query('SELECT product_id, image FROM ' . $db_config['prefix'] . '_' . $module_data . "_product_variants WHERE product_id IN (" . $image_ids_sql . ") AND image != '' ORDER BY id ASC");
        while ($image_row = $image_result->fetch()) {
            if (!isset($payment_variant_images[$image_row['product_id']])) {
                $payment_variant_images[$image_row['product_id']] = $image_row['image'];
            }
        }
    } catch (Exception $e) {
        // Older installations may not have a variants table.
        $payment_variant_images = array();
    }
}

foreach ($cart as $pid => $row) {
    if (empty($row['order'])) continue;
    $cart_id = $pid;
    $pid = isset($row['proid']) ? intval($row['proid']) : intval($pid);
    $qty = intval($row['num'] ?? 1);
    $price = floatval($row['price'] ?? 0);
    if ($price <= 0) {
        $current_price = nv_get_price($pid, $pro_config['money_unit'], $qty, true);
        $price = $current_price['sale'];
    }
    $subtotal = $qty * $price;
    $total += $subtotal;
    if (!empty($coupon['product']) && in_array($pid, $coupon['product'])) $eligible_total += $subtotal;
    $product_image = '';

    if (!empty($row['variant_image'])) {
        $product_image = $row['variant_image'];
    } elseif (!empty($row['img_pro'])) {
        $product_image = $row['img_pro'];
    }

    if (empty($product_image)) {
        $row_homeimgfile = '';
        $row_homeimgthumb = 0;
        try {
            $product_row = $payment_images[$pid] ?? array();
            if (!empty($product_row)) {
                $row_homeimgfile = $product_row['homeimgfile'];
                $row_homeimgthumb = $product_row['homeimgthumb'];
                if (!empty($payment_variant_images[$pid])) {
                    $row_homeimgfile = nv_shops_normalize_variant_image($payment_variant_images[$pid]);
                    $row_homeimgthumb = 3;
                }
                if ($row_homeimgthumb == 1) {
                    $product_image = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $row_homeimgfile;
                } elseif ($row_homeimgthumb == 2) {
                    $product_image = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row_homeimgfile;
                } elseif ($row_homeimgthumb == 3) {
                    $product_image = $row_homeimgfile;
                }
            }
        } catch (Exception $e) {
            $product_image = '';
        }
    }

    if (empty($product_image)) {
        $product_image = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
    }

    $items[] = [
        'id' => $cart_id,
        'proid' => $pid,
        'title' => $row['title_pro'] ?? 'San pham ' . $pid,
        'link_pro' => $row['link_pro'] ?? '#',
        'img_pro' => $product_image,
        'qty' => $qty,
        'price' => number_format($price, 0, ',', '.'),
        'price_raw' => $price,
        'subtotal' => number_format($subtotal, 0, ',', '.'),
        'variant_label' => $row['variant_label'] ?? ''
    ];
}

$coupon_calc = nv_shops_get_coupon_discount($coupon, $total, $eligible_total);
if ($coupon_calc['is_valid']) $total = $coupon_calc['final_total'];
if (($pro_config['money_unit'] ?? 'VND') === 'VND') $total = round($total);

// Chuẩn bị dữ liệu cho template payment.tpl
$xtpl = new XTemplate("payment.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('CART_SUGGESTIONS', nv_shops_cart_suggestions($total, count($items), array_column($items, 'proid')));
$xtpl->assign('PAYMENT_ACTION', htmlspecialchars($payment_url, ENT_QUOTES, 'UTF-8'));
$xtpl->assign('PAYMENT_CHECKSS', $payment_checkss);
$xtpl->assign('INVOICE_FORM', nv_shops_invoice_form($payment_invoice, $payment_invoice_errors));
$payment_banking_allowed = nv_shops_transfer_allowed($total, $pro_config['money_unit'] ?? 'VND');
$payment_banking = $payment_banking_allowed && $nv_Request->get_title('payment_method', 'post', 'cod') === 'banking';
$xtpl->assign('PAYMENT_COD_CHECKED', $payment_banking ? '' : 'checked');
$xtpl->assign('PAYMENT_BANKING_CHECKED', $payment_banking ? 'checked' : '');
$xtpl->assign('PAYMENT_BANKING_DISABLED', $payment_banking_allowed ? '' : 'disabled aria-describedby="bankingAvailabilityNotice"');
if (!$payment_banking_allowed) $xtpl->parse('main.banking_unavailable');
$xtpl->assign('BANK_TRANSFER_PANEL', $payment_banking_allowed ? nv_shops_transfer_panel($total, nv_shops_transfer_reference(), $pro_config['money_unit'] ?? 'VND') : '');
if (!defined('NV_IS_USER')) {
    $auth_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=';
    $return_url = '&nv_redirect=' . rawurlencode(nv_base64_encode($payment_url));
    $xtpl->assign('LOGIN_URL', htmlspecialchars($auth_url . 'login' . $return_url, ENT_QUOTES, 'UTF-8'));
    $xtpl->assign('REGISTER_URL', htmlspecialchars($auth_url . 'register' . $return_url, ENT_QUOTES, 'UTF-8'));
    $xtpl->parse('main.auth_required');
} elseif (!$payment_profile_ready) {
    $profile_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=editinfo&nv_redirect=' . rawurlencode(nv_base64_encode($payment_url));
    $xtpl->assign('PROFILE_URL', htmlspecialchars($profile_url, ENT_QUOTES, 'UTF-8'));
    $xtpl->parse('main.profile_required');
} else {
    $profile_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=editinfo&nv_redirect=' . rawurlencode(nv_base64_encode($payment_url));
    $xtpl->assign('PROFILE_URL', htmlspecialchars($profile_url, ENT_QUOTES, 'UTF-8'));
    $xtpl->assign('DELIVERY_PHONE', htmlspecialchars($payment_customer['order_phone'], ENT_QUOTES, 'UTF-8'));
    $xtpl->assign('DELIVERY_ADDRESS', nl2br(htmlspecialchars(nv_br2nl($payment_customer['order_address']), ENT_QUOTES, 'UTF-8')));
    $xtpl->parse('main.checkout_details');
    $xtpl->parse('main.authenticated');
}
if ($payment_submit_error) {
    $xtpl->parse('main.submit_error');
}
$xtpl->assign('unit', $pro_config['money_unit'] ?? 'VND');
$xtpl->assign('dateup', date('d/m/Y'));
$xtpl->assign('moment', date('H:i:s'));
$xtpl->assign('order_total', number_format($total, 0, ',', '.'));

// Parse sản phẩm
$no = 1;
foreach ($items as $product) {
    $xtpl->assign('pro_no', $no++);
    $xtpl->assign('title', $product['title']);
    $xtpl->assign('variant_label', $product['variant_label'] ?? '');
    if (!empty($product['variant_label'])) {
        $xtpl->parse('main.loop.variant');
    }
    $xtpl->assign('link_pro', $product['link_pro']);
    $xtpl->assign('product_number', $product['qty']);
    $xtpl->assign('product_unit', $pro_config['money_unit'] ?? 'VND');
    $xtpl->assign('product_price', $product['price']);
    if ($product['price_raw'] > 0 && !empty($pro_config['active_price'])) {
        $xtpl->parse('main.loop.shipping_note');
    }
    $xtpl->assign('product_price_total', $product['subtotal']);
    $xtpl->assign('img_pro', $product['img_pro']);
    $xtpl->parse('main.loop');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

// Hiển thị bằng theme NukeViet
$page_title = $lang_module['payment_title'] ?? 'Thanh toán';
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
