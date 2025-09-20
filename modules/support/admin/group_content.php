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
 $query = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_group WHERE id=" . $id;
 $result = $db->query( $query );
 $numrows = $result->rowCount();
 if ( empty( $numrows ) )
 {
 Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
 die();
 }
 $row = $result->fetch();
 define( 'IS_EDIT', true );
 $page_title = $lang_module ['support18'];
 $action = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $op . "&amp;id=" . $id;
}
else
{
 $page_title = $lang_module ['support17'];
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
 
 if ( empty( $title ) )
 {
 $error = $lang_module ['support14'];
 }
 else
 {
 
 if ( defined( 'IS_EDIT' ) )
 {
 $query = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_group SET 
 title = " . $db->quote( $title ) . " WHERE id =" . $id; 
 }
 else
 {
 $weight = $db->query( "SELECT MAX(weight) FROM " . NV_PREFIXLANG . "_" . $module_data . "_group" )->fetchColumn();
 $weight = intval( $weight ) + 1;
 
 $query = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_group VALUES (
 NULL, " . $db->quote( $title ) . ", " . $weight . ");";
 }
 
 nv_del_moduleCache( $module_name );
 if ( $db->exec( $query ) > 0 )
 {
 if ( defined( 'IS_EDIT' ) )
 {
 nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['log_edit_nsupport'], "nsupportid " . $id, $admin_info ['userid'] );
 }
 else
 {
 nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['log_add_nsupport'], " ", $admin_info ['userid'] );
 }
 Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=group_main" );
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
 }
 else
 {
 $title = "";
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
$contents .= "<td>" . $lang_module ['support04'] . ":</td>\n";
$contents .= "<td><input style=\"width:400px\" name=\"title\" id=\"idtitle\" type=\"text\" value=\"" . $title . "\" maxlength=\"255\" /></td>\n";
$contents .= "</tr>\n";
$contents .= "</tbody>\n";

$contents .= "</table>\n";

$contents .= "<br>\n";
$contents .= "<div style=\"text-align:center\"><input name=\"submit1\" type=\"submit\" value=\"" . $lang_module ['save'] . "\" /></div>\n";
$contents .= "</form>\n";

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>