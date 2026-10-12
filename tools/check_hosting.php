<?php
// Read-only diagnostics. Run in the hosting terminal: php tools/check_hosting.php
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
$root = dirname(__DIR__);
$failures = 0;
function hosting_check($ok, $label)
{
    global $failures;
    echo ($ok ? 'OK   ' : 'FAIL ') . $label . PHP_EOL;
    if (!$ok) ++$failures;
}
echo 'PHP ' . PHP_VERSION . ' (' . PHP_SAPI . ')' . PHP_EOL;
echo 'Use the same PHP version as the website PHP-FPM/Apache handler.' . PHP_EOL;
hosting_check(version_compare(PHP_VERSION, '7.3.0', '>='), 'PHP >= 7.3 required by session cookie options; local tested version: 8.0.30');
foreach (array('session', 'json', 'PDO', 'pdo_mysql', 'openssl', 'mbstring') as $extension) {
    hosting_check(extension_loaded($extension), 'Extension: ' . $extension);
}
foreach (array('hash_equals', 'random_bytes', 'password_hash', 'password_verify') as $function) {
    hosting_check(function_exists($function), 'Function: ' . $function);
}
$files = array(
    'index.php', 'mainfile.php', 'includes/constants.php', 'includes/class/error.class.php',
    'includes/functions.php', 'includes/core/admin_access.php',
    'includes/core/auth_security.php', 'includes/core/is_user.php',
    'includes/class/request.class.php', 'includes/class/nv_crypt.class.php',
    'modules/shops/functions.php', 'modules/shops/theme.php', 'modules/shops/bank_transfer.php',
    'modules/shops/funcs/order.php', 'modules/shops/funcs/payment.php', 'modules/shops/funcs/setcart.php',
    'modules/users/functions.php', 'modules/users/theme.php',
    'modules/users/funcs/register.php', 'modules/users/funcs/register_email_otp.php',
    'themes/dungcuytecantho/modules/shops/payment.tpl',
    'themes/dungcuytecantho/modules/shops/order.tpl',
    'themes/dungcuytecantho/modules/shops/order_check.tpl',
    'themes/dungcuytecantho/modules/shops/bank_transfer.tpl',
    'themes/dungcuytecantho/css/bank-transfer.css', 'themes/dungcuytecantho/js/bank-transfer.js'
);
$manifest = array();
foreach ($files as $file) {
    $present = is_file($root . '/' . $file) && is_readable($root . '/' . $file);
    hosting_check($present, 'File: ' . $file);
    if ($present) $manifest[$file] = hash_file('sha256', $root . '/' . $file);
}
$manifest_file = $root . '/tools/hosting_manifest.json';
if (is_readable($manifest_file)) {
    $expected = json_decode(file_get_contents($manifest_file), true);
    hosting_check(is_array($expected), 'Deployment manifest is valid');
    if (is_array($expected)) foreach ($expected as $file => $hash) {
        hosting_check(isset($manifest[$file]) && $manifest[$file] === $hash, 'Version matches local: ' . $file);
    }
}
foreach (array('logs', 'logs/error_logs', 'cache', 'tmp') as $directory) {
    hosting_check(is_dir($root . '/' . $directory) && is_writable($root . '/' . $directory), 'Writable directory: ' . $directory);
}
$rate_path = $root . '/logs/auth_security';
hosting_check(is_dir($rate_path) ? is_writable($rate_path) : is_writable($root . '/logs'), 'Authentication rate limit directory writable or creatable');
$log_file = $root . '/error_php.log';
hosting_check(is_file($log_file) ? is_writable($log_file) : is_writable($root), 'PHP error log writable or creatable');
if (extension_loaded('pdo_mysql') && is_readable($root . '/config.php')) {
    define('NV_MAINFILE', true);
    require $root . '/config.php';
    try {
        $database = new PDO('mysql:host=' . $db_config['dbhost'] . ';dbname=' . $db_config['dbsystem'] . ';charset=utf8mb4', $db_config['dbuname'], $db_config['dbpass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        hosting_check(true, 'Database connection using hosting config.php');
        $info_columns = $database->query('SHOW COLUMNS FROM ' . $db_config['prefix'] . '_users_info')->fetchAll(PDO::FETCH_COLUMN);
        foreach (array('phone', 'address') as $field) hosting_check(in_array($field, $info_columns, true), 'Checkout profile database column: ' . $field);
    } catch (Exception $error) {
        hosting_check(false, 'Database check failed (SQLSTATE ' . $error->getCode() . '); credentials are not printed');
    }
}
echo 'Failures: ' . $failures . PHP_EOL;
exit($failures ? 1 : 0);
