<!DOCTYPE html>
<html lang="{LANG.Content_Language}" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#">
	<head>
	    <meta name="google-site-verification" content="jnnyrcztwUgPu4zdrwvnsy51f0OfS0BQneZGMkIYiAM" />
		<meta name="theme-color" content="#3ca32f" />
		<meta name="format-detection" content="telephone=yes" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="default" />
		<meta name="apple-mobile-web-app-title" content="{SITE_NAME}" />
		<meta name="twitter:card" content="summary_large_image" />
		{THEME_PAGE_TITLE} {THEME_META_TAGS}
        <!-- BEGIN: viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- END: viewport -->
		{THEME_SITE_RSS}

		<link rel="shortcut icon" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/favicon.ico" />
		<link rel="preload" as="image" href="{NV_BASE_SITEURL}images/Banner.webp" type="image/webp" fetchpriority="high" />

        <!-- BEGIN: responsive -->
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/bootstrap.min.css" rel="stylesheet" />
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/style.css?v=20260705e" rel="stylesheet" />
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/style.responsive.css?v=20260705e" rel="stylesheet" />
        <!-- END: responsive -->

        <!-- BEGIN: non_responsive -->
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/bootstrap.non-responsive.css" rel="stylesheet" />
        <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/style.css?v=20260705e" rel="stylesheet" />
        <!-- END: non_responsive -->

		<link href="{NV_BASE_SITEURL}themes/dungcuytecantho/css/font-awesome.min.css" rel="stylesheet" />
		{THEME_CSS}
		{THEME_SITE_JS}
        <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/modernizr.custom.js" defer></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.cbpFWSlider.min.js" defer></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.slicknav.js" defer></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/owl.carousel.min.js" defer></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery-ui.min.js" defer></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.nice-select.min.js" defer></script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.easing.1.3.js" defer></script>
        <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.skitter.min.js" defer></script>


        <script>
			window.addEventListener('DOMContentLoaded', function() {
				if (window.jQuery && $('#cbp-fwslider').length && $.fn.cbpFWSlider) {
					$('#cbp-fwslider').cbpFWSlider();
				}

				if (window.jQuery && $('.box_skitter_large').length && $.fn.skitter) {
					$('.box_skitter_large').skitter({
						theme: 'clean',
						numbers_align: 'center',
						progressbar: true,
						dots: true,
						preview: true
					});
				}

				var skitterControlLabels = {
					prev_button: 'Slide trước',
					next_button: 'Slide tiếp theo',
					play_pause_button: 'Tạm dừng hoặc tiếp tục slideshow',
					focus_button: 'Phóng to slideshow'
				};

				document.querySelectorAll('.box_skitter a.prev_button, .box_skitter a.next_button, .box_skitter a.play_pause_button, .box_skitter a.focus_button').forEach(function(link) {
					Object.keys(skitterControlLabels).forEach(function(className) {
						if (link.classList.contains(className)) {
							link.setAttribute('aria-label', skitterControlLabels[className]);
							link.setAttribute('title', skitterControlLabels[className]);
						}
					});

					if (link.getAttribute('href') === '#') {
						link.setAttribute('href', window.location.pathname + '#hero-banner');
					}
				});

				document.querySelectorAll('.box_skitter a[href=""]').forEach(function(link) {
					link.setAttribute('href', window.location.pathname + '#hero-banner');
					if (!link.getAttribute('aria-label')) {
						link.setAttribute('aria-label', 'Xem banner nổi bật');
						link.setAttribute('title', 'Xem banner nổi bật');
					}
				});
			});

			window.addEventListener('pageshow', function() {
                var btn = document.getElementById('topmenu_search_submit');
                if (btn && btn.disabled) {
                    btn.disabled = false;
                }
            });
		</script>
		<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/main.js?v=20260705e" defer></script>
		<!-- BEGIN: lt_ie9 -->
		<script src="{NV_BASE_SITEURL}themes/dungcuytecantho/js/html5shiv.js" defer></script>
		<script src="{NV_BASE_SITEURL}themes/dungcuytecantho/js/respond.min.js" defer></script>
		<!-- END: lt_ie9 -->
	</head>
	<body>
		<a class="skip-link" href="#maincontent">Chuyển đến nội dung</a>
		<div id="timeoutsess" class="chromeframe">
		{LANG_TIMEOUTSESS_NOUSER}, <a onclick="timeoutsesscancel();" href="#">{LANG_TIMEOUTSESS_CLICK}</a>. {LANG_TIMEOUTSESS_TIMEOUT}: <span id="secField"> 60 </span> {LANG_TIMEOUTSESS_SEC}
		</div>
