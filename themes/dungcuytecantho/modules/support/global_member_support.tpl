<!-- BEGIN: main -->
<style type="text/css">
.support-ol { float:right; padding: 7px; background:#fff; color:#F90; border-radius:3px; text-align:center}
.support-ol .name-phone {}
.support-ol .name-phone span {font-weight:bold;}
.support-ol .name-phone span.name {}
.support-ol .name-phone span.phone {font-size:16px;color:#000;}
.support-ol .email-support {padding: 5px 0;}
.support-ol .email-support div {padding: 3px 0;}
.support-ol .email-support .email {background:url({NV_BASE_SITEURL}themes/{TEMPLATE}/images/icons/email.png) no-repeat scroll 0 center;display:inline-block;height: 16px;line-height: 15px;padding-left: 25px;}
.support-ol .email-support .support {background:url({NV_BASE_SITEURL}themes/{TEMPLATE}/images/yahoo_messenger.png) no-repeat scroll 0 center;display:inline-block;height: 16px;line-height: 15px;padding-left: 25px;}
.contact {background: #fff;margin-top:10px;padding: 8px 0 8px 0px;border:1px dashed #555555;text-align:center;}
.contact a {font-weight:bold;color: #000;}
</style>

	<div class="support-ol">
	<div class="name-phone">
    	<span class="name"><!-- BEGIN: iconyahoo -->
			<a href="ymsgr:sendim?{YHITEM}"><img alt="" src="http://opi.yahoo.com/online?u={YHITEM}&amp;m=g&amp;t={YHTYPE}" width="150" style="margin:5px auto"/> </a><br>
            {TITLE} - {PHONE} 
			<!-- END: iconyahoo --></span><br />
        
    </div>

    <div class="email-support" style="display:none">
	<div class="support">
			<a rel="nofollow" href="mailto:{EMAIL}" style="display:none"><img src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/support/email.png" alt=""></a>
            <!-- BEGIN: iconskype -->
            <a href="skype:{SKITEM}?chat" style="display:none"> <img alt="" src="http://mystatus.skype.com/{SKTYPE}/{SKITEM}"/> </a>
            <!-- END: iconskype -->
     </div>
    </div></div>

    <div class="contact" style="display:none">
    	<a href="{CONTACT}" title="{LANG.contact}">Liên hệ hợp tác</a>
    </div>
<!-- END: main -->