<!-- BEGIN: main -->
<div id="cse"></div>
<div id="search-form" class="text-center">
	<p><em>{LANG.info_title}</em></p>
	<form action="{NV_BASE_SITEURL}index.php" name="form_search" method="get" id="form_search" role="form" class="form-inline">
		<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" />
		<input type="hidden" name="nv" value="seek" />
		<input type="hidden" name="{NV_OP_VARIABLE}" value="main" />

		<div class="m-bottom">
			<div class="form-group">
				<label class="sr-only" for="search_query">{LANG.key_title}</label>
				<input class="form-control" id="search_query" name="q" value="{DATA.key}" maxlength="{NV_MAX_SEARCH_LENGTH}" placeholder="{LANG.key_title}" />
			</div>
			<div class="form-group">
				<label class="sr-only" for="search_query_mod">{LANG.type_search}</label>
				<select name="m" id="search_query_mod" class="form-control">
					<option value="all">{LANG.search_on_site}</option>
					<!-- BEGIN: select_option -->
					<option data-adv="{MOD.adv_search}" value="{MOD.value}"{MOD.selected}>{MOD.custom_title}</option>
					<!-- END: select_option -->
				</select>
			</div>
			<div class="form-group">
				<input type="submit" id="search_submit" value="{LANG.search_title}" class="btn btn-primary"/>
				<a href="#" class="advSearch">{LANG.search_title_adv}</a>
			</div>
		</div>

		<div class="radio">
			<label class="radio-inline">
				<input name="l" id="search_logic_and" type="radio"{DATA.andChecked} value="1" />
				{LANG.logic_and}
			</label>
			<label class="radio-inline">
				<input name="l" id="search_logic_or" type="radio"{DATA.orChecked} value="0" />
				{LANG.logic_or}
			</label>
		</div>
		<input type="hidden" name="page" value="{PAGE}"/>
	</form>

	<!-- BEGIN: search_engine_unique_ID -->
	<div class="text-center search_adv">
		<a href="#" class="IntSearch">{LANG.search_adv_internet}</a>
	</div>
	<script src="http://www.google.com/jsapi" type="text/javascript" data-show="after"></script>
	<script type="text/javascript" data-show="after">
		google.load('search', '1', { language : nv_sitelang });
	</script>
	<link rel="stylesheet" href="https://www.google.com/cse/style/look/default.css" type="text/css" />
	<!-- END: search_engine_unique_ID -->
	<hr />
</div>

<script type="text/javascript" data-show="after">
//<![CDATA[
$('#search_query_mod').change(function(){
	var data = $(this).find('option:selected').data();
	if( data.adv == true ){
		$("a.advSearch").show();
	}else if( data.adv == false ){
		$("a.advSearch").hide();
	}else{
		$("a.advSearch").show();
	}
});

$("a.advSearch").click(function(e){
	e.preventDefault();
	var keyword = $("#form_search #search_query").val();
	keyword = strip_tags(keyword);

	if ({NV_MIN_SEARCH_LENGTH} <= keyword.length && {NV_MAX_SEARCH_LENGTH} >= keyword.length) {
		keyword = rawurlencode(keyword);
		var link = nv_siteroot + "index.php?" + nv_lang_variable + "=" + nv_sitelang + "&nv=seek&op=main&q=" + keyword;
		window.location.href = link;
	}
});

$("a.IntSearch").click(function(){
	var keyword = $("#form_search [name=q]").val();
	$("#search-form").hide();
	$("#search_result").hide();
	var customSearchControl = new google.search.CustomSearchControl('{SEARCH_ENGINE_UNIQUE_ID}');
	customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
	customSearchControl.draw('cse');
	customSearchControl.execute(keyword);
});

$("#form_search").submit(function(){
	var keyword = $("#form_search [name=q]").val();
	keyword = strip_tags(keyword);
	$("#form_search [name=q]").val(keyword);
	if({NV_MIN_SEARCH_LENGTH} > keyword.length || {NV_MAX_SEARCH_LENGTH} < keyword.length){
		$("#form_search [name=q]").select();
		return false;
	}
	return true;
});
//]]>
</script>
<!-- END: main -->
