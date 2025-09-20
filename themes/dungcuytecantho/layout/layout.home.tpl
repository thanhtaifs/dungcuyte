<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}
   
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
                </div>
                <div class="hero__item set-bg">
                    <img src="{NV_BASE_SITEURL}images/Banner.jpg" alt="thiết bị y tế huỳnh gia alpha"/>
                </div>
        	</div>
     </div>

{MODULE_CONTENT}
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->