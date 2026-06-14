<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
<main id="maincontent" class="site-main site-main--home">
	<div class="trust-strip">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="trust-item">
						<i class="fa fa-certificate"></i>
						<div><strong>Sản phẩm chính hảng</strong><span>Giấy phép lưu hành</span></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="trust-item">
						<i class="fa fa-refresh"></i>
						<div><strong>Đổi trả linh hoạt</strong><span>Hỗ trợ kiểm tra hàng lỗi</span></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="trust-item">
						<i class="fa fa-headphones"></i>
						<div><strong>Hỗ trợ 24/7</strong><span>Tư vấn kỹ thuật và báo giá miễn phí</span></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="trust-item">
						<i class="fa fa-money"></i>
						<div><strong>Giá cả hợp lý</strong><span>Chiết khấu tốt cho các cơ sở khám chữa bệnh</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="hero-banner">
		<div class="container">
			<div class="hero-banner__panel">
				<div class="hero-banner__content">
					<span class="hero-banner__eyebrow">Cửa hàng cung cấp thiết bị y tế và dụng cụ thể dục uy tín tại Cần Thơ</span>
					<h1>Thiết bị y tế chất lượng cao và đội ngũ tư vấn tận tâm !!!</h1>
					<p>Hơn 12 năm cung cấp thiết bị y tế phục vụ Bệnh viện, Phòng khám và Gia đình tại khu vực Đồng bằng sông Cửu Long. Hàng đảm bảo chất lượng và có bảo hành chính hảng.</p>
					<div class="hero-banner__tags">
						<span><i class="fa fa-hospital-o"></i>Bệnh viện và phòng khám</span>
						<span><i class="fa fa-heartbeat"></i>Cho thuê máy tại nhà</span>
						<span><i class="fa fa-wrench"></i>Bảo trình và sửa chữa</span>
					</div>
					<div class="hero-banner__actions">
						<a class="hero-banner__button hero-banner__button--light" href="{THEME_SITE_HREF}san-pham/"><i class="fa fa-th-large"></i> Xem sản phẩm</a>
						<a class="hero-banner__button hero-banner__button--light" href="tel:0937037770"> <i class="fa fa-phone"></i>  Gọi tư vấn ngay</a>
					</div>
				</div>
				<div class="hero-banner__stats">
					<div class="hero-stat-card">
						<i class="fa fa-cubes"></i>
						<strong>2,700+</strong>
						<span>San pham da dang</span>
					</div>
					<div class="hero-stat-card">
						<i class="fa fa-hospital-o"></i>
						<strong>500+</strong>
						<span>Cở sở khám chữa bệnh</span>
					</div>
					<div class="hero-stat-card">
						<i class="fa fa-clock-o"></i>
						<strong>12+</strong>
						<span>Năm kinh nghiệm</span>
					</div>
					<div class="hero-stat-card">
						<i class="fa fa-map-marker"></i>
						<strong>03</strong>
						<span>Chi nhánh Đồng bằng sông Cửu Long</span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="home-content">
		<div class="container">
			<div class="row home-layout-row">
				<aside class="col-xs-24 col-sm-8 col-md-6 col-lg-5">
					<div class="home-sidebar">
						<div class="sidebar-cat-shell">
							<div class="sidebar-cat-shell__head">
								<i class="fa fa-th-large"></i>
								<span>Danh mục sản phẩm</span>
							</div>
							[RIGHT_TOP]
						</div>
					</div>
				</aside>
				<div class="col-xs-24 col-sm-16 col-md-18 col-lg-19">
					<div class="page-shell page-shell--home-catalog">
						{MODULE_CONTENT}
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->
