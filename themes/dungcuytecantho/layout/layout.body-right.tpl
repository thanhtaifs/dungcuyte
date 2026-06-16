<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<main id="maincontent" class="site-main site-main--catalog">
	<div class="container">
		[HEADER]
		<div class="page-shell page-shell--single">
			[TOP]
			<!-- BEGIN: breadcrumbs -->
			<nav class="breadcrumb-shell" aria-label="breadcrumb">
				<ol class="breadcrumb-card">
					<li class="sub-breadcrumb"><a href="{THEME_SITE_HREF}">{LANG.Home}</a></li>
					<!-- BEGIN: loop -->
					<li class="sub-breadcrumb"><a href="{BREADCRUMBS.link}">{BREADCRUMBS.title}</a></li>
					<!-- END: loop -->
				</ol>
			</nav>
			<!-- END: breadcrumbs -->
			{MODULE_CONTENT}
			[BOTTOM]
		</div>
		[FOOTER]
	</div>
</main>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->
