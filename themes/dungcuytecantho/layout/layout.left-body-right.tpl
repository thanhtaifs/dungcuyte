<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<main id="maincontent" class="site-main">
	<div class="container">
		[HEADER]
		<div class="page-shell page-shell--catalog">
			<div class="row pt-3">
				<aside class="col-lg-3 page-shell__sidebar page-shell__sidebar--filters">
					<div class="hero__categories">
						<div class="hero__categories__all">
							<i class="fa fa-bars"></i>
							<span>Loai san pham</span>
						</div>
						[RIGHT_TOP]
					</div>
				</aside>
				<div class="col-lg-9 page-shell__content">
					[TOP]
					{MODULE_CONTENT}
					[BOTTOM]
				</div>
			</div>
		</div>
		[FOOTER]
	</div>
</main>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->
