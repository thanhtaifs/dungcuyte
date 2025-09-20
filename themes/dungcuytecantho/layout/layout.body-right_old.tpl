<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
[TUVAN]


<!-- <div class="row">
    <div class="col-lg-3">
        <div class="hero__categories">
            <div class="hero__categories__all">
                <i class="fa fa-bars"></i><span>Loại sản phẩm</span>
                 [RIGHT_TOP]
            </div>
        </div>
    </div>
</div> -->




<div class="row">
	<div class="col-md-24">
		[HEADER]
	</div>
</div>
<div class="row">
	<div class="col-sm-8 col-md-6 sidebar">
	 <div class="right-top">[RIGHT_TOP]</div>
		<div class="support">
			[RIGHT]
		</div>
		<div class="support">
			[TRUYCAP]
		</div>
	</div>
	<div class="col-sm-16 col-md-18 body-content">
		[TOP]
		{MODULE_CONTENT}
		[BOTTOM]
	</div>
	
</div>
<div class="row">
		[FOOTER]
</div>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->