<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 31/05/2010, 00:36
 */

 if( ! defined( 'NV_SYSTEM' ) or ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

function dungcuyte_add_schema( $schema )
{
	global $dungcuyte_schema_nodes;

	if( empty( $schema ) )
	{
		return;
	}

	if( ! isset( $dungcuyte_schema_nodes ) || ! is_array( $dungcuyte_schema_nodes ) )
	{
		$dungcuyte_schema_nodes = array();
	}

	$nodes = isset( $schema['@graph'] ) && is_array( $schema['@graph'] ) ? $schema['@graph'] : array( $schema );

	foreach( $nodes as $node )
	{
		if( empty( $node ) || ! is_array( $node ) )
		{
			continue;
		}

		unset( $node['@context'] );
		$key = ! empty( $node['@id'] ) ? $node['@id'] : md5( json_encode( $node, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) );
		$dungcuyte_schema_nodes[$key] = $node;
	}
}

function dungcuyte_render_schema()
{
	global $dungcuyte_schema_nodes;

	if( empty( $dungcuyte_schema_nodes ) || ! is_array( $dungcuyte_schema_nodes ) )
	{
		return '';
	}

	$schema = array(
		'@context' => 'https://schema.org',
		'@graph' => array_values( $dungcuyte_schema_nodes )
	);

	return '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . "</script>\n";
}

function dungcuyte_absolute_url( $url )
{
	global $global_config;

	if( empty( $url ) )
	{
		return '';
	}

	if( preg_match( '#^https?://#i', $url ) )
	{
		return $url;
	}

	$site_url = ! empty( $global_config['site_url'] ) ? rtrim( $global_config['site_url'], '/' ) : '';
	return $site_url . '/' . ltrim( $url, '/' );
}

function dungcuyte_build_website_schema()
{
	global $global_config;

	$site_url = ! empty( $global_config['site_url'] ) ? rtrim( $global_config['site_url'], '/' ) : '';

	return array(
		'@context' => 'https://schema.org',
		'@graph' => array(
			array(
				'@type' => 'WebSite',
				'@id' => $site_url . '/#website',
				'url' => $site_url,
				'name' => $global_config['site_name'],
				'description' => $global_config['site_description'],
				'publisher' => array(
					'@id' => $site_url . '/#localbusiness'
				),
				'potentialAction' => array(
					'@type' => 'SearchAction',
					'target' => $site_url . '/index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=seek&q={search_term_string}',
					'query-input' => 'required name=search_term_string'
				)
			)
		)
	);
}

function dungcuyte_build_localbusiness_schema()
{
	global $global_config;

	$site_url = ! empty( $global_config['site_url'] ) ? rtrim( $global_config['site_url'], '/' ) : '';
	$logo_url = '';

	if( ! empty( $global_config['site_logo'] ) )
	{
		$logo_url = $site_url . '/' . ltrim( $global_config['site_logo'], '/' );
	}

	$schema = array(
		'@context' => 'https://schema.org',
		'@graph' => array(
			array(
				'@type' => 'LocalBusiness',
				'@id' => $site_url . '/#localbusiness',
				'name' => 'CÔNG TY TNHH HUỲNH GIA ALPHA',
				'url' => $site_url,
				'image' => $logo_url,
				'logo' => $logo_url,
				'description' => ! empty( $global_config['site_description'] ) ? $global_config['site_description'] : 'Thiết bị y tế Huỳnh Gia Alpha tại Cần Thơ và Vĩnh Long',
				'email' => 'huynhgiact65@gmail.com',
				'telephone' => '+84937037770',
				'priceRange' => '$$',
				'address' => array(
					'@type' => 'PostalAddress',
					'streetAddress' => '4AB1 Xuân Thủy, KDC Cái Sơn - Hàng Bàng, KV2, P. An Bình',
					'addressLocality' => 'Cần Thơ',
					'addressRegion' => 'Cần Thơ',
					'addressCountry' => 'VN'
				),
				'areaServed' => array(
					array(
						'@type' => 'City',
						'name' => 'Cần Thơ'
					),
					array(
						'@type' => 'State',
						'name' => 'Vĩnh Long'
					)
				),
				'branchOf' => array(
					'@type' => 'Organization',
					'name' => 'CÔNG TY TNHH HUỲNH GIA ALPHA'
				),
				'hasMap' => 'https://www.google.com/maps/place/D%E1%BB%A5ng+c%E1%BB%A5+y+khoa+C%E1%BA%A7n+Th%C6%A1+-+Hu%E1%BB%B3nh+Gia+1/@10.0265453,105.7493923,17z'
			),
			array(
				'@type' => 'LocalBusiness',
				'@id' => $site_url . '/#huynh-gia-1',
				'name' => 'Dụng cụ y khoa Cần Thơ - Huỳnh Gia 1',
				'parentOrganization' => array(
					'@id' => $site_url . '/#localbusiness'
				),
				'telephone' => '+84906377086',
				'address' => array(
					'@type' => 'PostalAddress',
					'streetAddress' => '04-06 Xuân Thủy, KDC Hồng Phát, P. An Bình',
					'addressLocality' => 'Cần Thơ',
					'addressRegion' => 'Cần Thơ',
					'addressCountry' => 'VN'
				),
				'hasMap' => 'https://www.google.com/maps/place/D%E1%BB%A5ng+c%E1%BB%A5+y+khoa+C%E1%BA%A7n+Th%C6%A1+-+Hu%E1%BB%B3nh+Gia+1/@10.0265453,105.7493923,17z'
			),
			array(
				'@type' => 'LocalBusiness',
				'@id' => $site_url . '/#huynh-gia-2',
				'name' => 'Cửa hàng thiết bị y tế Cần Thơ - Huỳnh Gia 2',
				'parentOrganization' => array(
					'@id' => $site_url . '/#localbusiness'
				),
				'telephone' => '+84907694868',
				'address' => array(
					'@type' => 'PostalAddress',
					'streetAddress' => '369B Nguyễn Văn Cừ nối dài, KV4, P. Tân An',
					'addressLocality' => 'Cần Thơ',
					'addressRegion' => 'Cần Thơ',
					'addressCountry' => 'VN'
				),
				'hasMap' => 'https://www.google.com/maps/place/C%E1%BB%ACA+H%C3%80NG+THI%E1%BA%BET+B%E1%BB%8A+Y+T%E1%BA%BE+C%E1%BA%A6N+TH%C6%A0+(HU%E1%BB%B2NH+GIA+1%262)/@10.0316776,105.7529779,15z'
			),
			array(
				'@type' => 'LocalBusiness',
				'@id' => $site_url . '/#huynh-gia-3',
				'name' => 'Cửa hàng thiết bị y tế Vĩnh Long - Huỳnh Gia 3',
				'parentOrganization' => array(
					'@id' => $site_url . '/#localbusiness'
				),
				'telephone' => '+84907694868',
				'address' => array(
					'@type' => 'PostalAddress',
					'streetAddress' => '37A Phạm Hùng, Khóm 2, P. Long Châu',
					'addressLocality' => 'Vĩnh Long',
					'addressRegion' => 'Vĩnh Long',
					'addressCountry' => 'VN'
				),
				'hasMap' => 'https://www.google.com/maps/place/C%E1%BB%ACA+H%C3%80NG+THI%E1%BA%BET+B%E1%BB%8A+Y+T%E1%BA%BE+V%C4%A8NH+LONG+(HU%E1%BB%B2NH+GIA+4)/@10.2599847,105.9427509,15z'
			)
		)
	);

	return $schema;
}

function dungcuyte_build_breadcrumb_schema( $breadcrumbs )
{
	global $global_config, $lang_global;

	$site_url = ! empty( $global_config['site_url'] ) ? rtrim( $global_config['site_url'], '/' ) : '';
	$items = array(
		array(
			'title' => $lang_global['Home'],
			'link' => $site_url . '/index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA
		)
	);

	if( ! empty( $breadcrumbs ) && is_array( $breadcrumbs ) )
	{
		foreach( $breadcrumbs as $breadcrumb )
		{
			if( empty( $breadcrumb['title'] ) || empty( $breadcrumb['link'] ) )
			{
				continue;
			}

			$items[] = array(
				'title' => strip_tags( $breadcrumb['title'] ),
				'link' => dungcuyte_absolute_url( $breadcrumb['link'] )
			);
		}
	}

	if( sizeof( $items ) < 2 )
	{
		return array();
	}

	$list = array();
	foreach( $items as $position => $item )
	{
		$list[] = array(
			'@type' => 'ListItem',
			'position' => $position + 1,
			'name' => $item['title'],
			'item' => $item['link']
		);
	}

	return array(
		'@context' => 'https://schema.org',
		'@graph' => array(
			array(
				'@type' => 'BreadcrumbList',
				'@id' => $site_url . '/#breadcrumb',
				'itemListElement' => $list
			)
		)
	);
}

function nv_site_theme( $contents, $full = true )
{
	global $home, $array_mod_title, $lang_global, $language_array, $global_config, $site_mods, $module_name, $module_info, $op_file, $mod_title, $my_head, $my_footer, $client_info, $module_config, $op;

	//error_log('===== DEBUG nv_site_theme =====');
	//error_log('Layout funcs: ' . print_r($module_info['layout_funcs'], true));
	//error_log('op_file: ' . $op_file);
	//error_log('Layout file: ' . (isset($module_info['layout_funcs'][$op_file]) ? 'layout.' . $module_info['layout_funcs'][$op_file] . '.tpl' : 'layout.default.tpl'));


	// Determine tpl file, check exists tpl file
	//$layout_file = ( $full ) ? 'layout.' . $module_info['layout_funcs'][$op_file] . '.tpl' : 'simple.tpl';
	if($module_name == 'shops' && $op == 'main')
    {
        $layout_file = 'layout.home.tpl';
    }
    else
    {
        $layout_file = ( $full ) ? 'layout.' . $module_info['layout_funcs'][$op_file] . '.tpl' : 'simple.tpl';
    }

	if( ! file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/layout/' . $layout_file ) )
	{
		nv_info_die( $lang_global['error_layout_title'], $lang_global['error_layout_title'], $lang_global['error_layout_content'] );
	}

	if( isset( $global_config['sitetimestamp'] ) )
	{
		$global_config['timestamp'] += $global_config['sitetimestamp'];
	}

	$css = nv_html_css();
	// Css for admin
	if( defined( 'NV_IS_ADMIN' ) and $full )
	{
		$css .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . NV_BASE_SITEURL . "themes/" . $global_config['module_theme'] . "/css/admin.css\" />\n";
	}

    // Style config
    if ( isset( $module_config['themes'][$global_config['module_theme']] ) )
	{
		if ( ! file_exists( NV_ROOTDIR . '/' . SYSTEM_FILES_DIR . '/css/theme_' . $global_config['module_theme'] . '_' . $global_config['idsite'] . '.css' ) )
	    	{
	    		$config_theme = unserialize( $module_config['themes'][$global_config['module_theme']] );
	    		$css_content = nv_css_setproperties( 'body', $config_theme['body'] );
	    		$css_content .= nv_css_setproperties( 'a, a:link, a:active, a:visited', $config_theme['a_link'] );
	    		$css_content .= nv_css_setproperties( 'a:hover', $config_theme['a_link_hover'] );
	    		$css_content .= nv_css_setproperties( '#wraper', $config_theme['content'] );
	    		$css_content .= nv_css_setproperties( '#header, #banner', $config_theme['header'] );
	    		$css_content .= nv_css_setproperties( '#footer', $config_theme['footer'] );
	    		$css_content .= nv_css_setproperties( '.panel, .well, .nv-block-banners', $config_theme['block'] );
	    		//$css_content .= nv_css_setproperties( '.panel-default>.panel-heading', $config_theme['block_heading'] );
	    		$css_content .= nv_css_setproperties( 'generalcss', $config_theme['generalcss'] ); // Không nên thay đổi "generalcss"
	
	    		file_put_contents( NV_ROOTDIR . '/' . SYSTEM_FILES_DIR . '/css/theme_' . $global_config['module_theme'] . '_' . $global_config['idsite'] . '.css', $css_content );
	    		unset( $config_theme, $css_content );
	    	}
		// Theme config CSS is not enqueued; current design styles are maintained in style.css.
	}

	$xtpl = new XTemplate( $layout_file, NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/layout' );
	$xtpl->assign( 'LANG', $lang_global );
	$xtpl->assign( 'TEMPLATE', $global_config['module_theme'] );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );

	$xtpl->assign( 'NV_SITE_COPYRIGHT', $global_config['site_name'] . ' [' . $global_config['site_email'] . '] ' );
	$xtpl->assign( 'NV_SITE_NAME', $global_config['site_name'] );
	$xtpl->assign( 'NV_SITE_TITLE', $global_config['site_name'] . ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['admin_page'] . ' ' . NV_TITLEBAR_DEFIS . ' ' . $module_info['custom_title'] );
	$xtpl->assign( 'SITE_DESCRIPTION', $global_config['site_description'] );
	$xtpl->assign( 'NV_CHECK_PASS_MSTIME', (intval( $global_config['user_check_pass_time'] ) - 62) * 1000 );
	$xtpl->assign( 'MODULE_NAME', $module_name );
	$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
	$xtpl->assign( 'NV_LANG_INTERFACE', NV_LANG_INTERFACE );
	$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
	$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
	$xtpl->assign( 'NV_SITE_TIMEZONE_OFFSET', round( NV_SITE_TIMEZONE_OFFSET / 3600 ) );
	$xtpl->assign( 'NV_CURRENTTIME', nv_date( 'T', NV_CURRENTTIME ) );
	$xtpl->assign( 'NV_COOKIE_PREFIX', $global_config['cookie_prefix'] );

	$xtpl->assign( 'LANG_TIMEOUTSESS_NOUSER', $lang_global['timeoutsess_nouser'] );
	$xtpl->assign( 'LANG_TIMEOUTSESS_CLICK', $lang_global['timeoutsess_click'] );
	$xtpl->assign( 'LANG_TIMEOUTSESS_SEC', $lang_global['sec'] );
	$xtpl->assign( 'LANG_TIMEOUTSESS_TIMEOUT', $lang_global['timeoutsess_timeout'] );
	$xtpl->assign( 'MSGBEFOREUNLOAD', $lang_global['msgbeforeunload'] );

	// System variables
	$theme_page_title = nv_html_page_title();
	if( $home )
	{
		$home_seo_title = 'Dụng Cụ Y Tế Cần Thơ | Máy siêu âm, Máy đo huyết áp, Giường bệnh, Xe lăn - Huỳnh Gia Alpha';
		$home_seo_description = 'Huỳnh Gia Alpha cung cấp thiết bị y tế, dụng cụ y khoa, giường bệnh, xe lăn, máy đo huyết áp tại Cần Thơ và Đồng bằng sông Cửu Long.';
		$theme_page_title = '<title>' . nv_htmlspecialchars( $home_seo_title ) . '</title>' . PHP_EOL;
		$global_config['site_description'] = $home_seo_description;
		$meta_property['og:title'] = $home_seo_title;
		$meta_property['og:description'] = $home_seo_description;
	}
	$xtpl->assign( 'THEME_PAGE_TITLE', $theme_page_title );
	$xtpl->assign( 'THEME_META_TAGS', nv_html_meta_tags() );
	$xtpl->assign( 'THEME_SITE_RSS', nv_html_site_rss() );
	$xtpl->assign( 'THEME_CSS', $css );
	$xtpl->assign( 'THEME_SITE_JS', nv_html_site_js() );
	dungcuyte_add_schema( dungcuyte_build_website_schema() );
	dungcuyte_add_schema( dungcuyte_build_localbusiness_schema() );
	
	if($client_info['browser']['key'] == "explorer" AND $client_info['browser']['version'] < 9)
	{
		$xtpl->parse( 'main.lt_ie9' );
	}
	
	if($client_info['browser']['key'] == "explorer" AND $client_info['browser']['version'] < 7)
	{
		$xtpl->parse( 'main.lt_ie7' );
	}
	    
	if( $global_config['current_theme_type'] == 'r' )
	{
		$xtpl->parse( 'main.viewport' );
		$xtpl->parse( 'main.responsive' );
	}
	else
	{
		$xtpl->parse( 'main.non_responsive' );
	}

	// Module contents
	$xtpl->assign( 'MODULE_CONTENT', $contents );

	// Header variables
	$xtpl->assign( 'SITE_NAME', $global_config['site_name'] );
	$xtpl->assign( 'THEME_SITE_HREF', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA );
	// Ưu tiên dùng ảnh og:image nếu module đã thiết lập
	$logo_src = NV_BASE_SITEURL . $global_config['site_logo'];

	if (!empty($meta_property['og:image'])) {
		$logo_src = $meta_property['og:image'];
	}

	$xtpl->assign('LOGO_SRC', $logo_src);

	$size = @getimagesize( NV_ROOTDIR . '/' . $global_config['site_logo'] );
	$xtpl->assign( 'LOGO_WIDTH', $size[0] );
	$xtpl->assign( 'LOGO_HEIGHT', $size[1] );

	if( isset( $size['mime'] ) and $size['mime'] == 'application/x-shockwave-flash' )
	{
		$xtpl->parse( 'main.swf' );
	}
	else
	{
		$xtpl->parse( 'main.image' );
	}

	if( $op == 'main' ) $xtpl->parse( 'main.main_h1' );
	else  $xtpl->parse( 'main.main_none_h1' );
	// Only full theme
	if( $full )
	{
		// Search form variables
		$xtpl->assign( 'THEME_SEARCH_QUERY_MAX_LENGTH', NV_MAX_SEARCH_LENGTH );
		$xtpl->assign( 'THEME_SEARCH_SUBMIT_ONCLICK', "nv_search_submit('topmenu_search_query', 'topmenu_search_submit', " . NV_MIN_SEARCH_LENGTH . ", " . NV_MAX_SEARCH_LENGTH . ");" );
        $xtpl->assign('THEME_SEARCH_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=seek&q=');
		// Breadcrumbs
		// if( $home != 1 && $module_name != 'seek' && $module_name != 'search')
		// {
		// 	if( $global_config['rewrite_op_mod'] != $module_name )
		// 	{


		// 		$arr_cat_title_i = array(
		// 			'catid' => 0,
		// 			'title' => $module_info['custom_title'],
		// 			'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name
		// 		);
		// 		// error_log("=== BEFORE array_unshift ===");
		// 		// foreach ($array_mod_title as $i => $arr) {
		// 		// 	error_log($i . " => " . $arr['title']);
		// 		// }
		// 		array_unshift( $array_mod_title, $arr_cat_title_i );
		// 	}
		// 	if( ! empty( $array_mod_title ) )
		// 	{				
		// 		foreach( $array_mod_title as $arr_cat_title_i )
		// 		{
		// 			$xtpl->assign( 'BREADCRUMBS', $arr_cat_title_i );
		// 			$xtpl->parse( 'main.breadcrumbs.loop' );
		// 		}
		// 		$xtpl->parse( 'main.breadcrumbs' );
		// 	}
		// }

		// Đảm bảo biến $global_array_shops_cat được khai báo
		if (!isset($global_array_shops_cat)) {
			global $global_array_shops_cat;
		}
		// Lặp từ con lên cha
		while (isset($catid_i) && $catid_i > 0 && isset($global_array_shops_cat[$catid_i])) {
			$array_mod_title[] = array(
				'catid' => $catid_i,
				'title' => $global_array_shops_cat[$catid_i]['title'],
				'link'  => $global_array_shops_cat[$catid_i]['link']
			);
			$catid_i = $global_array_shops_cat[$catid_i]['parentid'];
		}

		// Đảo ngược để được Cha → Con
		$array_mod_title = array_reverse($array_mod_title);
		$excluded_modules = ['seek', 'search']; // Loại trừ module
		$excluded_ops = ['cart', 'payment', 'order']; // Loại trừ các trang con trong module shops
		// Thêm module cha "Sản phẩm" vào đầu
		if ($home != 1	&& !in_array($module_name, $excluded_modules, true)	&& !in_array($op, $excluded_ops, true)) 
		{
			if ($global_config['rewrite_op_mod'] != $module_name) {
				$arr_cat_title_i = [
					'catid' => 0,
					'title' => $module_info['custom_title'],
					'link'  => NV_BASE_SITEURL . 'index.php?' 
						. NV_LANG_VARIABLE . '=' . NV_LANG_DATA 
						. '&amp;' . NV_NAME_VARIABLE . '=' . $module_name
				];
				array_unshift($array_mod_title, $arr_cat_title_i);
			}

			if (!empty($array_mod_title)) {
				foreach ($array_mod_title as $arr_cat_title_i) {
					$xtpl->assign('BREADCRUMBS', $arr_cat_title_i);
					$xtpl->parse('main.breadcrumbs.loop');
				}
				dungcuyte_add_schema( dungcuyte_build_breadcrumb_schema( $array_mod_title ) );
				$xtpl->parse('main.breadcrumbs');
			}
		}

		// Statistics image
		$theme_stat_img = '';
		if( $global_config['statistic'] and isset( $site_mods['statistics'] ) )
		{
			$theme_stat_img .= "<a title=\"" . $lang_global['viewstats'] . "\" href=\"" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=statistics\"><img alt=\"" . $lang_global['viewstats'] . "\" src=\"" . NV_BASE_SITEURL . "index.php?second=statimg&amp;p=" . nv_genpass() . "\" width=\"88\" height=\"31\" /></a>\n";
		}

		$xtpl->assign( 'THEME_STAT_IMG', $theme_stat_img );

		// Change theme types
		$mobile_theme = empty( $module_info['mobile'] ) ?  $global_config['mobile_theme'] : $module_info['mobile'];
		if( empty( $mobile_theme ) or empty( $global_config['switch_mobi_des'] ))
		{
			$array_theme_type  = array_diff( $global_config['array_theme_type'], array( 'm' ) );
		}
		else
		{
			$array_theme_type = $global_config['array_theme_type'];
		}
		$num_theme_type = sizeof( $array_theme_type ) - 1;
		foreach( $array_theme_type as $i => $theme_type )
		{
			$xtpl->assign( 'STHEME_TYPE', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;nv' . NV_LANG_DATA . 'themever=' . $theme_type . '&amp;nv_redirect=' . nv_base64_encode( $client_info['selfurl'] ) );
			$xtpl->assign( 'STHEME_TITLE', $lang_global['theme_type_' . $theme_type] );
			$xtpl->assign( 'STHEME_INFO', sprintf( $lang_global['theme_type_chose'], $lang_global['theme_type_' . $theme_type] ) );

			if( $theme_type == $global_config['current_theme_type'] )
			{
				$xtpl->parse( 'main.theme_type.loop.current' );
			}
			else
			{
				$xtpl->parse( 'main.theme_type.loop.other' );
			}

			if( $i < $num_theme_type ) $xtpl->parse( 'main.theme_type.loop.space' );

			$xtpl->parse( 'main.theme_type.loop' );
		}
		$xtpl->parse( 'main.theme_type' );
	}	
	
	$xtpl->parse( 'main' );
	$sitecontent = $xtpl->text( 'main' );
    
	// Only full theme
	if( $full )
	{
		$sitecontent = nv_blocks_content( $sitecontent );
		$sitecontent = str_replace( '[THEME_ERROR_INFO]', nv_error_info(), $sitecontent );

		if( defined( 'NV_IS_ADMIN' ) )
		{
			$my_footer = nv_admin_menu() . $my_footer;
		}
	}

	$schema_head = dungcuyte_render_schema();
	if( ! empty( $schema_head ) )
	{
		$my_head .= $schema_head;
	}

	if( ! empty( $my_head ) ) $sitecontent = preg_replace( '/(<\/head>)/i', $my_head . '\\1', $sitecontent, 1 );
	if( ! empty( $my_footer ) ) $sitecontent = preg_replace( '/(<\/body>)/i', $my_footer . '\\1', $sitecontent, 1 );

	return $sitecontent;
}
