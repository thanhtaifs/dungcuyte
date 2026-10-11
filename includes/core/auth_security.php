<?php
if (!defined('NV_MAINFILE')) die('Stop!!!');

function nv_auth_csrf_token()
{
    global $global_config;
    return md5(session_id() . $global_config['sitekey']);
}

function nv_auth_require_csrf()
{
    global $nv_Request;
    $token = $nv_Request->get_string('checkss', 'post', '');
    if (!is_string($token) || !hash_equals(nv_auth_csrf_token(), $token)) {
        http_response_code(403);
        exit('Phien xac thuc khong hop le. Vui long tai lai trang.');
    }
}

// Persist counters outside the browser session; flock serializes concurrent requests.
function nv_auth_rate_allow($scope, $identity, $limit, $window)
{
    global $global_config;
    $directory = NV_ROOTDIR . '/logs/auth_security';
    if (!is_dir($directory) && !@mkdir($directory, 0700, true) && !is_dir($directory)) return false;
    $key = hash_hmac('sha256', $scope . '|' . $identity, $global_config['sitekey']);
    $handle = @fopen($directory . '/' . $key . '.json', 'c+');
    if (!$handle) return false;
    if (!flock($handle, LOCK_EX)) { fclose($handle); return false; }
    $state = json_decode(stream_get_contents($handle), true);
    $now = time();
    if (!is_array($state) || empty($state['expires']) || $now >= $state['expires']) {
        $state = array('expires' => $now + $window, 'count' => 0);
    }
    $allowed = $state['count'] < $limit;
    if ($allowed) {
        ++$state['count'];
        rewind($handle);
        ftruncate($handle, 0);
        $written = fwrite($handle, json_encode($state));
        $allowed = $written !== false && fflush($handle);
    }
    flock($handle, LOCK_UN);
    fclose($handle);
    return $allowed;
}

function nv_auth_require_rate($scope, $limit = 20, $window = 900)
{
    // Do not let caller-supplied forwarding headers reset the limit.
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
    if (!nv_auth_rate_allow($scope, $ip, $limit, $window)) {
        http_response_code(429);
        header('Retry-After: ' . $window);
        exit('Qua nhieu yeu cau xac thuc. Vui long thu lai sau.');
    }
}

function nv_auth_rotate_session()
{
    global $nv_Request, $client_info;
    if (session_status() === PHP_SESSION_ACTIVE && !headers_sent()) {
        if (!session_regenerate_id(true)) throw new RuntimeException('Cannot rotate authentication session');
        $nv_Request->session_id = session_id();
        $client_info['session_id'] = session_id();
    }
}

// Only allow redirects within this installation, with no HTML/URL control characters.
function nv_auth_safe_redirect($url)
{
    $fallback = NV_BASE_SITEURL;
    if (!is_string($url) || $url === '' || preg_match('/[\x00-\x20\x7f<>"\'\\\\]/', $url)) return $fallback;
    if (preg_match('/%(?:0[0-9a-f]|1[0-9a-f]|7f|22|27|3c|3e|5c)/i', $url)) return $fallback;
    $parts = parse_url($url);
    if ($parts === false || isset($parts['user']) || isset($parts['pass'])) return $fallback;
    if (isset($parts['host']) || isset($parts['scheme'])) {
        $origin = parse_url(NV_MY_DOMAIN);
        if (empty($parts['scheme']) || !in_array(strtolower($parts['scheme']), array('http', 'https'), true)
            || empty($parts['host']) || strcasecmp($parts['host'], $origin['host']) !== 0
            || strtolower($parts['scheme']) !== strtolower($origin['scheme'])
            || (isset($parts['port']) ? $parts['port'] : null) !== (isset($origin['port']) ? $origin['port'] : null)) return $fallback;
    } elseif (substr($url, 0, 1) !== '/' || substr($url, 0, 2) === '//') {
        return $fallback;
    }
    $path = isset($parts['path']) ? rawurldecode($parts['path']) : '/';
    if (strpos($path, NV_BASE_SITEURL) !== 0 || preg_match('#(?:^|/)\.\.(?:/|$)#', $path) || strpos($path, '\\') !== false) return $fallback;
    return $url;
}

function nv_auth_unserialize_array($value)
{
    if (!is_string($value) || strlen($value) > 16384) return array();
    $data = @unserialize($value, array('allowed_classes' => false));
    if (!is_array($data)) return array();
    foreach ($data as $item) {
        if (is_object($item) || is_array($item)) return array();
    }
    return $data;
}

function nv_auth_is_admin_user($userid)
{
    global $db;
    return (bool) $db->query('SELECT admin_id FROM ' . NV_AUTHORS_GLOBALTABLE . ' WHERE admin_id=' . (int) $userid)->fetchColumn();
}

function nv_auth_oauth_state($server, $callback = false)
{
    global $nv_Request;
    $key = 'oauth_state_' . $server;
    if (!$callback) {
        $state = bin2hex(random_bytes(32));
        $nv_Request->unset_request('openid_attribs', 'session');
        $nv_Request->set_Session($key, json_encode(array('state' => $state, 'expires' => time() + 600)));
        return $state;
    }
    $expected = json_decode($nv_Request->get_string($key, 'session', ''), true);
    $nv_Request->unset_request($key, 'session');
    $actual = $nv_Request->get_string('state', 'get', '');
    if (!is_array($expected) || empty($expected['state']) || empty($expected['expires']) || time() >= $expected['expires']
        || !is_string($actual) || !hash_equals($expected['state'], $actual)) {
        $nv_Request->unset_request('openid_attribs', 'session');
        http_response_code(403);
        exit('Phien dang nhap mang xa hoi khong hop le. Vui long thu lai.');
    }
    return $actual;
}

function nv_auth_invalidate_credentials($userid)
{
    global $db, $nv_Request;
    $userid = (int) $userid;
    $db->query("UPDATE " . NV_USERS_GLOBALTABLE . " SET checknum='', passlostkey='', last_openid='' WHERE userid=" . $userid);
    $db->query("UPDATE " . NV_AUTHORS_GLOBALTABLE . " SET check_num='' WHERE admin_id=" . $userid);
    $nv_Request->unset_request('nvloginhash', 'cookie');
    $nv_Request->unset_request('admin,online', 'session');
    nv_auth_rotate_session();
}

function nv_auth_upgrade_password(&$user, $password)
{
    global $db;
    if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $statement = $db->prepare('UPDATE ' . NV_USERS_GLOBALTABLE . ' SET password=:hash WHERE userid=:userid AND password=:old_hash');
        $statement->execute(array(':hash' => $hash, ':userid' => (int) $user['userid'], ':old_hash' => $user['password']));
        if ($statement->rowCount() !== 1) throw new RuntimeException('Credentials changed during login');
        $user['password'] = $hash;
    }
}

function nv_auth_valid_avatar($filename, $userid)
{
    if (!is_string($filename) || !preg_match('/^[a-zA-Z0-9_.-]+_' . (int) $userid . '\.(?:jpe?g|png|gif|webp)$/iD', $filename)) return false;
    $path = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $filename;
    $root = realpath(NV_ROOTDIR . '/' . NV_TEMP_DIR);
    $resolved = realpath($path);
    if (!$root || !$resolved || strcasecmp(dirname($resolved), $root) !== 0 || is_link($path)) return false;
    $image = @getimagesize($resolved);
    return $image && in_array($image[2], array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP), true);
}
