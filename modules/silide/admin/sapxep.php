<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
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
	$rs = $db->sql_query($sql);
	$row = $db->sql_fetch_assoc($rs);
	//Lấy giá trị cũ của số chuẩn bị thay
	
	$sql2 = "SELECT id FROM ". NV_PREFIXLANG ."_". $module_data ."_silide
				WHERE sapxep =". $val;	//ID= 16
							
	$rs2 = $db->sql_query($sql2);
	$row2 = $db->sql_fetch_assoc($rs2);
	// lấy id của số sẽ được đổi
	
	
	$sql_up = "UPDATE ". NV_PREFIXLANG ."_". $module_data ."_silide SET 
				  `sapxep` = '". $row['sapxep'] ."'					 
				  WHERE `id` =". $row2['id'];
	$db->sql_query($sql_up);
	
	
	$sql_up = "UPDATE ". NV_PREFIXLANG ."_". $module_data ."_silide SET 
				  `sapxep` = '". $val ."'					 
				  WHERE `id` =".$id;				  				  
	if($db->sql_query($sql_up))
		echo $lang_module['tb_thanhcong'];
	else
		echo $lang_module['tb_thatbai']; 
				  				  
	
	
}	
?>