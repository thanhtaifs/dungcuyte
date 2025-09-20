<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<div class="row">
	[HEADER]
</div>
<div class="container">    
    <div class="row pt-3">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Loại sản phẩm</span>
                    </div>
                    [RIGHT_TOP]
                </div>
            </div>
            <div class="col-lg-9">
                [TOP]
                {MODULE_CONTENT}
                [BOTTOM]
            </div>
    </div>
</div>
<div class="footer__top">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="support">
        			[RIGHT]
        		</div>
            </div>
            <div class="col-md-6 col-sm-12">
                 <div class="panel panel-default">
                    <div class="panel-heading">
                        Hệ thống chi nhánh
                    </div>
                </div>
              {FILE "footer_extended.tpl"}
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="support">
        			[TRUYCAP]
        		</div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="footer__copyright">
                <p style="font-size: 14px; color: #65aa00;">
                    <i class="fa fa-building"></i> CÔNG TY TNHH HUỲNH GIA ALPHA | <span><i class="fa fa-map-marker"></i> 4AB1 Xuân Thủy, KDC Cái Sơn - Hàng Bàng, KV2,P. An Bình, TP. Cần Thơ |</span> 
                            <span>
                                <i class="fa fa-credit-card"></i> Giấy ĐKKD: 1801763703 |
                                <i class="fa fa-university "></i> Cấp bởi: Sở Kế Hoạch &amp; Đầu Tư TPCT |
                                <i class="fa fa-calendar"></i> Ngày cấp: 08/05/2024
                            </span>
                </p>
                <p>
                    Copyright © 2013 bởi <i class="fa fa-globe"></i><a href="https://www.dungcuytecantho.com"> dungcuytecantho.com </a> webiste | <i class="fa fa-phone"></i> <a href="tel:0937037770">0937 037 770 </a> Mr Nguyên | <i class="fa fa-envelope"> </i> <a href="mailto:huynhgiact65@gmail.com">huynhgiact65@gmail.com</a> Huỳnh Gia Alpha
                </p>
            </div>
        </div>
    </div>
</div>

{FILE "footer_only.tpl"}
<!-- END: main -->