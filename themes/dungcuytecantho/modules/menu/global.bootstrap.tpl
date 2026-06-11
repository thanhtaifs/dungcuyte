<!-- BEGIN: submenu -->
<ul class="header__menu__dropdown">
	<!-- BEGIN: loop -->
    <li>
        <a href="{SUBMENU.link}" title="{SUBMENU.note}" {SUBMENU.target}>
            <i class="fa menu-item__icon-font" data-menu-link="{SUBMENU.link}"></i>
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
<nav id="menu-site-default" class="header__menu" aria-label="Dieu huong chinh">
    <ul>
		<li>
			<a title="{LANG.Home}" href="{THEME_SITE_HREF}"><i class="fa fa-home menu-item__icon-font"></i>{LANG.Home}</a>
		</li>
		<!-- BEGIN: top_menu -->
        <li{TOP_MENU.current}>
            <a href="{TOP_MENU.link}" title="{TOP_MENU.note}" {TOP_MENU.target}>
                <i class="fa menu-item__icon-font" data-menu-link="{TOP_MENU.link}"></i>
                <span class="menu-item__label">{TOP_MENU.title}</span>
            </a>
            <!-- BEGIN: sub_normal -->
            {SUB}
            <!-- END: sub_normal -->
            <!-- BEGIN: sub_featured -->
            <div class="header__menu__mega-wrap">
                {SUB}
                <div class="header__menu__featuredbar">
                    <a href="{TOP_MENU.link}">Xem tat ca danh muc</a>
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

	// Apply icons to menu items
	$('#menu-site-default .menu-item__icon-font[data-menu-link]').each(function(){
		var link = $(this).attr('data-menu-link').toLowerCase();
		var foundIcon = 'fa-folder'; // default icon
		
		// Find matching icon from map
		for(var keyword in iconMap) {
			if(link.indexOf(keyword) !== -1) {
				foundIcon = iconMap[keyword];
				break;
			}
		}
		
		// Add Font Awesome icon class
		$(this).addClass(foundIcon);
	});

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
