<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NHÍM THỦ LĨNH (contact@vinanat.vn)
 * @Copyright (C) 2014 Pa Software Solutions (http://vinanat.vn). All rights reserved
 * @Createdate Nov 18, 2014, 02:32:08 PM
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

$submenu['main'] = $lang_module['support01'];
$submenu['group_main'] = $lang_module['support16'];
$submenu['content'] = $lang_module['support10'];

$allow_func = array( 
 'main', 'list', 'content', 'del', 'del_group', 'group_main', 'change_weight', 'group_content', 'change_weightg', 'list_group' 
);

?>