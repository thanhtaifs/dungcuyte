<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3-6-2010 0:14
 */

if( !defined( 'NV_IS_MOD_SHOPS' ) )
	die( 'Stop!!!' );

$orders_id_table = $db_config['prefix'] . '_' . $module_data . '_orders_id';
$has_order_variant_label = false;
try
{
	$has_order_variant_label = (bool)$db->query( "SHOW COLUMNS FROM " . $orders_id_table . " LIKE 'variant_label'" )->fetchColumn();
}
catch( Exception $e )
{
	$has_order_variant_label = false;
}

//error_log('Running order page');

if( !defined( 'NV_IS_USER' ) and !$pro_config['active_guest_order'] )
{
	$redirect = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=cart';
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_base64_encode( $redirect ) );
	die( );
}

$contents = '';
$link1 = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=';
$action = 0;
$post_order = $nv_Request->get_int( 'postorder', 'post', 0 );
$order_info = array();
$error = array( );
$success = false;
error_log('order.php request: method=' . $_SERVER['REQUEST_METHOD'] . ', postorder=' . $post_order . ', success=' . $nv_Request->get_int( 'success', 'get', 0 ));

if( $nv_Request->get_int( 'success', 'get', 0 ) == 1 )
{
    $success_order = isset( $_SESSION[$module_data . '_order_success'] ) ? $_SESSION[$module_data . '_order_success'] : array();
    unset( $_SESSION[$module_data . '_order_success'] );

    $contents = nv_theme_shops_order_page( true, array(), $success_order );

    include NV_ROOTDIR . '/includes/header.php';
    echo nv_site_theme( $contents );
    include NV_ROOTDIR . '/includes/footer.php';
    exit();
}

$first_name = $user_info['first_name'] ?? '';
$last_name  = $user_info['last_name'] ?? '';

$user_info['full_name'] = trim($first_name . ' ' . $last_name);
//error_log('fullname: '. $user_info['full_name']);


$data_order = array(
	'user_id' => $user_info['userid'] ?? 0,
	'order_name' => (!empty($user_info['full_name'])) 
		? $user_info['full_name'] 
		: ($user_info['username'] ?? 'Khách hàng'),
	'order_email' => $user_info['email'] ?? 'noemail@gmail.com',
	'order_phone' => '',
	'order_address' => '',
	'order_note' => '',
	'admin_id' => 0,
	'shop_id' => 0,
	'who_is' => 0,
	'unit_total' => $pro_config['money_unit'],
	'order_total' => 0,
	'order_time' => NV_CURRENTTIME,
	'order_shipping' => 0,
	'shipping' => array(
					'ship_name' => '',
					'ship_phone' => '',
					'ship_location_id' => 0,
					'ship_address_extend' => '',
					'ship_shops_id' => 0,
					'ship_carrier_id' => 0,
					'weight' => 0,
					'weight_unit' => 'g' )
);


if( isset( $_SESSION[$module_data . '_order_info'] ) and !empty( $_SESSION[$module_data . '_order_info'] ) )
{
	$order_info = $_SESSION[$module_data . '_order_info'];

	$data_order = array(
		'order_name' => $order_info['order_name'],
		'order_email' => $order_info['order_email'],
		'order_address' => $order_info['order_address'],
		'order_phone' => $order_info['order_phone'],
		'order_note' => $order_info['order_note'],
		'unit_total' => $order_info['unit_total'],
		'order_shipping' => $order_info['shipping']['order_shipping'],
		'shipping' => $order_info['shipping']
	);
}


//error_log('check sesion ok');
$shipping_data = array( 'list_location' => array(), 'list_carrier' => array(), 'list_shops' => array() );

// Ma giam gia
$array_counpons = array( 'code' => '', 'discount' => 0, 'check' => 0 );
$counpons = array( 'id' => 0, 'total_amount' => 0, 'date_start' => 0, 'uses_per_coupon_count' => 0, 'uses_per_coupon' => 0, 'type' => 0, 'discount' => 0 );
if( ! empty( $_SESSION[$module_data . '_coupons'] ) and !empty( $_SESSION[$module_data . '_coupons']['code'] ) )
{
	$array_counpons = $_SESSION[$module_data . '_coupons'];
}
$total_coupons = 0;
if( !empty( $array_counpons['code'] ) and $array_counpons['check'] )
{
	$counpons = nv_shops_get_coupon_info( $array_counpons['code'] );
}

if( $post_order == 1 )
{	
	error_log('order.php entered submit branch');
	//error_log('post_order is 1');
	$total = 0;
	$total_point = 0;
	$total_weight = 0;
	$total_weight_price = 0;
	$i = 0;
	$listid = $listnum = $listprice = $listgroup = $listid_old = $listnum_old = array();
	//error_log(print_r($_SESSION[$module_data . '_cart'], true));
	foreach( $_SESSION[$module_data . '_cart'] as $pro_id => $info )
	{
		$cart_id = $pro_id;
		$pro_id = isset( $info['proid'] ) ? intval( $info['proid'] ) : intval( $pro_id );
		if( $pro_config['active_price'] == '0' )
		{
			$info['price'] = 0;
		}
		if( !empty( $_SESSION[$module_data . '_cart'][$cart_id]['order'] ) )
		{
			//error_log('SESSION order = 1');
			$unit_price = isset( $info['price'] ) ? doubleval( $info['price'] ) : 0;
			if( $unit_price <= 0 )
			{
				$price = nv_get_price( $pro_id, $pro_config['money_unit'], ( int )$info['num'] );
				$unit_price = $price['sale'];
			}
			$line_price = $unit_price * ( int )$info['num'];

			// Ap dung giam gia cho tung san pham dac biet
			if( !empty( $counpons['product'] ) )
			{
				if( in_array( $pro_id, $counpons['product'] ) )
				{
					$total_coupons = $total_coupons + $line_price;
				}
			}

			// Tinh diem tich luy doi voi thanh vien
			if( $pro_config['point_active'] and defined( 'NV_IS_USER' ) )
			{
				$result = $db->query( 'SELECT listcatid FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows WHERE id=' . $pro_id );
				if( $result->rowCount() > 0 )
				{
					list( $listcatid ) = $result->fetch( 3 );
					if( $global_array_shops_cat[$listcatid]['cat_allow_point'] and ( $global_array_shops_cat[$listcatid]['cat_number_product'] == 0 or $info['num'] >= $global_array_shops_cat[$listcatid]['cat_number_product'] ) )
					{
						$total_point += intval( $global_array_shops_cat[$listcatid]['cat_number_point'] );
					}
				}
			}

			$info['price'] = $unit_price;
			$total = $total + ( double )$line_price;
			$total_weight = $total_weight + nv_weight_conversion( ( double )$info['weight'], $info['weight_unit'], $pro_config['weight_unit'], ( int )$info['num'] );

			$i++;
		}
	}

	$total_point += intval( $pro_config['point_new_order'] );
	$total_old = $total;
	
	$data_order['order_name'] = nv_substr( $nv_Request->get_title( 'order_name', 'post', '', 1 ), 0, 200 );
	$data_order['order_email'] = nv_substr( $nv_Request->get_title( 'order_email', 'post', '', 1 ), 0, 250 );
	$data_order['order_address'] = nv_substr( $nv_Request->get_title( 'order_address', 'post', '', 1 ), 0, 250 );
	$data_order['order_phone'] = nv_substr( $nv_Request->get_title( 'order_phone', 'post', '', 1 ), 0, 20 );
	$data_order['order_note'] = nv_substr( $nv_Request->get_title( 'order_note', 'post', '', 1 ), 0, 2000 );
	$data_order['order_shipping'] = $nv_Request->get_int( 'order_shipping', 'post', 0 );
	$check = $nv_Request->get_int( 'check', 'post', 0 );

	if( $data_order['order_shipping'] )
	{
		$data_order['shipping']['ship_name'] = $nv_Request->get_title( 'ship_name', 'post', '' );
		$data_order['shipping']['ship_phone'] = $nv_Request->get_title( 'ship_phone', 'post', '' );
		$data_order['shipping']['ship_address_extend'] = $nv_Request->get_title( 'ship_address_extend', 'post', '' );
		$data_order['shipping']['ship_location_id'] = $nv_Request->get_int( 'ship_location', 'post', 0 );
		$data_order['shipping']['ship_shops_id'] = $nv_Request->get_int( 'shops', 'post', 0 );
		$data_order['shipping']['ship_carrier_id'] = $nv_Request->get_int( 'carrier', 'post', 0 );

		$price_ship = nv_shipping_price( $total_weight, $pro_config['weight_unit'], $data_order['shipping']['ship_location_id'], $data_order['shipping']['ship_shops_id'], $data_order['shipping']['ship_carrier_id'] );
		$total_weight_price = empty( $price_ship ) ? 0 : $price_ship;
	}
	//error_log('total' . $total);
	$total += $total_weight_price;
	$coupon_calc = nv_shops_get_coupon_discount( $counpons, $total, $total_coupons );
	$total_coupons = $coupon_calc['discount_amount'];
	if( $coupon_calc['is_valid'] and $coupon_calc['discount_amount'] > 0 )
	{
		$total = $coupon_calc['final_total'];
	}
	$_SESSION[$module_data . '_coupons']['discount'] = $total_coupons;
	
	$data_order['order_total'] = $total;
	if( empty( $data_order['order_name'] ) )
		$error['order_name'] = $lang_module['order_name_err'];
	if( nv_check_valid_email( $data_order['order_email'] ) != '' )
		$error['order_email'] = $lang_module['order_email_err'];
	if( empty( $data_order['order_phone'] ) )
		$error['order_phone'] = $lang_module['order_phone_err'];
	if( $data_order['order_shipping'] and empty( $data_order['shipping']['ship_name'] ) )
		$error['order_shipping_name'] = $lang_module['order_shipping_name_err'];
	if( $data_order['order_shipping'] and empty( $data_order['shipping']['ship_phone'] ) )
		$error['order_shipping_phone'] = $lang_module['order_shipping_phone_err'];
	if( $data_order['order_shipping'] and empty( $data_order['shipping']['ship_address_extend'] ) )
		$error['order_shipping_address_extend'] = $lang_module['shipping_address_extend_empty'];
	if( $data_order['order_shipping'] and empty( $data_order['shipping']['ship_carrier_id'] ) )
		$error['order_shipping_carrier_id'] = $lang_module['shipping_carrier_chose'];
	if( $check == 0 )
		$error['order_check'] = $lang_module['order_check_err'];
	//error_log('pass check data order');
	if( empty($error) and $i > 0 )
	{
		//error_log('order.php validation passed, item_count=' . $i . ', total=' . $total);
		if( !$has_order_variant_label )
		{
			try
			{
				$db->query( "ALTER TABLE " . $orders_id_table . " ADD variant_label VARCHAR(255) NOT NULL DEFAULT '' AFTER price" );
				$has_order_variant_label = true;
			}
			catch( Exception $e )
			{
				$has_order_variant_label = false;
			}
		}
		//error_log('is > 0');
		$sth = false; // đảm bảo biến tồn tại, tránh warning
		$order_id = 0; // luôn nên khởi tạo
		if( !empty( $order_info ) ) // Sua don hang
		{			
			//error_log(message: 'Sua don hang');
			$sth = $db->prepare( 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_orders SET
			order_name = :order_name, order_email = :order_email,
			order_phone = :order_phone, order_address = :order_address, order_note = :order_note, order_total = ' . doubleval( $data_order['order_total'] ) . ',
			unit_total = :unit_total, edit_time = ' . NV_CURRENTTIME . ' WHERE order_id=' . $order_info['order_id'] );

			$sth->bindParam( ':order_name', $data_order['order_name'], PDO::PARAM_STR );
			$sth->bindParam( ':order_email', $data_order['order_email'], PDO::PARAM_STR );
			$sth->bindParam( ':order_phone', $data_order['order_phone'], PDO::PARAM_STR );
			$sth->bindParam( ':order_address', $data_order['order_address'], PDO::PARAM_STR );
			$sth->bindParam( ':order_note', $data_order['order_note'], PDO::PARAM_STR );
			$sth->bindParam( ':unit_total', $data_order['unit_total'], PDO::PARAM_STR );
			$sth->execute();
		}
		else
		{
			//error_log('SHOW TABLE  thêm dữ liệu đơn hàng ');
			$result = $db->query( "SHOW TABLE STATUS WHERE Name='" . $db_config['prefix'] . "_" . $module_data . "_orders'" );			
			$item = $result->fetch();			
			$result->closeCursor();
	

			$order_code = vsprintf( $pro_config['format_order_id'], array($item['auto_increment']));		
			$transaction_status = ( empty( $pro_config['auto_check_order'] )) ? -1 : 0;			

			$sql = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_orders (
				lang, order_code, order_name, order_email, order_phone, order_address,order_note,
				user_id, admin_id, shop_id, who_is, unit_total, order_total, order_time, postip, order_view,
				transaction_status, transaction_id, transaction_count
			) VALUES (
				'" . NV_LANG_DATA . "', :order_code, :order_name, :order_email, :order_phone, :order_address, :order_note,
				" . intval( $data_order['user_id'] ) . ", " . intval( $data_order['admin_id'] ) . ", " . intval( $data_order['shop_id'] ) . ",
				" . intval( $data_order['who_is'] ) . ", :unit_total, " . doubleval( $data_order['order_total'] ) . ",
				" . intval( $data_order['order_time'] ) . ", :ip, 0, " . $transaction_status . ", 0, 0)";			
			$data_insert = array();
			$data_insert['order_code'] = $order_code;
			$data_insert['order_name'] = $data_order['order_name'];
			$data_insert['order_email'] = $data_order['order_email'];
			$data_insert['order_phone'] = $data_order['order_phone'];
			$data_insert['order_address'] = $data_order['order_address'];
			$data_insert['order_note'] = $data_order['order_note'];
			$data_insert['ip'] = $client_info['ip'];
			$data_insert['unit_total'] = $data_order['unit_total'];
			$order_id = $db->insert_id( $sql, 'order_id', $data_insert );
		}

		if( $sth or $order_id > 0 )
		{
			//error_log('order.php order header saved, order_id=' . $order_id);
			//error_log('Bat dau them don hang');
			if( empty( $order_info ) ) // Them don hang
			{				
				// Cap nhat lai ma don hang
				$order_code2 = vsprintf( $pro_config['format_order_id'], array($order_id));				
				if( $order_code != $order_code2 )
				{
					$stmt = $db->prepare( 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_orders SET order_code= :order_code WHERE order_id=' . $order_id );
					$stmt->bindParam( ':order_code', $order_code2, PDO::PARAM_STR );
					$stmt->execute();
				}
			}
			else
			{			

				$order_id = $order_info['order_id'];
				$order_code2 = $order_info['order_code'];
				foreach( $order_info['order_product'] as $pro_id => $info )
				{
					$listid_old[] = $pro_id;
					$listnum_old[] = $info['num'];
				}				
				// Xoa cac ban ghi san pham don hang cu
				$db->query( 'DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_id WHERE order_id=' . $order_info['order_id'] );

				// Neu khong tat chuc nang dat hang vo han thi tru so sp trong kho
				if( $pro_config['active_order_number'] == '0' )
				{
					product_number_order( $listid_old, $listnum_old, '+' );
				}
				product_number_sell( $listid_old, $listnum_old, '-' );
			}
			//error_log('Bat dau them chi tiet don hang');
			//Them chi tiet don hang
			foreach( $_SESSION[$module_data . '_cart'] as $pro_id => $info)
			{				
				$cart_id = $pro_id;
				$pro_id = isset( $info['proid'] ) ? intval( $info['proid'] ) : intval( $pro_id );
				if( $pro_config['active_price'] == '0' )
				{
					$info['price'] = 0;
				}

				if( !empty( $_SESSION[$module_data . '_cart'][$cart_id]['order'] ) and $i > 0 )
				{
					$info['price'] = isset( $info['price'] ) ? doubleval( $info['price'] ) : 0;
					if( $info['price'] <= 0 )
					{
						$price = nv_get_price( $pro_id, $pro_config['money_unit'], $info['num'], true );
						$info['price'] = $price['sale'];
					}
					$variant_label = isset( $info['variant_label'] ) ? nv_substr( $info['variant_label'], 0, 255 ) : '';
					// $sql = 'INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_orders_id( order_id, proid, num, price, discount_id ) 
         			// VALUES ( :order_id, :proid, :num, :price, :discount_id )';
					// Tạm thời không xử lý discount_id
					$sql = $has_order_variant_label ? 'INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_orders_id( order_id, proid, num, price, variant_label ) 
         			VALUES ( :order_id, :proid, :num, :price, :variant_label )' : 'INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_orders_id( order_id, proid, num, price ) 
         			VALUES ( :order_id, :proid, :num, :price )';				

					$data_insert = array();
					$data_insert['order_id'] = $order_id;
					$data_insert['proid'] = $pro_id;
					$data_insert['num'] = $info['num'];
					$data_insert['price'] = $info['price'];
					if( $has_order_variant_label ) $data_insert['variant_label'] = $variant_label;
					// Hiện tại đang dùng mặc định
					//$data_insert['discount_id'] = 0;					
					try 
					{
						$order_i = $db->insert_id($sql, 'id', $data_insert);
						//error_log('Insert success, insert_id = ' . $order_i);
					} catch (PDOException $e) 
					{
						error_log('Insert failed: ' . $e->getMessage());
					}

					if( $order_i > 0 and !empty( $info['group'] ) )
					{
						$sth = $db->prepare( 'INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_orders_id_group(order_i, group_id) VALUES( :order_i, :group_id )' );
						$info['group'] = explode( ',', $info['group'] );
						foreach( $info['group'] as $group_i )
						{
							$sth->bindParam( ':order_i', $order_i, PDO::PARAM_INT );
							$sth->bindParam( ':group_id', $group_i, PDO::PARAM_INT );
							$sth->execute();
						}
					}

					// Thong tin san pham dat hang
					$listid[] = $pro_id;
					$listnum[] = $info['num'];
					$listprice[] = $info['price'];
					$list = '';
					if( !empty( $info['group'] ) )
					{
						asort( $info['group'] );
						$list = implode( ',', $info['group'] );
					}
					$listgroup[] = $list;
				}
			}
			//error_log('duyet chi tiet san pham thanh cong');
			// Neu khong tat chuc nang dat hang vo han thi tru so sp trong kho
			if( $pro_config['active_order_number'] == '0' )
			{
				
				product_number_order( $listid, $listnum, $listgroup );
			}

			// Cong vao so luong san pham da ban
			product_number_sell( $listid, $listnum );

			$checkss = md5( $order_id . $global_config['sitekey'] . session_id() );
			$review_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=payment&order_id=' . $order_id . '&checkss=' . $checkss;
			//error_log('order_info check');
			if( empty( $order_info ) ) // Them don hang
			{				
				// Cap nhat lich su su dung ma giam gia
				if( ! empty( $array_counpons['code'] ) )
				{
					$db->query( 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_coupons SET uses_per_coupon_count = uses_per_coupon_count + 1 WHERE id = ' . $counpons['id'] );

					$amount = $total_old - $total;
					$stmt = $db->prepare( 'INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_coupons_history( cid, order_id, amount, date_added ) VALUES ( :cid, :order_id, :amount, ' . NV_CURRENTTIME . ' )' );
					$stmt->bindParam( ':cid', $counpons['id'], PDO::PARAM_INT );
					$stmt->bindParam( ':order_id', $order_id, PDO::PARAM_INT );
					$stmt->bindParam( ':amount', $amount, PDO::PARAM_INT );
					$stmt->execute();
				}

				// Ghi nhan diem tich luy khach hang
				if( $total_point > 0 and $pro_config['point_active'] )
				{
					$stmt = $db->prepare( 'INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_point_queue( order_id, point, status ) VALUES ( :order_id, :point, 1 )' );
					$stmt->bindParam( ':order_id', $order_id, PDO::PARAM_INT );
					$stmt->bindParam( ':point', $total_point, PDO::PARAM_INT );
					$stmt->execute();
				}
			}
		
			// Thong tin van chuyen
			$num = $db->query( 'SELECT COUNT(*) FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_shipping WHERE order_id = ' . $order_id )->fetchColumn();
			if( $num > 0 )
			{				
				// Sua thong tin van chuyen
				if( $data_order['order_shipping'] )
				{
					$stmt = $db->prepare( 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_orders_shipping SET ship_name = :ship_name, ship_phone = :ship_phone, ship_location_id = :ship_location_id, ship_address_extend = :ship_address_extend, ship_shops_id = :ship_shops_id, ship_carrier_id = :ship_carrier_id, weight = :weight, weight_unit = :weight_unit, ship_price = :ship_price, ship_price_unit = :ship_price_unit, edit_time = ' . NV_CURRENTTIME . ' WHERE order_id = ' . $order_id );
					$stmt->bindParam( ':ship_name', $data_order['shipping']['ship_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':ship_phone', $data_order['shipping']['ship_phone'], PDO::PARAM_STR );
					$stmt->bindParam( ':ship_location_id', $data_order['shipping']['ship_location_id'], PDO::PARAM_INT );
					$stmt->bindParam( ':ship_address_extend', $data_order['shipping']['ship_address_extend'], PDO::PARAM_STR );
					$stmt->bindParam( ':ship_shops_id', $data_order['shipping']['ship_shops_id'], PDO::PARAM_INT );
					$stmt->bindParam( ':ship_carrier_id', $data_order['shipping']['ship_carrier_id'], PDO::PARAM_INT );
					$stmt->bindParam( ':weight', $total_weight, PDO::PARAM_STR );
					$stmt->bindParam( ':weight_unit', $pro_config['weight_unit'], PDO::PARAM_STR );
					$stmt->bindParam( ':ship_price', $total_weight_price, PDO::PARAM_STR );
					$stmt->bindParam( ':ship_price_unit', $pro_config['money_unit'], PDO::PARAM_STR );
					$stmt->execute();
				}
				else
				{
					$db->query( 'DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_shipping WHERE order_id = ' . $order_id );
				}
			}
			else
			{		
			
				// Ghi nhan thong tin van chuyen
				if( $data_order['order_shipping'] )
				{
					try
					{
					$stmt = $db->prepare( 'INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_orders_shipping( order_id, ship_name, ship_phone, ship_location_id, ship_address_extend, ship_shops_id, ship_carrier_id, weight, weight_unit, ship_price, ship_price_unit, add_time ) VALUES ( :order_id, :ship_name, :ship_phone, :ship_location_id, :ship_address_extend, :ship_shops_id, :ship_carrier_id, :weight, :weight_unit, :ship_price, :ship_price_unit, ' . NV_CURRENTTIME . ' )' );
					$stmt->bindParam( ':order_id', $order_id, PDO::PARAM_INT );
					$stmt->bindParam( ':ship_name', $data_order['shipping']['ship_name'], PDO::PARAM_STR );
					$stmt->bindParam( ':ship_phone', $data_order['shipping']['ship_phone'], PDO::PARAM_STR );
					$stmt->bindParam( ':ship_location_id', $data_order['shipping']['ship_location_id'], PDO::PARAM_INT );
					$stmt->bindParam( ':ship_address_extend', $data_order['shipping']['ship_address_extend'], PDO::PARAM_STR );
					$stmt->bindParam( ':ship_shops_id', $data_order['shipping']['ship_shops_id'], PDO::PARAM_INT );
					$stmt->bindParam( ':ship_carrier_id', $data_order['shipping']['ship_carrier_id'], PDO::PARAM_INT );
					$stmt->bindParam( ':weight', $total_weight, PDO::PARAM_STR );
					$stmt->bindParam( ':weight_unit', $pro_config['weight_unit'], PDO::PARAM_STR );
					$stmt->bindParam( ':ship_price', $total_weight_price, PDO::PARAM_STR );
					$stmt->bindParam( ':ship_price_unit', $pro_config['money_unit'], PDO::PARAM_STR );
					$stmt->execute();
					}
					catch( PDOException $e )
					{
						die($e->getMessage());
					    trigger_error( $e->getMessage() );
					}

				}
			}

			// Gui mail thong bao den khach hang
			$data_order['id'] = $order_id;
			$data_order['order_code'] = $order_code2;
			// Thong tin san pham dat hang
			$data_pro = array( );
			$temppro = array( );
			$arrayid = array();
			$i = 0;

			foreach( $listid as $proid )
			{
				if( empty( $listprice[$i]))
					$listprice[$i] = 0;
				if( empty( $listnum[$i]))
					$listnum[$i] = 0;
				$temppro[$proid] = array(
					'price' => $listprice[$i],
					'num' => $listnum[$i]
				);

				$arrayid[] = $proid;
				++$i;
			}
			if( !empty( $arrayid ) )
			{
				
				$templistid = implode( ',', $arrayid );		
				$sql = 'SELECT t1.id, t1.listcatid, t1.publtime, t1.' . NV_LANG_DATA . '_title, t1.' . NV_LANG_DATA . '_alias, t1.' . NV_LANG_DATA . '_hometext, t2.' . NV_LANG_DATA . '_title, t1.money_unit FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows AS t1 LEFT JOIN ' . $db_config['prefix'] . '_' . $module_data . '_units AS t2 ON t1.product_unit = t2.id WHERE t1.id IN (' . $templistid . ') AND t1.status =1';
				$result = $db->query( $sql );			
				while( list( $id, $listcatid, $publtime, $title, $alias, $hometext, $unit, $money_unit ) = $result->fetch( 3 ) )
				{
					$data_pro[] = array(
						'id' => $id,
						'publtime' => $publtime,
						'title' => $title,
						'alias' => $alias,
						'hometext' => $hometext,
						'product_price' => $temppro[$id]['price'],
						'product_unit' => $unit,
						'money_unit' => $money_unit,
						'product_number' => $temppro[$id]['num']
					);
				}
			}
	
			$lang_module['order_email_noreply'] = sprintf( $lang_module['order_email_noreply'], $global_config['site_url'], $global_config['site_url'] );
			$lang_module['order_email_thanks'] = sprintf( $lang_module['order_email_thanks'], $global_config['site_url'] );
			$lang_module['order_email_review'] = sprintf( $lang_module['order_email_review'], $global_config['site_url'] . $review_url );
			$data_order['review_url'] = $review_url;		
			$content = '';
			$email_contents_table = call_user_func( 'email_new_order', $content, $data_order, $data_pro, true );
			$replace_data = array(
				'order_code' => $data_order['order_code'],
				'order_name' => $data_order['order_name'],
				'order_email' => $data_order['order_email'],
				'order_phone' => $data_order['order_phone'],
				'order_address' => $data_order['order_address'],
				'order_note' => $data_order['order_note'],
				'order_total' => $data_order['order_total'],
				'unit_total' => $data_order['unit_total'],
				'dateup' => nv_date( "d-m-Y", $data_order['order_time'] ),
				'moment' => nv_date( "H:i", $data_order['order_time'] ),
				'review_url' => '<a href="' . $global_config['site_url'] . $data_order['review_url'] . '">' . $lang_module['content_here'] . '</a>',
				'table_product' => $email_contents_table,
				'site_url' => $global_config['site_url'],
				'site_name' => $global_config['site_name'],
			);
		
			$content_file = NV_ROOTDIR . '/' . NV_DATADIR . '/' . NV_LANG_DATA . '_' . $module_data . '_order_content.txt';
			if( file_exists( $content_file ) )
			{
				$content = file_get_contents( $content_file );
				$content = nv_editor_br2nl( $content );
			}
			else
			{
				$content = $lang_module['order_payment_email'];
			}				
			foreach( $replace_data as $key => $value )
			{
				$content = str_replace( '{' . $key . '}', $value, $content );
			}
			$email_contents = call_user_func( 'email_new_order', $content, $data_order, $data_pro );
			$email_title = empty( $order_info ) ? $lang_module['order_email_title'] : $lang_module['order_email_edit_title'];
			//error_log('order.php prepared customer email, order_id=' . $order_id);
			nv_sendmail( array(
				$global_config['site_name'],
				$global_config['site_email']
			), $data_order['order_email'], sprintf( $email_title, $module_info['custom_title'], $data_order['order_code'] ), $email_contents );
			//error_log('order.php customer email sent, order_id=' . $order_id);
			
			// Them vao notification
			$content = array( 'order_id' => $data_order['id'], 'order_code' => $data_order['order_code'], 'order_name' => $data_order['order_name'] );
			$userid = isset( $user_info['userid'] ) and !empty( $user_info['userid'] ) ? $user_info['userid'] : 0;
			nv_insert_notification( $module_name, empty( $order_info ) ? 'order_new' : 'order_edit', $content, 0, $userid, 1 );

			// Gui mail thong bao den nguoi quan ly shops
			$order_url = $global_config['site_url'] . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=or_view&amp;order_id=' . $data_order['id'];
			$lang_module['order_email_thanks'] = sprintf( $lang_module['order_email_thanks_to_admin'], $data_order['order_name'] );
			$lang_module['order_email_review'] = sprintf( $lang_module['order_email_review_to_admin'], $order_url );
			$listmail_notify = nv_listmail_notify();
			if( !empty( $listmail_notify ) )
			{
				
				try 
				{
					if (!function_exists('email_new_order')) 
					{
						throw new Exception('Function email_new_order() not found');
					}
					$email_contents_to_admin = call_user_func('email_new_order', $data_order, $data_pro, true);					
					nv_sendmail(
						array($global_config['site_name'], $global_config['site_email']),
						$listmail_notify,
						sprintf($email_title, $module_info['custom_title'], $data_order['order_code']),
						$email_contents_to_admin
					);
					
				} catch (Throwable $e)
				{
					error_log('Error before nv_sendmail: ' . $e->getMessage());
					error_log('Stack trace: ' . $e->getTraceAsString());
				}
			}			
			// Chuyen trang xem thong tin don hang vua dat
			$_SESSION[$module_data . '_order_success'] = array(
				'order_id' => $data_order['id'],
				'order_code' => $data_order['order_code'],
				'order_name' => $data_order['order_name'],
				'order_email' => $data_order['order_email'],
				'order_phone' => $data_order['order_phone'],
				'order_address' => $data_order['order_address'],
				'order_total' => $data_order['order_total'],
				'unit_total' => $data_order['unit_total']
			);

			unset( $_SESSION[$module_data . '_cart'] );
			unset( $_SESSION[$module_data . '_order_info'] );
			unset( $_SESSION[$module_data . '_coupons'] );

			$success_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=order&success=1&order_id=' . $data_order['id'] . '&checkss=' . md5( $data_order['id'] . $global_config['sitekey'] . session_id() );
			//error_log('order.php redirecting to success page: ' . $success_url);
			Header( 'Location: ' . nv_url_rewrite( $success_url, true ) );
			exit();
						
		}
	}
}
//error_log('post_order is 0');
// Lay dia diem
$sql = "SELECT id, parentid, title, lev FROM " . $db_config['prefix'] . '_' . $module_data . "_location ORDER BY sort ASC";
$result = $db->query( $sql );
while( list( $id_i, $parentid_i, $title_i, $lev_i ) = $result->fetch( 3 ) )
{
	
	$xtitle_i = '';
	if( $lev_i > 0 )
	{
		$xtitle_i .= '&nbsp;';
		for( $i = 1; $i <= $lev_i; $i++ )
		{
			$xtitle_i .= '&nbsp;&nbsp;&nbsp;';
		}
	}
	$xtitle_i .= $title_i;
	$shipping_data['list_location'][$id_i] = array( 'id' => $id_i, 'parentid' => $parentid_i, 'title' => $xtitle_i );
}
$shipping_data['list_carrier'] = $array_carrier;
$shipping_data['list_shops'] = $array_shops;

if( $action == 0)
{	
	$page_title = $lang_module['cart_check_cart'];
	$i = 0;
	//error_log("=== order.php display ===");
	//error_log("Cart session: " . json_encode($_SESSION[$module_data . '_cart']));
	$arrayid = array( );
	$id_to_proid = array();
	foreach( $_SESSION[$module_data . '_cart'] as $pro_id => $pro_info )
	{
		$arrayid[] = $pro_info['proid'];
		$id_to_proid[$pro_info['proid']] = $pro_id;
	}
	//error_log("arrayid: " . json_encode($arrayid));

	if( !empty($arrayid))
	{
		//error_log("Entering if !empty(arrayid)");
	
		$listid = implode( ',', $arrayid );
		$sql = 'SELECT t1.id, t1.listcatid, t1.publtime, t1.' . NV_LANG_DATA . '_title, t1.' . NV_LANG_DATA . '_alias, t1.' . NV_LANG_DATA . '_hometext, t1.homeimgalt, t1.homeimgfile, t1.homeimgthumb, t1.product_price, t2.' . NV_LANG_DATA . '_title, t1.money_unit, t1.discount_id, t1.product_weight, t1.weight_unit FROM ' . $db_config['prefix'] . '_' . $module_data . '_rows AS t1 LEFT JOIN ' . $db_config['prefix'] . '_' . $module_data . '_units AS t2 ON t1.product_unit = t2.id WHERE t1.id IN (' . $listid . ') AND t1.status =1';
		$result = $db->query( $sql );
		//error_log("SQL executed, result rowCount: " . $result->rowCount());
		$weight_total = 0;
		$order_total = 0;
		while( list( $id, $listcatid, $publtime, $title, $alias, $hometext, $homeimgalt, $homeimgfile, $homeimgthumb, $product_price, $unit, $money_unit, $discount_id, $product_weight, $weight_unit ) = $result->fetch( 3 ) )
		{
			//error_log("Processing product $id in while loop");
			if( $homeimgthumb == 1 )//image thumb
			{
				$thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $homeimgfile;
			}
			elseif( $homeimgthumb == 2 )//image file
			{
				$thumb = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $homeimgfile;
			}
			elseif( $homeimgthumb == 3 ) //image url
			{
				$thumb = $homeimgfile;
			}
			else
			{
				$thumb = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
			}

			if( $pro_config['active_price'] == '0' )
			{
				$discount_id = $product_price = 0;
			}

			$pro_id_key = $id_to_proid[$id] ?? null;
			if( empty( $pro_id_key ) || empty( $_SESSION[$module_data . '_cart'][$pro_id_key] ) )
			{
				// Cart entry missing for this product id (avoid Undefined array key warnings)
				continue;
			}

			$cart_item = $_SESSION[$module_data . '_cart'][$pro_id_key];
			$num = (int) ( $cart_item['num'] ?? 0 );
			$weight_total += nv_weight_conversion( $product_weight, $weight_unit, $pro_config['weight_unit'], $num );
			$group = $cart_item['group'] ?? array();
			try {
				$price_info = nv_get_price($id, $money_unit);
				// Sử dụng giá bán (sale price) để tính tổng, không phải giá gốc
				$item_total = $price_info['sale'] * $num;
				$order_total += $item_total;
				//error_log("Product $id: price_info sale = " . $price_info['sale'] . ", num = $num, item_total = $item_total");
			} catch (Exception $e) {
				//error_log('Error getting price for product ' . $id . ': ' . $e->getMessage());
				$item_total = 0;
			}
			//error_log("After price calculation for $id, item_total = $item_total");
			//error_log('order_total: ' . $order_total );
			$data_content[] = array(
				'id' => $id,
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
				'group' => $group,
				'link_pro' => $link . $global_array_shops_cat[$listcatid]['alias'] . '/' . $alias . $global_config['rewrite_exturl'],
				'num' => $num,
				'variant_id' => $_SESSION[$module_data . '_cart'][$pro_id_key]['variant_id'] ?? '',
				'variant_label' => $_SESSION[$module_data . '_cart'][$pro_id_key]['variant_label'] ?? '',
				'selected_price' => $_SESSION[$module_data . '_cart'][$pro_id_key]['price'] ?? 0,
			);
			++$i;
		}
		//error_log("While loop ended, i = $i");
	}
	//error_log("After if !empty(arrayid), i = $i");

	$data_order['weight_total'] = $weight_total;
	$data_order['order_total'] = $order_total;
	// Cảnh báo đang sửa đơn hàng
	if( isset( $_SESSION[$module_data . '_order_info'] ) and !empty( $_SESSION[$module_data . '_order_info'] ) )
	{
		$order_info = $_SESSION[$module_data . '_order_info'];
		$lang_module['order_submit_send'] = $lang_module['order_edit'];
	}
	
	//error_log("Before if i==0, i = $i");
	if( $i == 0 )
	{
		Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=cart', true ) );
		exit( );
	}
	else
	{		
		try {
			//error_log("Calling users_order with " . count($data_content) . " products");
			$contents = call_user_func( 'users_order', $data_content, $data_order, $array_counpons['discount'], $order_info, $error );
			//error_log("users_order completed successfully");
		} catch (Exception $e) {
			//error_log('Error in users_order: ' . $e->getMessage());
			$contents = 'Có lỗi xảy ra. Vui lòng thử lại.';
		}
	}
}
else	
{
	$contents = nv_theme_shops_order_page($success, $error, $order_info);
}


include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents);
include NV_ROOTDIR . '/includes/footer.php';
