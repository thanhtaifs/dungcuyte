<!DOCTYPE html>
<html lang="{LANG.Content_Language}" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
	<head>
	    <meta name="google-site-verification" content="jnnyrcztwUgPu4zdrwvnsy51f0OfS0BQneZGMkIYiAM" />
		{THEME_PAGE_TITLE} {THEME_META_TAGS}
        <!-- BEGIN: viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- END: viewport -->
		{THEME_SITE_RSS}

		<link rel="shortcut icon" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/favicon.ico" />

        <!-- BEGIN: responsive -->
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/bootstrap.min.css" rel="stylesheet" />
                <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/owl.carousel.min.css" rel="stylesheet" />
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/style.css" rel="stylesheet" />
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/style.responsive.css" rel="stylesheet" /> 
        <link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/default.css" />
		<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/component.css" />
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/skitter.styles.min.css" type="text/css" media="all" rel="stylesheet" />
        <!-- END: responsive -->

        <!-- BEGIN: non_responsive -->
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/bootstrap.non-responsive.css" rel="stylesheet" />
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/style.css" rel="stylesheet" />
        <!-- END: non_responsive -->

		<link href="{NV_BASE_SITEURL}themes/dungcuytecantho/css/font-awesome.min.css" rel="stylesheet" />
		{THEME_CSS}
		{THEME_SITE_JS}
        <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/modernizr.custom.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.cbpFWSlider.min.js"></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.slicknav.js"></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/owl.carousel.min.js"></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery-ui.min.js"></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.nice-select.min.js"></script>
        
		<script type="text/javascript" language="javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" language="javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.skitter.min.js"></script>
        

        <script>
			$( function() {

				$( '#cbp-fwslider' ).cbpFWSlider();

			} );
		</script>
        
        <script type="text/javascript" language="javascript">
			$(document).ready(function() {
			  $('.box_skitter_large').skitter({
				theme: 'clean',
				numbers_align: 'center',
				progressbar: true, 
				dots: true, 
				preview: true
			  });
			});
			window.addEventListener('pageshow', function(event) {
                // Kích hoạt lại nút tìm kiếm nếu nó bị disabled
                var btn = document.getElementById('topmenu_search_submit');
                if (btn && btn.disabled) {
                    btn.disabled = false;
                }
            });
		  </script>
		<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/main.js"></script>
		<!-- BEGIN: lt_ie9 -->
		<script type="text/javascript" src="{NV_BASE_SITEURL}themes/dungcuytecantho/js/html5shiv.js"></script>
		<script type="text/javascript" src="{NV_BASE_SITEURL}themes/dungcuytecantho/js/respond.min.js"></script>
		<!-- END: lt_ie9 -->
	</head>
	<body>
		<div id="timeoutsess" class="chromeframe">
		{LANG_TIMEOUTSESS_NOUSER}, <a onclick="timeoutsesscancel();" href="#">{LANG_TIMEOUTSESS_CLICK}</a>. {LANG_TIMEOUTSESS_TIMEOUT}: <span id="secField"> 60 </span> {LANG_TIMEOUTSESS_SEC}
		</div>
