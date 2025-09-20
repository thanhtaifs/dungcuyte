<?php

/**
 * @Project VINAGON - HOTDEAL 1.1.0
 * @Author VINAGON.COM (info@vinagon.com)
 * @Copyright (C) 2012 VINAGON.COM. All rights reserved
 * @Createdate Sat, 08 Aug 2013 02:59:43 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if ( ! nv_function_exists( 'nv_global_support' ) )
{

 function nv_global_support ()
 {
 global $global_config, $db;
 if ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/support/global_support.tpl" ) )
 {
 $block_theme = $global_config['site_theme'];
 }
 else
 {
 $block_theme = "default";
 }
 $xtpl = new XTemplate( "global_support.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/support" );
 $xtpl->assign( 'TEMPLATE', $block_theme );
 $base_url_site = NV_BASE_SITEURL . "?";
 $res_tr = $db->query( "SELECT * FROM " . NV_PREFIXLANG . "_support_group ORDER BY weight" );
 while ( $rows = $res_tr->fetch() )
 {
 $xtpl->assign( 'ROWS', $rows );
 $id = $rows['id'];
 $res = $db->query( "SELECT * FROM " . NV_PREFIXLANG . "_support where idgroup='$id' ORDER BY weight ASC" );
 while ( $row = $res->fetch() )
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
 $xtpl->parse( 'main.loop.icon.iconskype' );
 }
 if ( ! empty( $yahoo_item_sub ) )
 {
 $xtpl->parse( 'main.loop.icon.iconyahoo' );
 }
 $xtpl->assign( 'CONTACT', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=contact" );
 $xtpl->parse( 'main.loop.icon' );
 }
 $xtpl->parse( 'main.loop' );
 }
 $xtpl->parse( 'main' );
 return $xtpl->text( 'main' );
 }

}

if ( defined( 'NV_SYSTEM' ) )
{
 $content = nv_global_support();
}
?>