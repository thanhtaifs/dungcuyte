<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Apr 20, 2010 10:47:41 AM
 */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if (! defined('NV_IS_MOD_PAGE')) {
    die('Stop!!!');
}
global $module_data;
//file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào page main.php - ' . date('H:i:s') . PHP_EOL, FILE_APPEND);
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name;
$contents = '';
     if ($id) {
    // xem theo bài viết
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào page main.php if - '. $id . PHP_EOL, FILE_APPEND);
    $base_url_rewrite = nv_url_rewrite($base_url . '&' . NV_OP_VARIABLE . '=' . $rowdetail['alias'] . $global_config['rewrite_exturl'], true);
    //$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name;
    //$base_url_rewrite = NV_BASE_SITEURL . 'page/' . $rowdetail['alias'] . $global_config['rewrite_exturl'];
    
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'base url - '. $base_url_rewrite  . PHP_EOL, FILE_APPEND);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'module name - '. $module_name  . PHP_EOL, FILE_APPEND);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', '$rowdetail - '. $rowdetail['alias']  . PHP_EOL, FILE_APPEND);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', '[FIXED base_url] ' . $base_url . PHP_EOL, FILE_APPEND);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', '[Rewrite URL] ' . $base_url_rewrite . PHP_EOL, FILE_APPEND);
    
    if ($_SERVER['REQUEST_URI'] == $base_url_rewrite) {
        $canonicalUrl = NV_MAIN_DOMAIN . $base_url_rewrite;
    } elseif (NV_MAIN_DOMAIN . $_SERVER['REQUEST_URI'] != $base_url_rewrite) {
        if (! empty($array_op) and $_SERVER['REQUEST_URI'] != $base_url_rewrite) {
            Header('Location: ' . $base_url_rewrite);
            die();
        }
        $canonicalUrl = $base_url_rewrite;
    }

    if (! empty($rowdetail['image']) && ! nv_is_url($rowdetail['image'])) {
        $imagesize = @getimagesize(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $rowdetail['image']);
        $rowdetail['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $rowdetail['image'];
        $rowdetail['imageWidth'] = $imagesize[0] > 500 ? 500 : $imagesize[0];
		$meta_property['og:image'] = NV_MY_DOMAIN . $rowdetail['image'];
    }
    $rowdetail['add_time'] = nv_date('H:i T l, d/m/Y', $rowdetail['add_time']);
    $rowdetail['edit_time'] = nv_date('H:i T l, d/m/Y', $rowdetail['edit_time']);

    $module_info['layout_funcs'][$op_file] = !empty($rowdetail['layout_func']) ? $rowdetail['layout_func'] : $module_info['layout_funcs'][$op_file];

    if (! empty($rowdetail['keywords'])) {
        $key_words = $rowdetail['keywords'];
    } else {
        $key_words = nv_get_keywords($rowdetail['bodytext']);

        if (empty($key_words)) {
            $key_words = nv_unhtmlspecialchars($rowdetail['title']);
            $key_words = strip_punctuation($key_words);
            $key_words = trim($key_words);
            $key_words = nv_strtolower($key_words);
            $key_words = preg_replace('/[ ]+/', ',', $key_words);
        }
    }

    $page_title = $mod_title = $rowdetail['title'];
    $description = $rowdetail['description'];
    $id_profile_googleplus = $rowdetail['gid'];

    // Hiển thị các bài liên quan mới nhất.
	$other_links = array();

	$related_articles = intval( $page_config['related_articles'] );
	if( $related_articles )
	{
	    $db->sqlreset()->select( '*' )->from( NV_PREFIXLANG . '_' . $module_data )->where( 'id !=' . $id )->order( 'weight ASC' )->limit( $related_articles );
	    $result = $db->query($db->sql());
		while( $_other = $result->fetch() )
		{
			$_other['link'] = $base_url . '&amp;' . NV_OP_VARIABLE . '=' . $_other['alias'] . $global_config['rewrite_exturl'];
			$other_links[$_other['id']] = $_other;
		}
	}

    // comment
    if (isset($site_mods['comment']) and isset($module_config[$module_name]['activecomm'])) {
        define('NV_COMM_ID', $id);//ID bài viết
        define('NV_COMM_AREA', $module_info['funcs'][$op]['func_id']);
        //check allow comemnt
        $allowed = $module_config[$module_name]['allowed_comm'];//tuy vào module để lấy cấu hình. Nếu là module news thì có cấu hình theo bài viết
        if ($allowed == '-1') {
            $allowed = $rowdetail['activecomm'];
        }
        define('NV_PER_PAGE_COMMENT', 5); //Số bản ghi hiển thị bình luận
        require_once NV_ROOTDIR . '/modules/comment/comment.php';
        $area = (defined('NV_COMM_AREA')) ? NV_COMM_AREA : 0;
        $checkss = md5($module_name . '-' . $area . '-' . NV_COMM_ID . '-' . $allowed . '-' . NV_CACHE_PREFIX);

        $content_comment = nv_comment_module($module_name, $checkss, $area, NV_COMM_ID, $allowed, 1);
    } else {
        $content_comment = '';
    }

    $contents = nv_page_main($rowdetail, $other_links, $content_comment);
} else {
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào page main.php else ', FILE_APPEND);
    // Xem theo danh sách
    $page_title = $module_info['custom_title'];
    //(NV_ROOTDIR . '/debug_seek.log', 'Đã vào page m- ' . $page_title . PHP_EOL, FILE_APPEND);
    $key_words = $module_info['keywords'];
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào  keywword- ' . $key_words . PHP_EOL, FILE_APPEND);
    $mod_title = isset($lang_module['main_title']) ? $lang_module['main_title'] : $module_info['custom_title'];
    $per_page = $page_config['per_page'];
   
    $array_data = array();
    file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'module_data: ' . $module_data . PHP_EOL, FILE_APPEND);
    //$db_slave->sqlreset()->select('COUNT(*)')->from(NV_PREFIXLANG . '_' . $module_data)->where('status=1
    $db->sqlreset()->select( 'COUNT(*)' )->from( NV_PREFIXLANG . '_' . $module_data );
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'SQL COUNT: ' . $sql . PHP_EOL, FILE_APPEND);
    $num_items = $db->query( $db->sql() )->fetchColumn();
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'num_items: ' . $num_items . PHP_EOL, FILE_APPEND);
    $db->select( '*' )->order( 'weight' )->limit( $per_page )->offset( ($page - 1) * $per_page);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'get per_page_db \n', FILE_APPEND);
    $result = $db->query($db->sql());
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'result db \n', FILE_APPEND);
    while( $row = $result->fetch() )
	{
		$row['link'] = $base_url . '&amp;' . NV_OP_VARIABLE . '=' . $row['alias'] . $global_config['rewrite_exturl'];
		//file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào page m- ' . $row['link'] . PHP_EOL, FILE_APPEND);
		$array_data[$row['id']] = $row;
	}
	$generate_page = nv_alias_page( $page_title, $base_url, $num_items, $per_page, $page);
	file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào page $generate_page', FILE_APPEND);
	
	if( $page > 1 )
	{
		$page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
		//file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào page m- ' . $page_title . PHP_EOL, FILE_APPEND);
	}
	//file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào page m- ' . $page . PHP_EOL, FILE_APPEND);
	$contents = nv_page_main_list( $array_data, $generate_page );
    // $db_slave->select('*')->order('weight')->limit($per_page)->offset(($page - 1) * $per_page);

    // $result = $db_slave->query($db_slave->sql());
    // while ($row = $result->fetch()) {
    //     $row['link'] = $base_url . '&amp;' . NV_OP_VARIABLE . '=' . $row['alias'] . $global_config['rewrite_exturl'];
    //     $array_data[$row['id']] = $row;
    // }

    // $generate_page = nv_alias_page($page_title, $base_url, $num_items, $per_page, $page);

    // if ($page > 1) {
    //     $page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
    // }

    // $contents = nv_page_main_list($array_data, $generate_page);
}
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
