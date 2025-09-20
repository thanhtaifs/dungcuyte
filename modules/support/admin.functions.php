<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NHÍM THỦ LĨNH (contact@vinanat.vn)
 * @Copyright (C) 2014 Pa Software Solutions (http://vinanat.vn). All rights reserved
 * @Createdate Nov 18, 2014, 02:32:08 PM
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

$submenu ['group_main'] = $lang_module ['support16'];
$submenu ['content'] = $lang_module ['support10'];

$allow_func = array( 
    'main', 'list', 'content', 'del', 'del_group', 'group_main', 'change_weight', 'group_content', 'change_weightg', 'list_group'
);
function nv_fix_weight_group($gid = 0) {
	global $db, $db_config, $module_data;
	$sqlg = "SELECT id FROM ". NV_PREFIXLANG ."_". $module_data."_group ORDER BY weight ASC";
	$resultg = $db->query($sqlg);
	$array_weight_g = array();
	while ($rowg = $resultg->fetch()){
		$array_weight_g[] = $rowg['id'];
	}
	//$xxx->closeCursor();
	$weight = 0;
	foreach($array_weight_g as $groupid){
		$gid ++;
		$weight ++;
		$sql = "UPDATE ". NV_PREFIXLANG ."_". $module_data ."_group SET weight = ". $weight ." WHERE id = ". $groupid ."";
		$db->query($sql);
	}
	return $gid;
}
function nv_fix_weight_sp($spid = 0) {
	global $db, $db_config, $module_data;
	$sqlsp = "SELECT id FROM ". NV_PREFIXLANG ."_". $module_data." ORDER BY weight ASC";
	$resultsp = $db->query($sqlsp);
	$array_weight = array();
	while ($rowsp = $resultsp->fetch()){
		$array_weight[] = $rowsp['id'];
	}
	//$xxx->closeCursor();
	$weight = 0;
	foreach($array_weight as $vgtid){
		$spid ++;
		$weight ++;
		$sql = "UPDATE ". NV_PREFIXLANG ."_". $module_data ." SET weight = ". $weight ." WHERE id = ". $vgtid ."";
		$db->query($sql);
	}
	return $spid;
}
function nv_show_list ()
{
 global $db, $db_config, $lang_module, $lang_global, $module_name, $module_data;
 $contents = "";
 $url = NV_BASE_ADMINURL . "index.php?". NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=del&id=";
 $demnv = 0;
 $sqls = "SELECT id, title FROM " . NV_PREFIXLANG . "_" . $module_data . "_group ORDER BY weight ASC";
 $results = $db->query( $sqls );
 foreach ($results as $rows)
 {
 $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . " WHERE idgroup = ".$rows['id']." ORDER BY weight ASC";
 $result = $db->query( $sql );
 $num = $result->rowCount();
 if ( $num > 0 )
 {
 $contents .= "<table class=\"table table-striped table-bordered table-hover\">\n";
 $contents .= "<caption>" . $rows['title']. "</caption>\n";
 $contents .= "<thead>\n";
 $contents .= "<tr>\n";
 $contents .= "<td>" . $lang_module['support02'] . "</td>\n";
 $contents .= "<td>" . $lang_module['support03'] . "</td>\n";
 $contents .= "<td>" . $lang_module['support05'] . "</td>\n";
 $contents .= "<td align=\"center\">" . $lang_module['support06'] . "</td>\n";
 $contents .= "<td align=\"center\">" . $lang_module['support19'] . "</td>\n";
 $contents .= "<td align=\"center\">" . $lang_module['support07'] . "</td>\n";
 $contents .= "<td align=\"center\">" . $lang_module['support09'] . "</td>\n";
 $contents .= "</tr>\n";
 $contents .= "</thead>\n";
 $a = 0;
 $demnv =1;
 while ( $row = $result->fetch() )
 {
  $class = ( $a % 2 ) ? " class=\"second\"" : "";
            $contents .= "<tbody" . $class . ">\n";
            $contents .= "<tr>\n";
            $contents .= "<td><select id=\"change_weight_" . $row ['id'] . "\" onchange=\"nv_chang_weight('" . $row ['id'] . "');\">\n";
            for ( $i = 1; $i <= $num; $i ++ )
            {
                $contents .= "<option value=\"" . $i . "\"" . ( $i == $row ['weight'] ? " selected=\"selected\"" : "" ) . ">" . $i . "</option>\n";
            }
            $contents .= "</select></td>\n";
			$contents .= "<td>" . $row ['title'] . "</td>\n";
 $contents .= "<td align=\"center\">" . $row['phone'] . "</td>\n";
 $contents .= "<td align=\"center\">" . $row['email'] . "</td>\n";
 $contents .= "<td align=\"center\">" . $row['skype_item'] . "<br /><a href=\"skype:" . $row['skype_item'] . "?chat\"><img border=\"0\" alt=\"\" src=\"http://mystatus.skype.com/" . $row['skype_type'] . "/" . $row['skype_item'] . "\"/></a></td>\n";
 $contents .= "<td align=\"center\">" . $row['yahoo_item'] . "<br /><a href=\"ymsgr:sendim?" . $row['yahoo_item'] . "\"><img border=\"0\" alt=\"\" src=\"http://opi.yahoo.com/online?u=" . $row['yahoo_item'] . "&m=g&t=" . $row['yahoo_type'] . "\"/></a></td>\n";
 $contents .= "<td><span class=\"edit_icon\"><a href=\"" . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=content&amp;id=" . $row['id'] . "\">" . $lang_global['edit'] . "</a></span>\n";
 $contents .= "&nbsp;-&nbsp;<span class=\"delete_icon\"><a href=\"".$url.$row['id']."\">" . $lang_global['delete'] . "</a></span></td>\n";
 $contents .= "</tr>\n";
 $contents .= "</tbody>\n";
 $a ++;
 }
 $contents .= "</table>\n";
 }
 }
 if( $demnv == 0)
 {
 Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=content" );
 die();
 }
 $contents .= "<table class=\"table table-striped table-bordered table-hover\">\n";
 $contents .= "<thead>\n";
 $contents .= "<tr>\n";
 $contents .= "<td colspan=\"10\" align=\"center\"><span class=\"btn btn-primary\"><a style=\"color:#fff\"href=\"" . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=content\">" . $lang_module['support10'] . "</a></span></td>\n";
 $contents .= "</tr>\n";
 $contents .= "</thead>\n";
 $contents .= "</table>\n";
 
 return $contents;
}
function nv_show_list_group ()
{
    global $db, $db_config, $lang_module, $lang_global, $module_name, $module_data;
    $contents = "";
    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_group ORDER BY weight ASC";
    $result = $db->query( $sql );
    $num = $result->rowCount();
    if ( $num > 0 )
    {
        $contents .= "<table class=\"table table-striped table-bordered table-hover\">\n";
        $contents .= "<thead>\n";
        $contents .= "<tr>\n";
		$contents .= "<td>" . $lang_module ['support02'] . "</td>\n";
        $contents .= "<td>" . $lang_module ['support04'] . "</td>\n";
		$contents .= "<td align=\"center\">" . $lang_module['support09'] . "</td>\n";
		$contents .= "</tr>\n";
        $contents .= "</thead>\n";
        $a = 0;
        while ( $row = $result->fetch() )
        {
            $class = ( $a % 2 ) ? " class=\"second\"" : "";
            $contents .= "<tbody" . $class . ">\n";
            $contents .= "<tr>\n";
			$contents .= "<tr>\n";
            $contents .= "<td><select id=\"change_weightg_" . $row ['id'] . "\" onchange=\"nv_chang_weightg('" . $row ['id'] . "');\">\n";
            for ( $i = 1; $i <= $num; $i ++ )
            {
                $contents .= "<option value=\"" . $i . "\"" . ( $i == $row ['weight'] ? " selected=\"selected\"" : "" ) . ">" . $i . "</option>\n";
            }
            $contents .= "</select></td>\n";
            $contents .= "<td>" . $row ['title'] . "</td>\n";
            $contents .= "<td  align=\"center\"><span class=\"edit_icon\"><a href=\"" . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=group_content&amp;id=" . $row ['id'] . "\">" . $lang_global ['edit'] . "</a></span>\n";
            $contents .= "&nbsp;-&nbsp;<span class=\"delete_icon\"><a href=\"javascript:void(0);\" onclick=\"nv_module_del_group(" . $row ['id'] . ")\">" . $lang_global ['delete'] . "</a></span></td>\n";
            $contents .= "</tr>\n";
            $contents .= "</tbody>\n";
            $a ++;
        }
		$contents .= "<thead>\n";
        $contents .= "<tr>\n";
        $contents .= "<td colspan=\"3\" align=\"center\"><span class=\"btn btn-primary\"><a style=\"color:#fff\" href=\"" . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=group_content\">" . $lang_module['support17'] . "</a></span></td>\n";
		$contents .= "</tr>\n";
        $contents .= "</thead>\n";

        $contents .= "</table>\n";
    }
    else
    {
        Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=group_content" );
        die();
    }
    return $contents;
}

define( 'NV_IS_FILE_ADMIN', true );