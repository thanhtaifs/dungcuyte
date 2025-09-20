<!-- BEGIN: main -->
<div class="page-content">
<div class="border-content">
	<h1>{CONTENT.title}</h1>	
	<!-- BEGIN: facebookjssdk -->
	<div id="fb-root"></div>
	<script type="text/javascript">
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/{FACEBOOK_LANG}/sdk.js#xfbml=1&version=v17.0&appId={FACEBOOK_APPID}";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- END: facebookjssdk -->	
	<!-- BEGIN: socialbutton -->
	<div class="well well-sm">
		<ul class="nv-social-share">
			<!-- BEGIN: facebook -->
			<li class="facebook">
				<div class="fb-like" data-href="{SELFURL}" data-layout="button_count" data-width="200"
         data-layout="button_count" 
         data-action="like" 
         data-size="small"
         data-share="true">Facebook</div>
			</li>
			<!-- END: facebook -->
			<li class="twitter">
				<a href="https://twitter.com/share" class="twitter-share"> <i class="fa fa-twitter"></i> Tweet</a>
				<script type="text/javascript" src="https://platform.twitter.com/widgets.js" data-show="after"></script>
			</li>
		</ul>
	</div>
	<!-- END: socialbutton -->
		<p>{CONTENT.description}</p>
		<!-- BEGIN: image -->
		<div class="image text-center">
			<a href="#" id="pop" title="{CONTENT.title}">
	            <img id="imageresource" alt="{CONTENT.imagealt}" src="{CONTENT.image}" class="img-thumbnail" >
	        </a>
	        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">{CONTENT.title}</h4>
						</div>
						<div class="modal-body">
							<img src="" id="imagepreview" class="img-thumbnail">
						</div>
					</div>
				</div>
			</div>
			<em style="display: block;margin: 10px 0 10px 0;">{CONTENT.imagealt}</em>
		</div>
		<!-- END: image -->
		<div class="bodytext">
			{CONTENT.bodytext}
		</div>
		<div class="clear">
			<!-- BEGIN: comment -->
				{CONTENT_COMMENT}
			<!-- END: comment -->
		</div>
		<!-- BEGIN: other -->
	</div>
	<ul class="nv-list-item">
		<!-- BEGIN: loop -->
		<li><em class="fa fa-angle-double-right">&nbsp;</em> <a title="{OTHER.title}" href="{OTHER.link}">{OTHER.title}</a></li>
		<!-- END: loop -->
	</ul>
	<!-- END: other -->
	<script type="text/javascript" data-show="after">
		$(document).ready(function() {
		    $("#pop").on("click", function() {
               $('#imagepreview').attr('src', $('#imageresource').attr('src'));
               $('#imagemodal').modal('show');
            });
			$(".bodytext img").toggleClass('img-thumbnail');
		});
	</script>
	</div>
<!-- END: main -->
