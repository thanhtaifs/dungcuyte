	<!-- BEGIN: lt_ie7 -->
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<!-- END: lt_ie7 -->
	<noscript>
		<div class="alert alert-danger">{LANG.nojs}</div>
	</noscript>
       <!-- Humberger Begin -->
       <div class="humberger__menu__overlay"></div>
       <div class="humberger__menu__wrapper">
            [MOBILE_MENU]        
        <div class="humberger__menu__contact">
            <ul>
                <li><a href="mailto:huynhgiact65@gmail.com">
                        <i class="fa fa-envelope"> huynhgiact65@gmail.com</i>
                    </a></li>
                <li>
                        <a href="tel:0937037770">
                            <i class="fa fa-phone" aria-hidden="true"> 0937.037.770 </i>
                        </a>
                </li>
                <li>
                        <a href="tel:0907694868">
                            <i class="fa fa-phone" aria-hidden="true"> 0907.694.868 </i>
                        </a>
                </li>
                <li>
                        <a href="tel:0906377086">
                            <i class="fa fa-phone" aria-hidden="true"> 0906.377.086 </i>
                        </a>
                </li>
            </ul>
        </div>
    </div>       
       <!-- Humberger End -->
       <header class="header">
           <div class="header__top">
               <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-md-10">
                            <div class="header__top__left">
                                <ul>
                                    <li>
                                        <a href="mailto:huynhgiact65@gmail.com">
                                             <i class="fa fa-envelope"> huynhgiact65@gmail.com</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tel:0937037770">
                                            <i class="fa fa-phone" aria-hidden="true"> 0937.037.770 </i>
                                        </a>
                                    </li>
                                      <li>
                                        <a href="tel:0907694868">
                                            <i class="fa fa-phone" aria-hidden="true"> 0907.694.868 </i>
                                        </a>
                                    </li>
                                      <li>
                                        <a href="tel:0906377086">
                                            <i class="fa fa-phone" aria-hidden="true"> 0906.377.086 </i>
                                        </a>
                                    </li>
                              
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="header__top__right">
                                
                            </div>
                        </div>
                    </div>
               </div>
           </div>
           <div class="header__top_menu">
               <div class="container">
                   <div class="row">
                       [MENU_SITE]
                    </div>
                   </div>
                   <div class="humberger__open">
                        <i class="fa fa-bars"></i>
                    </div>
           </div>
           </div>
       </header>
	<div class="container">
        <div class="row pt-1">
            <div class="col-lg-12 p-1">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{NV_BASE_SITEURL}index.php" method="get" onsubmit="return {THEME_SEARCH_SUBMIT_ONCLICK}">
                            <input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" />
        					<input type="hidden" name="{NV_NAME_VARIABLE}" value="seek" />
                            <div class="hero__search__categories">
                                <i class="fa fa-search" style="margin-right: 10px;"></i> Tất cả 
                            </div>
                            <input type="text" name="q" id="topmenu_search_query" maxlength="{THEME_SEARCH_QUERY_MAX_LENGTH}" placeholder="{LANG.search}...">
                            <div class="search__button">
                                <button type="submit" id="topmenu_search_submit">Tìm kiếm</button>
                            </div>                            
                        </form>
                    </div> 
                     <div class="cart_postion">
                    <!-- CART INTEGRATION START -->
                                    <div class="position-relative d-inline-block">
                                        <button class="cart-icon-btn" id="cartToggle">
                                            <i class="fa fa-shopping-cart"></i>
                                                Giỏ hàng
                                            <span class="cart-badge" id="cartBadge">0</span>
                                        </button>  
                                        <div id="cartContentWrapper">                                     
                                             <!-- Cart Dropdown -->
                                            <div class="cart-dropdown" id="cartDropdown">
                                                <div class="cart-dropdown-header">
                                                    <i class="fa fa-shopping-cart mr-2"></i>
                                                    Giỏ hàng của bạn
                                                </div>                                            
                                                <div class="cart-content" id="cartContent">
                                                    <div class="empty-cart">
                                                        <i class="fas fa-shopping-bag"></i>
                                                        <p class="mb-0">Giỏ hàng trống</p>
                                                        <small>Thêm sản phẩm để bắt đầu mua sắm!</small>
                                                    </div>
                                                </div>                                            
                                                <div class="cart-footer" id="cartFooter" style="display: none;">
                                                    <div class="cart-total">
                                                        <span>Tổng cộng:</span>
                                                        <span class="total-price" id="totalPrice">0đ</span>
                                                    </div>
                                                    <button class="checkout-btn">
                                                        <i class="fas fa-credit-card mr-2"></i>
                                                        Thanh toán ngay
                                                    </button>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>         
                                <!-- CART INTEGRATION END -->
                </div>
                                     
                </div>               
            </div>
        </div>
		[THEME_ERROR_INFO]
