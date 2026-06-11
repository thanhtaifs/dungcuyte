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
						<div><strong>Hang chinh hang</strong><span>Co giay phep luu hanh</span></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="trust-item">
						<i class="fa fa-refresh"></i>
						<div><strong>Doi tra linh hoat</strong><span>Ho tro kiem tra hang loi</span></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="trust-item">
						<i class="fa fa-headphones"></i>
						<div><strong>Ho tro 24/7</strong><span>Tu van ky thuat va bao gia</span></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="trust-item">
						<i class="fa fa-money"></i>
						<div><strong>Gia hop ly</strong><span>Chiet khau tot cho phong kham</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="hero-banner">
		<div class="container">
			<div class="hero-banner__panel">
				<div class="hero-banner__content">
					<span class="hero-banner__eyebrow">Cua hang thiet bi y te uy tin tai Can Tho</span>
					<h1>Thiet Bi Y Te Chat Luong Cao Tu Van Tan Tinh Gia Tot Nhat</h1>
					<p>Hon 10 nam phuc vu benh vien, phong kham va gia dinh tai khu vuc DBSCL. Dam bao hang chinh hang co giay phep luu hanh.</p>
					<div class="hero-banner__tags">
						<span><i class="fa fa-hospital-o"></i>Benh vien va Phong kham</span>
						<span><i class="fa fa-heartbeat"></i>Cham soc tai nha</span>
						<span><i class="fa fa-wrench"></i>Bao tri va Sua chua</span>
					</div>
					<div class="hero-banner__actions">
						<a class="hero-banner__button hero-banner__button--light" href="{THEME_SITE_HREF}san-pham/">Xem san pham</a>
						<a class="hero-banner__button hero-banner__button--outline" href="tel:0937037770">Goi tu van ngay</a>
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
						<span>Benh vien tin dung</span>
					</div>
					<div class="hero-stat-card">
						<i class="fa fa-clock-o"></i>
						<strong>10+</strong>
						<span>Nam kinh nghiem</span>
					</div>
					<div class="hero-stat-card">
						<i class="fa fa-map-marker"></i>
						<strong>3</strong>
						<span>Chi nhanh DBSCL</span>
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
								<span>Danh muc san pham</span>
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
