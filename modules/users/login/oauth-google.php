<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 26 Oct 2014 08:34:25 GMT
 */

if( ! defined( 'NV_IS_MOD_USER' ) ) die( 'Stop!!!' );

require_once NV_ROOTDIR . '/modules/users/oAuthLib/autoload.php';

use OAuth\OAuth2\Service\Google;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

// Bootstrap the example
require_once NV_ROOTDIR . '/modules/users/oAuthLib/OAuth/bootstrap.php';

// Session storage
$storage = new Session();

$serviceFactory = new \OAuth\ServiceFactory();

// Setup the credentials for the requests
// Local OAuth callbacks must return to the local session, even when the main domain is configured for production.
$google_callback_domain = in_array( strtolower( NV_SERVER_NAME ), array( 'localhost', '127.0.0.1', '::1', '[::1]' ), true ) ? NV_MY_DOMAIN : NV_MAIN_DOMAIN;
$credentials = new Credentials( $global_config['google_client_id'], $global_config['google_client_secret'], $google_callback_domain . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=oauth&server=google' );

// Instantiate the Google service using the credentials, http client and storage mechanism for the token
/** @var $googleService Google */
$googleService = $serviceFactory->createService( 'google', $credentials, $storage, array(
	'userinfo_email',
	'userinfo_profile'
) );

if( !empty( $_GET['code'] ) )
{
	nv_auth_oauth_state('google', true);
	// This was a callback request from google, get the token
	$googleService->requestAccessToken( $_GET['code'] );

	// Send a request with it
	$result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
	if( !empty($result['id']) && !empty($result['email']) && isset($result['verified_email']) && $result['verified_email'] === true )
	{
		$attribs = array(
			'identity' => isset($result['link']) ? $result['link'] : '',
			'result' => 'is_res',
			'id' => $result['id'],
			'contact/email' => $result['email'],
			'namePerson/first' => isset($result['given_name']) ? $result['given_name'] : '',
			'namePerson/last' => isset($result['family_name']) ? $result['family_name'] : '',
			'namePerson' => isset($result['name']) ? $result['name'] : '',
			'person/gender' => isset($result['gender']) ? $result['gender'] : '',
			'server' => $server,
			'current_mode' => 3
		);
	}
	else
	{
		$attribs = array( 'result' => 'notlogin' );
	}
	foreach (array('namePerson/first', 'namePerson/last', 'namePerson') as $name_key) {
		if (isset($attribs[$name_key])) $attribs[$name_key] = nv_htmlspecialchars(strip_tags($attribs[$name_key]));
	}
	$nv_Request->set_Session( 'openid_attribs', serialize( $attribs ) );

	$op_redirect = ( defined( 'NV_IS_USER' )) ? 'openid' : 'login';
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op_redirect . '&server=' . $server . '&result=1&nv_redirect=' . $nv_redirect );
	exit();
}
else
{
	$url = $googleService->getAuthorizationUri(array('state' => nv_auth_oauth_state('google')));
	Header( 'Location: ' . $url );
	exit();
}
