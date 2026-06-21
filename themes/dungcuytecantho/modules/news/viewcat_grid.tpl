<!-- BEGIN: main -->
<div class="news-page news-page--grid">
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

	<!-- BEGIN: featuredloop -->
	<article class="news-featured-card">
		<!-- BEGIN: image -->
		<a class="news-featured-card__media" href="{CONTENT.link}" title="{CONTENT.title}">
			<img alt="{HOMEIMGALT1}" src="{HOMEIMG1}" width="150" class="img-thumbnail imghome" />
		</a>
		<!-- END: image -->
		<div class="news-featured-card__body">
			<div class="news-meta">
				<span><em class="fa fa-clock-o">&nbsp;</em> {CONTENT.publtime}</span>
				<span><em class="fa fa-eye">&nbsp;</em> {LANG.view}: {CONTENT.hitstotal}</span>
				<span><em class="fa fa-comment-o">&nbsp;</em> {LANG.total_comment}: {CONTENT.hitscm}</span>
			</div>
			<h2 class="news-featured-card__title">
				<a href="{CONTENT.link}" title="{CONTENT.title}">{CONTENT.title}</a>
			</h2>
			<p class="news-featured-card__text">{CONTENT.hometext}</p>
			<!-- BEGIN: adminlink -->
			<p class="news-featured-card__admin">{ADMINLINK}</p>
			<!-- END: adminlink -->
		</div>
	</article>
	<!-- END: featuredloop -->

	<div class="news-grid">
		<!-- BEGIN: viewcatloop -->
		<article class="news-card">
			<a class="news-card__media" title="{CONTENT.title}" href="{CONTENT.link}">
				<img alt="{HOMEIMGALT1}" src="{HOMEIMG1}" width="{IMGWIDTH1}" class="img-thumbnail"/>
			</a>
			<div class="news-card__body">
				<h3 class="news-card__title">
					<a class="show" href="{CONTENT.link}" data-content="{CONTENT.hometext_clean}" data-img="{CONTENT.imghome}" data-rel="tooltip" title="{CONTENT.title}">{CONTENT.title}</a>
				</h3>
				<div class="news-card__footer">
					<a class="news-card__link" href="{CONTENT.link}" title="{CONTENT.title}">Xem chi tiết <i class="fa fa-angle-right"></i></a>
					<span class="news-card__admin">{ADMINLINK}</span>
				</div>
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
