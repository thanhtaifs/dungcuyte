<?php
// Create the policy page: php tools/setup_facebook_data_deletion.php
// Existing pages are preserved so later edits in the admin are not overwritten.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit();
}
define('NV_MAINFILE', true);
require dirname(__DIR__) . '/config.php';
$policy_db = new PDO(
    'mysql:host=' . $db_config['dbhost'] . ';dbname=' . $db_config['dbsystem'] . ';charset=utf8mb4',
    $db_config['dbuname'],
    $db_config['dbpass'],
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$policy_module = $policy_db->query("SELECT module_data FROM " . $db_config['prefix'] . "_vi_modules WHERE title='chinh-sach' AND module_file='policies'")->fetchColumn();
if (!$policy_module || !preg_match('/^[a-z0-9_]+$/', $policy_module)) {
    throw new RuntimeException('The chinh-sach policies module is required.');
}
$policy_table = $db_config['prefix'] . '_vi_' . $policy_module;
$policy_alias = 'huong-dan-xoa-du-lieu-facebook';
$exists = $policy_db->prepare('SELECT id FROM ' . $policy_table . ' WHERE alias=?');
$exists->execute(array($policy_alias));
$policy_id = $exists->fetchColumn();
if (!$policy_id) {
    $policy_body = file_get_contents(__DIR__ . '/content/facebook-data-deletion.html');
    if ($policy_body === false) {
        throw new RuntimeException('The policy content file is missing.');
    }
    $policy_weight = (int) $policy_db->query('SELECT MAX(weight) FROM ' . $policy_table)->fetchColumn() + 1;
    $insert = $policy_db->prepare('INSERT INTO ' . $policy_table . " (title, alias, image, imagealt, description, bodytext, keywords, socialbutton, activecomm, layout_func, gid, weight, admin_id, add_time, edit_time, status) VALUES (?, ?, '', '', ?, ?, ?, 0, '', '', 0, ?, 0, ?, ?, 1)");
    $insert->execute(array(
        'Hướng dẫn yêu cầu xóa dữ liệu người dùng',
        $policy_alias,
        'Hướng dẫn yêu cầu xóa dữ liệu cá nhân và thông tin xác thực khi đăng nhập bằng Facebook tại dungcuytecantho.com.',
        $policy_body,
        'xóa dữ liệu,Facebook,quyền riêng tư',
        $policy_weight,
        time(),
        time()
    ));
    $policy_id = $policy_db->lastInsertId();
}
// Invalidate only the policy module cache after creating its new public page.
foreach (glob(dirname(__DIR__) . '/cache/chinh-sach/*.cache') as $policy_cache) {
    unlink($policy_cache);
}
echo 'Ready: policy ID ' . $policy_id . PHP_EOL;
echo 'index.php?language=vi&nv=chinh-sach&op=' . $policy_alias . PHP_EOL;
