<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}js/jquery/jquery.validate.min.js" data-show="after"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.validator-{NV_LANG_INTERFACE}.js" data-show="after"></script>

<div class="page user-account-page">
	<nav class="user-account-nav" aria-label="{LANG.account_navigation}">
<div class="user-account-nav__title"><i class="fa fa-user" aria-hidden="true"></i> {LANG.account_navigation}</div>
<ul class="nav">
	<li><a href="{URL_MODULE}"><i class="fa fa-user" aria-hidden="true"></i><span>{LANG.user_info}</span></a></li>
	<li><a href="{URL_HREF}editinfo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>{LANG.editinfo}</span></a></li>
	<li><a href="{URL_HREF}changepass"><i class="fa fa-lock" aria-hidden="true"></i><span>{LANG.changepass_title}</span></a></li>
	<li class="active"><a href="{URL_HREF}changequestion" aria-current="page"><i class="fa fa-shield" aria-hidden="true"></i><span>{LANG.question2}</span></a></li>
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
	<h2>{LANG.change_question_pagetitle}</h2>
	<div class="well">
		<p>
			<em class="fa fa-info fa-lg">&nbsp;</em> {LANG.changequestion_info}:
		</p>
		<ul class="nv-list-item">
			<li>
				<em class="fa fa-angle-right">&nbsp;</em> {LANG.changequestion_info1}
			</li>
			<li>
				<em class="fa fa-angle-right">&nbsp;</em> {LANG.changequestion_info2}
			</li>
		</ul>
	</div>
	<!-- BEGIN: step1 -->
	<form id="changeQuestionForm" action="{FORM1_ACTION}" method="post" role="form" class="form-horizontal m-bottom">
		<div class="m-bottom">
			<em class="fa fa-quote-left">&nbsp;</em>
			{DATA.info}
			<em class="fa fa-quote-right">&nbsp;</em>
		</div>
		<div class="form-group">
			<label for="nv_username_iavim" class="col-sm-6 control-label">{LANG.password}<span class="text-danger"> (*)</span>:</label>
			<div class="col-sm-18">
				<input class="required password form-control" name="nv_password" id="nv_password_iavim" type="password" maxlength="{PASS_MAXLENGTH}" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-6 col-sm-18">
				<input type="hidden" name="checkss" value="{DATA.checkss}" />
				<input type="submit" name="submit" value="{LANG.changequestion_submit1}" class="btn btn-primary"/>
			</div>
		</div>
	</form>
	<!-- END: step1 -->
	<!-- BEGIN: step2 -->
	<script type="text/javascript" data-show="after">
		function question_change() {
			var question_option = $("#question").val();
			$("#question").val('0');
			$("#your_question").val(question_option);
			$("#your_question").focus();
			return;
		}
	</script>
	<form id="changeQuestionForm" action="{FORM2_ACTION}" method="post" role="form" class="form-horizontal m-bottom">
		<div class="m-bottom">
			<em class="fa fa-quote-left">&nbsp;</em>
			{DATA.info}
			<em class="fa fa-quote-right">&nbsp;</em>
		</div>
		<div class="form-group">
			<label for="question" class="col-sm-8 control-label">{LANG.question}:</label>
			<div class="col-sm-16">
				<select name="question" id="question" onchange="question_change();" class="form-control">
					<!-- BEGIN: frquestion -->
					<option value="{QUESTIONVALUE}">{QUESTIONTITLE}</option>
					<!-- END: frquestion -->
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="your_question" class="col-sm-8 control-label">{LANG.your_question}:</label>
			<div class="col-sm-16">
				<input class="form-control" name="your_question" id="your_question" value="{DATA.your_question}" />
			</div>
		</div>
		<div class="form-group">
			<label for="answer" class="col-sm-8 control-label">{LANG.answer_your_question}:</label>
			<div class="col-sm-16">
				<input class="form-control required" name="answer" id="answer" value="{DATA.answer}" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-8 col-sm-16">
				<input type="hidden" name="nv_password" value="{DATA.nv_password}" />
				<input type="hidden" name="checkss" value="{DATA.checkss}" />
				<input type="hidden" name="send" value="1" />
				<input type="submit" value="{LANG.changequestion_submit2}" class="btn btn-primary" />
			</div>
		</div>
	</form>
	<!-- END: step2 -->
</div>
</div>
<script type="text/javascript" data-show="after">
	$(document).ready(function() {
		$('#changeQuestionForm').validate();
	});
</script>
<!-- END: main -->