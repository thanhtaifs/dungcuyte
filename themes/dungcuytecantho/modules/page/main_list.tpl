<!-- BEGIN: main -->
<div class="page">
    <div class="panel panel-default">
        <div class="panel-body">
             <div class="row mb-4 align-items-center">
            	<!-- BEGIN: loop -->
		        <!-- BEGIN: image -->
		        <div class="col-12 col-md-3 col-sm-4">
		           <div class="service-image">
		               <a href="{DATA.link}" title="{DATA.title}">
		                   <img src="{DATA.image}" alt="{DATA.imagealt}" />
		                </a>
		           </div>
		        </div>
		        <!-- END: image -->
		        <div class="col-12 col-md-9 col-sm-8">
		            <div class="service-text">
		                <h3>
		                <a href="{DATA.link}" title="{DATA.title}">{DATA.title} </a>
    		            </h3>
    		    	    <p>{DATA.description}</p>
		            </div>
		        </div>
            	<!-- END: loop -->
	        </div>
		</div>
	</div>
	<div aria-label="Page navigation" class="d-flex justify-content-center my-4">
     {GENERATE_PAGE}
    </div>
</div>
<!-- END: main -->