<!-- BEGIN: main -->
<div class="page panel panel-default">
    <div class="panel-body">
        <div id="search_result">
        	{SEARCH_RESULT}
        </div>
    </div>
</div>
<script type="text/javascript">
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
	var b = $("#form_search #search_query_mod").val();
	if("all" == b){
		return alert("{LANG.chooseModule}"), $("#form_search #search_query_mod").focus(), !1
	}
	var b = nv_base_siteurl + "index.php?" + nv_lang_variable + "=" + nv_lang_data + "&" + nv_name_variable + "=" + b + "&" + nv_fc_variable + "=search", a = $("#form_search #search_query").val(), a = strip_tags(a);
	{NV_MIN_SEARCH_LENGTH} <= a.length && {NV_MAX_SEARCH_LENGTH} >= a.length && (a = rawurlencode(a), b = b + "&q=" + a);

	window.location.href = b;
});
$("a.IntSearch").click(function(){
	var a = $("#form_search [name=q]").val();
	$("#search-form").hide();
	$("#search_result").hide();
	var customSearchControl = new google.search.CustomSearchControl('{SEARCH_ENGINE_UNIQUE_ID}');
	customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
	customSearchControl.draw('cse');
	customSearchControl.execute(a);
});
$("#form_search").submit(function(){
	var a = $("#form_search [name=q]").val(), a = strip_tags(a), b;
	$("#form_search [name=q]").val(a);
	if({NV_MIN_SEARCH_LENGTH} > a.length || {NV_MAX_SEARCH_LENGTH} < a.length){
		return $("#form_search [name=q]").select(), !1
	}
	return true;
});
//]]>
</script>
<!-- END: main -->
