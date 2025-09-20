<!-- BEGIN: main -->
<div id="category">
    <div class="page-header">
        <h1>{CAT_NAME} ({count} {LANG.title_products})</h1>
        <!-- BEGIN: viewdescriptionhtml -->
		<!-- BEGIN: image -->
		<div class="text-center">
			<img src="{IMAGE}" class="img-thumbnail" alt="{CAT_NAME}">
		</div>
		<!-- END: image -->
		<p>{DESCRIPTIONHTML}</p>
		<!-- END: viewdescriptionhtml -->
    </div>
    <div class="list-product">
        <!-- BEGIN: displays -->
        <div class="form-group form-inline pull-right">
            <label class="control-label">{LANG.displays_product}</label>
            <select name="sort" id="sort" class="form-control input-sm" onchange="nv_chang_price();">
                <!-- BEGIN: sorts -->
                    <option value="{key}" {se}> {value}</option>
                <!-- END: sorts -->
            </select>
            <label class="control-label">{LANG.title_viewnum}</label>
            <select name="viewtype" id="viewtype" class="form-control input-sm" onchange="nv_chang_viewtype();">
                <!-- BEGIN: viewtype -->
                    <option value="{VIEWTYPE.key}" {VIEWTYPE.selected}> {VIEWTYPE.value}</option>
                <!-- END: viewtype -->
            </select>
        </div>
        <div class="clear">&nbsp;</div>
        <!-- END: displays -->
        <div class="row">    
    	<!-- BEGIN: grid_rows -->
    	     <div class="col-12 col-sm-6 col-md-3">
    	         <div class="product-card">
                      <div class="product-badges">
                      </div>
                      <div class="product-image">
                          <div class="image_center">
                                <a href="{link_pro}" title="{title_pro}"  data-content='{intro}' data-rel="tooltip" >
                                <img src="{img_pro}" alt="{TITLE}" class="img-fluid" loading="lazy"/>
                                </a>
                                 <div class="product-overlay">
                                    <div class="quick-actions">
                                    </div>
                                </div>
                          </div>
                    </div>
                     <div class="product-info">
                               <h3 class="product-title">
                                    <a href="{link_pro}" title="{title_pro0}">{title_pro0}</a>
                                </h3>
                    </div>
                         <div class="product-price">
                             <p class="current-price"> {PRICE.sale_format}</p>
                          </div>
                  </div>
        </div>
    	<!-- END: grid_rows -->
    	</div>
        	<div class="clearfix">
        	</div>
        	<div aria-label="Page navigation" class="d-flex justify-content-center my-4">
        	    {pages}
        	</div>
    
    </div>
</div>

<!-- BEGIN: modal_loaded -->
<div class="modal fade" id="idmodals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{LANG.add_product}</h4>
			</div>
			<div class="modal-body">
				<em class="fa fa-spinner fa-spin">&nbsp;</em>
			</div>
		</div>
	</div>
</div>
<!-- END: modal_loaded -->

<div class="msgshow" id="msgshow">
</div>
<!-- BEGIN: tooltip_js -->
<script type="text/javascript">
	$(document).ready(function() {$("[data-rel='tooltip']").tooltip({
		placement: "bottom",
		html: true,
		title: function(){return '<p class="text-justify">' + $(this).data('content') + '</p><div class="clearfix"></div>';}
	});});
</script>
<!-- END: tooltip_js -->
<!-- END: main -->