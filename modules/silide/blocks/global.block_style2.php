<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES., JSC. All rights reserved
 * @Createdate 3/9/2010 23:25
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if ( ! nv_function_exists( 'nv_silide_blocks' ) )
{

    function nv_block_config_silide_blocks ( $module, $data_block, $lang_block )
    {		
       global $language_array, $site_mods;
	    $html = "";        
        $html .= "<tr>";
        $html .= "	<td>" . $lang_block['numrow'] . "</td>";
        $html .= "	<td><input type=\"text\" name=\"config_numrow\" size=\"5\" value=\"" . $data_block['numrow'] . "\"/></td>";
        $html .= "</tr>";
		$html .= "<tr>";
		
        $html .= "	<td>" . $lang_block['width'] . "</td>";
        $html .= "	<td><input type=\"text\" name=\"config_width\" size=\"5\" value=\"" . $data_block['width'] . "\"/></td>";
        $html .= "</tr>";
		$html .= "<tr>";
		
        $html .= "	<td>" . $lang_block['height'] . "</td>";
        $html .= "	<td><input type=\"text\" name=\"config_height\" size=\"5\" value=\"" . $data_block['height'] . "\"/></td>";
        $html .= "</tr>";		
        return $html;
    }

    function nv_block_config_silide_blocks_submit ( $module, $lang_block )
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();        
        $return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 5 );
		$return['config']['width'] = $nv_Request->get_int( 'config_width', 'post', 959 );
		$return['config']['height'] = $nv_Request->get_int( 'config_height', 'post', 350 );		
        return $return;
    }

    function nv_silide_blocks ( $block_config )
    {
		global $module_array_cat, $module_info, $lang_module, $site_mods, $db;
		$module = $block_config['module'];
		$block_theme = $module_info['template'];
		
		$array_th = array();
		
		$sql = "SELECT * FROM ". NV_PREFIXLANG ."_". $module ."_silide
				WHERE khoa = 1 ORDER BY sapxep ASC
				LIMIT 0 , ".$block_config['numrow'];
		$rs = $db->sql_query($sql);
		
		while ($rows = $db->sql_fetchrow($rs)){
			$array_th[] = array(
							'id' => $rows['id'],
							'name' => $rows['name'],
							'link' => NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module . "/".$rows['link'],
							'url' => $rows['url'],
							'thumb' => NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module ."/thumb/".$rows['link'],
							'sapxep' => $rows['sapxep']
						 );
		}
		
		$xtpl = new XTemplate( "global.block_style2.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/".$block_config['module'] );
		$xtpl->assign( 'config', $block_config );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
    	$xtpl->assign( 'TEMPLATE', $module_info['template'] );
		foreach($array_th as $ar){			
			$xtpl->assign( 'silide' ,$ar );
			$xtpl->parse( 'main.img' );
			
			$xtpl->assign( 'silide' ,$ar );
			$xtpl->parse( 'main.thumbs' );
		}
				
        $xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
    }
	
	if ( defined( 'NV_SYSTEM' ) )
	{		
		$content = nv_silide_blocks($block_config);
	}
}


?>