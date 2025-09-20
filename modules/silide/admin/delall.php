<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 2-9-2010 14:43
 */
if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$listall = $nv_Request->get_string('listall', 'post,get');

$array_id = explode(',', $listall);
$array_id = array_map("intval", $array_id);
$rs = false;
foreach($array_id as $id)
{
	global $module_data, $db,$lang_module;
	if($id > 0)
	{
		$rs = Del($id);
	}
}
if($rs)
	echo $lang_module['tb_thanhcong'];
else
	echo $lang_module['tb_thatbai'];

?>