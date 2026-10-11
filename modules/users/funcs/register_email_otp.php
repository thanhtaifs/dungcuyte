<?php

if( ! defined( 'NV_IS_MOD_USER' ) ) die( 'Stop!!!' );

function nv_users_register_email_username( $email )
{
	global $global_config;

	$local = strtolower( substr( $email, 0, strpos( $email, '@' ) ) );
	$prefix = preg_replace( '/[^a-z0-9]/', '', $local );
	if( empty( $prefix ) )
	{
		$prefix = 'user';
	}

	$max_length = NV_UNICKMAX;
	for( $i = 0; $i < 100; ++$i )
	{
		if( $global_config['nv_unick_type'] == 1 )
		{
			$username = str_pad( (string) random_int( 0, 999999 ), $max_length, '0', STR_PAD_LEFT );
			$username = substr( $username, 0, $max_length );
		}
		else
		{
			$suffix = (string) random_int( 100000, 999999 );
			$username = substr( $prefix, 0, max( 1, $max_length - strlen( $suffix ) ) ) . $suffix;
			$username = substr( $username, 0, $max_length );
		}
		if( strlen( $username ) < NV_UNICKMIN )
		{
			$username = substr( str_pad( $username, NV_UNICKMIN, 'u' ), 0, $max_length );
		}
		if( nv_check_username_reg( $username ) == '' )
		{
			return $username;
		}
	}

	return '';
}

function nv_users_register_email_create( $email, $password )
{
	global $db, $crypt, $global_config;

	$username = nv_users_register_email_username( $email );
	if( empty( $username ) )
	{
		return false;
	}

	$first_name = substr( $email, 0, strpos( $email, '@' ) );
	$hashed_password = $crypt->hash_password( $password, $global_config['hashprefix'] );
	$checknum = md5( nv_genpass( 10 ) );
	$query_field = array( 'userid' => 0 );
	$result_field = $db->query( 'SELECT * FROM ' . NV_USERS_GLOBALTABLE . '_field ORDER BY fid ASC' );
	while( $row_field = $result_field->fetch() )
	{
		$query_field[$row_field['field']] = $db->quote( $row_field['default_value'] );
	}

	if( $global_config['allowuserreg'] == 3 )
	{
		$sql = 'INSERT INTO ' . NV_USERS_GLOBALTABLE . '_reg
			(username, md5username, password, email, first_name, last_name, regdate, question, answer, checknum, users_info)
			VALUES (:username, :md5username, :password, :email, :first_name, \'\', ' . NV_CURRENTTIME . ', 0, \'\', :checknum, :users_info)';
		return $db->insert_id( $sql, 'userid', array(
			'username' => $username,
			'md5username' => nv_md5safe( $username ),
			'password' => $hashed_password,
			'email' => $email,
			'first_name' => $first_name,
			'checknum' => $checknum,
			'users_info' => nv_base64_encode( serialize( $query_field ) )
		) );
	}

	$db->beginTransaction();
	$sql = 'INSERT INTO ' . NV_USERS_GLOBALTABLE . '
		(username, md5username, password, email, first_name, last_name, gender, photo, birthday, regdate,
		question, answer, passlostkey, view_mail, remember, in_groups, active, checknum, last_login, last_ip, last_agent, last_openid, idsite)
		VALUES (:username, :md5username, :password, :email, :first_name, \'\', \'\', \'\', 0, ' . NV_CURRENTTIME . ',
		0, \'\', \'\', 0, 1, \'\', 1, \'\', 0, \'\', \'\', \'\', ' . intval( $global_config['idsite'] ) . ')';
	$userid = $db->insert_id( $sql, 'userid', array(
		'username' => $username,
		'md5username' => nv_md5safe( $username ),
		'password' => $hashed_password,
		'email' => $email,
		'first_name' => $first_name
	) );

	if( ! $userid )
	{
		$db->rollBack();
		return false;
	}

	$query_field['userid'] = $userid;
	$db->query( 'INSERT INTO ' . NV_USERS_GLOBALTABLE . '_info (' . implode( ', ', array_keys( $query_field ) ) . ') VALUES (' . implode( ', ', array_values( $query_field ) ) . ')' );
	$db->query( 'UPDATE ' . NV_GROUPS_GLOBALTABLE . ' SET numbers = numbers+1 WHERE group_id=4' );
	$db->commit();

	return $userid;
}

$page_title = $lang_module['register'];
$key_words = $module_info['keywords'];
$mod_title = $lang_module['register'];
$checkss = md5( $client_info['session_id'] . $global_config['sitekey'] );
$data = array(
	'checkss' => $checkss,
	'email' => '',
	'nv_redirect' => $nv_redirect,
	'info' => ''
);
$error = $nv_Request->get_string( 'register_oauth_error', 'session', '' );
$nv_Request->unset_request( 'register_oauth_error', 'session' );
$otp_key = 'register_email_otp';
$otp_value = $nv_Request->get_string( $otp_key, 'session', '' );
$otp_state = ! empty( $otp_value ) ? nv_auth_unserialize_array( $otp_value ) : array();
if( ! is_array( $otp_state ) )
{
	$otp_state = array();
}
if( isset( $otp_state['email'] ) )
{
	$data['email'] = $otp_state['email'];
}

if( $nv_Request->isset_request( 'register_otp_send', 'post' ) or $nv_Request->isset_request( 'register_otp_complete', 'post' ) )
{
	$data['email'] = strtolower( trim( nv_substr( $nv_Request->get_title( 'email', 'post', '', 1 ), 0, 100 ) ) );
	$post_checkss = $nv_Request->get_title( 'checkss', 'post', '' );

	if( $post_checkss != $checkss )
	{
		$error = $lang_module['register_email_otp_invalid'];
	}
	elseif( $nv_Request->isset_request( 'register_otp_send', 'post' ) )
	{
		if( ( $email_error = nv_check_valid_email( $data['email'] ) ) != '' )
		{
			$error = $email_error;
		}
		elseif( ! empty( $otp_state['sent_at'] ) and NV_CURRENTTIME < $otp_state['sent_at'] + 60 )
		{
			$error = $lang_module['register_email_otp_wait'];
		}
		elseif( ( $email_error = nv_check_email_reg( $data['email'] ) ) != '' )
		{
			$error = $email_error;
		}
		else
		{
			nv_auth_require_rate('register-otp-send', 5, 600);
			if (!nv_auth_rate_allow('register-otp-email', $data['email'], 3, 600)) {
				http_response_code(429);
				header('Retry-After: 600');
				exit('Qua nhieu yeu cau ma OTP cho email nay. Vui long thu lai sau.');
			}
			$otp = (string) random_int( 100000, 999999 );
			$subject = $lang_module['register_email_otp_mail_subject'];
			$message = sprintf( $lang_module['register_email_otp_mail_body'], $global_config['site_name'], $otp );
			if( nv_sendmail( $global_config['site_email'], $data['email'], $subject, $message ) )
			{
				$otp_state = array(
					'email' => $data['email'],
					'code_hash' => hash_hmac( 'sha256', $otp, $global_config['sitekey'] ),
					'sent_at' => NV_CURRENTTIME,
					'expires_at' => NV_CURRENTTIME + 600,
					'attempts' => 0
				);
				$nv_Request->set_Session( $otp_key, serialize( $otp_state ) );
				$error = $lang_module['register_email_otp_sent'];
			}
			else
			{
				$nv_Request->unset_request( $otp_key, 'session' );
				$otp_state = array();
				$error = $lang_global['error_sendmail'];
			}
		}
	}
	else
	{
		$otp = $nv_Request->get_title( 'register_otp', 'post', '' );
		$password = $nv_Request->get_string( 'register_password', 'post', '' );
		$password_confirm = $nv_Request->get_string( 'register_password_confirm', 'post', '' );

		if( empty( $otp_state['email'] ) or $otp_state['email'] != $data['email'] or empty( $otp_state['code_hash'] ) or empty( $otp_state['expires_at'] ) or NV_CURRENTTIME > $otp_state['expires_at'] or ! preg_match( '/^[0-9]{6}$/', $otp ) )
		{
			$error = $lang_module['register_email_otp_invalid'];
		}
		elseif( ! hash_equals( $otp_state['code_hash'], hash_hmac( 'sha256', $otp, $global_config['sitekey'] ) ) )
		{
			$otp_state['attempts'] = isset( $otp_state['attempts'] ) ? $otp_state['attempts'] + 1 : 1;
			if( $otp_state['attempts'] >= 5 )
			{
				$nv_Request->unset_request( $otp_key, 'session' );
				$otp_state = array();
			}
			else
			{
				$nv_Request->set_Session( $otp_key, serialize( $otp_state ) );
			}
			$error = $lang_module['register_email_otp_invalid'];
		}
		elseif( ( $password_error = nv_check_valid_pass( $password, NV_UPASSMAX, NV_UPASSMIN ) ) != '' or $password !== $password_confirm )
		{
			$error = ! empty( $password_error ) ? $password_error : $lang_module['register_email_password_error'];
		}
		elseif( ( $email_error = nv_check_email_reg( $data['email'] ) ) != '' )
		{
			$error = $email_error;
			$nv_Request->unset_request( $otp_key, 'session' );
			$otp_state = array();
		}
		else
		{
			$userid = nv_users_register_email_create( $data['email'], $password );
			if( ! $userid )
			{
				$error = $lang_module['err_no_save_account'];
			}
			else
			{
				$nv_Request->unset_request( $otp_key, 'session' );
				$info = $global_config['allowuserreg'] == 3 ? $lang_module['register_email_waiting'] : $lang_module['register_email_success'];
				$login_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=login';
				$info .= '<br /><br /><a href="' . $login_url . '">' . $lang_module['login'] . '</a>';
				$contents = user_info_exit( $info );
				include NV_ROOTDIR . '/includes/header.php';
				echo nv_site_theme( $contents );
				include NV_ROOTDIR . '/includes/footer.php';
				exit();
			}
		}
	}
}

$data['info'] = ! empty( $error ) ? '<span style="color:#fb490b;">' . $error . '</span>' : '';
$email_otp_sent = ! empty( $otp_state['email'] ) && $otp_state['email'] == $data['email'] && ! empty( $otp_state['expires_at'] ) && NV_CURRENTTIME <= $otp_state['expires_at'];
$array_register = $data;
$array_register['email_otp_sent'] = $email_otp_sent;
$array_register['info'] = $data['info'];
$contents = user_register( 0, $array_register, '', array(), array(), array() );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
exit();
