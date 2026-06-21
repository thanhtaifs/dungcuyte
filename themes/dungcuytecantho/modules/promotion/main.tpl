<!-- BEGIN: main -->
<article class="content-detail-page">
    <div class="content-detail-card">
        <div class="content-detail-head">
            <div class="content-hero__eyebrow">Khuyến mãi</div>
            <h1>{CONTENT.title}</h1>
            <p class="content-detail-desc">{CONTENT.description}</p>
        </div>

        <!-- BEGIN: socialbutton -->
        <div class="content-detail-share well well-sm">
            <ul class="nv-social-share">
                <!-- BEGIN: facebook -->
                <li class="facebook">
                    <div class="fb-like" data-href="{SELFURL}" data-layout="button_count" data-width="200" data-layout="button_count" data-action="like" data-size="small" data-share="true">Facebook</div>
                </li>
                <!-- END: facebook -->
                <li class="twitter">
                    <a href="https://twitter.com/share" class="twitter-share"> <i class="fa fa-twitter"></i> Tweet</a>
                    <script type="text/javascript" src="https://platform.twitter.com/widgets.js" data-show="after"></script>
                </li>
            </ul>
        </div>
        <!-- END: socialbutton -->

        <!-- BEGIN: image -->
        <div class="content-detail-media text-center">
            <a href="#" id="pop" title="{CONTENT.title}">
                <img id="imageresource" alt="{CONTENT.imagealt}" src="{CONTENT.image}" class="img-thumbnail">
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
            <em class="content-detail-note">{CONTENT.imagealt}</em>
        </div>
        <!-- END: image -->

        <div class="bodytext content-detail-body">
            {CONTENT.bodytext}
        </div>

        <div class="clear">
            <!-- BEGIN: comment -->
            {CONTENT_COMMENT}
            <!-- END: comment -->
        </div>
    </div>

    <!-- BEGIN: other -->
    <div class="content-related-card">
        <h2>Bài viết liên quan</h2>
        <ul class="nv-list-item content-related-list">
            <!-- BEGIN: loop -->
            <li><em class="fa fa-angle-double-right">&nbsp;</em> <a title="{OTHER.title}" href="{OTHER.link}">{OTHER.title}</a></li>
            <!-- END: loop -->
        </ul>
    </div>
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
</article>
<!-- END: main -->
