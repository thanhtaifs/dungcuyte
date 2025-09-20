<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 23 Oct 2011 00:36:35 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS `".$db_config['prefix']."_".$lang."_".$module_data."_silide`";


$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE `".$db_config['prefix']."_".$lang."_".$module_data."_silide` (
`id` INT( 220 ) NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 220 ) NOT NULL ,
`link` VARCHAR( 220 ) NOT NULL ,
`url` VARCHAR( 220 ) NOT NULL ,
`sapxep` INT( 20 ) NOT NULL ,
`khoa` INT( 1 ) NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE=MyISAM;";

?>