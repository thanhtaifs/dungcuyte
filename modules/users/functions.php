<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 10/03/2010 10:51
 */

if( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_USER', true );

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    nv_auth_require_csrf();
    nv_auth_require_rate('users-post', 60, 900);
    if ($op === 'login') nv_auth_require_rate('user-login', 20, 900);
    if ($op === 'lostpass') nv_auth_require_rate('password-reset', 5, 900);
}

$lang_module['in_groups'] = $lang_global['in_groups'];

/**
 * validUserLog()
 *
 * @param mixed $array_user
 * @param mixed $remember
 * @param mixed $opid
 * @return
 */
function validUserLog( $array_user, $remember, $opid, $current_mode = 0 )
{
	global $db, $db_config, $global_config, $nv_Request;

	if ($opid !== '' && nv_auth_is_admin_user($array_user['userid'])) {
		http_response_code(403);
		exit('Administrator social login is not allowed');
	}
	nv_auth_rotate_session();

	$remember = intval( $remember );
	$checknum = bin2hex( random_bytes( 16 ) );
	$user = array(
		'userid' => $array_user['userid'],
		'current_mode' => $current_mode,
		'checknum' => $checknum,
		'credential_hash' => hash_hmac('sha256', $array_user['password'], $global_config['sitekey']),
		'checkhash' => md5( $array_user['userid'] . $checknum . $global_config['sitekey'] . NV_USER_AGENT ),
		'current_agent' => NV_USER_AGENT,
		'last_agent' => $array_user['last_agent'],
		'current_ip' => NV_CLIENT_IP,
		'last_ip' => $array_user['last_ip'],
		'current_login' => NV_CURRENTTIME,
		'last_login' => intval( $array_user['last_login'] ),
		'last_openid' => $array_user['last_openid'],
		'current_openid' => $opid
	);

	$user = nv_base64_encode( serialize( $user ) );

	$stmt = $db->prepare( "UPDATE " . NV_USERS_GLOBALTABLE . " SET
		checknum = :checknum,
		last_login = " . NV_CURRENTTIME . ",
		last_ip = :last_ip,
		last_agent = :last_agent,
		last_openid = :opid,
		remember = " . $remember . "
		WHERE userid=" . $array_user['userid'] );

	$stmt->bindValue( ':checknum', $checknum, PDO::PARAM_STR );
	$stmt->bindValue( ':last_ip', NV_CLIENT_IP, PDO::PARAM_STR );
	$stmt->bindValue( ':last_agent', NV_USER_AGENT, PDO::PARAM_STR );
	$stmt->bindValue( ':opid', $opid, PDO::PARAM_STR );
	$stmt->execute();
	$live_cookie_time = ( $remember ) ? NV_LIVE_COOKIE_TIME : 0;

	$nv_Request->set_Cookie( 'nvloginhash', $user, $live_cookie_time );
}
