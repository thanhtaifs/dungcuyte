<?php

if (!defined('NV_IS_MOD_SEARCH')) {
    die('Stop!!!');
}

//file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Đã vào search shops!\n", FILE_APPEND);

global $db, $db_config, $global_config;
global $lang_module, $key, $logic, $result_array, $num_items, $limit, $page;
global $m_values, $nv_Cache;

$result_array = [];
$num_items = 0;

// Escape từ khóa tìm kiếm
$dbkeyword = $db->dblikeescape($key);
$dbkeywordhtml = $db->dblikeescape(nv_htmlspecialchars($key));

//file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Từ khóa: $key - Escaped: $dbkeyword\n", FILE_APPEND);

// Tạo câu lệnh đếm số dòng khớp
$db->sqlreset()->select('COUNT(*)')
    ->from($db_config['prefix'] . '_' . $m_values['module_data'] . '_rows')
    ->where(
        "(" .
        nv_like_logic('vi_title', $dbkeywordhtml, $logic) . " OR " .
        nv_like_logic('product_code', $dbkeyword, $logic) . " OR " .
        nv_like_logic('vi_hometext', $dbkeywordhtml, $logic) . " OR " .
        nv_like_logic('vi_bodytext', $dbkeywordhtml, $logic) . ")" .
        " AND (publtime < " . NV_CURRENTTIME . " AND (exptime=0 OR exptime>" . NV_CURRENTTIME . "))"
    );

$num_items = (int)$db->query($db->sql())->fetchColumn();

//file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Tổng kết quả tìm thấy: $num_items\n", FILE_APPEND);

if ($num_items > 0) {
   // file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> vào ok number \n", FILE_APPEND);
    $db->select('id, vi_title, vi_alias, listcatid, vi_title, vi_hometext, vi_bodytext, homeimgthumb, homeimgfile')
        ->order('id DESC')
        ->limit($limit)
        ->offset(($page - 1) * $limit);
    $result = $db->query($db->sql());
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> vào được phần result \n", FILE_APPEND);
    
    $sql = 'SELECT catid, vi_alias AS alias FROM ' . $db_config['prefix'] . '_' . $m_values['module_data'] . '_catalogs';
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Kiểm tra \$nv_Cache: " . (is_object($nv_Cache) ? 'ĐÃ CÓ' : 'CHƯA TỒN TẠI') . "\n", FILE_APPEND);
    $array_cat_alias = [];
    $sql = 'SELECT catid, vi_alias AS alias FROM ' . $db_config['prefix'] . '_' . $m_values['module_data'] . '_catalogs';
    $stmt = $db->query($sql);
    while ($row = $stmt->fetch()) {
        $array_cat_alias[$row['catid']] = ['alias' => $row['alias']];
    }
    $array_cat_alias[0] = ['alias' => 'other'];
    //$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $m_values['module_name'] . '&amp;' . NV_OP_VARIABLE . '=';
    $link_base = NV_BASE_SITEURL . $m_values['module_name'] . '/';
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> khởi tạo link \n", FILE_APPEND);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        
        if(isset($row['vi_title'] ))
        {
            $title_alt = $row['vi_title'];
        }
        else
        {
            $title_alt  = 'no title';
        }       
        
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> while loop \n", FILE_APPEND);
        if (empty($row['listcatid'])) {
            continue;
        }
        $catids = explode(',', $row['listcatid']);
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> explode \n", FILE_APPEND);
        
        $catid = end($catids);
        if (function_exists('nv_shops_apply_variant_image')) {
            nv_shops_apply_variant_image($row['id'], $row['homeimgfile'], $row['homeimgthumb']);
        } elseif (!empty($row['id'])) {
            try {
                $variant = $db->query('SELECT image FROM ' . $db_config['prefix'] . '_' . $m_values['module_data'] . '_product_variants WHERE product_id = ' . (int)$row['id'] . " AND image != '' ORDER BY id ASC")->fetch();
                if (!empty($variant['image'])) {
                    $variant_images = preg_split('/[\r\n|,;]+/', trim((string)$variant['image']));
                    $variant_image = trim((string)$variant_images[0]);
                    if (!empty($variant_image)) {
                        if (nv_is_url($variant_image)) {
                            $row['homeimgfile'] = $variant_image;
                        } else {
                            $variant_image = ltrim($variant_image, '/');
                            $upload_prefix = trim(NV_UPLOADS_DIR, '/') . '/' . $m_values['module_name'] . '/';
                            if (strpos($variant_image, $upload_prefix) === 0) {
                                $row['homeimgfile'] = NV_BASE_SITEURL . $variant_image;
                            } else {
                                $row['homeimgfile'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $m_values['module_name'] . '/' . $variant_image;
                            }
                        }
                        $row['homeimgthumb'] = 3;
                    }
                }
            } catch (Exception $e) {
                // Keep product image fallback if variants table is unavailable here.
            }
        }
        if (isset($array_cat_alias[$catid]) && is_array($array_cat_alias[$catid]) && isset($array_cat_alias[$catid]['alias'])) {
            $cat_alias = $array_cat_alias[$catid]['alias'];
        } else {
            //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> catid $catid KHÔNG tồn tại trong array_cat_alias\n", FILE_APPEND);
            $cat_alias = 'other';
        }
        
        // Xử lý hình ảnh
        if ($row['homeimgthumb'] == 1) {
            $thumbnail_image = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $m_values['module_name'] . '/' . $row['homeimgfile'];
        } elseif ($row['homeimgthumb'] == 2) {
            $thumbnail_image = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $m_values['module_name'] . '/' . $row['homeimgfile'];
        } elseif ($row['homeimgthumb'] == 3) {
            $thumbnail_image = $row['homeimgfile'];
        } else {
            $thumbnail_image = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
        }
        
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> search php homeimgthumb: " .  $thumb . PHP_EOL, FILE_APPEND);
        
        $url = $link_base . $cat_alias . '/' . $row['vi_alias'] . $global_config['rewrite_exturl'];
        //$title = '[' . $lang_module['cart_products'] . '] ' . BoldKeywordInStr($row['vi_title'], $key, $logic);
        $title = BoldKeywordInStr($row['vi_title'], $key, $logic);
        $content = BoldKeywordInStr($row['vi_hometext'] . $row['vi_bodytext'], $key, $logic);
        
       
        //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Result thumbnail: " . $thumbnail . PHP_EOL, FILE_APPEND);

        $result_array[] = [
        'link' => $url,
        'title_alt' => $title_alt,
        'title' => $title,
        'thumbnail_image' => $thumbnail_image,
        'image' => isset($row['homeimgfile']) ? $row['homeimgfile'] : '',
        'content' => $content
        ];
    }
   
    
    //file_put_contents(NV_ROOTDIR . '/debug_seek.log', ">>> Đã gán result_array: " . var_export($result_array, true) . "\n", FILE_APPEND);
}

