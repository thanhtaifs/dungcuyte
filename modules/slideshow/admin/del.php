<?php
/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */
if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$id = $nv_Request->get_int('id', 'post,get');

if($id > 0)
{
	global $module_data, $db,$lang_module;
	if(Del($id))
	{
		SapXep();
		echo $lang_module['tb_thanhcong'];
	}
	else
		echo $lang_module['tb_thatbai'];	
}

?>