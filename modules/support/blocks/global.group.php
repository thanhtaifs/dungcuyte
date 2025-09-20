<?php

/**
 * @Project VINAGON - HOTDEAL 1.1.0
 * @Author VINAGON.COM (info@vinagon.com)
 * @Copyright (C) 2012 VINAGON.COM. All rights reserved
 * @Createdate Sat, 08 Aug 2013 02:59:43 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if ( ! nv_function_exists( 'nv_global_hotro_support' ) )
{

 function nv_block_config_hotro_blocks ( $module, $data_block, $lang_block )
 {
 global $db, $language_array, $site_mods;
 $html = "";
 $html .= "<tr>";
 $html .= "	<td>" . $lang_block['supportid'] . "</td>";
 $html .= "	<td><select name=\"config_supportid\">\n";
 $sql = "SELECT * FROM " . NV_PREFIXLANG . "_support_group ORDER BY weight ASC";
 $result = $db->query( $sql );
 foreach (  $result as $rows )
 {
 $sel = ( $data_block['supportid'] == $rows['id'] ) ? ' selected' : '';
 $html .= "<option value=\"" . $rows['id'] . "\" " . $sel . ">" . $rows['title'] . "</option>\n";
 }
 $html .= "	</select></td>\n";
 $html .= "</tr>";
 return $html;
 }

 function nv_block_config_hotro_blocks_submit ( $module, $lang_block )
 {
 global $nv_Request;
 $return = array();
 $return['error'] = array();
 $return['config'] = array();
 $return['config']['supportid'] = $nv_Request->get_int( 'config_supportid', 'post', 0 );
 return $return;
 }

 function nv_global_hotro_support ( $block_config )
 {
 global $global_config, $db;
 if ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/support/group.tpl" ) )
 {
 $block_theme = $global_config['site_theme'];
 }
 else
 {
 $block_theme = "default";
 }
 $xtpl = new XTemplate( "group.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/support" );
 $xtpl->assign( 'TEMPLATE', $block_theme );
 $base_url_site = NV_BASE_SITEURL . "?";

 
 $sql = "SELECT * FROM " . NV_PREFIXLANG . "_support where idgroup= " . $block_config['supportid'] ." ORDER BY id ASC";
 $list = $db->query($sql);
 while ( $row = $list->fetch() )
 {
 $skype_item_sub = trim( $row['skype_item'] );
 $skype_type_sub = trim( $row['skype_type'] );
 $yahoo_item_sub = trim( $row['yahoo_item'] );
 $yahoo_type_sub = intval( $row['yahoo_type'] );
 $xtpl->assign( 'TITLE', $row['title'] );
 $xtpl->assign( 'PHONE', $row['phone'] );
 $xtpl->assign( 'EMAIL', $row['email'] );
 $xtpl->assign( 'SKITEM', $skype_item_sub );
 $xtpl->assign( 'SKTYPE', $skype_type_sub );
 $xtpl->assign( 'YHITEM', $yahoo_item_sub );
 $xtpl->assign( 'YHTYPE', $yahoo_type_sub );
 if ( ! empty( $skype_item_sub ) )
 {
 $xtpl->parse( 'main.loop.iconskype' );
 }
 if ( ! empty( $yahoo_item_sub ) )
 {
 $xtpl->parse( 'main.loop.iconyahoo' );
 }
 $xtpl->assign( 'CONTACT', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=contact" );
 $xtpl->parse( 'main.loop' );
 }
 
 $xtpl->parse( 'main' );
 return $xtpl->text( 'main' );
 }

}

if ( defined( 'NV_SYSTEM' ) )
{
 $content = nv_global_hotro_support( $block_config );
}
?>