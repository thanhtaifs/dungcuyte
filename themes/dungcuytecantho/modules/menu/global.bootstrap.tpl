<!-- BEGIN: submenu -->
<ul class="header__menu__dropdown">
	<!-- BEGIN: loop -->
    <li >
        <a href="{SUBMENU.link}" title="{SUBMENU.note}" {SUBMENU.target}>{SUBMENU.title_trim}</a>
        <!-- BEGIN: item -->
        {SUB}
        <!-- END: item -->
    </li>
    <!-- END: loop -->
</ul>
<!-- END: submenu -->


<!-- BEGIN: main -->
<div class="col-lg-12">
    <nav class="header__menu">
        <ul>
			<li>
				<a title="{LANG.Home}" href="{THEME_SITE_HREF}">Trang chủ</a>
			</li>
			<!-- BEGIN: top_menu -->
            <li>
                <a href="{TOP_MENU.link}" title="{TOP_MENU.note}" {TOP_MENU.target}>{TOP_MENU.title_trim}
                </a>
                <!-- BEGIN: sub -->
                {SUB}
                <!-- END: sub -->
			</li>
			<!-- END: top_menu -->
         </ul>
    </nav>
</div>
<div class="col-lg-2">
    <div class="header__logo">
        <a href ="{THEME_SITE_HREF}">
        <img src="/images/logo_3.png" alt="DỤNG CỤ Y TẾ CẦN THƠ">
         </a>
    </div>
</div>



<script type="text/javascript" data-show="after">
nv_DigitalClock('digclock');
$(document).ready(function(){
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
    // Execute on load
    checkWidth();
    // Bind event listener
    $(window).resize(checkWidth);
});
</script>
<!-- END: main -->
