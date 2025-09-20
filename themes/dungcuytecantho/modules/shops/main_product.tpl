<!-- BEGIN: main -->
<div class="panel panel-default">
    <div class="panel-heading">
	</div>
	<div class="panel-body">
	   <div class="container">
	        <div id="products">
            <!-- BEGIN: displays -->
            <div class="form-group form-inline pull-right">
                <label class="control-label">{LANG.displays_product}</label>
                <select name="sort" id="sort" class="form-control input-sm" onchange="nv_chang_price();">
                    <!-- BEGIN: sorts -->
                        <option value="{key}" {se}> {value}</option>
                    <!-- END: sorts -->
                </select>
            </div>
            <div class="clearfix">&nbsp;</div>
            <!-- END: displays -->
                <div class="row">
                <!-- BEGIN: items -->
                <div class="col-12 col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <div class="image_center">
                                <a href="{LINK}" title="{TITLE}"><img src="{IMG_SRC}" alt="{TITLE}" data-content='{hometext}' data-rel="tooltip" class="img-thumbnail" style="max-height:160px;max-width:160px"></a>
                            </div>
                             <div class="caption text-center">
                                <h3>
                                    <a href="{LINK}" title="{TITLE}">{TITLE0}</a>
                                    
                                </h3>
                                <p class="price">
                                    <span class="money"> {PRICE.sale_format}  </span>
                                </p>
                            </div>
                        </div>
                </div>
                 <!-- END: items -->
            </div>
        </div>
	</div>
            <!-- BEGIN: modal_loaded -->
            <div class="modal fade" id="idmodals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none">
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

        <!-- BEGIN: pages -->
        <div aria-label="Page navigation" class="d-flex justify-content-center my-4">
             {generate_page}
        </div>
        <!-- END: pages -->
	</div>
</div>



<div class="msgshow" id="msgshow">&nbsp;</div>
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