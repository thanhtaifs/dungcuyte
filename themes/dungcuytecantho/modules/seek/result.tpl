<!-- BEGIN: main -->
<input type="hidden" id="hidden_key" value="{HIDDEN_KEY}" />
<ul class="nav nav-tabs m-bottom">
	<li class="active">
		<a>{LANG.search_on} &quot;{MODULE_CUSTOM_TITLE}&quot; &nbsp;&nbsp;<span class="label label-info">{SEARCH_RESULT_NUM}</span></a>
	</li>
	<!-- BEGIN: more -->
	<li class="pull-right">
		<a href="{MORE}"><em class="fa fa-thumb-tack">&nbsp;</em> {LANG.view_all_title}</a>
	</li>
	<!-- END: more -->
</ul>
<div class=row>
    <!-- BEGIN: result -->
    <div class="col-xs-4 col-sm-3 col-md-2 p-2">
    <a href="{RESULT.link}">
            <img src="{RESULT.thumbnail_image}" alt="{RESULT.title_alt}" class="img-responsive img-thumbnail">
        </a>
     </div>
     <div class="col-xs-8 col-sm-9 col-md-10 p-2">
        <h3 class="margin-bottom-sm">
            <a href="{RESULT.link}">{RESULT.title}</a>
        </h3>
        <div>{RESULT.content}</div>
    </div>
<!-- END: result -->
</div>

<!-- BEGIN: generate_page -->
<div class="text-center">
	{GENERATE_PAGE}
</div>
<!-- END: generate_page -->
<!-- END: main -->