<!-- BEGIN: main -->

<div class="compare-toolbar">
	<button class="btn btn-danger btn-xs" onclick="nv_compare_del(0, 1)">{LANG.compare_del_all}</button>
</div>
<div class="table-responsive compare-responsive">
	<table class="table table-hover compare-table">
		<colgroup>
			<col width="150px" />
		</colgroup>
		<thead>
			<tr>
				<th>&nbsp;</th>
				<!-- BEGIN: product -->
				<th class="text-center compare-product-heading">
					<div class="thumbnail compare-card">
						<div class="image_center">
							<a href="{link_pro}" title="{title_pro}"><img src="{img_pro}" alt="{title_pro}" loading="lazy" decoding="async" /></a>
						</div>
						<div class="caption text-center">
							<h3><a href="{link_pro}" title="{title_pro}">{title_pro}</a></h3>
							<!-- BEGIN: price -->
							<p class="price">
								<!-- BEGIN: discounts -->
								<span class="money">{PRICE.sale_format}</span>
								<span class="discounts_money">{PRICE.price_format}</span>
								<!-- END: discounts -->
								<!-- BEGIN: no_discounts -->
								<span class="money">{PRICE.price_format}</span>
								<!-- END: no_discounts -->
							</p>
							<!-- END: price -->
							<!-- BEGIN: contact -->
							<p class="price">{LANG.detail_pro_price}: <span class="money">{LANG.price_contact}</span></p>
							<!-- END: contact -->
							<div class="compare-actions">
								<!-- BEGIN: order -->
								<a href="javascript:void(0)" id="{id}" title="{title_pro}" onclick="cartorder(this, {GROUP_REQUIE}, '{LINK}')"><button type="button" class="btn btn-primary btn-xs">{LANG.add_product}</button></a>
								<!-- END: order -->
								<!-- BEGIN: product_empty -->
								<button class="btn btn-danger disabled btn-xs">{LANG.product_empty}</button>
								<!-- END: product_empty -->
								<button class="btn btn-warning btn-xs" onclick="nv_compare_del({id}, 0)">{GLANG.delete}</button>
							</div>
						</div>
					</div>
				</th>
				<!-- END: product -->
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><strong>{LANG.product_intro}</strong></td>
				<!-- BEGIN: hometext -->
				<td>{intro}</td>
				<!-- END: hometext -->
			</tr>
			<tr>
				<td><strong>{LANG.detail_product}</strong></td>
				<!-- BEGIN: bodytext -->
				<td>{bodytext}</td>
				<!-- END: bodytext -->
			</tr>
			<tr>
				<td><strong>{LANG.detail_warranty}</strong></td>
				<!-- BEGIN: warranty -->
				<td>{warranty}</td>
				<!-- END: warranty -->
			</tr>
			<tr>
				<td><strong>{LANG.detail_promotional}</strong></td>
				<!-- BEGIN: promotional -->
				<td>{promotional}</td>
				<!-- END: promotional -->
			</tr>
		</tbody>
	</table>
</div>
<div class="msgshow" id="msgshow">&nbsp;</div>
<script type="text/javascript">
	var lang_del_confirm = '{LANG.compare_del_items_confirm}';
</script>

<!-- END: main -->