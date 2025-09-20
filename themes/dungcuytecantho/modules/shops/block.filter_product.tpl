<!-- BEGIN: main -->
<form action="" method="POST" onsubmit="check(); return false;" style="border:1px solid #fff; padding:10px 10px 50px 10px; border-top:none">
	<!-- BEGIN: loop -->

	<!-- BEGIN: main_group -->
	<p style="padding:10px 0; color:#71C30E">
		<!-- BEGIN: image -->
		<img src="{DATA.image}" style="max-height: 16px; max-width: 16px" />
		<!-- END: image -->
		<strong>{DATA.title}</strong>
	</p>
	<!-- END: main_group -->

	<!-- BEGIN: sub_group -->
	<p>
		{DATA.space}
		<!-- BEGIN: checkbox -->
		<input type="checkbox" name="group_id[]" value="{DATA.id}" id="{DATA.id}" {DATA.checked}>
		<!-- END: checkbox -->
		<label for="{DATA.id}"> <!-- BEGIN: image --> <img src="{DATA.image}" style="max-height: 16px; max-width: 16px" /> <!-- END: image --> {DATA.title} <span class="text-danger">({DATA.numpro})</span> </label>
	</p>
	<!-- END: sub_group -->
	<!-- END: loop -->

	<!-- BEGIN: group_price -->
	<p><strong>{LANG.title_price} ({MONEY_UNIT})</strong></p>
	<!-- BEGIN: loop -->
	<p><label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="group_price[]" value="{PRICE.price_key}" {PRICE.checked}>{PRICE.price_value}</label></p>
	<!-- END: loop -->
	<!-- END: group_price -->

	<input type="submit" name="filter" value="{LANG.filter}" class="btn btn-primary btn-xs btn-sm pull-right" />
</form>

<script type="text/javascript">
	function check() {
		var count = 0;
		$('input[name="group_id[]"], input[name="group_price[]"]').each(function() {
			if ($(this).is(':checked'))
				$count++;
		});

		if (count == 0)
			alert('{LANG.filter_no_item}');
	}
</script>
<!-- END: main -->