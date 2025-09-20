<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES ., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Jan 17, 2011 11:34:27 AM
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( defined( 'NV_IS_FILE_THEMES' ) )
{
	// include config theme
	require NV_ROOTDIR . '/modules/menu/menu_config.php';
	//file_put_contents(NV_ROOTDIR . '/menu_debug.log', "Chạy qua được menu_config\n", FILE_APPEND);
}


if( ! nv_function_exists( 'nv_block_mobile_menu' ) )
{
    //file_put_contents(NV_ROOTDIR . '/menu_debug.log', "OK \n", FILE_APPEND);
	/**
	 * nv_menu_bootstrap_check_current()
	 *
	 * @param mixed $url
	 * @param integer $type
	 * @return
	 *
	 */

    function nv_block_mobile_menu($block_config)
    {
        //file_put_contents(NV_ROOTDIR . '/menu_debug.log', "nv_menu_mobile ok \n", FILE_APPEND);
        global $db, $db_config, $global_config, $site_mods, $module_info, $module_name, $module_file, $module_data, $lang_global, $catid, $home;

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/menu/mobile_menu.tpl' ) )
		{
		    //file_put_contents(NV_ROOTDIR . '/menu_debug.log', " file_exists mobile_menu.tpl \n", FILE_APPEND);
			$block_theme = $global_config['module_theme'];
		}
		elseif( file_exists( NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/menu/mobile_menu.tpl' ) )
		{
		    //file_put_contents(NV_ROOTDIR . '/menu_debug.log', " file_exists mobile_menu.tpl \n", FILE_APPEND);
			$block_theme = $global_config['site_theme'];
		}
		else
		{
			$block_theme = 'default';
		}

		$array_menu = array();
		//file_put_contents(NV_ROOTDIR . '/menu_debug.log', "nv_menu_mobile pass array menu \n", FILE_APPEND);
		$sql = 'SELECT id, parentid, title, link, icon, note, subitem, groups_view, module_name, op, target, css, active_type FROM ' . NV_PREFIXLANG . '_menu_rows WHERE status=1 AND mid = ' . $block_config['menuid'] . ' ORDER BY weight ASC';
		//file_put_contents(NV_ROOTDIR . '/menu_debug.log', "SQL: " . $sql . "\n", FILE_APPEND);
		$list = nv_db_cache( $sql, '', $block_config['module'] );
		foreach( $list as $row )
		{
			if( nv_user_in_groups( $row['groups_view'] ) )
			{
				switch( $row['target'] )
				{
					case 1:
						$row['target'] = '';
						break;
					case 3:
						$row['target'] = ' onclick="window.open(this.href,\'targetWindow\',\'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,\');return false;"';
						break;
					default:
						$row['target'] = ' onclick="this.target=\'_blank\'"';
				}

				$array_menu[$row['parentid']][$row['id']] = array(
					'id' => $row['id'],
					'title' => $row['title'],
					'title_trim' => nv_clean60( $row['title'], $block_config['title_length'] ),
					'target' => $row['target'],
					'note' => empty( $row['note'] ) ? $row['title'] : $row['note'],
					'link' => nv_url_rewrite( nv_unhtmlspecialchars( $row['link'] ), true ),
					'icon' => ( empty( $row['icon'] ) ) ? '' : NV_BASE_SITEURL . NV_UPLOADS_DIR . '/menu/' . $row['icon'],
					'css' => $row['css'],
					'active_type' => $row['active_type']
				);
			}
		}
		//file_put_contents(NV_ROOTDIR . '/menu_debug.log', "nv_menu_mobile pass foreach \n", FILE_APPEND);
		$xtpl = new XTemplate( 'mobile_menu.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/menu' );
		$xtpl->assign( 'LANG', $lang_global );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
		$xtpl->assign( 'BLOCK_THEME', $block_theme );
		$xtpl->assign( 'THEME_SITE_HREF', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA );
		foreach( $array_menu[0] as $id => $item )
		{
		    //file_put_contents(NV_ROOTDIR . '/menu_debug.log', "item: " . $item . "\n", FILE_APPEND);
			$classcurrent = array();
			$submenu_active = array();
			if( isset( $array_menu[$id] ) )
			{
				$classcurrent[] = 'dropdown';
				$submenu = nv_get_bootstrap_submenu( $id, $array_menu, $submenu_active, $block_theme );
				$xtpl->assign( 'SUB', $submenu );
				$xtpl->parse( 'main.top_menu.sub' );
				$xtpl->parse( 'main.top_menu.has_sub' );
			}
			if( nv_menu_bootstrap_check_current( $item['link'], $item['active_type'] ) )
			{
				$classcurrent[] = 'active';
			}
			elseif( ! empty( $submenu_active ) )
			{
				$classcurrent[] = 'active';
			}
			if( ! empty( $item['class'] ) )
			{
				$classcurrent[] = $item['class'];
			}
			$item['current'] = empty( $classcurrent ) ? '' : ' class="' . ( implode( ' ', $classcurrent ) ) . '"';

			if( nv_menu_bootstrap_check_current( $item['link'], $item['active_type'] ) )
			{
				$classcurrent[] = 'active';
			}

			$xtpl->assign( 'TOP_MENU', $item );
			if( ! empty( $item['icon'] ) )
			{
				$xtpl->parse( 'main.top_menu.icon' );
			}
			$xtpl->parse( 'main.top_menu' );
		}
		
		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
    }

}


if( defined( 'NV_SYSTEM' ) )
{
	$content = nv_block_mobile_menu( $block_config );
}