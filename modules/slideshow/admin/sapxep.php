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
$val = $nv_Request->get_int('val', 'post,get');

if($id > 0)
{
	global $module_data, $db,$lang_module;
	
	//Lay gia tri cua truong sap bị thay the
	$sql = "SELECT sapxep FROM ". NV_PREFIXLANG ."_". $module_data ."_silide
				WHERE id =". $id; //Sap Xep = 1
	$rs = $db->query($sql);
	$row = $db->sql_fetch_assoc($rs);
	//Lấy giá trị cũ của số chuẩn bị thay
	
	$sql2 = "SELECT id FROM ". NV_PREFIXLANG ."_". $module_data ."_silide
				WHERE sapxep =". $val;	//ID= 16
							
	$rs2 = $db->query($sql2);
	$row2 = $db->sql_fetch_assoc($rs2);
	// lấy id của số sẽ được đổi
	
	
	$sql_up = "UPDATE ". NV_PREFIXLANG ."_". $module_data ."_silide SET 
				 `sapxep` = '". $row['sapxep'] ."'					 
				 WHERE `id` =". $row2['id'];
	$db->query($sql_up);
	
	
	$sql_up = "UPDATE ". NV_PREFIXLANG ."_". $module_data ."_silide SET 
				 `sapxep` = '". $val ."'					 
				 WHERE `id` =".$id;				 				 
	if($db->query($sql_up))
		echo $lang_module['tb_thanhcong'];
	else
		echo $lang_module['tb_thatbai']; 
				 				 
	
	
}	
?>