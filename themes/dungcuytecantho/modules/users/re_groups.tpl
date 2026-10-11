<!-- BEGIN: main -->
<div class="page user-account-page">
    <nav class="user-account-nav" aria-label="{LANG.account_navigation}">
<div class="user-account-nav__title"><i class="fa fa-user" aria-hidden="true"></i> {LANG.account_navigation}</div>
<ul class="nav">
	<li><a href="{URL_MODULE}"><i class="fa fa-user" aria-hidden="true"></i><span>{LANG.user_info}</span></a></li>
	<li><a href="{URL_HREF}editinfo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>{LANG.editinfo}</span></a></li>
	<li><a href="{URL_HREF}changepass"><i class="fa fa-lock" aria-hidden="true"></i><span>{LANG.changepass_title}</span></a></li>
	<li><a href="{URL_HREF}changequestion"><i class="fa fa-shield" aria-hidden="true"></i><span>{LANG.question2}</span></a></li>
	<!-- BEGIN: allowopenid -->
	<li><a href="{URL_HREF}openid"><i class="fa fa-link" aria-hidden="true"></i><span>{LANG.openid_administrator}</span></a></li>
	<!-- END: allowopenid -->
	<li class="active"><a href="{URL_HREF}regroups" aria-current="page"><i class="fa fa-users" aria-hidden="true"></i><span>{LANG.in_group}</span></a></li>
	<!-- BEGIN: logout -->
	<li><a href="{URL_HREF}logout" class="user-account-nav__logout"><i class="fa fa-sign-out" aria-hidden="true"></i><span>{LANG.logout_title}</span></a></li>
	<!-- END: logout -->
</ul>
</nav>
<div class="user-account-content">
    <h2>{LANG.in_group}</h2>
    <form action="{USER_REGISTER}" method="post" role="form" class="form-horizontal form-tooltip m-bottom">
		<input type="hidden" name="checkss" value="{AUTH_CHECKSS}" />
    	<div class="m-bottom">
    		<!-- BEGIN: list -->
    		<div class="checkbox">
    			<label>
    				<input type="checkbox" value="{GROUP.id}" name="group[]" {GROUP.checked}/>
    				{GROUP.title}
    			</label>
    		</div>
    		<!-- END: list -->
    	</div>
    	<div class="text-left">
    		<input type="submit" class="btn btn-primary" value="{LANG.in_group}" name="save" />
    	</div>
    </form>
</div>
</div>
<!-- END: main -->