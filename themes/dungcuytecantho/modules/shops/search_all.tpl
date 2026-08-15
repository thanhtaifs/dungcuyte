<!-- BEGIN: form -->
<div id="formsearch" class="shop-search-filter">
	<form action="{NV_BASE_SITEURL}" method="get" name="frm_search" onsubmit="return onsubmitsearch1();">
		<div class="shop-search-filter__panel">
			<div class="shop-search-filter__header">
				<h3>Tìm kiếm sản phẩm</h3>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="form-group form-group--modern">
						<label>{LANG.keyword}</label>
						<input id="keyword1" type="text" value="{value_keyword}" name="keyword" class="form-control">
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group form-group--modern">
						<label>{LANG.product_catalogs}</label>
						<select name="cata" id="cata1" class="form-control">
							<option value="0">{LANG.allcatagories}</option>
							<!-- BEGIN: loopcata -->
							<option {ROW.selected} value="{ROW.catid}">{ROW.xtitle}</option>
							<!-- END: loopcata -->
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="form-group form-group--modern">
						<label>{LANG.price1}</label>
						<input id="price11" type="text" value="{value_price1}" name="price1" class="form-control">
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="form-group form-group--modern">
						<label>{LANG.price1}</label>
						<input id="price21" size="20" type="text" value="{value_price2}" name="price2" class="form-control">
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="form-group form-group--modern">
						<label>{LANG.moneyunit}</label>
						<select name="typemoney" id="typemoney1" class="form-control">
							<option value="0">{LANG.moneyunit}</option>
							<!-- BEGIN: typemoney -->
							<option {ROW.selected} value="{ROW.code}">{ROW.currency}</option>
							<!-- END: typemoney -->
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-2">
					<div class="form-group form-group--modern form-group--submit">
						<label>&nbsp;</label>
						<input type="submit" class="btn btn-primary btn-search" name="submit" id="submit" value="{LANG.search}" onclick="onsubmitsearch1()">
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- END: form -->
<!-- BEGIN: main -->
<div id="products" class="shop-search-results">
	<!-- BEGIN: items -->
	<div class="product-list-item">
		<div class="product-list-item__image">
			<a href="{LINK}" title="{TITLE}">
				<img src="{IMG_SRC}" alt="{TITLE}" data-content='{hometext}' data-rel="tooltip" class="img-thumbnail" style="max-height:{height}px;max-width:{width}px;">
			</a>
		</div>
		<div class="product-list-item__content">
			<div class="product-list-item__title-wrap">
				<h3 class="product-list-item__title"><a href="{LINK}" title="{TITLE}">{TITLE0}</a></h3>
			</div>

			<p class="text-muted product-list-item__meta">{hometext}</p>

			<!-- BEGIN: adminlink -->
			<p>{ADMINLINK}</p>
			<!-- END: adminlink -->

		</div>
	</div>
	<!-- END: items -->
</div>
<div class="clear">&nbsp;</div>

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

<!-- BEGIN: pages -->
<div class="text-center">{generate_page}</div>
<!-- END: pages -->

<div class="msgshow" id="msgshow"></div>

<!-- BEGIN: tooltip_js -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[data-rel="tooltip"]').tooltip({
			placement : 'bottom',
			html : true,
			title : function() {
				return '<p class="text-justify">' + $(this).data('content') + '</p><div class="clearfix"></div>';
			}
		});
	});
</script>
<!-- END: tooltip_js -->

<style>
	.shop-search-filter {
		margin: 0 0 20px;
	}
	.shop-search-filter__panel {
		background: linear-gradient(180deg, #ffffff, #f8fcf7);
		border: 1px solid #d7efe8;
		border-radius: 14px;
		padding: 18px 18px 8px;
		box-shadow: 0 10px 24px rgba(13, 111, 72, 0.08);
	}
	.shop-search-filter__header {
		margin-bottom: 12px;
	}
	.shop-search-filter__header h3 {
		margin: 0;
		font-size: 20px;
		font-weight: 700;
		color: #0d6f48;
	}
	.form-group--modern {
		margin-bottom: 12px;
	}
	.form-group--modern label {
		display: block;
		margin-bottom: 6px;
		font-size: 12px;
		font-weight: 600;
		color: #265d4b;
		text-transform: uppercase;
		letter-spacing: 0.04em;
	}
	.form-group--modern .form-control {
		height: 42px;
		border: 1px solid #cfe5d9;
		border-radius: 10px;
		background: #fff;
		box-shadow: none;
		color: #1f2d3d;
		padding: 8px 12px;
	}
	.form-group--modern .form-control:focus {
		border-color: #1aa66d;
		box-shadow: 0 0 0 3px rgba(26, 166, 109, 0.12);
	}
	.form-group--submit {
		align-items: end;
		height: 100%;
	}
	.btn-search {
		width: 100%;
		height: 42px;
		border: none;
		border-radius: 10px;
		background: linear-gradient(135deg, #2c9b28, #55ae16);
		font-weight: 700;
		box-shadow: 0 10px 20px rgba(25, 167, 107, 0.18);
	}	
	.shop-search-results {
		display: block;
	}
	.shop-search-results .product-list-item {
		display: flex;
		align-items: flex-start;
		gap: 15px;
		padding: 15px;
		margin-bottom: 15px;
		border: 1px solid #e3efe8;
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 6px 16px rgba(20, 55, 46, 0.04);
	}
	.shop-search-results .product-list-item__image {
		flex: 0 0 140px;
		max-width: 140px;
	}
	.shop-search-results .product-list-item__image img {
		width: 100%;
		height: auto;
		max-height: 140px;
		object-fit: contain;
		border-radius: 10px;
	}
	.shop-search-results .product-list-item__content {
		flex: 1;
	}
	.shop-search-results .product-list-item__title-wrap {
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		gap: 8px;
	}
	.shop-search-results .product-list-item__title {
		margin: 0;
		font-size: 20px;
		line-height: 1.4;
	}
	.shop-search-results .product-list-item__title a {
		color: #1d2a36;
		font-weight: 600;
	}
	.shop-search-results .product-list-item__meta {
		margin: 10px 0 0;
		color: #5a6f78;
		line-height: 1.6;
	}
	@media (max-width: 767px) {
		.shop-search-results .product-list-item {
			flex-direction: column;
		}
		.shop-search-results .product-list-item__image {
			flex-basis: auto;
			max-width: 220px;
			width: 100%;
		}
	}
</style>
<!-- END: main -->