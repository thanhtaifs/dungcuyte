<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NHÍM THỦ LĨNH (contact@vinanat.vn)
 * @Copyright (C) 2014 Pa Software Solutions (http://vinanat.vn). All rights reserved
 * @Createdate Nov 18, 2014, 02:32:08 PM
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$id = $nv_Request->get_int( 'id', 'post,get', 0 );

if ( $id )
{
 $query = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . " WHERE id=" . $id;
 $result = $db->query( $query );
 $numrows = $result->rowCount();
 if ( empty( $numrows ) )
 {
 Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
 die();
 }
 $row = $result->fetch();
 define( 'IS_EDIT', true );
 $page_title = $lang_module ['support11'];
 $action = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $op . "&amp;id=" . $id;
}
else
{
 $page_title = $lang_module ['support10'];
 $action = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $op;
}

$error = "";

if ( defined( 'NV_EDITOR' ) )
{
 require_once ( NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php' );
}

if ( $nv_Request->get_int( 'save', 'post' ) == '1' )
{
 $title = $nv_Request->get_title( 'title', 'post', '', 1 );
 $idgroup = $nv_Request->get_title( 'idgroup', 'post', '', 1 );
 $phone = $nv_Request->get_title( 'phone', 'post', '', 1 );
 $email = $nv_Request->get_title( 'email', 'post', '', 1 );
 $skype_item = $nv_Request->get_title( 'skype_item', 'post', '', 1 );
 $skype_type = $nv_Request->get_title( 'skype_type', 'post', '', 1 );
 $yahoo_item = $nv_Request->get_title( 'yahoo_item', 'post', '', 1 );
 $yahoo_type = $nv_Request->get_title( 'yahoo_type', 'post', '', 1 );
 $check_valid_email = nv_check_valid_email( $email );
	if ( empty( $title ) )
 {
 $error = $lang_module ['support14'];
 } elseif (!empty ($check_valid_email)){
		$error = $check_valid_email;
	} else {
 
 if ( defined( 'IS_EDIT' ) )
 {
 $query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . " SET 
			idgroup = " . $db->quote( $idgroup ) . ", 
			title=" . $db->quote( $title ) . ", 			
            phone=" . $db->quote( $phone ) . ", 
			email=" . $db->quote( $email ) . ", 
			skype_item=" . $db->quote( $skype_item ) . ", 
			skype_type=" . $db->quote( $skype_type ) . ", 
			yahoo_item=" . $db->quote( $yahoo_item ) . ", 
			yahoo_type=" . $db->quote( $yahoo_type ) . " 
			WHERE id =" . $id;
			
 }
 else
 {
 $weight = $db->query( "SELECT MAX(weight) FROM " . NV_PREFIXLANG . "_" . $module_data . "" )->fetchColumn();
 $weight = intval( $weight ) + 1;
 
 $query = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . " VALUES (
 NULL, 			
			" . $db->quote( $idgroup ) . ",
			" . $db->quote( $title ) . ",
			" . $db->quote( $phone ) . ",
			" . $db->quote( $email ) . ", 
			" . $db->quote( $skype_item ) . ", 
			" . $db->quote( $skype_type ) . ", 
			" . $db->quote( $yahoo_item ) . ", 
			" . $db->quote( $yahoo_type ) . ", 
			" . $weight . ");";
 }

 nv_del_moduleCache( $module_name );
 if ( $db->exec( $query ) > 0 )
 {
 if ( defined( 'IS_EDIT' ) )
 {
 nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['log_edit_support'], "supportid " . $id, $admin_info ['userid'] );
 }
 else
 {
 nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['log_add_support'], " ", $admin_info ['userid'] );
 }
 Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=main" );
 die();
 }
 else
 {
 $error = $lang_module ['support15'];
 }
 }
}
else
{
 if ( defined( 'IS_EDIT' ) )
 {
 $title = $row ['title'];
 $idgroup = $row ['idgroup'];
 $phone = $row ['phone'];
 $email = $row ['email'];
 $skype_item = $row ['skype_item'];
 $skype_type = $row ['skype_type'];
 $yahoo_item = $row ['yahoo_item'];
 $yahoo_type = $row ['yahoo_type'];
 }
 else
 {
 $title = $idgroup =$phone =$email = $skype_item = $skype_type = $yahoo_item = $yahoo_type = "";
 }
}

if ( ! empty( $error ) )
{
 $contents .= "<div class=\"quote\" style=\"width:780px;\">\n";
 $contents .= "<blockquote class=\"error\"><span>" . $error . "</span></blockquote>\n";
 $contents .= "</div>\n";
 $contents .= "<div class=\"clear\"></div>\n";
}
$j=0;
$contents .= "<form action=\"" . $action . "\" method=\"post\">\n";
$contents .= "<input name=\"save\" type=\"hidden\" value=\"1\" />\n";
$contents .= "<table class=\"table table-striped table-bordered table-hover\">\n";

$j ++;
$class = ( $j % 2 == 0 ) ? " class=\"second\"" : "";
$contents .= "<tbody" . $class . ">\n";
$contents .= "<tr>\n";
$contents .= "<td>" . $lang_module ['support03'] . ":</td>\n";
$contents .= "<td><input style=\"width:400px\" name=\"title\" id=\"idtitle\" type=\"text\" value=\"" . $title . "\" maxlength=\"255\" /></td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$j ++;
$class = ( $j % 2 == 0 ) ? " class=\"second\"" : "";
$contents .= "<tbody" . $class . ">\n";
$contents .= "<tr>\n";
$contents .= "<td>" . $lang_module ['support04'] . ":</td>\n";
$contents .= "<td>\n";
	$contents .= "<select name=\"idgroup\">\n";
	$sqls = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_group";
	$results = $db->query( $sqls );
	foreach( $results as $rows){
			if($rows['id'] == $idgroup){$checkselect = "selected";}else{$checkselect = "";}
	$contents .= "<option value=\"".$rows['id']."\" " . $checkselect . ">".$rows['title']."</option>";
	}
	$contents .= "</select>\n";
$contents .= "</td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$j ++;
$class = ( $j % 2 == 0 ) ? " class=\"second\"" : "";
$contents .= "<tbody" . $class . ">\n";
$contents .= "<tr>\n";
$contents .= "<td>" . $lang_module ['support05'] . ":</td>\n";
$contents .= "<td><input style=\"width:400px\" name=\"phone\" id=\"idphone\" type=\"text\" value=\"" . $phone . "\" maxlength=\"255\" /></td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$j ++;
$class = ( $j % 2 == 0 ) ? " class=\"second\"" : "";
$contents .= "<tbody" . $class . ">\n";
$contents .= "<tr>\n";
$contents .= "<td>" . $lang_module ['support06'] . ":</td>\n";
$contents .= "<td><input style=\"width:400px\" name=\"email\" id=\"idemail\" type=\"text\" value=\"" . $email . "\" maxlength=\"255\" /></td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$j ++;
$class = ( $j % 2 == 0 ) ? " class=\"second\"" : "";
$contents .= "<tbody" . $class . ">\n";
$contents .= "<tr>\n";
$contents .= "<td>" . $lang_module ['support19'] . ":</td>\n";
$contents .= "<td><input style=\"width:400px\" name=\"skype_item\" id=\"idskype_item\" type=\"text\" value=\"" . $skype_item . "\" maxlength=\"255\" /></td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$j ++;
$class = ( $j % 2 == 0 ) ? " class=\"second\"" : "";
$array = array( 'balloon', 'bigclassic', 'smallclassic', 'smallicon', 'mediumicon');
$contents .= "<tbody" . $class . ">\n";
$contents .= "<tr>\n";
$contents .= "<td>" . $lang_module ['support20'] . ":</td>\n";
$contents .= "<td>\n";
$contents .= "<select name=\"skype_type\">\n";
 foreach ( $array as $key => $val )
 {
 $contents .= "<option value=\"" . $val . "\"" . ( $val == $skype_type ? " selected=\"selected\"" : "" ) . ">" . $val . "</option>\n";
 }
$contents .= "</select>\n";
$contents .= "</td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$j ++;
$class = ( $j % 2 == 0 ) ? " class=\"second\"" : "";
$contents .= "<tbody" . $class . ">\n";
$contents .= "<tr>\n";
$contents .= "<td>" . $lang_module ['support07'] . ":</td>\n";
$contents .= "<td><input style=\"width:400px\" name=\"yahoo_item\" id=\"idyahoo_item\" type=\"text\" value=\"" . $yahoo_item . "\" maxlength=\"255\" /></td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$j ++;
$class = ( $j % 2 == 0 ) ? " class=\"second\"" : "";
$contents .= "<tbody" . $class . ">\n";
$contents .= "<tr>\n";
$contents .= "<td>" . $lang_module ['support12'] . ":</td>\n";
$contents .= "<td>\n";
$contents .= "<select name=\"yahoo_type\" style=\"width: 60px;\">\n";
			for ( $i = 0; $i <= 24; $i ++ )
			{
				$contents .= "<option value=\"" . $i . "\"" . ( $i == $yahoo_type ? " selected=\"selected\"" : "" ) . ">" . $i . "</option>\n";
			}
$contents .= "</select>\n";
$contents .= "</td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$contents .= "</table>\n";

$contents .= "<br>\n";
$contents .= "<div style=\"text-align:center\"><input name=\"submit1\"class=\"btn btn-primary\" type=\"submit\" value=\"" . $lang_module ['save'] . "\" /></div>\n";
$contents .= "</form>\n";

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>