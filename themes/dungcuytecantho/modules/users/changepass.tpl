<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}js/jquery/jquery.validate.min.js" data-show="after"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.validator-{NV_LANG_INTERFACE}.js" data-show="after"></script>

<div class="page user-account-page">
    <nav class="user-account-nav" aria-label="{LANG.account_navigation}">
<div class="user-account-nav__title"><i class="fa fa-user" aria-hidden="true"></i> {LANG.account_navigation}</div>
<ul class="nav">
	<li><a href="{URL_MODULE}"><i class="fa fa-user" aria-hidden="true"></i><span>{LANG.user_info}</span></a></li>
	<li><a href="{URL_HREF}editinfo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>{LANG.editinfo}</span></a></li>
	<li class="active"><a href="{URL_HREF}changepass" aria-current="page"><i class="fa fa-lock" aria-hidden="true"></i><span>{LANG.changepass_title}</span></a></li>
	<li><a href="{URL_HREF}changequestion"><i class="fa fa-shield" aria-hidden="true"></i><span>{LANG.question2}</span></a></li>
	<!-- BEGIN: allowopenid -->
	<li><a href="{URL_HREF}openid"><i class="fa fa-link" aria-hidden="true"></i><span>{LANG.openid_administrator}</span></a></li>
	<!-- END: allowopenid -->
	<!-- BEGIN: regroups -->
	<li><a href="{URL_HREF}regroups"><i class="fa fa-users" aria-hidden="true"></i><span>{LANG.in_group}</span></a></li>
	<!-- END: regroups -->
	<!-- BEGIN: logout -->
	<li><a href="{URL_HREF}logout" class="user-account-nav__logout"><i class="fa fa-sign-out" aria-hidden="true"></i><span>{LANG.logout_title}</span></a></li>
	<!-- END: logout -->
</ul>
</nav>
<div class="user-account-content">
    <h2>{LANG.change_pass}</h2>
    <form action="{USER_CHANGEPASS}" method="post" role="form" class="form-horizontal form-tooltip m-bottom">
    	<p class="text-info">
    		<em class="fa fa-quote-left">&nbsp;</em>
    		{DATA.change_info}
    		<em class="fa fa-quote-right">&nbsp;</em>
    	</p>
    	<!-- BEGIN: passEmpty -->
    	<div class="form-group">
    		<label for="nv_password_iavim" class="col-sm-6 control-label">{LANG.pass_old}<span class="text-danger"> (*)</span>:</label>
    		<div class="col-sm-18">
    			<input type="password" class="form-control required password" name="nv_password" value="{DATA.nv_password}" id="nv_password_iavim" maxlength="{PASS_MAXLENGTH}"  placeholder="{LANG.pass_old}"/>
    		</div>
    	</div>
    	<!-- END: passEmpty -->
    	<div class="form-group">
    		<label for="new_password_iavim" class="col-sm-6 control-label">{LANG.pass_new}<span class="text-danger"> (*)</span>:</label>
    		<div class="col-sm-18">
    			<input type="password" class="form-control required password" name="new_password" value="{DATA.new_password}" id="new_password_iavim" maxlength="{PASS_MAXLENGTH}"  placeholder="{LANG.pass_new}"/>
    		</div>
    	</div>
    	<div class="form-group">
    		<label for="re_password_iavim" class="col-sm-6 control-label">{LANG.pass_new_re}<span class="text-danger"> (*)</span>:</label>
    		<div class="col-sm-18">
    			<input type="password" class="form-control required password" name="re_password" value="{DATA.re_password}" id="re_password_iavim" maxlength="{PASS_MAXLENGTH}"  placeholder="{LANG.pass_new_re}"/>
    		</div>
    	</div>
    	<div class="text-center">
    		<input type="hidden" name="checkss" value="{DATA.checkss}" />
    		<input type="submit" name="submit" value="{LANG.change_pass}" class="btn btn-primary"/>
    	</div>
    </form>
</div>
</div>
<script type="text/javascript" data-show="after">
$(document).ready(function(){
	$('#changePassForm').validate();
});
</script>
<!-- END: main -->