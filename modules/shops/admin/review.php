<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 16 Jan 2015 02:23:16 GMT
 */

if( !defined( 'NV_IS_FILE_ADMIN' ) )
	die( 'Stop!!!' );

function nv_shops_review_status_map()
{
	return array(
		'pending' => 0,
		'approved' => 1,
		'rejected' => 0
	);
}

function nv_shops_review_status_label( $moderation_status, $lang_module )
{
	$key = 'review_moderation_' . $moderation_status;
	return isset( $lang_module[$key] ) ? $lang_module[$key] : $moderation_status;
}

if( $nv_Request->isset_request( 'del', 'post,get' ) )
{
	$dellist = $nv_Request->isset_request( 'dellist', 'post,get' );
	if( $dellist )
	{
		$array_id = $nv_Request->get_string( 'listid', 'post,get' );
		$array_id = explode( ',', $array_id );

		foreach( $array_id as $review_id )
		{
			if( !empty( $review_id ) )
			{
				$db->query( 'DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_review WHERE review_id=' . $review_id );
			}
		}
		nv_del_moduleCache( $module_name );
		die( 'OK' );
	}
	else
	{
		$id = $nv_Request->get_int( 'id', 'post,get', 0 );
		if( empty( $id ) ) die( 'NO' );

		$result = $db->query( 'DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_review WHERE review_id=' . $id );
		if( $result )
		{
			nv_del_moduleCache( $module_name );
			die( 'OK' );
		}
	}
	die( 'NO' );
}

if( $nv_Request->isset_request( 'change_status', 'get,post' ) )
{
	$array_id = $nv_Request->get_string( 'listid', 'post,get' );
	$array_id = explode( ',', $array_id );
	$new_status = $nv_Request->get_title( 'status', 'post,get', 'pending' );
	$status_map = nv_shops_review_status_map();
	$new_status = isset( $status_map[$new_status] ) ? $new_status : 'pending';
	$status_int = $status_map[$new_status];

	foreach( $array_id as $review_id )
	{
		if( !empty( $review_id ) )
		{
			$sql = 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_review SET status=' . $status_int . ', moderation_status=' . $db->quote( $new_status ) . ' WHERE review_id=' . $review_id;
			$db->query( $sql );
		}
	}
	nv_del_moduleCache( $module_name );
	die( 'OK' );
}

if( $nv_Request->isset_request( 'save_review', 'post' ) )
{
	$review_id = $nv_Request->get_int( 'review_id', 'post', 0 );
	$moderation_status = $nv_Request->get_title( 'moderation_status', 'post', 'pending' );
	$is_verified_purchase = $nv_Request->get_int( 'is_verified_purchase', 'post', 0 ) ? 1 : 0;
	$seller_response = $nv_Request->get_textarea( 'seller_response', '' );
	$rejection_reason = $nv_Request->get_textarea( 'rejection_reason', '' );
	$status_map = nv_shops_review_status_map();
	$moderation_status = isset( $status_map[$moderation_status] ) ? $moderation_status : 'pending';
	$status = $status_map[$moderation_status];
	$seller_response_time = !empty( $seller_response ) ? NV_CURRENTTIME : 0;

	if( $moderation_status != 'rejected' )
	{
		$rejection_reason = '';
	}

	$stmt = $db->prepare( 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_review
		SET status = :status,
			moderation_status = :moderation_status,
			is_verified_purchase = :is_verified_purchase,
			seller_response = :seller_response,
			seller_response_time = :seller_response_time,
			rejection_reason = :rejection_reason,
			edit_time = ' . NV_CURRENTTIME . ',
			edited_count = edited_count + 1
		WHERE review_id = :review_id' );
	$stmt->bindParam( ':status', $status, PDO::PARAM_INT );
	$stmt->bindParam( ':moderation_status', $moderation_status, PDO::PARAM_STR );
	$stmt->bindParam( ':is_verified_purchase', $is_verified_purchase, PDO::PARAM_INT );
	$stmt->bindParam( ':seller_response', $seller_response, PDO::PARAM_STR );
	$stmt->bindParam( ':seller_response_time', $seller_response_time, PDO::PARAM_INT );
	$stmt->bindParam( ':rejection_reason', $rejection_reason, PDO::PARAM_STR );
	$stmt->bindParam( ':review_id', $review_id, PDO::PARAM_INT );
	$stmt->execute();

	nv_del_moduleCache( $module_name );
	Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=review&edit_id=' . $review_id );
	die();
}

$per_page = 20;
$page = $nv_Request->get_int( 'page', 'post,get', 1 );
$array_search = array();
$array_search['product_id'] = $nv_Request->get_int( 'product_id', 'get', 0 );
$array_search['keywords'] = $nv_Request->get_title( 'keywords', 'get', '' );
$array_search['status'] = $nv_Request->get_title( 'status', 'get', '' );
$edit_id = $nv_Request->get_int( 'edit_id', 'get', 0 );

$db->sqlreset( )
	->select( 'COUNT(*)' )
	->from( $db_config['prefix'] . '_' . $module_data . '_review t1' )
	->join( 'INNER JOIN ' . $db_config['prefix'] . '_' . $module_data . '_rows t2 ON t1.product_id = t2.id' );

$where = '';
$base_url = '';

if( !empty( $array_search['keywords'] ) )
{
	$where .= ' AND (t2.' . NV_LANG_DATA . '_title LIKE :q_title OR t1.sender LIKE :q_sender OR t1.content LIKE :q_content)';
}

if( !empty( $array_search['product_id'] ) )
{
	$where .= ' AND t1.product_id = ' . $array_search['product_id'];
}

if( !empty( $array_search['status'] ) )
{
	$where .= ' AND t1.moderation_status = ' . $db->quote( $array_search['status'] );
}

if( ! empty( $where ) )
{
	$db->where( '1=1' . $where );
}

$sth = $db->prepare( $db->sql( ) );

if( !empty( $array_search['keywords'] ) )
{
	$sth->bindValue( ':q_title', '%' . $array_search['keywords'] . '%' );
	$sth->bindValue( ':q_sender', '%' . $array_search['keywords'] . '%' );
	$sth->bindValue( ':q_content', '%' . $array_search['keywords'] . '%' );
}

$sth->execute( );
$num_items = $sth->fetchColumn( );

$db->select( 't1.*, t2.listcatid, t2.' . NV_LANG_DATA . '_title title, t2.' . NV_LANG_DATA . '_alias alias' )->order( 'review_id DESC' )->limit( $per_page )->offset( ($page - 1) * $per_page );
$sth = $db->prepare( $db->sql( ) );

if( !empty( $array_search['keywords'] ) )
{
	$sth->bindValue( ':q_title', '%' . $array_search['keywords'] . '%' );
	$sth->bindValue( ':q_sender', '%' . $array_search['keywords'] . '%' );
	$sth->bindValue( ':q_content', '%' . $array_search['keywords'] . '%' );
}
$sth->execute( );

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'NV_UPLOADS_DIR', NV_UPLOADS_DIR );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'SEARCH', $array_search );

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
if( !empty( $array_search['keywords'] ) )
{
	$base_url .= '&keywords=' . $array_search['keywords'];
}

if( !empty( $array_search['product_id'] ) )
{
	$base_url .= '&product_id=' . $array_search['product_id'];
}

if( !empty( $array_search['status'] ) )
{
	$base_url .= '&status=' . $array_search['status'];
}

$review_edit = array();
if( !empty( $edit_id ) )
{
	$stmt = $db->query( 'SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_review WHERE review_id = ' . $edit_id );
	$review_edit = $stmt->fetch();
	if( !empty( $review_edit ) )
	{
		$review_edit['seller_response_time'] = !empty( $review_edit['seller_response_time'] ) ? nv_date( 'H:i d/m/Y', $review_edit['seller_response_time'] ) : '';
		$review_edit['is_verified_purchase_checked'] = !empty( $review_edit['is_verified_purchase'] ) ? 'checked="checked"' : '';
		$xtpl_moderation = array(
			'pending' => '',
			'approved' => '',
			'rejected' => ''
		);
		$current_moderation = !empty( $review_edit['moderation_status'] ) ? $review_edit['moderation_status'] : ( !empty( $review_edit['status'] ) ? 'approved' : 'pending' );
		if( isset( $xtpl_moderation[$current_moderation] ) )
		{
			$xtpl_moderation[$current_moderation] = 'selected="selected"';
		}
		$review_edit['selected_pending'] = $xtpl_moderation['pending'];
		$review_edit['selected_approved'] = $xtpl_moderation['approved'];
		$review_edit['selected_rejected'] = $xtpl_moderation['rejected'];
	}
}

while( $view = $sth->fetch( ) )
{
	$view['link_product'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $global_array_shops_cat[$view['listcatid']]['alias'] . '/' . $view['alias'] . $global_config['rewrite_exturl'];
	$view['add_time'] = nv_date( 'H:i d/m/Y', $view['add_time'] );
	$view['moderation_status_raw'] = !empty( $view['moderation_status'] ) ? $view['moderation_status'] : ( !empty( $view['status'] ) ? 'approved' : 'pending' );
	$view['status'] = nv_shops_review_status_label( $view['moderation_status_raw'], $lang_module );
	$view['is_verified_purchase'] = !empty( $view['is_verified_purchase'] ) ? $lang_module['review_verified_purchase_yes'] : $lang_module['review_verified_purchase_no'];
	$view['edit_link'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=review&amp;edit_id=' . $view['review_id'];
	$xtpl->assign( 'VIEW', $view );
	$xtpl->parse( 'main.loop' );
}

$array_status = array(
	'pending' => nv_shops_review_status_label( 'pending', $lang_module ),
	'approved' => nv_shops_review_status_label( 'approved', $lang_module ),
	'rejected' => nv_shops_review_status_label( 'rejected', $lang_module )
);
foreach( $array_status as $key => $value )
{
	$xtpl->assign( 'STATUS', array( 'key' => $key, 'value' => $value, 'selected' => $array_search['status'] == $key ? 'selected="selected"' : '' ) );
	$xtpl->parse( 'main.status' );
}

if( !empty( $review_edit ) )
{
	$xtpl->assign( 'REVIEW_EDIT', $review_edit );
	$xtpl->parse( 'main.review_edit' );
}

$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
if( !empty( $generate_page ) )
{
	$xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['review'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
