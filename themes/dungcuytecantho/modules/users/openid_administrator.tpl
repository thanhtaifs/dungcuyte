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
	<li class="active"><a href="{URL_HREF}openid" aria-current="page"><i class="fa fa-link" aria-hidden="true"></i><span>{LANG.openid_administrator}</span></a></li>
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
    <h2>{LANG.openid_administrator}</h2>
    <p class="text-center">
    	<img alt="{LANG.openid_administrator}" src="{OPENID_IMG_SRC}" width="{OPENID_IMG_WIDTH}" height="{OPENID_IMG_HEIGHT}" />

    </p>
    <!-- BEGIN: openid_empty -->
    <form id="openidForm" action="{FORM_ACTION}" method="post" role="form" class="m-bottom">
		<input type="hidden" name="checkss" value="{AUTH_CHECKSS}" />
    	<table class="table table-bordered table-striped table-hover">
    		<tbody>
    			<!-- BEGIN: openid_list -->
    			<tr>
    				<th class="text-center"><input name="openid_del[]" type="checkbox" value="{OPENID_LIST.opid}"{OPENID_LIST.disabled} /></th>
    				<td>{OPENID_LIST.openid}</td>
    				<td>{OPENID_LIST.email}</td>
    			</tr>
    			<!-- END: openid_list -->
    		</tbody>
    	</table>
    	<p>
    		<input id="submit" type="submit" class="btn btn-primary" value="{LANG.openid_del}" />
    	</p>
    </form>
    <!-- END: openid_empty -->
    <div class="text-center m-bottom">
    	<p>
    		{DATA.info}
    	</p>
    	<!-- BEGIN: server -->
    	<a href="{OPENID.href}"><img alt="{OPENID.title}" src="{OPENID.img_src}" width="{OPENID.img_width}" height="{OPENID.img_height}" /> {OPENID.title}</a>
    	<!-- END: server -->
    </div>
</div>
</div>
<!-- END: main -->