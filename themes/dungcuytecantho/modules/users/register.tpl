<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}js/jquery/jquery.validate.min.js" data-show="after"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.validator-{NV_LANG_INTERFACE}.js" data-show="after"></script>

<div class="page user-auth-page user-auth-page--register">
	<section class="user-auth-card">
		<header class="user-auth-card__header">
			<span class="user-auth-card__icon"><i class="fa fa-user-plus"></i></span>
			<h2>{LANG.register}</h2>
			<p>{LANG.register_email_info}</p>
		</header>
		<form id="registerForm" action="{USER_REGISTER}" method="post" role="form" class="user-auth-form form-tooltip">
		<div class="form-group">
			<label for="nv_email_iavim">{LANG.email}<span class="text-danger"> (*)</span></label>
			<input type="email" class="email required form-control" name="email" value="{DATA.email}" id="nv_email_iavim" maxlength="100" autocomplete="email" required="required" />
		</div>
		<div class="form-group">
			<button type="submit" class="btn user-auth-submit user-auth-submit--secondary cancel" formnovalidate="formnovalidate" name="register_otp_send" value="1"><i class="fa fa-envelope-o"></i> {OTP_BUTTON}</button>
		</div>
		<!-- BEGIN: otp_sent -->
		<div class="form-group">
			<label for="register_otp">{LANG.register_email_otp}<span class="text-danger"> (*)</span></label>
			<input class="form-control required" name="register_otp" value="" id="register_otp" type="text" inputmode="numeric" autocomplete="one-time-code" maxlength="6" required="required" />
		</div>
		<div class="form-group">
			<label for="register_password">{LANG.register_email_password}<span class="text-danger"> (*)</span></label>
			<input class="form-control required password" name="register_password" id="register_password" type="password" maxlength="{PASS_MAXLENGTH}" autocomplete="new-password" required="required" />
		</div>
		<div class="form-group">
			<label for="register_password_confirm">{LANG.register_email_password_confirm}<span class="text-danger"> (*)</span></label>
			<input class="form-control required password" name="register_password_confirm" id="register_password_confirm" type="password" maxlength="{PASS_MAXLENGTH}" autocomplete="new-password" required="required" />
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary user-auth-submit" name="register_otp_complete" value="1">{LANG.register}</button>
		</div>
		<!-- END: otp_sent -->
		<div class="user-auth-message">{DATA.info}</div>
		<input type="hidden" name="checkss" value="{DATA.checkss}" />
		<input type="hidden" name="nv_redirect" value="{DATA.nv_redirect}" />
		</form>
		<!-- BEGIN: social_login -->
		<div class="user-auth-social">
			<div class="user-oauth-divider">{LANG.register_email_social}</div>
			<div class="user-oauth-btns">
				<!-- BEGIN: loop -->
				<a class="user-oauth-btn user-oauth-btn--{SOCIAL.icon}" href="{SOCIAL.href}"><i class="fa fa-{SOCIAL.icon}"></i> {SOCIAL.title}</a>
				<!-- END: loop -->
			</div>
		</div>
		<!-- END: social_login -->
		<p class="user-auth-switch">{LANG.login_title} <a href="{USER_LOGIN}">{LANG.login}</a></p>
	</section>
</div>	
<script type="text/javascript" data-show="after">
$(document).ready(function(){
	$('#registerForm').validate();
});
</script>
<!-- END: main -->