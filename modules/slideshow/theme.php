<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 23 Oct 2011 00:36:35 GMT
 */

if ( ! defined( 'NV_IS_MOD_SILIDE' ) ) die( 'Stop!!!' );


function nv_theme_silide_main ( $noidung )
{
 global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

 $xtpl = new XTemplate( $op . ".tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
 $xtpl->assign( 'LANG', $lang_module );
	foreach ($noidung as $nd){
		$xtpl->assign('noidung',$nd);
		$xtpl->parse( 'main.sub' );
	}
 

 $xtpl->parse( 'main' );
 return $xtpl->text( 'main' );
}

?>