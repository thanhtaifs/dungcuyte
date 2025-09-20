<?php

/**
 * @Project NUKEVIET 3.0
 * @Author Nhoc.Maru@yahoo.com.vn
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

$id = $nv_Request->get_int('id', 'get', 0);
$url_root = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/";
$cat_url = strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/" );

if($id!=0) {
	$array_silie = LayAnh($id);	
	$sapxep = count($array_silie);
	foreach($array_silie as $as)
	{
		if($as['khoa'] == 1)
			$as['khoa'] = 'checked="checked"';				
		$as['link'] = $url_root.$as['link'];	
		$xtpl->assign( 'config', $as );	
		$xtpl->parse( 'main.sub' );	
	}
}
else 
{
	$as['khoa'] = 'checked="checked"';		
	$xtpl->assign( 'config', $as );	
	$xtpl->parse( 'main.sub' );	
}
if( $nv_Request->get_int( 'guidi', 'post' ,1) == 0){
	$err = "";
	if($nv_Request->get_string('txtlink','post') == NULL) $err .= $lang_module['er_chonanh']."<p>";
	if($nv_Request->get_string('txtname','post') == NULL) $err .= $lang_module['er_tieude']."<p>";	
	if(!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $nv_Request->get_string('txtweb','post')))
		$err .= $lang_module['er_linkweb']."<p>";
		
	if($err == ""){ 
		if( $id == 0)
		{		
			$query = "SELECT id FROM ". NV_PREFIXLANG ."_". $module_data ."_silide";
			$rs = $db->sql_query( $query );
			if($rs)	
				$sapxep = $db->sql_numrows( $rs ) + 1;
			else
				$sapxep = 1;			
            $link = substr( $nv_Request->get_string('txtlink','post'), $cat_url );
			//---- Tao thumb ---//
				$homeimgfile = NV_DOCUMENT_ROOT . $nv_Request->get_string('txtlink','post');
				require_once ( NV_ROOTDIR . "/includes/class/image.class.php" );
                $basename = basename( $homeimgfile );
                $image = new image( $homeimgfile, NV_MAX_WIDTH, NV_MAX_HEIGHT );
                $image->resizeXY( 120, 50 );
                $image->save( NV_UPLOADS_REAL_DIR . '/' . $module_name . '/thumb/', $basename );				
                $image_info = $image->create_Image_info;
                $image->close();
			//#--- Tao thumb ---//
			$query = "INSERT INTO ". NV_PREFIXLANG ."_". $module_data ."_silide 
			VALUES(NULL,'". $nv_Request->get_string('txtname','post') ."','". $link ."'
						,'". $nv_Request->get_string('txtweb','post') ."'
						,". $sapxep .",". $nv_Request->get_string('kichhoat','post') .")" ;
			
			$rs = $db->sql_query( $query );
			if($rs){				
				Header("Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "");
				die();
			}
			
			$page_title = $lang_module['config'];
		}	
		else //Có ID Sẽ Là Sửa
		{
			if( $nv_Request->get_int( 'guidi', 'post' ,1) == 0 ){	
			//---- Tao thumb ---//
				$homeimgfile = NV_DOCUMENT_ROOT . $nv_Request->get_string('txtlink','post');
				
				require_once ( NV_ROOTDIR . "/includes/class/image.class.php" );
                $basename = "thumb.".basename( $homeimgfile );
				echo $basename;die();
                $image = new image( $homeimgfile, NV_MAX_WIDTH, NV_MAX_HEIGHT );
                $image->resizeXY( 120, 50 );
                $image->save( NV_UPLOADS_REAL_DIR . '/' . $module_name, $basename );				
                $image_info = $image->create_Image_info;
                $image->close();
			//#--- Tao thumb ---//
            	$link = substr( $nv_Request->get_string('txtlink','post'), $cat_url );					
				$query = "UPDATE ". NV_PREFIXLANG ."_". $module_data ."_silide SET 
						 `name` = '". $nv_Request->get_string('txtname','post') ."',
						 `link` = '". $link ."',
						 `url` = '". $nv_Request->get_string('txtweb','post') ."',
						 `khoa` = '". $nv_Request->get_string('kichhoat','post') ."' 
						 WHERE `id` =".$id;
				
				$rs = $db->sql_query( $query );
				if($rs){
					Header("Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "");
					die();
				}
				
				
			}
			$page_title = $lang_module['sua'];
		}
	}
	else {	
		$xtpl->assign('err',$err);
		$config1 = array (
						'name' => $nv_Request->get_string('txtname','post'),
						'link' => $nv_Request->get_string('txtlink','post'),
						'url' => $nv_Request->get_string('txturl','post')
						);
		$xtpl->assign( 'config', $config1 );
	}
}

$xtpl->assign('PATH', NV_UPLOADS_DIR . '/' . $module_name);
$xtpl->assign('BROWSER', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=upload&popup=1&area=" + area+"&path="+path+"&type="+type, "NVImg", "850", "420","resizable=no,scrollbars=no,toolbar=no,location=no,status=no');
	
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>