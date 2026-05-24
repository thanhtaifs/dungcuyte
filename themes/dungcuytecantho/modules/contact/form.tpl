<!-- BEGIN: main -->
<div class="contact-page">   
    <div class="contact-layout contact-two-column row">
        <div class="col-xs-24 col-lg-12">
            <div class="contact-section-card">
                <div class="contact-section-head">
                    <h2>Hệ thống chi nhánh</h2>
                    <p>{LANG.note}</p>
                    <div class="contact-quick-actions">
                        <a class="contact-quick-btn primary" href="tel:0937037770">
                            <i class="fa fa-phone"></i>
                            <span>Gọi điện</span>
                        </a>
                        <a class="contact-quick-btn" href="mailto:huynhgiact65@gmail.com">
                            <i class="fa fa-envelope-o"></i>
                            <span>Gửi thư điện tử</span>
                        </a>
                    </div>
                </div>
                <div class="contact-branch-list">
                    <!-- BEGIN: department_loop -->
                    <article class="contact-branch-card{DEPARTMENT.selected_class}">
                        <div class="contact-branch-top">
                            <div class="contact-branch-icon">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="contact-branch-meta">
                                <h3>{DEPARTMENT.full_name}</h3>
                                <span>Bo phan tiep nhan thong tin</span>
                            </div>
                        </div>

                        <div class="contact-branch-body">
                            <!-- BEGIN: phone -->
                            <a class="contact-branch-line contact-branch-phone" href="tel:{DEPARTMENT.phone_link}">
                                <i class="fa fa-phone"></i>
                                <span>{DEPARTMENT.phone}</span>
                            </a>
                            <!-- END: phone -->

                            <!-- BEGIN: email -->
                            <a class="contact-branch-line" href="mailto:{DEPARTMENT.email}">
                                <i class="fa fa-envelope-o"></i>
                                <span>{DEPARTMENT.email}</span>
                            </a>
                            <!-- END: email -->

                            <!-- BEGIN: note -->
                            <div class="contact-branch-note">
                                {DEPARTMENT.note}
                            </div>
                            <!-- END: note -->
                        </div>
                    </article>
                    <!-- END: department_loop -->
                </div>
            </div>
        </div>

        <div class="col-xs-24 col-lg-12">
            <!-- BEGIN: error -->
            <div class="alert alert-danger fade in contact-alert">
                <em data-dismiss="alert" aria-hidden="true" class="fa fa-times fa-fix fa-pointer pull-right fa-lg">&nbsp;</em>
                {CONTENT.error}
            </div>
            <!-- END: error -->

            <!-- BEGIN: form -->
            <div class="contact-section-card contact-form-card">
                <div class="contact-section-head">
                    <h2>Gửi yêu cầu hỗ trợ</h2>
                    <p>Bạn vui lòng điền các thông tin cần thiết để gửi yêu cầu hỗ trợ !</p>
                </div>

                <form id="fcontact" method="post" action="{ACTION_FILE}" onsubmit="return sendcontact('{NV_GFX_NUM}');">
                    <div class="form-group">
                        <label for="ftitle">{LANG.title}</label>
                        <input type="text" maxlength="255" class="form-control" value="{CONTENT.ftitle}" id="ftitle" name="ftitle" placeholder="{LANG.title}" />
                    </div>

                    <!-- BEGIN: iguest -->
                    <div class="form-group">
                        <label for="fname">{LANG.fullname}</label>
                        <input type="text" maxlength="100" value="{CONTENT.fname}" id="fname" name="fname" class="form-control" placeholder="{LANG.fullname}" />
                    </div>
                    <div class="form-group">
                        <label for="femail_iavim">{LANG.email}</label>
                        <input type="text" maxlength="60" value="{CONTENT.femail}" id="femail_iavim" name="femail" class="form-control" placeholder="{LANG.email}" />
                    </div>
                    <!-- END: iguest -->

                    <!-- BEGIN: iuser -->
                    <div class="form-group">
                        <label for="fname">{LANG.fullname}</label>
                        <input type="text" maxlength="100" value="{CONTENT.fname}" id="fname" name="fname" class="form-control" disabled="disabled" />
                    </div>
                    <div class="form-group">
                        <label for="femail_iavim">{LANG.email}</label>
                        <input type="text" maxlength="60" value="{CONTENT.femail}" id="femail_iavim" name="femail" class="form-control" disabled="disabled" />
                    </div>
                    <!-- END: iuser -->

                    <div class="form-group">
                        <label for="fphone">{LANG.phone}</label>
                        <input type="text" maxlength="60" value="{CONTENT.fphone}" id="fphone" name="fphone" class="form-control" placeholder="{LANG.phone}" />
                    </div>

                    <div class="form-group">
                        <label for="fpart">{LANG.part}</label>
                        <select class="form-control" id="fpart" name="fpart">
                            <!-- BEGIN: select_option_loop -->
                            <option value="{SELECT_VALUE}" {SELECTED}>{SELECT_NAME}</option>
                            <!-- END: select_option_loop -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fcon">{LANG.content}</label>
                        <textarea cols="8" id="fcon" name="fcon" class="form-control contact-message" onkeyup="return nv_ismaxlength(this, 1000);" placeholder="{LANG.content}">{CONTENT.fcon}</textarea>
                    </div>

                    <div class="contact-captcha-box">
                        <div class="contact-captcha-head">
                            <label for="fcode_iavim">{LANG.captcha}</label>
                            <button type="button" class="contact-captcha-refresh" onclick="nv_change_captcha('vimg','fcode_iavim');">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                        <div class="contact-captcha-body">
                            <img src="{NV_BASE_SITEURL}index.php?scaptcha=captcha&t={NV_CURRENTTIME}" alt="{LANG.captcha}" id="vimg" width="{GFX_WIDTH}" height="{GFX_HEIGHT}" />
                            <input type="text" maxlength="6" value="" id="fcode_iavim" name="fcode" class="form-control" placeholder="{LANG.captcha}" />
                        </div>
                    </div>

                    <div class="contact-form-actions">
                        <input type="hidden" name="checkss" value="{CHECKSS}" />
                        <input type="reset" value="{LANG.reset}" class="btn btn-default contact-btn-secondary" />
                        <input type="submit" value="{LANG.sendcontact}" id="btsend" name="btsend" class="btn btn-primary contact-btn-primary" />
                    </div>
                </form>
            </div>
            <!-- END: form -->
        </div>
    </div>
</div>
<!-- END: main -->
