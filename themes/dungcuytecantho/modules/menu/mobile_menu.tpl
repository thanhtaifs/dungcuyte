<!-- BEGIN: main -->
<div class="humberger__menu__logo">
    <img src="/images/logo_3.png" alt="DỤNG CỤ Y TẾ CẦN THƠ">
</div>

<nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li>
				    <a title="{LANG.Home}" href="{THEME_SITE_HREF}">Trang chủ</a>
			    </li>
			<!-- BEGIN: top_menu -->
            <li>
                <a href="{TOP_MENU.link}" title="{TOP_MENU.note}" {TOP_MENU.target}>{TOP_MENU.title_trim}
                </a>
                <!-- BEGIN: sub -->
                <ul class = "header__menu__dropdown">
                    {SUB}
                </ul>
                <!-- END: sub -->
			</li>
			<!-- END: top_menu -->
            </ul>
</nav>

 <div id="mobile-menu-wrap">
            <div class="slicknav_menu">
            <nav class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">
                 <ul>
                    <ul class="header__menu__dropdown slicknav_hidden" role="menu" aria-hidden="true" style="display: none;">
                    </ul>
                </ul>
           </nav>
            </div>
</div>

<!-- END: main -->