<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NHÍM THỦ LĨNH (contact@vinanat.vn)
 * @Copyright (C) 2014 Pa Software Solutions (http://vinanat.vn). All rights reserved
 * @Createdate Nov 18, 2014, 02:32:08 PM
 */

if ( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();

$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . ";";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_group;";

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . " (
 id int(11) NOT NULL auto_increment,
 idgroup varchar(255) NOT NULL default '',
 title varchar(255) NOT NULL default '',
 phone varchar(255) NOT NULL default '',
 email varchar(255) NOT NULL default '',
 skype_item varchar(100) NOT NULL,
 skype_type varchar(100) NOT NULL,
 yahoo_item varchar(100) NOT NULL,
 yahoo_type varchar(2) NOT NULL,
 weight smallint(4) NOT NULL DEFAULT '0',
 PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_group (
 id int(11) NOT NULL auto_increment,
 title varchar(255) NOT NULL default '',
 weight smallint(4) NOT NULL DEFAULT '0',
 PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "
(id, idgroup, title, phone, email,skype_item,skype_type,yahoo_item, yahoo_type, weight) VALUES 
(NULL, '1', 'Nhím Thủ Lĩnh', '0904.9999.55','contact@vinanat.vn','nhimthulinh08', 'smallicon','nhimthulinh08', '1','6')";
$sql_create_module[] = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_group 
(id, title,weight) VALUES 
(NULL, 'Pa','3')"; 
?>