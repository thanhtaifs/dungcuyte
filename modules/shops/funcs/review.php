<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3-6-2010 0:14
 */

if( ! defined( 'NV_IS_MOD_SHOPS' ) ) die( 'Stop!!!' );

function nv_shops_is_verified_purchase( $product_id, $userid )
{
	global $db, $db_config, $module_data;

	$product_id = intval( $product_id );
	$userid = intval( $userid );

	if( $product_id <= 0 || $userid <= 0 )
	{
		return 0;
	}

	$sql = 'SELECT COUNT(*) FROM ' . $db_config['prefix'] . '_' . $module_data . '_orders_id t1
		INNER JOIN ' . $db_config['prefix'] . '_' . $module_data . '_orders t2 ON t1.order_id = t2.order_id
		WHERE t1.proid = ' . $product_id . ' AND t2.user_id = ' . $userid;

	return $db->query( $sql )->fetchColumn() > 0 ? 1 : 0;
}

$contents = "";
$difftimeout = 360;
$id = $nv_Request->get_int( 'id', 'get,post', 0 );
$showdata = $nv_Request->get_int( 'showdata', 'get,post', 0 );
if( $showdata == 1 )
{
	$contents = '';
	$array_data = array();
	$page = $nv_Request->get_int( 'page', 'get', 1 );
	$per_page = 10;
	$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=review&amp;id=' . $id . '&amp;showdata=1';

	$db->sqlreset()
	  ->select( 'COUNT(*)' )
	  ->from( $db_config['prefix'] . "_" . $module_data . "_review" )
	  ->where( "product_id=" . $id . " AND moderation_status=" . $db->quote( 'approved' ) . " AND status=1" );

	$all_page = $db->query( $db->sql() )->fetchColumn();

	$db->select( '*' )
	  ->order( 'review_id DESC' )
	  ->limit( $per_page )
	  ->offset( ($page - 1) * $per_page );

	$_query = $db->query( $db->sql() );
	while( $row = $_query->fetch() )
	{
		$array_data[$row['review_id']] = $row;
	}
	$xtpl = new XTemplate( "review_list.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
	$xtpl->assign( 'LANG', $lang_module );

	if( !empty( $array_data ) )
	{
		foreach( $array_data as $data )
		{
			$data['add_time'] = nv_date( 'H:i d/m/Y', $data['add_time'] );
			$data['is_verified_purchase'] = !empty( $data['is_verified_purchase'] ) ? 1 : 0;
			$data['has_seller_response'] = !empty( $data['seller_response'] );
			if( $data['has_seller_response'] )
			{
				$data['seller_response'] = nl2br( $data['seller_response'] );
			}
			if( !empty( $data['seller_response_time'] ) )
			{
				$data['seller_response_time'] = nv_date( 'H:i d/m/Y', $data['seller_response_time'] );
			}
			$xtpl->assign( 'DATA', $data );

			if( $data['is_verified_purchase'] )
			{
				$xtpl->parse( 'main.rate_data.loop.verified_purchase' );
			}

			for( $i = 1; $i <= $data['rating']; $i++ )
			{
				$xtpl->parse( 'main.rate_data.loop.star' );
			}

			if( !empty( $data['content'] ) )
			{
				$xtpl->parse( 'main.rate_data.loop.content' );
			}

			if( $data['has_seller_response'] )
			{
				$xtpl->parse( 'main.rate_data.loop.seller_response' );
			}

			$xtpl->parse( 'main.rate_data.loop' );
		}

		if( ( $page * $per_page ) < $all_page )
		{
			$xtpl->assign( 'NEXT_PAGE', $page + 1 );
			$xtpl->assign( 'LOAD_MORE_URL', $base_url );
			$xtpl->parse( 'main.rate_data.load_more' );
		}
		$xtpl->parse( 'main.rate_data' );
	}
	else
	{
		$xtpl->assign( 'EMPTY', $lang_module['rate_empty'] );
		$xtpl->parse( 'main.rate_empty' );
	}

	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );

	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';
    exit();
}

if( ! defined( 'NV_IS_AJAX' ) ) die( 'Wrong URL' );

$timeout = $nv_Request->get_int( $module_data . '_' . $op . '_' . $id, 'cookie', 0 );
if( $timeout == 0 or NV_CURRENTTIME - $timeout > $difftimeout )
{
	$sender = $nv_Request->get_string( 'sender', 'get,post', '' );
	$rating = $nv_Request->get_int( 'rating', 'get,post', 0 );
	$comment = $nv_Request->get_textarea( 'comment', '' );
	$fcode = $nv_Request->get_string( 'fcode', 'get,post', '' );

	if( empty( $sender ) )
	{
		$contents = "NO_" . $lang_module['rate_empty_sender'];
	}
	elseif( empty( $rating ) )
	{
		$contents = "NO_" . $lang_module['rate_empty_rating'];
	}
	elseif( $pro_config['review_captcha'] and ! nv_capcha_txt( $fcode ) )
	{
		$contents = "NO_" . $lang_module['rate_empty_captcha'];
	}
	else
	{
		$userid = !empty( $user_info ) ? $user_info['userid'] : 0;
		$is_verified_purchase = nv_shops_is_verified_purchase( $id, $userid );
		$moderation_status = 'pending';
		$status = 0;
		$sth = $db->prepare( 'INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_review( product_id, userid, sender, content, rating, add_time, edit_time, status, is_verified_purchase, moderation_status, helpful_count, unhelpful_count, seller_response, seller_response_time, spam_score, edited_count, rejection_reason) VALUES( :product_id, :userid, :sender, :content, :rating, ' . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', ' . $status . ', :is_verified_purchase, :moderation_status, 0, 0, NULL, NULL, 0, 0, NULL )' );
		$sth->bindParam( ':product_id', $id, PDO::PARAM_STR );
		$sth->bindParam( ':userid', $userid, PDO::PARAM_INT );
		$sth->bindParam( ':sender', $sender, PDO::PARAM_STR, strlen( $sender ) );
		$sth->bindParam( ':content', $comment, PDO::PARAM_STR, strlen( $comment ) );
		$sth->bindParam( ':rating', $rating, PDO::PARAM_INT );
		$sth->bindParam( ':is_verified_purchase', $is_verified_purchase, PDO::PARAM_INT );
		$sth->bindParam( ':moderation_status', $moderation_status, PDO::PARAM_STR );
		if( $sth->execute() )
		{
			$content = array( 'product_id' => $id, 'content' => $comment, 'rating' => $rating, 'status' => $status, 'moderation_status' => $moderation_status );
			nv_insert_notification( $module_name, 'review_new', $content, 0, $userid, 1 );
			nv_del_moduleCache( $module_name );
			$contents = "OK_" . $lang_module['rate_success_queue'];
		}
		else
		{
			$contents = "NO_" . $lang_module['rate_success_fail'];
		}
		$nv_Request->set_Cookie( $module_data . '_' . $op . '_' . $id, NV_CURRENTTIME );
	}
}
else
{
	$timeout = ceil( ( $difftimeout - NV_CURRENTTIME + $timeout ) / 60 );
	$timeoutmsg = sprintf( $lang_module['detail_rate_timeout'], $timeout );
	$contents = "NO_" . $timeoutmsg;
}

include NV_ROOTDIR . '/includes/header.php';
echo $contents;
include NV_ROOTDIR . '/includes/footer.php';
