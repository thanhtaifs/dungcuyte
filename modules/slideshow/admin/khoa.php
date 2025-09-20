<?php
/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */
if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$result = false;
$id = $nv_Request->get_int('id', 'post,get');

if($id > 0)
{
	global $module_data, $db,$lang_module;
	
	$sql = "SELECT khoa FROM ". NV_PREFIXLANG ."_". $module_data ."_silide 
			WHERE id =".$id;
			
	$rs = $db->query($sql);
	
	while ($rows = $db->sql_fetchrow($rs)){	
	if($rows['khoa']==0)	
		$khoa = 1;
	else
		$khoa = 0;
			
		$sql_up = "UPDATE ". NV_PREFIXLANG ."_". $module_data ."_silide SET 
				 `khoa` = '". $khoa ."'					 
				 WHERE `id` =".$id;				 
		if(!$db->query($sql_up)) 
			echo $lang_module['tb_thatbai'];
		else
			echo $lang_module['tb_thanhcong'];
	}	

}

?>