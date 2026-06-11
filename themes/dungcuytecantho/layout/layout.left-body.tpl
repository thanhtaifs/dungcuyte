<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<main id="maincontent" class="site-main">
	<div class="container">
		[HEADER]
		<div class="page-shell page-shell--sidebar-left">
			<aside class="page-shell__sidebar">
				[LEFT]
				<div class="panel panel-default">
					<div class="panel-heading">Lien ket Facebook</div>
					<div class="panel-body">
						<div class="fb-page" data-href="https://www.facebook.com/nguyenthinewtech" data-width="100%" data-height="350" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/nguyenthinewtech"><a href="https://www.facebook.com/nguyenthinewtech">Nguyen Thi</a></blockquote></div></div>
						<div id="fb-root"></div>
					</div>
				</div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				[LEFT1]
			</aside>
			<div class="page-shell__content">
				[TOP]
				<!-- BEGIN: breadcrumbs -->
				<nav class="breadcrumb-shell" aria-label="breadcrumb">
					<ol class="breadcrumb-card">
						<li class="sub-breadcrumb"><a href="{THEME_SITE_HREF}">{LANG.Home}</a></li>
						<!-- BEGIN: loop -->
						<li class="sub-breadcrumb"><a href="{BREADCRUMBS.link}" title="{BREADCRUMBS.title}">{BREADCRUMBS.title}</a></li>
						<!-- END: loop -->
					</ol>
				</nav>
				<!-- END: breadcrumbs -->
				[BOTTOM]
				{MODULE_CONTENT}
			</div>
		</div>
		[FOOTER]
	</div>
</main>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->
