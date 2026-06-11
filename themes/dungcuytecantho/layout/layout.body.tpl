<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<main id="maincontent" class="site-main">
	<div class="container">
		[HEADER]
		<div class="page-shell page-shell--single">
			[TOP]
			{MODULE_CONTENT}
			[BOTTOM]
		</div>
		[FOOTER]
	</div>
</main>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->
