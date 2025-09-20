<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate Sun, 23 Oct 2011 00:36:35 GMT
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

$submenu['main'] = $lang_module['main'];
$submenu['config'] = $lang_module['config'];

$allow_func = array( 'main', 'config','del','khoa','sapxep',"delall");

function LayAnh($id) {
	global $module_data, $db;	
	if((int)$id == 0)
		$sql = "SELECT * FROM ". NV_PREFIXLANG ."_". $module_data ."_silide ORDER BY sapxep ASC";
	else
		$sql = "SELECT * FROM ". NV_PREFIXLANG ."_". $module_data ."_silide
				WHERE id=".$id;
		
	$rs = $db->sql_query($sql);
	$array_data = array();
	while ($rows = $db->sql_fetchrow($rs)){
		$array_data[] = array(
								'id' => $rows['id'],
								'name' => $rows['name'],
								'link' => $rows['link'],
								'url' => $rows['url'],
								'sapxep' => $rows['sapxep'],
								'khoa' => $rows['khoa'],
							 );
	}
	return $array_data;
}

function Del($id)
{
	global $module_data, $db;
	$sql = "DELETE FROM ". NV_PREFIXLANG ."_". $module_data ."_silide 
			WHERE id = ".$id;
	$rs = $db->sql_query($sql);		
	return $rs;
}


function SapXep()
{
	global $module_data, $db;
	$sql = "SELECT id FROM ". NV_PREFIXLANG ."_". $module_data ."_silide ORDER BY sapxep ASC";
	$rs = $db->sql_query($sql);
	$dem = 1;
	while ($rows = $db->sql_fetchrow($rs)){		
		$sql_up = "UPDATE ". NV_PREFIXLANG ."_". $module_data ."_silide SET 
				  `sapxep` = '". $dem ."'					 
				  WHERE `id` =".$rows['id'];				  
		$db->sql_query($sql_up);		
		$dem++;
	}
}


define( 'NV_IS_FILE_ADMIN', true );

?>