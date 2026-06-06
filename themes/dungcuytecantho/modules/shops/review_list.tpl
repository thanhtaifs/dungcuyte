<!-- BEGIN: main -->

<!-- BEGIN: rate_empty -->
<div class="alert alert-info">
	{EMPTY}
</div>
<!-- END: rate_empty -->

<!-- BEGIN: rate_data -->
<div class="row">
	<div class="review-items">
		<!-- BEGIN: loop -->
		<div class="review_row">
			<div class="review_meta">
				<strong>{DATA.sender}</strong>
				<!-- BEGIN: verified_purchase -->
				<span class="label label-success">{LANG.rate_verified_purchase}</span>
				<!-- END: verified_purchase -->
				<span class="help-block">{DATA.add_time}</span>
				<div class="review_stars clearfix">
					<!-- BEGIN: star -->
					<div class="star-icon">&nbsp;</div>
					<!-- END: star -->
				</div>
			</div>
			<div class="review_body">
				<!-- BEGIN: content -->
				<em class="help-block">"{DATA.content}"</em>
				<!-- END: content -->
				<!-- BEGIN: seller_response -->
				<div class="alert alert-success review_seller_response" style="margin-top: 10px; margin-bottom: 0;">
					<strong>{LANG.rate_seller_response}:</strong> {DATA.seller_response}
				</div>
				<!-- END: seller_response -->
			</div>
		</div>
		<!-- END: loop -->
	</div>
	<!-- BEGIN: load_more -->
	<div class="text-center review-loadmore-wrap">
		<button type="button" class="btn btn-default review-loadmore-btn" data-next-page="{NEXT_PAGE}" data-url="{LOAD_MORE_URL}">{LANG.rate_load_more}</button>
	</div>
	<!-- END: load_more -->
</div>
<!-- END: rate_data -->

<!-- END: results -->
