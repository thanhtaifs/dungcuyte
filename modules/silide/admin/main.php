<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate Sun, 23 Oct 2011 00:36:35 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$xtpl = new XTemplate( $op . ".tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$array_silie = LayAnh(0);
$sapxep = count($array_silie);

$url = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=";
$action = array(
				'sua' => 'config&id=',
				'xoa' => 'del&id='
				);
foreach($array_silie as $as)
{
	if($as['khoa'] == 1)
		$as['khoa'] = 'checked="checked"';
		
	$xtpl->assign( 'url', $url );
	
	$select = $as['sapxep'];
	
	for($i=1;$i <= $sapxep;$i++){
		if($i == $select) 
			$selected = 'selected="selected"';
		else 
			$selected = '';
		
		$xtpl->assign( 'sapxep', '<option value="'.$i.'"'. $selected .'>'.$i.'</option>' );
		$xtpl->parse( 'main.sub.sapxep' );	
	}
	$xtpl->assign( 'action', $action );
	$as['link'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/".$as['link'];
	$xtpl->assign( 'config', $as );	
	$xtpl->parse( 'main.sub' );	
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );
$page_title = $lang_module['main'];

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>