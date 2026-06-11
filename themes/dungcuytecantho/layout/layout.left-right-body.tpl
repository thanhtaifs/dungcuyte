<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<main id="maincontent" class="site-main">
	<div class="container">
		[HEADER]
		<div class="page-shell page-shell--three-col">
			<div class="row">
				<div class="col-sm-12 col-md-13 col-sm-push-12 col-md-push-11 page-shell__content">
					[TOP]
					{MODULE_CONTENT}
					[BOTTOM]
				</div>
				<aside class="col-sm-6 col-md-6 col-sm-pull-6 col-md-pull-8 page-shell__sidebar">
					[RIGHT]
				</aside>
				<aside class="col-sm-6 col-md-5 col-sm-pull-18 col-md-pull-19 page-shell__sidebar">
					[LEFT]
				</aside>
			</div>
		</div>
		[FOOTER]
	</div>
</main>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->
