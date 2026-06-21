<!-- BEGIN: submenu -->
<ul class="header__menu__dropdown">
	<!-- BEGIN: loop -->
    <li>
        <a href="{SUBMENU.link}" title="{SUBMENU.note}" {SUBMENU.target}>
            <i class="fa menu-item__icon-font" data-menu-link="{SUBMENU.link}" data-menu-title="{SUBMENU.title_trim}"></i>
            <span class="menu-item__label">{SUBMENU.title_trim}</span>
        </a>
        <!-- BEGIN: item -->
        {SUB}
        <!-- END: item -->
    </li>
    <!-- END: loop -->
</ul>
<!-- END: submenu -->


<!-- BEGIN: main -->
<nav id="menu-site-default" class="header__menu" aria-label="Điều hướng website">
    <ul>
		<li>
			<a title="{LANG.Home}" href="{THEME_SITE_HREF}"><i class="fa fa-home menu-item__icon-font"></i>{LANG.Home}</a>
		</li>
		<!-- BEGIN: top_menu -->
        <li{TOP_MENU.current}>
            <a href="{TOP_MENU.link}" title="{TOP_MENU.note}" {TOP_MENU.target}>
                <i class="fa menu-item__icon-font" data-menu-link="{TOP_MENU.link}" data-menu-title="{TOP_MENU.title}"></i>
                <span class="menu-item__label">{TOP_MENU.title}</span>
            </a>
            <!-- BEGIN: sub_normal -->
            {SUB}
            <!-- END: sub_normal -->
            <!-- BEGIN: sub_featured -->
            <div class="header__menu__mega-wrap">
                {SUB}
                <div class="header__menu__featuredbar">
                    <a href="{FEATURED_ALL_LINK}">Xem tất cả sản phẩm</a>
                </div>
            </div>
            <!-- END: sub_featured -->
		</li>
		<!-- END: top_menu -->
     </ul>
</nav>

<script type="text/javascript" data-show="after">
nv_DigitalClock('digclock');

// Auto-select appropriate icon based on menu link
$(document).ready(function(){
	// Map menu keywords to Font Awesome icons
	var categoryIconMap = {
		'dung-cu-the-duc': 'fa-heartbeat',
		'dụng cụ thể dục': 'fa-heartbeat',
		'dung cu the duc': 'fa-heartbeat',
		'thiet-bi-do': 'fa-tachometer',
		'thiết bị đo': 'fa-tachometer',
		'thiet bi do': 'fa-tachometer',
		'den-y-khoa': 'fa-lightbulb-o',
		'đèn y khoa': 'fa-lightbulb-o',
		'den y khoa': 'fa-lightbulb-o',
		'thiet-bi-ho-hap': 'fa-stethoscope',
		'thiết bị hô hấp': 'fa-stethoscope',
		'thiet bi ho hap': 'fa-stethoscope',
		'thiet-bi-tieu-hao': 'fa-medkit',
		'thiết bị tiêu hao': 'fa-medkit',
		'thiet bi tieu hao': 'fa-medkit',
		'dung-cu-phong-mo': 'fa-hospital-o',
		'dụng cụ phòng mổ': 'fa-hospital-o',
		'dung cu phong mo': 'fa-hospital-o',
		'noi-that-benh-vien': 'fa-wheelchair',
		'nội thất bệnh viện': 'fa-wheelchair',
		'noi that benh vien': 'fa-wheelchair',
		'chuan-doan-hinh-anh': 'fa-picture-o',
		'chan-doan-hinh-anh': 'fa-picture-o',
		'chuẩn đoán hình ảnh': 'fa-picture-o',
		'chẩn đoán hình ảnh': 'fa-picture-o',
		'chuan doan hinh anh': 'fa-picture-o',
		'chan doan hinh anh': 'fa-picture-o'
	};

	var iconMap = {
		'shops': 'fa-shopping-cart',
		'san-pham': 'fa-shopping-cart',
		'product': 'fa-shopping-cart',
		'khuyen-mai': 'fa-gift',
		'promotion': 'fa-gift',
		'discount': 'fa-gift',
		'dich-vu': 'fa-briefcase',
		'service': 'fa-briefcase',
		'tin': 'fa-newspaper-o',
		'news': 'fa-newspaper-o',
		'bai-viet': 'fa-file-text',
		'article': 'fa-file-text',
		'trang': 'fa-file',
		'page': 'fa-file',
		'lien-he': 'fa-phone',
		'contact': 'fa-phone',
		'about': 'fa-info-circle',
		'gioi-thieu': 'fa-info-circle'
	};

	function normalizeMenuText(text) {
		return (text || '')
			.toLowerCase()
			.replace(/[\u00e0\u00e1\u1ea1\u1ea3\u00e3\u00e2\u1ea7\u1ea5\u1ead\u1ea9\u1eab\u0103\u1eb1\u1eaf\u1eb7\u1eb3\u1eb5]/g, 'a')
			.replace(/[\u00e8\u00e9\u1eb9\u1ebb\u1ebd\u00ea\u1ec1\u1ebf\u1ec7\u1ec3\u1ec5]/g, 'e')
			.replace(/[\u00ec\u00ed\u1ecb\u1ec9\u0129]/g, 'i')
			.replace(/[\u00f2\u00f3\u1ecd\u1ecf\u00f5\u00f4\u1ed3\u1ed1\u1ed9\u1ed5\u1ed7\u01a1\u1edd\u1edb\u1ee3\u1edf\u1ee1]/g, 'o')
			.replace(/[\u00f9\u00fa\u1ee5\u1ee7\u0169\u01b0\u1eeb\u1ee9\u1ef1\u1eed\u1eef]/g, 'u')
			.replace(/[\u1ef3\u00fd\u1ef5\u1ef7\u1ef9]/g, 'y')
			.replace(/\u0111/g, 'd');
	}

	// Apply icons to menu items
	$('#menu-site-default .menu-item__icon-font[data-menu-link]').each(function(){
		var link = normalizeMenuText($(this).attr('data-menu-link'));
		var title = normalizeMenuText($(this).attr('data-menu-title'));
		var haystack = link + ' ' + title;
		var foundIcon = 'fa-folder'; // default icon
		
		for(var categoryKeyword in categoryIconMap) {
			if(haystack.indexOf(categoryKeyword) !== -1) {
				foundIcon = categoryIconMap[categoryKeyword];
				break;
			}
		}

		// Find matching icon from map
		if(foundIcon === 'fa-folder') {
			for(var keyword in iconMap) {
				if(link.indexOf(keyword) !== -1) {
					foundIcon = iconMap[keyword];
					break;
				}
			}
		}
		
		// Add Font Awesome icon class
		$(this).addClass(foundIcon);
	});

	// Mark home item active when the current page is the site root.
	(function() {
		var $menu = $('#menu-site-default');
		var $homeItem = $menu.find('> ul > li').first();
		var currentPath = window.location.pathname.replace(/\/+$/, '');
		var sitePath = $('<a>', { href: '{THEME_SITE_HREF}' })[0].pathname.replace(/\/+$/, '');
		var hasExplicitCurrent = $menu.find('> ul > li.current, > ul > li.active').length > 0;
		var isHomePath = currentPath === sitePath || currentPath === '' || /\/index\.php$/i.test(window.location.pathname);

		if (!hasExplicitCurrent && isHomePath) {
			$homeItem.addClass('current');
		}
	})();

	// Hover effects for menu titles
	$('#menu-site-default a').hover(function(){
		$(this).attr("rel", $(this).attr("title"));
        $(this).removeAttr("title");
	}, function(){
		$(this).attr("title", $(this).attr("rel"));
        $(this).removeAttr("rel");
	});

	var $window = $(window);

    function checkWidth() {
        var windowsize = $window.width();
        if (theme_responsive == '1' && windowsize <= 640) {
            $( "li.dropdown ul" ).removeClass( "dropdown-menu" );
            $( "li.dropdown ul" ).addClass( "dropdown-submenu" );
            $( "li.dropdown a" ).addClass( "dropdown-mobile" );
            $( "#menu-site-default ul li a.dropdown-toggle" ).addClass( "dropdown-mobile" );
            $( "li.dropdown ul li a" ).removeClass( "dropdown-mobile" );
        }
        else{
            $( "li.dropdown ul" ).addClass( "dropdown-menu" );
            $( "li.dropdown ul" ).removeClass( "dropdown-submenu" );
            $( "li.dropdown a" ).removeClass( "dropdown-mobile" );
            $( "li.dropdown ul li a" ).removeClass( "dropdown-mobile" );
            $( "#menu-site-default ul li a.dropdown-toggle" ).removeClass( "dropdown-mobile" );
            $('#menu-site-default .dropdown').hover(function(){
                $(this).addClass('open');
            }, function(){
                $(this).removeClass('open');
            });
        }
    }
    checkWidth();
    $(window).resize(checkWidth);
});
</script>
<!-- END: main -->
