<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3-6-2010 0:14
 */

if( ! defined( 'NV_IS_MOD_SHOPS' ) ) die( 'Stop!!!' );

$order_info = array();
$order_old = array();
$coupons_code = '';
$coupons_check = 0;
$coupon_error = '';
$coupon_success = '';

if( isset( $_SESSION[$module_data . '_coupons']['code'] ) and isset( $_SESSION[$module_data . '_coupons']['check'] ) )
{
	$coupons_code = $_SESSION[$module_data . '_coupons']['code'];
	$coupons_check = $_SESSION[$module_data . '_coupons']['check'];
}
$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=';

if( $nv_Request->isset_request( 'coupon_apply_submit', 'post' ) )
{
	$coupons_code = $nv_Request->get_title( 'coupons_code', 'post', '' );
	if( empty( $coupons_code ) )
	{
		$coupon_error = $lang_module['coupons_empty'];
	}
	else
	{
		$coupon_data = nv_shops_get_coupon_info( $coupons_code );
		if( empty( $coupon_data ) )
		{
			$coupon_error = $lang_module['coupons_no_exist'];
			unset( $_SESSION[$module_data . '_coupons'] );
			$coupons_code = '';
			$coupons_check = 0;
		}
		else
		{
			$coupons_check = 1;
			$_SESSION[$module_data . '_coupons'] = array( 'check' => 1, 'code' => $coupons_code, 'discount' => 0 );
			$coupon_success = 'Đã áp dụng mã giảm giá: ' . $coupons_code;
		}
	}
}

if( $nv_Request->isset_request( 'coupon_clear_submit', 'post' ) )
{
	unset( $_SESSION[$module_data . '_coupons'] );
	$coupons_code = '';
	$coupons_check = 0;
	$coupon_success = 'Đã xóa mã giảm giá khỏi giỏ hàng';
}

// Coupons
if( $nv_Request->isset_request( 'coupons_check', 'post' ) )
{
	$data_content = array();
	$coupons_code = $nv_Request->get_title( 'coupons_code', 'post', '' );
	$contents = $error = '';
	if( empty( $coupons_code ) )
	{
		$error = $lang_module['coupons_empty'];
	}
	else
	{
		$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_coupons WHERE code = ' . $db->quote( $coupons_code ) );
		$num = $result->rowCount();
		$data_content = $result->fetch();
		if( empty( $data_content ) )
		{
			$error = $lang_module['coupons_no_exist'];
		}
	}

	if( empty( $error ) )
	{
		$_SESSION[$module_data . '_coupons'] = array( 'check' => 1, 'code' => $coupons_code, 'discount' => 0 );
	}

	$contents = call_user_func( 'coupons_info', $data_content, $coupons_check, $error );

	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';
	die();
}

if( $nv_Request->isset_request( 'coupons_clear', 'post' ) )
{
	unset( $_SESSION[$module_data . '_coupons'] );
	die();
}

$base_url_rewrite = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=cart', true );
if( $_SERVER['REQUEST_URI'] != $base_url_rewrite )
{
	Header( 'Location: ' . $base_url_rewrite );
	die( );
}

// Sửa đơn hàng
if( isset( $_SESSION[$module_data . '_order_info'] ) and !empty( $_SESSION[$module_data . '_order_info'] ) )
{
	$order_info = $_SESSION[$module_data . '_order_info'];
	$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders WHERE order_id=' . $order_info['order_id'] );

	if( $result->rowCount() == 0 )
	{
		unset( $_SESSION[$module_data . '_order_info'] );
		Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
		die();
	}

	if( $_SESSION[$module_data . '_order_info']['checked'] )
	{
		$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_id WHERE order_id=' . $order_info['order_id'] );
		while( $row = $result->fetch() )
		{
			$array_group = array();
			$data_content = $db->query( "SELECT * FROM " . $db_config['prefix'] . "_" . $module_data . "_rows WHERE id = " . $row['id'] )->fetch();
			$result_group = $db->query( "SELECT group_id FROM " . $db_config['prefix'] . "_" . $module_data . "_orders_id_group WHERE order_i = " . $row['id'] );
			while( list( $group_id ) = $result_group->fetch( 3 ) )
			{
				$array_group[] = $group_id;
			}
			$array_group = !empty( $array_group ) ? implode( ',', $array_group ) : '';
			$order_old[$row['proid']] = array(
				'num' => $row['num'],
				'num_old' => $row['num'],
				'order' => 1,
				'price' => $row['price'],
				'variant_label' => isset( $row['variant_label'] ) ? $row['variant_label'] : '',
				'money_unit' => $order_info['money_unit'],
				'discount_id' => $row['discount_id'],
				'group' => $array_group,
				'store' => $data_content['product_number'],
				'weight' => $data_content['product_weight'],
				'weight_unit' => $data_content['weight_unit']
			);
		}

		$shipping_old = array(
			'ship_name' => '',
			'ship_phone' => '',
			'ship_location_id' => 0,
			'ship_address_extend' => '',
			'ship_shops_id' => 0,
			'ship_carrier_id' => 0,
			'order_shipping' => 0
		);

		$result = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_shipping WHERE order_id=' . $order_info['order_id'] );
		if( $result->rowCount() )
		{
			$shipping_old = $result->fetch();
			$shipping_old['order_shipping'] = 1;
		}

		$_SESSION[$module_data . '_order_info']['checked'] = 0;
		$_SESSION[$module_data . '_order_info']['order_product'] = $order_old;
		$_SESSION[$module_data . '_order_info']['shipping'] = $shipping_old;
	
		//$_SESSION[$module_data . '_cart'] = $order_old;
		if( !empty($order_old) && is_array($order_old) ) 
		{

			$_SESSION[$module_data . '_cart'] = $order_old;
		} else 
		{
			//error_log("BỎ QUA ghi đè giỏ hàng vì order_old rỗng hoặc không hợp lệ");
		}
		
	}
}

// error_log("=== CART DEBUG START ===");
// error_log("POST: " . print_r($_POST, true));
// // error_log("SESSION CART BEFORE: " . print_r($_SESSION[$module_data . '_cart'], true));

if( $nv_Request->get_int( 'save', 'post', 0 ) == 1 )
{
	// Set cart to order
	$listproid = $nv_Request->get_array( 'listproid', 'post', '' );
	$coupons_code = $nv_Request->get_title( 'coupons_code', 'post', '' );

	if( ! empty( $listproid ) )
	{
		foreach( $listproid as $pro_id => $number )
		{
			if( ! empty( $_SESSION[$module_data . '_cart'][$pro_id] ) and $number >= 0 )
			{
				$_SESSION[$module_data . '_cart'][$pro_id]['num'] = $number;
			}
		}
	}
}

$data_content = array();
$array_error_product_number = array();
$coupon_data = array(
	'code' => $coupons_code,
	'discount_amount' => 0,
	'subtotal' => 0,
	'final_total' => 0,
	'error' => $coupon_error,
	'success' => $coupon_success
);
if( ! empty( $_SESSION[$module_data . '_cart'] ) )
{
	$arrayid = array();
	foreach( $_SESSION[$module_data . '_cart'] as $cart_id => $pro_info )
	{
		$pro_id = isset( $pro_info['proid'] ) ? intval( $pro_info['proid'] ) : intval( $cart_id );
		if( $pro_id > 0 )
		{
			$arrayid[] = $pro_id;
		}
	}

	if( ! empty( $arrayid ) )
	{
		$listid = implode( ',', $arrayid );

		$sql = 'SELECT t1.id, t1.listcatid, t1.publtime, t1.' . NV_LANG_DATA . '_title, t1.' . NV_LANG_DATA . '_alias, t1.' . NV_LANG_DATA . '_hometext, t1.homeimgalt, t1.homeimgfile, t1.homeimgthumb, t1.product_number, t1.product_price, t1.discount_id, t2.' . NV_LANG_DATA . '_title, t1.money_unit FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows AS t1 LEFT JOIN ' . $db_config['prefix'] . '_' . $module_data . '_units AS t2 ON t1.product_unit = t2.id WHERE t1.id IN (' . $listid . ') AND t1.status =1';
		$result = $db->query( $sql );
		$product_rows = array();
		while( list( $id, $listcatid, $publtime, $title, $alias, $hometext, $homeimgalt, $homeimgfile, $homeimgthumb, $product_number, $product_price, $discount_id, $unit, $money_unit ) = $result->fetch( 3 ) )
		{
			if( $homeimgthumb == 1 )
			{
				$thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $homeimgfile;
			}
			elseif( $homeimgthumb == 2 )
			{
				$thumb = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $homeimgfile;
			}
			elseif( $homeimgthumb == 3 )
			{
				$thumb = $homeimgfile;
			}
			else
			{
				$thumb = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
			}

			$product_rows[$id] = array(
				'id' => $id,
				'listcatid' => $listcatid,
				'publtime' => $publtime,
				'title' => $title,
				'alias' => $alias,
				'hometext' => $hometext,
				'homeimgalt' => $homeimgalt,
				'homeimgthumb' => $thumb,
				'product_price' => $product_price,
				'discount_id' => $discount_id,
				'product_unit' => $unit,
				'money_unit' => $money_unit,
				'link_pro' => $link . $global_array_shops_cat[$listcatid]['alias'] . '/' . $alias . $global_config['rewrite_exturl']
			);
		}

		foreach( $_SESSION[$module_data . '_cart'] as $cart_id => $cart_info )
		{
			$id = isset( $cart_info['proid'] ) ? intval( $cart_info['proid'] ) : intval( $cart_id );
			if( empty( $product_rows[$id] ) )
			{
				continue;
			}

			$row_data = $product_rows[$id];
			$group = isset( $cart_info['group'] ) ? $cart_info['group'] : '';
			$number = isset( $cart_info['num'] ) ? intval( $cart_info['num'] ) : 1;
			$product_number = $db->query( 'SELECT product_number FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows WHERE id=' . $id )->fetchColumn();

			if( !empty( $order_info ) )
			{
				$product_number = $product_number + ( isset( $cart_info['num_old'] ) ? $cart_info['num_old'] : $number );
			}

			if( !empty( $group ) )
			{
				$group = explode( ',', $group );
				asort( $group );
				$group = implode( ',', $group );
				$product_number = 0;
				$_result = $db->query( 'SELECT quantity FROM ' . $db_config['prefix'] . '_' . $module_data . '_group_quantity WHERE pro_id = ' . $id . ' AND listgroup="' . $group . '"' );
				if( $_result )
				{
					$product_number = $_result->fetchColumn();
				}
			}

			if( $product_number > 0 && $number > $product_number && empty($pro_config['active_order_number']) )
			{
				$number = $_SESSION[$module_data . '_cart'][$cart_id]['num'] = $product_number;
				$array_error_product_number[] = sprintf($lang_module['product_number_max'], $row_data['title'], $product_number);
			}

			if( $pro_config['active_price'] == '0' )
			{
				$row_data['discount_id'] = $row_data['product_price'] = 0;
			}

			$data_content[] = array_merge( $row_data, array(
				'cart_id' => $cart_id,
				'group' => $group,
				'num' => $number,
				'variant_id' => isset( $cart_info['variant_id'] ) ? $cart_info['variant_id'] : '',
				'variant_label' => isset( $cart_info['variant_label'] ) ? $cart_info['variant_label'] : '',
				'selected_price' => isset( $cart_info['price'] ) ? floatval( $cart_info['price'] ) : 0,
				'link_remove' => $link . 'remove&id=' . rawurlencode( $cart_id )
			) );
			$_SESSION[$module_data . '_cart'][$cart_id]['order'] = 1;
		}

		$total = 0;
		$total_coupons = 0;
		$coupon_info = array();
		if( !empty( $coupons_code ) and $coupons_check )
		{
			$coupon_info = nv_shops_get_coupon_info( $coupons_code );
		}
		foreach( $data_content as $product )
		{
			$line_total = !empty( $product['selected_price'] ) ? ( floatval( $product['selected_price'] ) * $product['num'] ) : nv_get_price( $product['id'], $pro_config['money_unit'], $product['num'] )['sale'];
			$total += $line_total;
			if( !empty( $coupon_info['product'] ) and in_array( intval( $product['id'] ), $coupon_info['product'] ) )
			{
				$total_coupons += $line_total;
			}
		}
		$coupon_data['subtotal'] = $total;
		$coupon_data['final_total'] = $total;
		if( !empty( $coupon_info ) and $coupons_check )
		{
			$coupon_calc = nv_shops_get_coupon_discount( $coupon_info, $total, $total_coupons );
			if( $coupon_calc['is_valid'] and $coupon_calc['discount_amount'] > 0 )
			{
				$coupon_data['discount_amount'] = $coupon_calc['discount_amount'];
				$coupon_data['final_total'] = $coupon_calc['final_total'];
				$_SESSION[$module_data . '_coupons']['discount'] = $coupon_calc['discount_amount'];
			}
			else
			{
				$_SESSION[$module_data . '_coupons']['discount'] = 0;
				if( empty( $coupon_data['error'] ) )
				{
					$coupon_data['error'] = 'Mã giảm giá hiện không áp dụng được cho giỏ hàng này';
				}
			}
		}
		$total_cart = nv_number_format($coupon_data['final_total']) . ' ' . $pro_config['money_unit'];
		//error_log("TỔNG GIỎ HÀNG =" . $total_cart);
		if( empty( $array_error_product_number ) and $nv_Request->isset_request( 'cart_order', 'post' ) )
		{
			Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=order', true ) );
			exit();
		}
	}
}
else
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	exit();
}

$page_title = $lang_module['cart_title'];
$contents = call_user_func( 'cart_product', $data_content, $coupons_code, $order_info, $array_error_product_number, $total_cart, $coupon_data );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
