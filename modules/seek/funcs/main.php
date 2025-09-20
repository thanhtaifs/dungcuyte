<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 24/8/2010, 2:0
 */

if (! defined('NV_IS_MOD_SEARCH')) {
    die('Stop!!!');
}
//file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đã vào main.php - ' . date('H:i:s') . PHP_EOL, FILE_APPEND);

$array_mod = LoadModulesSearch();

// Bỏ qua các module không có search.php hoặc không cần thiết
$modules_to_skip = ['about', 'dich-vu', 'khuyen-mai','page','news'];

foreach ($modules_to_skip as $mod_skip) {
    if (isset($array_mod[$mod_skip])) {
        unset($array_mod[$mod_skip]);
    }
}

//file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'array_mod: ' . var_export($array_mod, true) . PHP_EOL, FILE_APPEND);
$is_search = false;
$search = array(
    'key' => '',
    'len_key' => 0,
    'mod' => 'all',
    'logic' => 1, //OR
    'page' => 1,
    'is_error' => false,
    'errorInfo' => '',
    'content' => ''
);

if ($nv_Request->isset_request('q', 'get')) {
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'GET: ' . var_export($_GET, true) . PHP_EOL, FILE_APPEND);
    $is_search = true;

    $search['key'] = nv_substr($nv_Request->get_title('q', 'get', ''), 0, NV_MAX_SEARCH_LENGTH);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Từ khóa: ' . $search['key'] . PHP_EOL, FILE_APPEND);
    
    $search['key'] = str_replace('+', ' ', urldecode($search['key']));
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'str_replace: ' . $search['key'] . PHP_EOL, FILE_APPEND);
    
    $search['mod'] = $nv_Request->get_title('m', 'get', 'all', $search['mod']);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'mod: ' . $search['mod'] . PHP_EOL, FILE_APPEND);
    $search['logic'] = $nv_Request->get_int('l', 'get', $search['logic']);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'logic: ' . $search['logic'] . PHP_EOL, FILE_APPEND);
    $search['page'] = $nv_Request->get_int('page', 'get', 1);
    file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'page: ' . $search['page'] . PHP_EOL, FILE_APPEND);

    if ($search['logic'] != 1) {
        $search['logic'] = 0;
    }
    if (! isset($array_mod[$search['mod']])) {
        $search['mod'] = 'all';
    }

    $base_url_rewrite = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&q=' . htmlspecialchars(nv_unhtmlspecialchars($search['key']));
    //$base_url_rewrite = NV_BASE_SITEURL . 'seek/' . rawurlencode($search['key']);
    
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Bắt đầu xử lý base url \n", FILE_APPEND);
    if ($search['mod'] != 'all') {
        $base_url_rewrite .= '&m=' . htmlspecialchars(nv_unhtmlspecialchars($search['mod']));
    }
    if ($search['logic'] != 1) {
        $base_url_rewrite .= '&l=' . $search['logic'];
    }
    if ($search['page'] > 1) {
        $base_url_rewrite .= '&page=' . $search['page'];
    }
    $base_url_rewrite = nv_url_rewrite($base_url_rewrite, true);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Bắt đầu xử lý base url rewrite \n", FILE_APPEND);
    
    $request_uri = urldecode($_SERVER['REQUEST_URI']);
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đi qua đoạn xử lý : reqquest uri' . $request_uri . PHP_EOL, FILE_APPEND);
   
    /* if ($request_uri != $base_url_rewrite and NV_MAIN_DOMAIN . $request_uri != $base_url_rewrite) {
        file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'base_url_rewrite: ' . $base_url_rewrite . PHP_EOL, FILE_APPEND);
        file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'NV_MAIN_DOMAIN: ' . NV_MAIN_DOMAIN . PHP_EOL, FILE_APPEND);
        Header('Location: ' . $base_url_rewrite);
        die();
    } */

    if (! empty($search['key'])) {
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Đi qua đoạn xử lý từ khóa, len_key: ' . $search['len_key'] . PHP_EOL, FILE_APPEND);
        if (! $search['logic']) {
            $search['key'] = preg_replace(array( "/^([\S]{1})\s/uis", "/\s([\S]{1})\s/uis", "/\s([\S]{1})$/uis" ), " ", $search['key']);
        }
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> truoc trim \n", FILE_APPEND);
        $search['key'] = trim($search['key']);
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Bắt đầu xử lý độ dài từ khóa\n", FILE_APPEND);
        $search['len_key'] = nv_strlen($search['key']);
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Độ dài key: ' . $search['len_key'] . PHP_EOL, FILE_APPEND);
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Giá trị NV_MIN_SEARCH_LENGTH: ' . NV_MIN_SEARCH_LENGTH . PHP_EOL, FILE_APPEND);
    }

    if ($search['len_key'] < NV_MIN_SEARCH_LENGTH) {
        $search['is_error'] = true;
        $search['errorInfo'] = sprintf($lang_module['searchQueryError'], NV_MIN_SEARCH_LENGTH);
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Lỗi độ dài từ khóa, nhỏ hơn NV_MIN_SEARCH_LENGTH' . PHP_EOL, FILE_APPEND);
    } else {
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'Từ khóa hợp lệ, chuẩn bị xử lý module' . PHP_EOL, FILE_APPEND);
        if (isset($array_mod[$search['mod']])) {
            $mods = array( $search['mod'] => $array_mod[$search['mod']] );
            $limit = 24;
            $is_generate_page = true;
        } else {
            $mods = $array_mod;
            $limit = 24;
            $is_generate_page = false;
        }
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', 'mods after check: ' . var_export($mods, true) . PHP_EOL, FILE_APPEND);

        $dbkeyword = $db->dblikeescape($search['key']);
        $dbkeywordhtml = $db->dblikeescape(nv_htmlspecialchars($search['key']));
        $logic = $search['logic'] ? 'AND' : 'OR';
        $key = $search['key'];

        foreach ($mods as $m_name => $m_values) {
            //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">> Bắt đầu vòng foreach, có " . count($mods) . " module\n", FILE_APPEND);
            $page = $search['page'];
            $num_items = 0;
            $result_array = array();
            //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">> Đang xử lý module: $m_name - file: $search_file\n", FILE_APPEND);
            $search_file = NV_ROOTDIR . '/modules/' . $m_values['module_file'] . '/search.php';
            //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">> Đang xử lý module: $m_name - file: $search_file\n", FILE_APPEND);
            if (file_exists($search_file)) {
                //file_put_contents(NV_ROOTDIR . '/debug_seek.log', "  - File search.php TỒN TẠI, chuẩn bị include...\n", FILE_APPEND);
                //include $search_file;
                if (file_exists($search_file)) {
                    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">> Tìm thấy file search, chuẩn bị include...\n", FILE_APPEND);
                    try {
                        ob_start();
                        include $search_file;
                        $output = ob_get_clean();
                        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">> Đã include search.php thành công. Output: $output\n", FILE_APPEND);
                    } catch (Exception $e) {
                        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">> LỖI khi include search.php: " . $e->getMessage() . "\n", FILE_APPEND);
                    }
                } else {
                    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">> KHÔNG TÌM THẤY FILE search.php\n", FILE_APPEND);
                }
                //file_put_contents(NV_ROOTDIR . '/debug_seek.log', "  - Đã include search.php xong\n", FILE_APPEND);
            } else {
                //file_put_contents(NV_ROOTDIR . '/debug_seek.log', "  - KHÔNG tìm thấy file search.php\n", FILE_APPEND);
                continue;
            }
        
            //file_put_contents(NV_ROOTDIR . '/debug_seek.log', "  - num_items: $num_items\n", FILE_APPEND);
            //file_put_contents(NV_ROOTDIR . '/debug_seek.log', "  - result_array: " . var_export($result_array, true) . "\n", FILE_APPEND);
            if (! empty($num_items) and ! empty($result_array)) {
                $search['content'] .= search_result_theme($result_array, $m_name, $m_values['custom_title'], $search, $is_generate_page, $limit, $num_items);
            }
        }
        if (empty($search['content'])) {
            $search['content'] = $lang_module['search_none'] . ' &quot;' . $search['key'] . '&quot;';
        }
    }
}

$contents = search_main_theme($is_search, $search, $array_mod);

$page_title = $module_info['custom_title'];

if (! empty($search['key'])) {
    $page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $search['key'];

    if ($search['page'] > 1) {
        $page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $search['page'];
    }
}

$key_words = $description = 'no';
$mod_title = isset($lang_module['main_title']) ? $lang_module['main_title'] : $module_info['custom_title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
