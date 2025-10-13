<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if( ! defined( 'NV_IS_MOD_SEARCH' ) ) die( 'Stop!!!' );

if( file_exists( NV_ROOTDIR . '/modules/' . $m_values['module_file'] . '/language/' . NV_LANG_DATA . '.php' ) )
{
	require_once NV_ROOTDIR . '/modules/' . $m_values['module_file'] . '/language/' . NV_LANG_DATA . '.php';
}

// Khởi tạo biến chứa kết quả
$result_array = array(); 

// Truy vấn nhóm sản phẩm
$db->sqlreset()->select( 'COUNT(*)' )
	->from( $db_config['prefix'] . '_' . $m_values['module_data'] . '_group' )
	->where( "(" . nv_like_logic( NV_LANG_DATA . '_title', $dbkeywordhtml, $logic ) . "
		OR " . nv_like_logic( NV_LANG_DATA . '_description', $dbkeywordhtml, $logic ) . ")" );

$num_items = $db->query($db->sql())->fetchColumn();

echo "Số lượng kết quả tìm thấy: " . $num_items;
exit();

$db->select( 'groupid, ' . NV_LANG_DATA . '_title, ' . NV_LANG_DATA . '_alias, ' . NV_LANG_DATA . '_description' )
	->order( 'groupid DESC' );

$tmp_re = $db->query( $db->sql() );

if( $num_items )
{
	$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=group/';

	while( list( $groupid, $tilterow, $alias, $description ) = $tmp_re->fetch( 3 ) )
	{
		$content = $description;
		$url = $link . $alias . $global_config['rewrite_exturl'];

		$result_array[] = array(
			'link' => $url,
			'title' => '[' . $lang_module['group_title'] . '] ' . BoldKeywordInStr( $tilterow, $key, $logic ),
			'content' => BoldKeywordInStr( $content, $key, $logic )
		);
	}
}

// Truy vấn sản phẩm
$db->sqlreset()->select( 'COUNT(*)' )
	->from( $db_config['prefix'] . '_' . $m_values['module_data'] . '_rows' )
	->where( "(" . nv_like_logic( NV_LANG_DATA . '_title', $dbkeywordhtml, $logic ) . "
		OR " . nv_like_logic( 'product_code', $dbkeyword, $logic ) . "
		OR " . nv_like_logic( NV_LANG_DATA . '_bodytext', $dbkeywordhtml, $logic ) . "
		OR " . nv_like_logic( NV_LANG_DATA . '_hometext', $dbkeywordhtml, $logic ) . ")
		AND ( publtime < " . NV_CURRENTTIME . " AND (exptime=0 OR exptime>" . NV_CURRENTTIME . ") )" );

$num_items += $db->query( $db->sql() )->fetchColumn();

$db->select( 'id, ' . NV_LANG_DATA . '_title, ' . NV_LANG_DATA . '_alias, listcatid, ' . NV_LANG_DATA . '_hometext, ' . NV_LANG_DATA . '_bodytext' )
	->order( 'id DESC' )
	->limit( $limit )
	->offset( ( $page - 1 ) * $limit );

$tmp_re = $db->query( $db->sql() );

if( $num_items )
{
	// Lấy danh sách danh mục
	$sql = 'SELECT catid, ' . NV_LANG_DATA . '_alias AS alias FROM ' . $db_config['prefix'] . '_' . $m_values['module_data'] . '_catalogs';
	$array_cat_alias = nv_db_cache( $sql, 'catid', $m_values['module_name'] );
	$array_cat_alias[0] = array( 'alias' => 'Other' );

	$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=';

	while( list( $id, $tilterow, $alias, $listcatid, $hometext, $bodytext ) = $tmp_re->fetch( 3 ) )
	{
		$content = $hometext . ' ' . $bodytext;
		$catid = !empty($listcatid) ? end(explode(',', $listcatid)) : 0;

		$url = isset($array_cat_alias[$catid]) ? $link . $array_cat_alias[$catid]['alias'] . '/' . $alias . $global_config['rewrite_exturl'] : '#';

		$result_array[] = array(
			'link' => $url,
			'title' => '[' . $lang_module['cart_products'] . '] ' . BoldKeywordInStr( $tilterow, $key, $logic ),
			'content' => BoldKeywordInStr( $content, $key, $logic )
		);
	}
}

// Debug nếu cần
// var_dump($result_array); exit();
