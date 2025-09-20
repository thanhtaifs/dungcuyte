<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<div class="row">
	[HEADER]
</div>

<div class="row">
    <div class="col-sm-18 col-md-19 col-sm-push-6 col-md-push-5 border">
        [TOP]
        <!-- BEGIN: breadcrumbs -->
				<ol class="breadcrumb">
					<li class="home" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><em class="fa fa-lg fa-home">&nbsp;</em><a href="{THEME_SITE_HREF}" itemprop="url" title="{LANG.Home}"><span itemprop="title">{LANG.Home}</span></a></li>
					<!-- BEGIN: loop --><li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{BREADCRUMBS.link}" itemprop="url" title="{BREADCRUMBS.title}"><span itemprop="title">{BREADCRUMBS.title}</span></a></li><!-- END: loop -->
				</ol>
				<!-- END: breadcrumbs -->  
        [BOTTOM]       
        {MODULE_CONTENT}
        
       
    </div>
	<div class="col-sm-6 col-md-5 col-sm-pull-18 col-md-pull-19">
		[LEFT]
        <div class="panel panel-default">
	<div class="panel-heading">
		Liên kết Facebook
	</div>
	<div class="panel-body">
        <div class="fb-page" data-href="https://www.facebook.com/nguyenthinewtech" data-width="100%" data-height="350" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/nguyenthinewtech"><a href="https://www.facebook.com/nguyenthinewtech">Nguyễn Thi</a></blockquote></div></div>
        <div id="fb-root"></div>
     </div>
</div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        [LEFT1] 
	</div>
</div>
<div class="row">
	[FOOTER]
</div>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->