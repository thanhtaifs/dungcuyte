<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 14 Jul 2015 13:29:47 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) )
{
	die( 'Stop!!!' );
}

// Bật hiển thị lỗi PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Bật ghi log
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_error.log');

$db_config['dbhost'] = 'localhost';
$db_config['dbport'] = '';
$db_config['dbname'] = 'ndungcu39mo_db';
$db_config['dbsystem'] = 'ndungcu39mo_db';
#$db_config['dbuname'] = 'ndungcu39mo_db';
#$db_config['dbpass'] = '_*=Q~2(7xWO~';
$db_config['dbuname'] = 'root';
$db_config['dbpass'] = '';
$db_config['dbtype'] = 'mysql';
$db_config['collation'] = 'utf8_general_ci';
$db_config['persistent'] = false;
$db_config['prefix'] = 'nv4nu';

$global_config['idsite'] = 0;
$global_config['site_url'] = 'https://dungcuytecantho.com';
$global_config['sitekey'] = 'b489e338627a82fe2de280b6df176ec6';// Do not change sitekey!
$global_config['hashprefix'] = '{SSHA}';
$global_config['rewrite_mode'] = 1;
$global_config['debug_mode'] = 1;