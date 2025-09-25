<!-- BEGIN: main -->
<style type="text/css">
.panel-body {  padding: 0px !important; }
.support-ol {display:block;}
.support-ol .name-phone {}
.support-ol .name-phone span {font-weight:bold;}
.support-ol .name-phone span.name {color: #4B7A00; font-size:16px}
.support-ol .name-phone span.phone {font-size:16px;}
.support-ol .email-support {padding: 5px 0; text-align:left}
.support-ol .email-support div {text-align:center}
.support-ol .email-support .email {background:url({NV_BASE_SITEURL}themes/{TEMPLATE}/images/icons/email.png) no-repeat scroll 0 center;display:inline-block;height: 16px;line-height: 5px;padding-left: 15px;}
.contact {background: #fff;margin-top:10px;padding: 8px 0 8px 0px;border:1px dashed #555555;text-align:center;}
.contact a {font-weight:bold;color: #000;}
</style>
<!-- BEGIN: loop -->
<!-- BEGIN: icon -->
	<div class="support-ol">
	

    <div class="email-support">
	<div class="support">
			<!-- BEGIN: iconyahoo -->
			<a href="ymsgr:sendim?{YHITEM}"></a>
			<!-- END: iconyahoo -->
			
     </div>
     
     <div class="name-phone">
    	<span class="name">{TITLE}</span><br />
        <i class="fa fa-phone"></i><span class="phone"> {PHONE}</span>
    </div>
    </div></div>
 <!-- END: icon -->  
<!-- END: loop -->
    <div class="contact" style="display:none">
    	<a href="{CONTACT}" title="{LANG.contact}">Liên hệ hợp tác</a>
    </div>
<!-- END: main -->