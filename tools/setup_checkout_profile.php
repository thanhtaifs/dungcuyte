<?php
// Run once with: php tools/setup_checkout_profile.php
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit();
}
define('NV_MAINFILE', true);
require dirname(__DIR__) . '/config.php';
$profile_db = new PDO(
    'mysql:host=' . $db_config['dbhost'] . ';dbname=' . $db_config['dbsystem'] . ';charset=utf8mb4',
    $db_config['dbuname'],
    $db_config['dbpass'],
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$info_table = $db_config['prefix'] . '_users_info';
$field_table = $db_config['prefix'] . '_users_field';
$columns = $profile_db->query('SHOW COLUMNS FROM ' . $info_table)->fetchAll(PDO::FETCH_COLUMN);
$fields = array(
    'phone' => array('title' => 'Số điện thoại', 'type' => 'textbox', 'length' => 20),
    'address' => array('title' => 'Địa chỉ giao hàng', 'type' => 'textarea', 'length' => 250)
);
foreach ($fields as $field => $settings) {
    if (!in_array($field, $columns, true)) {
        $profile_db->exec('ALTER TABLE ' . $info_table . ' ADD ' . $field . " VARCHAR(" . $settings['length'] . ") NOT NULL DEFAULT ''");
    }
    $exists = $profile_db->prepare('SELECT fid FROM ' . $field_table . ' WHERE field=?');
    $exists->execute(array($field));
    if (!$exists->fetchColumn()) {
        $weight = (int)$profile_db->query('SELECT MAX(weight) FROM ' . $field_table)->fetchColumn() + 1;
        $insert = $profile_db->prepare('INSERT INTO ' . $field_table . " (field, weight, field_type, field_choices, sql_choices, match_type, match_regex, func_callback, min_length, max_length, required, show_register, user_editable, show_profile, class, language, default_value) VALUES (?, ?, ?, '', '', 'none', '', '', 0, ?, 0, 0, 1, 0, '', ?, '')");
        $insert->execute(array($field, $weight, $settings['type'], $settings['length'], serialize(array('vi' => array($settings['title'], '')))));
    }
    // Keep delivery details editable and private, also on installations already set up.
    $update = $profile_db->prepare('UPDATE ' . $field_table . ' SET user_editable=1, show_profile=0, match_type=?, match_regex=? WHERE field=?');
    $update->execute(array(
        $field === 'phone' ? 'regex' : 'none',
        $field === 'phone' ? '^\\+?[0-9][0-9\\s().-]{8,19}$' : '',
        $field
    ));
    echo 'Ready: ' . $field . PHP_EOL;
}
