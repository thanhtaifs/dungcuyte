<!-- BEGIN: main -->
<div class="news-page news-page--list">
	<!-- BEGIN: viewdescription -->
	<div class="news-hero">
		<div class="news-hero__body">
			<div class="news-eyebrow">Tin tức</div>
			<h1 class="news-hero__title">{CONTENT.title}</h1>
			<p class="news-hero__text">{CONTENT.description}</p>
		</div>
		<!-- BEGIN: image -->
		<div class="news-hero__media">
			<img alt="{CONTENT.title}" src="{HOMEIMG1}" width="{IMGWIDTH1}" class="img-thumbnail imghome" />
		</div>
		<!-- END: image -->
	</div>
	<!-- END: viewdescription -->

	<div class="news-list">
		<!-- BEGIN: viewcatloop -->
		<article class="news-list-card">
			<div class="news-list-card__count">{NUMBER}</div>
			<div class="news-list-card__body">
				<h3 class="news-list-card__title">
					<a class="show" href="{CONTENT.link}" data-content="{CONTENT.hometext}" data-img="{CONTENT.imghome}" data-rel="tooltip" title="{CONTENT.title}">
						{CONTENT.title}
					</a>
					<!-- BEGIN: newday -->
					<span class="icon_new">&nbsp;</span>
					<!-- END: newday -->
				</h3>
				<a class="news-list-card__link" href="{CONTENT.link}" title="{CONTENT.title}">Đọc bài viết <i class="fa fa-angle-right"></i></a>
			</div>
		</article>
		<!-- END: viewcatloop -->
	</div>

	<!-- BEGIN: generate_page -->
	<div class="news-pagination">
		{GENERATE_PAGE}
	</div>
	<!-- END: generate_page -->
</div>
<!-- BEGIN: tooltip -->
<script type="text/javascript" data-show="after">
	$(document).ready(function() {
		$("[data-rel='tooltip'][data-content!='']").removeAttr("title");
		$("[data-rel='tooltip'][data-content!='']").tooltip({
			placement: "{TOOLTIP_POSITION}",
			html: true,
			title: function(){return ( $(this).data('img') == '' ? '' : '<img class="img-thumbnail pull-left margin_image" src="' + $(this).data('img') + '" width="90" />' ) + '<p class="text-justify">' + $(this).data('content') + '</p><div class="clearfix"></div>';}
		});
	});
</script>
<!-- END: tooltip -->
<!-- END: main -->
