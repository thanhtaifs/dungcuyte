<!-- BEGIN: main -->
<div class="home-products">
	<!-- BEGIN: displays -->
	<div class="form-group form-inline pull-right home-products-sort">
		<label class="control-label">{LANG.displays_product}</label>
		<select name="sort" id="sort" class="form-control input-sm" onchange="nv_chang_price();">
			<!-- BEGIN: sorts -->
			<option value="{key}" {se}> {value}</option>
			<!-- END: sorts -->
		</select>
	</div>
	<div class="clearfix">&nbsp;</div>
	<!-- END: displays -->
	<!-- BEGIN: featured_section -->
	<section class="home-product-section">
		<div class="home-section-head">
			<h2 class="section-title"><i class="fa fa-fire"></i> {SECTION_TITLE}</h2>
			<a class="section-view-all" href="{SECTION_ALL_LINK}" title="Xem tất cả sản phẩm">Xem tất cả <i class="fa fa-angle-right"></i></a>
		</div>
		<div class="row home-product-row">
			<!-- BEGIN: items -->
			<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
				<div class="product-card product-card--featured">
					<div class="product-badges">
						<span class="badge badge-new">Hot</span>
					</div>
					<div class="product-image">
						<a href="{LINK}" title="{TITLE}">
							<img src="{SRC_PRO_LAGE}" alt="{TITLE}" class="img-fluid" loading="lazy" />
						</a>
					</div>
					<div class="product-body product-body--home">
						<div class="product-cat">{CATEGORY_NAME}</div>
						<h3 class="product-title">
							<a href="{LINK}" title="{TITLE}">{TITLE0}</a>
						</h3>
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
							<p class="current-price">Liên hệ</p>
						</div>
						<!-- END: contact -->
						<button class="btn-add-to-cart{BUTTON_CLASS}" onclick="{BUTTON_ACTION}" data-id="{ID}">
							<i class="fa {BUTTON_ICON}"></i>
							{BUTTON_TEXT}
						</button>
					</div>
				</div>
			</div>
			<!-- END: items -->
		</div>
	</section>
	<!-- END: featured_section -->

	<!-- BEGIN: new_section -->
	<section class="home-product-section">
		<div class="home-section-head">
			<h2 class="section-title"><i class="fa fa-star"></i> {SECTION_TITLE}</h2>
			<a class="section-view-all" href="{SECTION_ALL_LINK}" title="Xem tất cả sản phẩm">Xem tất cả <i class="fa fa-angle-right"></i></a>
		</div>
		<div class="row home-product-row">
			<!-- BEGIN: items -->
			<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
				<div class="product-card">
					<div class="product-badges">
						<span class="badge badge-new">New</span>
					</div>
					<div class="product-image">
						<a href="{LINK}" title="{TITLE}">
							<img src="{SRC_PRO_LAGE}" alt="{TITLE}" class="img-fluid" loading="lazy" />
						</a>
					</div>
					<div class="product-body product-body--home">
						<div class="product-cat">{CATEGORY_NAME}</div>
						<h3 class="product-title">
							<a href="{LINK}" title="{TITLE}">{TITLE0}</a>
						</h3>
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
							<p class="current-price">Liên hệ</p>
						</div>
						<!-- END: contact -->
						<button class="btn-add-to-cart{BUTTON_CLASS}" onclick="{BUTTON_ACTION}" data-id="{ID}">
							<i class="fa {BUTTON_ICON}"></i>
							{BUTTON_TEXT}
						</button>
					</div>
				</div>
			</div>
			<!-- END: items -->
		</div>
	</section>
	<!-- END: new_section -->

	<!-- BEGIN: single_section -->
	<section class="home-product-section">
		<div class="home-section-head">
			<h2 class="section-title"><i class="fa {SECTION_ICON}"></i> {SECTION_TITLE}</h2>
		</div>
		<div class="row home-product-row">
			<!-- BEGIN: items -->
			<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
				<div class="product-card">
					<div class="product-image">
						<a href="{LINK}" title="{TITLE}">
							<img src="{SRC_PRO_LAGE}" alt="{TITLE}" class="img-fluid" loading="lazy" />
						</a>
					</div>
					<div class="product-body product-body--home">
						<div class="product-cat">{CATEGORY_NAME}</div>
						<h3 class="product-title">
							<a href="{LINK}" title="{TITLE}">{TITLE0}</a>
						</h3>
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
							<p class="current-price">Liên hệ</p>
						</div>
						<!-- END: contact -->
						<button class="btn-add-to-cart{BUTTON_CLASS}" onclick="{BUTTON_ACTION}" data-id="{ID}">
							<i class="fa {BUTTON_ICON}"></i>
							{BUTTON_TEXT}
						</button>
					</div>
				</div>
			</div>
			<!-- END: items -->
		</div>
	</section>
	<!-- END: single_section -->

	<!-- BEGIN: home_products_more -->
	<div class="home-products-more">
		<a class="home-products-more__link" href="{HOME_PRODUCTS_MORE_LINK}" title="Xem toàn bộ sản phẩm">Xem toàn bộ sản phẩm <i class="fa fa-angle-right"></i></a>
	</div>
	<!-- END: home_products_more -->
</div>

<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        html: true,
        placement: 'top',
        container: 'body'
    });
});
</script>
<!-- BEGIN: pages -->
<div class="home-products-pagination" aria-label="Page navigation">
	<div class="home-products-pagination__inner">
		{generate_page}
	</div>
</div>
<!-- END: pages -->
<!-- END: main -->
