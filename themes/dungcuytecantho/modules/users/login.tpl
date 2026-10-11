<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}js/jquery/jquery.validate.min.js" data-show="after"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.validator-{NV_LANG_INTERFACE}.js" data-show="after"></script>

<div class="page user-auth-page user-auth-page--login">
	<section class="user-auth-card">
		<header class="user-auth-card__header">
			<span class="user-auth-card__icon"><i class="fa fa-user"></i></span>
			<h2>{LANG.login}</h2>
			<p>{LANG.login_info}</p>
		</header>
		<form id="loginForm" action="{USER_LOGIN}" method="post" role="form" class="user-auth-form form-tooltip">
		<input type="hidden" name="checkss" value="{AUTH_CHECKSS}" />
			<div class="form-group">
				<label for="login_iavim">{LANG.account}<span class="text-danger"> (*)</span></label>
				<input type="text" id="login_iavim" name="nv_login" value="{DATA.nv_login}" class="required form-control" autocomplete="username" />
			</div>
			<div class="form-group">
				<label for="password_iavim">{LANG.password}<span class="text-danger"> (*)</span></label>
				<input type="password" id="password_iavim" name="nv_password" value="{DATA.nv_password}" class="required form-control password" autocomplete="current-password" />
			</div>
			<!-- BEGIN: captcha -->
			<div class="user-auth-captcha">
				<div class="user-auth-captcha__image">
					<img id="vimglogin" alt="{N_CAPTCHA}" src="{SRC_CAPTCHA}" width="{GFX_WIDTH}" height="{GFX_HEIGHT}" />
					<button type="button" class="user-auth-captcha__refresh" aria-label="{LANG.captcha}" onclick="nv_change_captcha('vimglogin','seccode_iavim');"><i class="fa fa-refresh"></i></button>
				</div>
				<label for="seccode_iavim">{LANG.retype_captcha}<span class="text-danger"> (*)</span></label>
				<input type="text" name="nv_seccode" id="seccode_iavim" class="required form-control" maxlength="{GFX_MAXLENGTH}" />
			</div>
			<!-- END: captcha -->
			<div class="form-group">
				<input name="nv_redirect" value="{DATA.nv_redirect}" type="hidden" />
				<input name="nv_header" value="{DATA.nv_header}" type="hidden" />
				<button type="submit" class="btn btn-primary user-auth-submit">{LANG.login_submit}</button>
			</div>
			<div class="user-auth-links">
				<a title="{LANG.register}" href="{USER_REGISTER}">{LANG.register}</a>
				<a title="{LANG.lostpass}" href="{USER_LOSTPASS}">{LANG.lostpass}</a>
			</div>
		</form>
		<!-- BEGIN: openid -->
		<div class="user-auth-social">
			<div class="user-oauth-divider">{LANG.login_email_social}</div>
			<div class="user-oauth-btns">
				<!-- BEGIN: server -->
				<a class="user-oauth-btn user-oauth-btn--{OPENID.provider}" href="{OPENID.href}" title="{OPENID.title}"><i class="fa fa-{OPENID.icon}"></i> {OPENID.title}</a>
				<!-- END: server -->
			</div>
		</div>
		<!-- END: openid -->
	</section>
</div>
<script type="text/javascript" data-show="after">
$(document).ready(function(){
	$('#loginForm').validate();
});
</script>
<!-- END: main -->
