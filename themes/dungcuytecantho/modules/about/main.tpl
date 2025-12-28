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
		<div class="owner-info well well-sm">
			<h3>Thông tin chủ sở hữu website</h3>
			<ul>
				<li><strong>Tên đơn vị:</strong> Công Ty TNHH Huỳnh Gia Alpha</li>
				<li><strong>Mã số thuế:</strong> 1801763703 </li>
				<li><strong>Địa chỉ trụ sở:</strong> 4AB1 Xuân Thủy, KDC Cái Sơn - Hàng Bàng, KV2,P. An Bình, TP. Cần Thơ</li>
				<li><strong>Điện thoại:</strong> 0906 377 086 – 0899 060 456</li>
				<li><strong>Email:</strong> huynhgiact65@gmail.com</li>
				<li><strong>Người đại diện theo pháp luật:</strong> Huỳnh Tấn Nguyên</li>
				<li><strong>Chức vụ:</strong> Giám đốc</li>
				<li><strong>Giấy chứng nhận ĐKKD: 1801763703 </strong> Do Sở Kế hoạch và Đầu tư TP. Cần Thơ cấp: 08/05/2024</li>
				<li><strong>Lĩnh vực kinh doanh có điều kiện:</strong> Kinh doanh trang thiết bị y tế theo quy định pháp luật hiện hành</li>
			</ul>
		</div>

		<div class="branch-info well well-sm">
			<h3>Hệ thống cửa hàng – chi nhánh</h3>

			<div class="branch-item">
				<h4>♦ Cần Thơ</h4>
				<ul>
					<li>
						<strong>Huỳnh Gia 1</strong><br>
						☎ 0906 377 086 – 0899 060 456 (TVBH)<br>
						📍 04–06 Xuân Thủy, KDC Hồng Phát, Phường An Bình, TP. Cần Thơ<br>
						<em>(Đối diện Anh Đào Mekong 2 Hotel & Ngọc Nhớ 8 Motel)</em>
					</li>
					<li>
						<strong>Huỳnh Gia 2</strong><br>
						☎ 0907 694 868 – 0899 070 456 (TVBH)<br>
						📍 369B Nguyễn Văn Cừ, Phường Tân An, TP. Cần Thơ<br>
						<em>(BV Đại Học Y Dược xuống 5 căn nhà hướng về BVPS Phương Châu)</em>
					</li>
				</ul>
			</div>

			<div class="branch-item">
				<h4>♦ Vĩnh Long</h4>
				<ul>
					<li>
						<strong>Huỳnh Gia 3</strong><br>
						☎ 0907 694 868 – 0939 310 467 (TVBH)<br>
						📍 37A Phạm Hùng, Khóm 2, Phường Long Châu, Tỉnh Vĩnh Long<br>
						<em>(Cách BV Xuyên Á 100m, đối diện chợ Phường 9)</em>
					</li>
				</ul>
			</div>
		</div>


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
