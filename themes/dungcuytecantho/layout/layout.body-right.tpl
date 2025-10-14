<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended.tpl"}        
    		<div class="row pt-3">
                <div class="col-lg-12 p-1">
                 <!-- BEGIN: breadcrumbs -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb-card">
                            <!-- BEGIN: loop -->
                            <li class="sub-breadcrumb">
                                <a href="{BREADCRUMBS.link}">{BREADCRUMBS.title}</a>
                            </li>
                            <!-- END: loop -->
                        </ol>
                    </nav>
                    <!-- END: breadcrumbs -->
        		 </div>
                 
                <div class="col-lg-12 p-2">
                    {MODULE_CONTENT}
                </div>
        	</div>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->