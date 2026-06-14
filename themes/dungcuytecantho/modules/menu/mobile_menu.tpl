<!-- BEGIN: submenu -->
<ul class="header__menu__dropdown">
    <!-- BEGIN: loop -->
    <li>
        <a href="{SUBMENU.link}" title="{SUBMENU.note}" {SUBMENU.target}>{SUBMENU.title_trim}</a>
        <!-- BEGIN: item -->
        {SUB}
        <!-- END: item -->
    </li>
    <!-- END: loop -->
</ul>
<!-- END: submenu -->

<!-- BEGIN: main -->
<nav class="humberger__menu__nav mobile-menu">
    <ul>
        <li>
		    <a title="{LANG.Home}" href="{THEME_SITE_HREF}">{LANG.Home}</a>
	    </li>
		<!-- BEGIN: top_menu -->
        <li>
            <a href="{TOP_MENU.link}" title="{TOP_MENU.note}" {TOP_MENU.target}>{TOP_MENU.title}</a>
            <!-- BEGIN: sub -->
            {SUB}
            <!-- END: sub -->
            <!-- BEGIN: sub_normal -->
            {SUB}
            <!-- END: sub_normal -->
            <!-- BEGIN: sub_featured -->
            {SUB}
            <!-- END: sub_featured -->
		</li>
		<!-- END: top_menu -->
    </ul>
</nav>

<div id="mobile-menu-wrap"></div>
<!-- END: main -->
