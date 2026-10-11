<!-- BEGIN: main -->
<div class="page user-account-page">
    <nav class="user-account-nav" aria-label="{LANG.account_navigation}">
<div class="user-account-nav__title"><i class="fa fa-user" aria-hidden="true"></i> {LANG.account_navigation}</div>
<ul class="nav">
	<li class="active"><a href="{URL_MODULE}" aria-current="page"><i class="fa fa-user" aria-hidden="true"></i><span>{LANG.user_info}</span></a></li>
	<li><a href="{URL_HREF}editinfo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>{LANG.editinfo}</span></a></li>
	<li><a href="{URL_HREF}changepass"><i class="fa fa-lock" aria-hidden="true"></i><span>{LANG.changepass_title}</span></a></li>
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
    <h2>{LANG.user_info}</h2>
    <div class="row m-bottom">
    	<div class="col-md-6 text-center">
    		<img src="{SRC_IMG}" alt="{USER.username}" class="img-thumbnail m-bottom"/><br />
    		{LANG.img_size_title}
    	</div>
    	<div class="col-md-18">
    		<ul class="nv-list-item xsm">
    			<li><em class="fa fa-chevron-right ">&nbsp;</em> {LANG.account2}: <strong>{USER.username}</strong> ({USER.email})</li>
    			<li><em class="fa fa-chevron-right ">&nbsp;</em> {USER.current_mode}</li>
    			<li><em class="fa fa-chevron-right ">&nbsp;</em> {LANG.current_login}: {USER.current_login}</li>
    			<li><em class="fa fa-chevron-right ">&nbsp;</em> {LANG.ip}: {USER.current_ip}</li>
    		</ul>
    	</div>
    </div>
    <!-- BEGIN: change_login_note -->
    <div class="alert alert-danger">
    	<em class="fa fa-exclamation-triangle ">&nbsp;</em> {USER.change_name_info}
    </div>
    <!-- END: change_login_note -->
    <!-- BEGIN: pass_empty_note -->
    <div class="alert alert-danger">
    	<em class="fa fa-exclamation-triangle ">&nbsp;</em> {USER.pass_empty_note}
    </div>
    <!-- END: pass_empty_note -->
    <!-- BEGIN: question_empty_note -->
    <div class="alert alert-danger">
    	<em class="fa fa-exclamation-triangle ">&nbsp;</em> {USER.question_empty_note}
    </div>
    <!-- END: question_empty_note -->
    <div class="table-responsive">
    	<table class="table table-bordered table-striped">
    		<tbody>
    			<tr>
    				<th>{LANG.name}</th>
    				<td>
    				    {USER.full_name}
    				</td>
    			</tr>
    			<tr>
				<th>{LANG.delivery_phone}</th>
				<td>{DELIVERY_PHONE}</td>
			</tr>
			<tr>
				<th>{LANG.delivery_address}</th>
				<td>{DELIVERY_ADDRESS}</td>
			</tr>
			<tr>
    				<th>{LANG.birthday}</th>
    				<td>{USER.birthday}</td>
    			</tr>
    			<tr>
    				<th>{LANG.gender}</th>
    				<td>{USER.gender}</td>
    			</tr>
    			<tr>
    				<th>{LANG.showmail}</th>
    				<td>{USER.view_mail}</td>
    			</tr>
    			<tr>
    				<th>{LANG.regdate}</th>
    				<td>{USER.regdate}</td>
    			</tr>
    			<tr>
    				<th>{LANG.st_login2}</th>
    				<td>{USER.st_login}</td>
    			</tr>
    			<tr>
    				<th>{LANG.last_login}</th>
    				<td>{USER.last_login}</td>
    			</tr>
    		</tbody>
    	</table>
    </div>
</div>
</div>
<!-- END: main -->
