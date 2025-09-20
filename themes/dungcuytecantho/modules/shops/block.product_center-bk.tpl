<!-- BEGIN: main -->
<div id="category">
<div class="page-header">
        <!-- BEGIN: viewdescriptionhtml -->
		<!-- BEGIN: image -->
		<div class="text-center">
			<img src="{IMAGE}" class="img-thumbnail" alt="{CAT_NAME}">
		</div>
		<!-- END: image -->
		<p>{DESCRIPTIONHTML}</p>
		<!-- END: viewdescriptionhtml -->
    </div>

 	<!-- BEGIN: items -->
    <div class="col-sm-12 col-md-6">
        <div class="thumbnail">
        	<div class="hot">Hot</div>
            <div style="height: {height}px">
                <a href="{LINK}" title="{TITLE}"><img src="{SRC_IMG}" width="{WIDTH}" alt="{TITLE}"/></a>
            </div>
            <div class="info_pro">
            	<!-- BEGIN: new -->
            	<span class="label label-success newday">{LANG.newday}</span>
            	<!-- END: new -->
            	<!-- BEGIN: discounts -->
            	<span class="label label-danger">-{PRICE.discount_percent}{PRICE.discount_unit}</span>
            	<!-- END: discounts -->
            	<!-- BEGIN: point -->
            	<span class="label label-info" title="{point_note}">+{point}</span>
            	<!-- END: point -->
            	<!-- BEGIN: gift -->
            	<span class="label label-success">+<em class="fa fa-gift fa-lg">&nbsp;</em></span>
            	<!-- END: gift -->
            </div>
            <div class="caption text-center">
                <h3><a href="{LINK}" title="{TITLE}">{TITLE0}</a></h3>

                <!-- BEGIN: product_code -->
                <p class="label label-default" style="display:none">{PRODUCT_CODE}</p>
                <!-- END: product_code -->

                <!-- BEGIN: adminlink -->
                <p style="display:none">{ADMINLINK}</p>
                <!-- END: adminlink -->

				<!-- BEGIN: price -->
				<p class="price">
                    <!-- BEGIN: discounts -->
                    <span class="money">{PRICE.sale_format} </span>
                    <span class="discounts_money">{PRICE.price_format} </span>
                    <!-- END: discounts -->

					<!-- BEGIN: no_discounts -->
					<span class="money">{PRICE.price_format} </span>
					<!-- END: no_discounts -->
				</p>
				<!-- END: price -->

                <!-- BEGIN: contact -->
                <p class="price">
                    {LANG.detail_pro_price}: <span class="money">{LANG.price_contact}</span>
                </p>
                <!-- END: contact -->

                <!-- BEGIN: compare -->
                <p><input type="checkbox" value="{ID}"{ch} onclick="nv_compare({ID});" id="compare_{ID}"/><a href="#" onclick="nv_compare_click();" >&nbsp;{LANG.compare}</a></p>
                <!-- END: compare -->

                <div class="clearfix">
                    <a href="{LINK}" title="{TITLE}"><button type="button" class="btn btn-primary btn-xs">Chi tiết sản phẩm</button></a>

					<!-- BEGIN: product_empty -->
                    <button class="btn btn-danger disabled btn-xs">{LANG.product_empty}</button>
                    <!-- END: product_empty -->

	                <!-- BEGIN: wishlist -->
	                <a href="javascript:void(0)" title="{title_pro}" ><button type="button" onclick="wishlist({id}, this)" class="btn btn-primary btn-xs <!-- BEGIN: disabled -->disabled<!-- END: disabled -->">{LANG.wishlist}</button></a>
	                <!-- END: wishlist -->
                </div>
            </div>
        </div>
    </div>
	<!-- END: items -->
	<div class="clearfix">
	</div>
	<div class="text-center">
		{pages}
	</div>
</div>

<!-- BEGIN: modal_loaded -->
<div class="modal fade" id="idmodals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{LANG.add_product}</h4>
			</div>
			<div class="modal-body">
				<em class="fa fa-spinner fa-spin">&nbsp;</em>
			</div>
		</div>
	</div>
</div>
<!-- END: modal_loaded -->

<div class="msgshow" id="msgshow">
</div>
<!-- BEGIN: tooltip_js -->
<script type="text/javascript">
	$(document).ready(function() {$("[data-rel='tooltip']").tooltip({
		placement: "bottom",
		html: true,
		title: function(){return '<p class="text-justify">' + $(this).data('content') + '</p><div class="clearfix"></div>';}
	});});
</script>
<!-- END: tooltip_js -->
<!-- END: main -->