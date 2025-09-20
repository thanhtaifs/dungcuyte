<?php

if (!defined('NV_MAINFILE')) die('Stop!!!');

if (!nv_function_exists('nv_news_category')) {

    // Sắp xếp tiếng Việt không dùng Collator (chạy được trên PHP 5.6)
    function sort_vietnamese_title(&$array)
    {
        $vietnamese_order = [
            'a','à','á','ả','ã','ạ','â','ầ','ấ','ẩ','ẫ','ậ','ă','ằ','ắ','ẳ','ẵ','ặ',
            'b','c','d','đ','e','è','é','ẻ','ẽ','ẹ','ê','ề','ế','ể','ễ','ệ',
            'g','h','i','ì','í','ỉ','ĩ','ị','k','l','m','n','o','ò','ó','ỏ','õ','ọ','ô','ồ','ố','ổ','ỗ','ộ','ơ','ờ','ớ','ở','ỡ','ợ',
            'p','q','r','s','t','u','ù','ú','ủ','ũ','ụ','ư','ừ','ứ','ử','ữ','ự',
            'v','x','y','ỳ','ý','ỷ','ỹ','ỵ','z'
        ];

        usort($array, function ($a, $b) use ($vietnamese_order) {
            $a_val = mb_strtolower($a['title'], 'UTF-8');
            $b_val = mb_strtolower($b['title'], 'UTF-8');
            $len = min(mb_strlen($a_val, 'UTF-8'), mb_strlen($b_val, 'UTF-8'));

            for ($i = 0; $i < $len; $i++) {
                $a_char = mb_substr($a_val, $i, 1, 'UTF-8');
                $b_char = mb_substr($b_val, $i, 1, 'UTF-8');

                $a_index = array_search($a_char, $vietnamese_order);
                $b_index = array_search($b_char, $vietnamese_order);

                if ($a_index === false) $a_index = 1000 + ord($a_char);
                if ($b_index === false) $b_index = 1000 + ord($b_char);

                if ($a_index < $b_index) return -1;
                if ($a_index > $b_index) return 1;
            }

            return mb_strlen($a_val, 'UTF-8') - mb_strlen($b_val, 'UTF-8');
        });
    }

    function nv_block_config_news_category($module, $data_block, $lang_block)
    {
        global $site_mods;
        $html_input = '';
        $html = '<tr>';
        $html .= '<td>' . $lang_block['catid'] . '</td>';
        $html .= '<td><select name="config_catid" class="form-control w200">';
        $html .= '<option value="0"> -- </option>';

        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_cat ORDER BY sort ASC';
        $list = nv_db_cache($sql, '', $module);

        sort_vietnamese_title($list);

        foreach ($list as $l) {
            $xtitle_i = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $l['lev']);
            $html_input .= '<input type="hidden" id="config_catid_' . $l['catid'] . '" value="' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'] . '" />';
            $html .= '<option value="' . $l['catid'] . '" ' . (($data_block['catid'] == $l['catid']) ? ' selected="selected"' : '') . '>' . $xtitle_i . $l['title'] . '</option>';
        }

        $html .= '</select>';
        $html .= $html_input;
        $html .= '<script type="text/javascript" data-show="after">';
        $html .= '$("select[name=config_catid]").change(function() {
                        $("input[name=title]").val($("select[name=config_catid] option:selected").text());
                        $("input[name=link]").val($("#config_catid_" + $("select[name=config_catid]").val()).val());
                    });';
        $html .= '</script>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>' . $lang_block['title_length'] . '</td>';
        $html .= '<td><select name="config_title_length" class="form-control w200">';
        for ($i = 0; $i <= 100; ++$i) {
            $html .= '<option value="' . $i . '" ' . (($data_block['title_length'] == $i) ? ' selected="selected"' : '') . '>' . $i . '</option>';
        }
        $html .= '</select></td></tr>';

        return $html;
    }

    function nv_block_config_news_category_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['catid'] = $nv_Request->get_int('config_catid', 'post', 0);
        $return['config']['title_length'] = $nv_Request->get_int('config_title_length', 'post', 0);
        return $return;
    }

    function nv_news_category($block_config)
    {
        global $module_array_cat, $module_info, $lang_module, $global_config;

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/news/block_category.tpl')) {
            $block_theme = $global_config['module_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate('block_category.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/news');

        if (!empty($module_array_cat)) {
            $title_length = $block_config['title_length'];
            $xtpl->assign('LANG', $lang_module);
            $xtpl->assign('BLOCK_ID', $block_config['bid']);
            $xtpl->assign('TEMPLATE', $block_theme);

            $cat_list = [];

            foreach ($module_array_cat as $cat) {
                if ($block_config['catid'] == 0 && $cat['parentid'] == 0 || ($block_config['catid'] > 0 && $cat['parentid'] == $block_config['catid'])) {
                    $cat_list[] = $cat;
                }
            }

            sort_vietnamese_title($cat_list);

            $html = '';
            foreach ($cat_list as $cat) {
                $html .= "<li><a title=\"" . $cat['title'] . "\" href=\"" . $cat['link'] . "\">" . nv_clean60($cat['title'], $title_length) . "</a>";
                if (!empty($cat['subcatid'])) {
                    $html .= "<span class=\"arrow expand\">+</span>";
                    $html .= nv_news_sub_category($cat['subcatid'], $title_length);
                }
                $html .= "</li>";
            }

            $xtpl->assign('MENUID', $block_config['bid']);
            $xtpl->assign('HTML_CONTENT', $html);
            $xtpl->parse('main');
            return $xtpl->text('main');
        }
    }

    function nv_news_sub_category($list_sub, $title_length)
    {
        global $module_array_cat;

        if (empty($list_sub)) {
            return '';
        }

        $list = explode(',', $list_sub);
        $cats = [];

        foreach ($list as $catid) {
            if (isset($module_array_cat[$catid])) {
                $cats[] = $module_array_cat[$catid];
            }
        }

        sort_vietnamese_title($cats);

        $html = '<ul>';
        foreach ($cats as $cat) {
            $html .= "<li><a title=\"" . $cat['title'] . "\" href=\"" . $cat['link'] . "\">" . nv_clean60($cat['title'], $title_length) . "</a>";
            if (!empty($cat['subcatid'])) {
                $html .= nv_news_sub_category($cat['subcatid'], $title_length);
            }
            $html .= "</li>";
        }
        $html .= '</ul>';

        return $html;
    }
}

if (defined('NV_SYSTEM')) {
    global $site_mods, $module_name, $global_array_cat, $module_array_cat;
    $module = $block_config['module'];
    if (isset($site_mods[$module])) {
        if ($module == $module_name) {
            $module_array_cat = $global_array_cat;
            unset($module_array_cat[0]);
        } else {
            $module_array_cat = array();
            $sql = "SELECT catid, parentid, title, alias, viewcat, subcatid, numlinks, description, inhome, keywords, groups_view FROM " . NV_PREFIXLANG . "_" . $site_mods[$module]['module_data'] . "_cat ORDER BY sort ASC";
            $list = nv_db_cache($sql, 'catid', $module);
            foreach ($list as $l) {
                $module_array_cat[$l['catid']] = $l;
                $module_array_cat[$l['catid']]['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module . "&amp;" . NV_OP_VARIABLE . "=" . $l['alias'];
            }
        }

        $content = nv_news_category($block_config);
    }
}
