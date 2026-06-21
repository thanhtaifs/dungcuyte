<!-- BEGIN: main -->
<div id="category" class="home-products catalog-home-products">
	<!-- BEGIN: catalogs -->
	<section class="home-product-section category-group-section">
		<div class="home-section-head category-group-head">
			<h2 class="section-title">
				<i class="fa fa-th-large"></i>
				<a href="{LINK_CATALOG}" title="{TITLE_CATALOG}">{TITLE_CATALOG}</a>
			</h2>
			<!-- BEGIN: view_next -->
			<a class="section-view-all" href="{LINK_CATALOG}" title="{TITLE_CATALOG}">Xem tất cả <i class="fa fa-angle-right"></i></a>
			<!-- END: view_next -->
		</div>
		<div class="row home-product-row">
			<!-- BEGIN: items -->
			<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
				<div class="product-card">
					<div class="product-badges">
						<!-- BEGIN: new -->
						<span class="badge badge-new">New</span>
						<!-- END: new -->
					</div>
					<div class="product-image">
						<a href="{LINK}" title="{TITLE}" data-content='{hometext}' data-rel="tooltip">
							<img src="{IMG_SRC}" alt="{TITLE}" class="img-fluid" loading="lazy" />
						</a>
					</div>
					<div class="product-body product-body--home">
						<div class="product-cat">{TITLE_CATALOG}</div>
						<h3 class="product-title">
							<a href="{LINK}" title="{TITLE}">{TITLE0}</a>
						</h3>

						<!-- BEGIN: product_code -->
						<p class="label label-default">{PRODUCT_CODE}</p>
						<!-- END: product_code -->

						<!-- BEGIN: adminlink -->
						<p>{ADMINLINK}</p>
						<!-- END: adminlink -->

						<!-- BEGIN: price -->
						<div class="product-price">
							<!-- BEGIN: discounts -->
							<p class="current-price">{PRICE.sale_format} {PRICE.unit}</p>
							<p class="old-price discounts_money">{PRICE.price_format} {PRICE.unit}</p>
							<!-- END: discounts -->
							<!-- BEGIN: no_discounts -->
							<p class="current-price">{PRICE.price_format} {PRICE.unit}</p>
							<!-- END: no_discounts -->
						</div>
						<!-- END: price -->

						<!-- BEGIN: contact -->
						<div class="product-price product-price--contact">
							<p class="current-price">{LANG.price_contact}</p>
						</div>
						<!-- END: contact -->

						<!-- BEGIN: order -->
						<button class="btn-add-to-cart{BUTTON_CLASS}" onclick="{BUTTON_ACTION}" data-id="{ID}">
							<i class="fa {BUTTON_ICON}"></i>
							{BUTTON_TEXT}
						</button>
						<!-- END: order -->

						<!-- BEGIN: product_empty -->
						<button class="btn-add-to-cart btn-add-to-cart--quote" type="button" disabled>
							<i class="fa fa-ban"></i>
							{LANG.product_empty}
						</button>
						<!-- END: product_empty -->
					</div>
				</div>
			</div>
			<!-- END: items -->
		</div>
	</section>
	<!-- END: catalogs -->
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

<div class="msgshow" id="msgshow">&nbsp;</div>
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
