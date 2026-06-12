	<!-- BEGIN: lt_ie7 -->
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<!-- END: lt_ie7 -->
	<noscript>
		<div class="alert alert-danger">{LANG.nojs}</div>
	</noscript>
	<div class="humberger__menu__overlay"></div>
	<div class="humberger__menu__wrapper" id="mobileMenuDrawer" aria-hidden="true">
		<div class="mobile-drawer__header">
			<a class="mobile-drawer__brand" href="{THEME_SITE_HREF}" aria-label="{SITE_NAME}">
				<img src="{LOGO_SRC}" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}" alt="{SITE_NAME}" />
			</a>
			<button class="mobile-drawer__close" type="button" aria-label="Dong menu">
				<i class="fa fa-times"></i>
			</button>
		</div>
		[MOBILE_MENU]
		<div class="mobile-drawer__quicklinks">
			<a href="{NV_BASE_SITEURL}index.php?nv=shops&op=cart"><i class="fa fa-shopping-bag"></i> Gio hang</a>
			<a href="{NV_BASE_SITEURL}index.php?nv=contact"><i class="fa fa-map-marker"></i> Lien he</a>
			<a href="tel:0937037770"><i class="fa fa-phone"></i> Hotline</a>
		</div>
		<div class="humberger__menu__contact">
			<ul>
				<li><a href="mailto:huynhgiact65@gmail.com"><i class="fa fa-envelope"></i> huynhgiact65@gmail.com</a></li>
				<li><a href="tel:0937037770"><i class="fa fa-phone"></i> 0937.037.770</a></li>
				<li><a href="tel:0907694868"><i class="fa fa-phone"></i> 0907.694.868</a></li>
				<li><a href="tel:0906377086"><i class="fa fa-phone"></i> 0906.377.086</a></li>
			</ul>
		</div>
	</div>
	<header class="header site-header">
		<div class="header__top">
			<div class="container">
				<div class="header-top-bar">
					<div class="header-top-bar__group">
						<a href="mailto:huynhgiact65@gmail.com"><i class="fa fa-envelope"></i> huynhgiact65@gmail.com</a>
						<span><i class="fa fa-clock-o"></i> Thu 2-CN: 07:00-20:00</span>
					</div>
					<div class="header-top-bar__group header-top-bar__group--right">
						<span><i class="fa fa-truck"></i> Giao hang toan quoc</span>
						<span><i class="fa fa-certificate"></i> Da duoc cap phep So KHDT TPCT</span>
					</div>
				</div>
			</div>
		</div>
		<div class="header__brand">
			<div class="container">
				<div class="site-brand site-brand--header">
					<div class="site-brand__identity-wrap">
						<a class="site-brand__identity" href="{THEME_SITE_HREF}" aria-label="{SITE_NAME}">
							<span class="site-brand__logo">
								<img src="{LOGO_SRC}" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}" alt="{SITE_NAME}" />
							</span>
							<span class="site-brand__copy">
								<span class="site-brand__eyebrow">Huỳnh Gia Alpha</span>
								<span class="site-brand__name">{SITE_NAME}</span>							
							</span>
						</a>
					</div>
					<div class="site-brand__search">
						<div class="hero__search__form">
							<form action="{NV_BASE_SITEURL}index.php" method="get" onsubmit="return {THEME_SEARCH_SUBMIT_ONCLICK}">
								<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" />
								<input type="hidden" name="{NV_NAME_VARIABLE}" value="seek" />
								<div class="hero__search__categories">
									<i class="fa fa-search"></i>
									<span>Tat ca san pham</span>
								</div>
								<input type="text" name="q" id="topmenu_search_query" maxlength="{THEME_SEARCH_QUERY_MAX_LENGTH}" placeholder="{LANG.search}..." />
								<div class="search__button">
									<button type="submit" id="topmenu_search_submit">Tim kiem</button>
								</div>
							</form>
						</div>
					</div>
					<div class="site-brand__aside">
						<div class="hotline-box">
							<div class="hotline-box__label"><i class="fa fa-phone-square"></i> Hotline tu van</div>
							<div class="hotline-box__phone">0937 037 770</div>
						</div>
						<div class="cart_postion">
							<div class="position-relative d-inline-block">
								<button class="cart-icon-btn" id="cartToggle">
									<i class="fa fa-shopping-cart"></i>
									<span class="cart-icon-btn__label">Gio hang</span>
									<span class="cart-badge" id="cartBadge">0</span>
								</button>
								<div id="cartContentWrapper">
									<div class="cart-dropdown" id="cartDropdown">
										<div class="cart-dropdown-header">
											<i class="fa fa-shopping-cart"></i>
											<span>Gio hang cua ban</span>
										</div>
										<div class="cart-content" id="cartContent">
											<div class="empty-cart">
												<i class="fa fa-shopping-bag"></i>
												<p class="mb-0">Gio hang trong</p>
												<small>Them san pham de bat dau mua sam.</small>
											</div>
										</div>
										<div class="cart-footer" id="cartFooter" style="display: none;">
											<div class="cart-total">
												<span>Tong cong:</span>
												<span class="total-price" id="totalPrice-popup">0 VND</span>
											</div>
											<button class="checkout-btn">
												<i class="fa fa-credit-card"></i>
												<span>Xem gio hang</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header__top_menu">
			<div class="container">
				<div class="site-nav-shell">
					<div class="site-nav-shell__cta">
						<button class="humberger__open" type="button" aria-label="Mo menu" aria-controls="mobileMenuDrawer" aria-expanded="false">
							<i class="fa fa-bars"></i>
						</button>
					</div>
					<a class="mobile-nav-brand" href="{THEME_SITE_HREF}" aria-label="{SITE_NAME}">
						<img src="{LOGO_SRC}" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}" alt="{SITE_NAME}" />
					</a>
					[MENU_SITE]
					<div class="mobile-nav-actions">
						<button class="mobile-search-toggle" type="button" aria-label="Tim kiem" aria-controls="mobileSearchPanel" aria-expanded="false">
							<i class="fa fa-search"></i>
						</button>
						<button class="mobile-cart-toggle" id="cart-mobile" type="button" aria-label="Gio hang">
							<i class="fa fa-shopping-cart"></i>
							<span class="cart-badge" id="cartBadgeMobile">0</span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="mobile-search-panel" id="mobileSearchPanel" aria-hidden="true">
			<div class="mobile-search-panel__head">
				<strong>Tim kiem</strong>
				<button class="mobile-search-close" type="button" aria-label="Dong tim kiem">
					<i class="fa fa-times"></i>
				</button>
			</div>
			<div class="mobile-search-panel__body"></div>
		</div>
	</header>
	[THEME_ERROR_INFO]
