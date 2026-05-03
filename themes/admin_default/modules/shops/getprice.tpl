<!-- BEGIN: main -->
<td colspan="4" style="display:none;">
	<input type="hidden" name="product_price" value="0" />
	<select class="form-control" name="money_unit">
		<!-- BEGIN: money_unit -->
		<option value="{MON.code}" {MON.select}>{MON.currency}</option>
		<!-- END: money_unit -->
	</select>
	<select class="form-control" name="discount_id">
		<option value="0"> --- </option>
		<!-- BEGIN: discount -->
		<option value="{DISCOUNT.did}" {DISCOUNT.selected} >{DISCOUNT.title}</option>
		<!-- END: discount -->
	</select>
</td>
<!-- END:main -->
