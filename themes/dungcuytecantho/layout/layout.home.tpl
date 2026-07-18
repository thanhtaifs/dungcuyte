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
					<h1>Dụng cụ y tế Cần Thơ – Thiết bị y Khoa chính hãng | Huỳnh Gia Alpha</h1>
					<p>Công ty TNHH Huỳnh Gia Alpha chuyên bán sỉ & lẻ:</p>
					<div class="hero-banner__tags">
						<a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=vat-tu-y-te" aria-label="Thiết bị và vật tư y tế" title="Thiết bị và vật tư y tế"><i class="fa fa-medkit" aria-hidden="true"></i>Thiết bị & vật tư y tế</a>
						<a href="{NV_BASE_SITEURL}index.php?language=vi&nv=dich-vu&op=Cho-thue-may-tao-oxy" aria-label="Cho thuê máy tạo oxy" title="Cho thuê máy tạo oxy"><i class="fa fa-heartbeat" aria-hidden="true"></i>Cho thuê máy tạo oxy</a>
						<a href="{NV_BASE_SITEURL}index.php?language=vi&nv=dich-vu&op=Chuyen-sua-chua-dung-cu-phau-thuat" aria-label="Sửa dụng cụ phẫu thuật" title="Sửa dụng cụ phẫu thuật"><i class="fa fa-scissors" aria-hidden="true"></i>Sửa dụng cụ phẫu thuật</a>
						<a href="{NV_BASE_SITEURL}index.php?language=vi&nv=dich-vu&op=bao-tri-thiet-bi-y-te" aria-label="Sửa thiết bị y tế" title="Sửa thiết bị y tế"><i class="fa fa-wrench" aria-hidden="true"></i>Sửa thiết bị y tế</a>
						<a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=Dung-cu-the-duc" aria-label="Thiết bị thể thao trường học" title="Thiết bị thể thao trường học"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Thiết bị thể thao trường học</a>
						<a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=Dung-cu-the-duc" aria-label="Thiết bị thể dục" title="Thiết bị thể dục"><i class="fa fa-futbol-o" aria-hidden="true"></i>Thiết bị thể dục</a>
					</div>
					<div class="hero-banner__actions">
						<a class="hero-banner__button hero-banner__button--light" href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=san-pham-moi"><i class="fa fa-th-large"></i> Xem sản phẩm</a>
						<a class="hero-banner__button hero-banner__button--light" href="tel:0907694868"> <i class="fa fa-phone"></i>  Gọi tư vấn ngay</a>
					</div>
				</div>
				<div class="hero-banner__stats">
					<div class="hero-stat-card">
						<i class="fa fa-cubes"></i>
						<strong>2,700+</strong>
						<span>Sản phẩm đa dạng</span>
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
							<h2 class="sr-only">Danh mục sản phẩm</h2>
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
	<section class="why-choose-us" aria-labelledby="why-choose-us-title">
		<div class="container">
			<div class="why-choose-us__inner">
				<div class="why-choose-us__intro">
					<span class="why-choose-us__eyebrow">Cam kết dịch vụ</span>
					<h2 id="why-choose-us-title">Tại sao chọn Huỳnh Gia Alpha?</h2>
					<p>Chúng tôi đồng hành cùng bệnh viện, phòng khám và gia đình tại Cần Thơ với thiết bị y tế chính hãng, tư vấn rõ ràng và hỗ trợ sau bán hàng nhanh chóng.</p>
				</div>
				<ul class="why-choose-us__list">
					<li>
						<i class="fa fa-clock-o"></i>
						<strong>Hơn 12 năm kinh nghiệm</strong>
						<span>Tư vấn đúng nhu cầu cho cơ sở y tế và người dùng tại nhà.</span>
					</li>
					<li>
						<i class="fa fa-cubes"></i>
						<strong>2,700+ sản phẩm chính hãng</strong>
						<span>Đa dạng thiết bị y tế, dụng cụ phục hồi và chăm sóc sức khỏe.</span>
					</li>
					<li>
						<i class="fa fa-hospital-o"></i>
						<strong>500+ cơ sở khám chữa bệnh tin tưởng</strong>
						<span>Phục vụ phòng khám, bệnh viện, nhà thuốc và đơn vị chăm sóc sức khỏe.</span>
					</li>
					<li>
						<i class="fa fa-headphones"></i>
						<strong>Bảo hành chính hãng & hỗ trợ 24/7</strong>
						<span>Hỗ trợ báo giá, hướng dẫn sử dụng, bảo trì và sửa chữa khi cần.</span>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- [TESTIMONIALS SECTION ADDED BELOW WHY-CHOOSE-US] -->
        <section class="testimonials" aria-labelledby="testimonials-title">
            <div class="container">
                <div class="testimonials__head">
                    <span class="testimonials__eyebrow">Đánh giá từ khách hàng</span>
                    <h2 id="testimonials-title">Khách hàng nói gì về Huỳnh Gia Alpha?</h2>
                </div>
                <div class="row">
                    <div class="col-xs-24 col-sm-8 col-md-8">
                        <div class="testimonial-card">
                            <div class="testimonial-card__quote"><i class="fa fa-quote-left"></i></div>
                            <div class="testimonial-card__stars">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p class="testimonial-card__text">"Chúng tôi đã hợp tác với Huỳnh Gia Alpha trong suốt 5 năm qua để trang bị thiết bị cho khoa Nội. Máy đo huyết áp và máy siêu âm chất lượng rất tốt, độ chính xác cao. Đặc biệt là dịch vụ bảo hành và bảo trì định kỳ rất chuyên nghiệp."</p>
                            <div class="testimonial-card__author">
                                <div class="testimonial-card__avatar"><i class="fa fa-user-md"></i></div>
                                <div>
                                    <p class="testimonial-card__name">BS. Nguyễn Minh Tuấn</p>
                                    <p class="testimonial-card__role">Trưởng khoa Nội, BVĐK TP. Cần Thơ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-24 col-sm-8 col-md-8">
                        <div class="testimonial-card">
                            <div class="testimonial-card__quote"><i class="fa fa-quote-left"></i></div>
                            <div class="testimonial-card__stars">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p class="testimonial-card__text">"Khi mở phòng khám, tôi được đội ngũ Huỳnh Gia tư vấn tận tình từ A-Z về thiết bị cần thiết. Họ không chỉ bán hàng mà còn hỗ trợ setup, hướng dẫn sử dụng chi tiết. Giá cả hợp lý, chiết khấu tốt cho phòng khám mới."</p>
                            <div class="testimonial-card__author">
                                <div class="testimonial-card__avatar"><i class="fa fa-hospital-o"></i></div>
                                <div>
                                    <p class="testimonial-card__name">Chị Trần Thị Hồng</p>
                                    <p class="testimonial-card__role">Chủ PK Chuyên khoa Nhi - Cần Thơ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-24 col-sm-8 col-md-8">
                        <div class="testimonial-card">
                            <div class="testimonial-card__quote"><i class="fa fa-quote-left"></i></div>
                            <div class="testimonial-card__stars">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                            </div>
                            <p class="testimonial-card__text">"Mua xe lăn và giường bệnh cho ba tôi, nhân viên giao hàng tận nhà và lắp đặt tận tình. Sản phẩm chính hãng, bảo hành đầy đủ. Khi cần thuê máy tạo oxy, cũng được hỗ trợ nhanh chóng 24/7. Rất tin tưởng!"</p>
                            <div class="testimonial-card__author">
                                <div class="testimonial-card__avatar"><i class="fa fa-user"></i></div>
                                <div>
                                    <p class="testimonial-card__name">Anh Lê Hoàng Nam</p>
                                    <p class="testimonial-card__role">Khách hàng cá nhân - Q. Ninh Kiều</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- [/TESTIMONIALS SECTION] -->
	<!-- [footer SECTION] -->
	<footer class="footer__top">
	<div class="container">
		<div class="footer-grid">
			<section class="footer-card footer-card--company" aria-label="Thông tin công ty">
				<h3 class="footer-card__title"><i class="fa fa-heart-o"></i> Huỳnh Gia Alpha</h3>
				<p class="footer-card__subtitle">Công ty TNHH Huỳnh Gia Alpha</p>
				<p class="footer-card__text">Chuyên cung cấp thiết bị y tế và dụng cụ thể dục chính hãng cho bệnh viện, phòng khám và gia đình tại khu vực Đồng bằng sông Cửu Long từ năm 2013.</p>
				<p class="footer-card__text">Cung cấp các loại thiết bị y tế phổ biến nhất hiện nay như máy đo huyết áp, máy siêu âm, vật tư y tế và các giải pháp chăm sóc sức khỏe.</p>
				<div class="footer-company-meta">
					<p><i class="fa fa-map-marker" aria-hidden="true"></i> 4AB1 Xuân Thủy, phường An Bình, thành phố Cần Thơ</p>
				</div>					
			</section>

			<section class="footer-card footer-card--catalog">
				<h3 class="footer-card__title"><i class="fa fa-th-large"></i> Danh mục sản phẩm</h3>
				<div class="footer-link-columns">
					<ul class="footer-links">
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=may-sieu-am" aria-label="Máy siêu âm" title="Máy siêu âm"><i class="fa fa-picture-o" aria-hidden="true" data-menu-link="/shops/may-sieu-am" data-menu-title="Máy siêu âm"></i>Máy siêu âm</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=monitor-theo-doi" aria-label="Monitor theo dõi" title="Monitor theo dõi"><i class="fa fa-desktop" aria-hidden="true" data-menu-link="/shops/monitor-theo-doi" data-menu-title="Monitor theo dõi"></i>Monitor theo dõi</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=xe-lan" aria-label="Xe lăn các loại" title="Xe lăn các loại"><i class="fa fa-wheelchair" aria-hidden="true" data-menu-link="/shops/xe-lan-cac-loai" data-menu-title="Xe lăn các loại"></i>Xe lăn các loại</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=giuong-y-te" aria-label="Giường y tế" title="Giường y tế"><i class="fa fa-bed" aria-hidden="true" data-menu-link="/shops/giuong-y-te" data-menu-title="Giường y tế"></i>Giường y tế</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=may-tao-oxy" aria-label="Máy tạo oxy" title="Máy tạo oxy"><i class="fa fa-tint" aria-hidden="true" data-menu-link="/shops/may-tao-oxy" data-menu-title="Máy tạo oxy"></i>Máy tạo oxy</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=may-do-spo2" aria-label="Máy đo SpO2" title="Máy đo SpO2"><i class="fa fa-heartbeat" aria-hidden="true" data-menu-link="/shops/may-do-spo2" data-menu-title="Máy đo SpO2"></i>Máy đo SpO2</a></li>
					</ul>
					<ul class="footer-links">
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=chi-phau-thuat" aria-label="Chỉ phẫu thuật" title="Chỉ phẫu thuật"><i class="fa fa-scissors" aria-hidden="true" data-menu-link="/shops/chi-phau-thuat" data-menu-title="Chỉ phẫu thuật"></i>Chỉ phẫu thuật</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=Nem-chong-loet" aria-label="Nệm chống loét" title="Nệm chống loét"><i class="fa fa-bed" aria-hidden="true" data-menu-link="/shops/nem-chong-loet" data-menu-title="Nệm chống loét"></i>Nệm chống loét</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=khung-tap-di" aria-label="Khung tập đi" title="Khung tập đi"><i class="fa fa-male" aria-hidden="true" data-menu-link="/shops/khung-tap-di" data-menu-title="Khung tập đi"></i>Khung tập đi</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=que-test-nhanh" aria-label="Que Test nhanh" title="Que Test nhanh"><i class="fa fa-flask" aria-hidden="true" data-menu-link="/shops/que-test-nhanh" data-menu-title="Que Test nhanh"></i>Que Test nhanh</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=Noi-hap-tiet-trung" aria-label="Nồi hấp tiệt trùng" title="Nồi hấp tiệt trùng"><i class="fa fa-fire" aria-hidden="true" data-menu-link="/shops/noi-hap-tiet-trung" data-menu-title="Nồi hấp tiệt trùng"></i>Nồi hấp tiệt trùng</a></li>
						<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=vat-ly-tri-lieu" aria-label="Vật lý trị liệu" title="Vật lý trị liệu"><i class="fa fa-medkit" aria-hidden="true" data-menu-link="/shops/vat-ly-tri-lieu" data-menu-title="Vật lý trị liệu"></i>Vật lý trị liệu</a></li>
					</ul>
				</div>				
			</section>
			 <section class="footer-card footer-card--branches">
				<h3 class="footer-card__title"><i class="fa fa-map-marker"></i> Hệ thống chi nhánh</h3>
				<div class="footer-branch-list">
					<div class="footer-branch-item">
						<strong>Huỳnh Gia 1 - Cần Thơ</strong>
						<p><i class="fa fa-map-marker" aria-hidden="true"></i> 04-06 Xuân Thủy, KDC Hồng Phát, P. An Bình - <a href="https://maps.app.goo.gl/uDUfXCfNCLhtHfzd8" target="_blank" rel="noopener noreferrer" style="color: var(--brand-green-strong) !important;">Xem bản đồ <i class="fa fa-external-link" aria-hidden="true" style="color: var(--brand-green-strong) !important;"></i></a></p>
						<p><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:0907694868"> 0907 694 868</a> - <a href="tel:0899060456">0899 060 456</a></p>
					</div>
					<div class="footer-branch-item">
						<strong>Huỳnh Gia 2 - Cần Thơ</strong>
						<p><i class="fa fa-map-marker" aria-hidden="true"></i> 369B Nguyễn Văn Cừ nối dài, P. Tân An - <a href="https://maps.app.goo.gl/u7kfQd8XQ6CZnLBr9" target="_blank" rel="noopener noreferrer" style="color: var(--brand-green-strong) !important;">Xem bản đồ <i class="fa fa-external-link" aria-hidden="true" style="color: var(--brand-green-strong) !important;"></i></a></p>
						<p><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:0907694868"> 0907 694 868</a> - <a href="tel:0899070456">0899 070 456</a></p>
					</div>
					<div class="footer-branch-item">
						<strong>Huỳnh Gia 3 - Vĩnh Long</strong>
						<p><i class="fa fa-map-marker" aria-hidden="true"></i> 37A Phạm Hùng, Khóm 2, P. Long Châu - <a href="https://maps.app.goo.gl/9vQHNgan1NUNShSMA" target="_blank" rel="noopener noreferrer" style="color: var(--brand-green-strong) !important;">Xem bản đồ <i class="fa fa-external-link" aria-hidden="true" style="color: var(--brand-green-strong) !important;"></i></a></p>
						<p><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:0907694868"> 0907 694 868</a> - <a href="tel:0939310467">0939 310 467</a></p>
					</div>
				</div>
			</section>

			<section class="footer-card footer-card--about">
				<h3 class="footer-card__title"><i class="fa fa-info-circle"></i> Về chúng tôi</h3>
				<ul class="footer-links footer-links--single">
					<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=gioi-thieu" aria-label="Giới thiệu công ty" title="Giới thiệu công ty"><i class="fa fa-info-circle" aria-hidden="true"></i>Giới thiệu công ty</a></li>
					<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=gioi-thieu&op=Giay-phep-DKKD" aria-label="Giấy phép đăng ký kinh doanh" title="Giấy phép đăng ký kinh doanh"><i class="fa fa-certificate" aria-hidden="true"></i>Giấy phép đăng ký kinh doanh</a></li>
					<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=tuyen-dung" aria-label="Tuyển dụng" title="Tuyển dụng"><i class="fa fa-users" aria-hidden="true"></i>Tuyển dụng</a></li>
				</ul>
				<div class="footer-social-row social-icons">
					[SOCIAL_ICONS]
				</div>
				</br>
				<a class="footer-inline-cta" href="{NV_BASE_SITEURL}index.php?language=vi&nv=shops&op=san-pham-moi" aria-label="Xem tất cả sản phẩm" title="Xem tất cả sản phẩm">Xem tất cả sản phẩm</a>
			</section>

			<section class="footer-card footer-card--policies">
				<h3 class="footer-card__title"><i class="fa fa-shield"></i> Chính sách</h3>
				<ul class="footer-links footer-links--single">
					<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=chinh-sach&op=Chinh-sach-doi-tra" aria-label="Chính sách đổi trả" title="Chính sách đổi trả"><i class="fa fa-refresh" aria-hidden="true"></i>Chính sách đổi trả</a></li>
					<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=chinh-sach&op=Chinh-sach-bao-hanh" aria-label="Chính sách bảo hành" title="Chính sách bảo hành"><i class="fa fa-shield" aria-hidden="true"></i>Chính sách bảo hành</a></li>
					<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=chinh-sach&op=Phuong-thuc-thanh-toan" aria-label="Vận chuyển và giao nhận" title="Vận chuyển và giao nhận"><i class="fa fa-truck" aria-hidden="true"></i>Vận chuyển và giao nhận</a></li>
					<li><a href="{NV_BASE_SITEURL}index.php?language=vi&nv=chinh-sach&op=Phuong-thuc-thanh-toan" aria-label="Phương thức thanh toán" title="Phương thức thanh toán"><i class="fa fa-credit-card" aria-hidden="true"></i>Phương thức thanh toán</a></li>
				</ul>
				<div class="footer-verify">
					<a href="http://online.gov.vn/nen-tang/b5029ee0-9623-46f7-94c5-871262813190" target="_blank" rel="noopener noreferrer">
						<img src="/images/logobct.webp" alt="Thông báo từ Bộ Công Thương" width="160" height="70" loading="lazy" decoding="async" />
					</a>
				</div>
			</section> 
		</div>
		<div class="footer__copyright">
			<p><strong>Công ty TNHH Huỳnh Gia Alpha</strong> | 4AB1 Xuân Thủy, KDC Cái Sơn - Hàng Bàng, KV2, phường An Bình, thành phố Cần Thơ | GPKD: 1801763703 | Cấp ngày: 08/05/2024 </p>
			<p>Website: <a href="https://www.dungcuytecantho.com">dungcuytecantho.com</a> | Hotline: <a href="tel:0937037770">0937 037 770</a> | Email: <a href="mailto:huynhgiact65@gmail.com">huynhgiact65@gmail.com</a></p>
		</div> 
	</div>
	<!-- [End footer SECTION] -->
</footer>
</main>
{FILE "footer_only.tpl"}
<!-- END: main -->

