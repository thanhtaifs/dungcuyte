<!-- BEGIN: main -->
<div class="home-products">
    <!-- BEGIN: displays -->
    <div class="form-group form-inline pull-right home-products-sort">
        <label class="control-label">{LANG.displays_product}</label>
        <select name="sort" id="sort" class="form-control input-sm" onchange="nv_chang_price();">
            <!-- BEGIN: sorts -->
            <option value="{key}" {se}> {value}</option>
            <!-- END: sorts -->
        </select>
    </div>
    <div class="clearfix">&nbsp;</div>
    <!-- END: displays -->

    <div class="row home-product-row">
        <!-- BEGIN: items -->
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
            <div class="product-card">
                <div class="product-badges">
                    <!-- BEGIN: new -->
                    <span class="badge badge-new">New</span>
                    <!-- END: new -->
                    <!-- BEGIN: featured_badge -->
                    <span class="badge badge-new">Hot</span>
                    <!-- END: featured_badge -->
                </div>
                <div class="product-image">
                    <a href="{LINK}" title="{TITLE}" data-content='{hometext}' data-rel="tooltip">
                        <img src="{IMG_SRC}" alt="{TITLE}" class="img-fluid" width="500" height="500" loading="lazy" decoding="async" />
                    </a>
                </div>
                <div class="product-body product-body--home">
                    <div class="product-cat">{CATEGORY_NAME}</div>
                    <h3 class="product-title">
                        <a href="{LINK}" title="{TITLE}">{TITLE0}</a>
                    </h3>

                    <!-- BEGIN: product_code -->
                    <p class="label label-default" style="display:none">{PRODUCT_CODE}</p>
                    <!-- END: product_code -->

                    <!-- BEGIN: adminlink -->
                    <p style="display:none">{ADMINLINK}</p>
                    <!-- END: adminlink -->

                    <!-- BEGIN: price -->
                    <div class="product-price">
                        <!-- BEGIN: discounts -->
                        <p class="current-price">{PRICE.sale_format} {PRICE.unit}</p>
                        <p class="old-price discounts_money">{PRICE.price_format} {PRICE.unit}</p>
                        <!-- END: discounts -->
                        <!-- BEGIN: no_discounts -->
                        <p class="current-price">{PRICE.price_format} {PRICE.unit}</p>
                        <!-- END: no_discounts -->
                    </div>
                    <!-- END: price -->

                    <!-- BEGIN: contact -->
                    <div class="product-price product-price--contact">
                        <p class="current-price">Liên hệ</p>
                    </div>
                    <!-- END: contact -->

                    <button class="btn-add-to-cart{BUTTON_CLASS}" onclick="{BUTTON_ACTION}" data-id="{ID}">
                        <i class="fa {BUTTON_ICON}"></i>
                        {BUTTON_TEXT}
                    </button>
                </div>
            </div>
        </div>
        <!-- END: items -->
    </div>

    <!-- BEGIN: pages -->
    <div aria-label="Page navigation" class="d-flex justify-content-center my-4 home-products-pagination">
        {generate_page}
    </div>
    <!-- END: pages -->
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

<div class="msgshow" id="msgshow">&nbsp;</div>
<!-- BEGIN: tooltip_js -->
<script type="text/javascript">
    $(document).ready(function() {
        $("[data-rel='tooltip']").tooltip({
            placement: "bottom",
            html: true,
            title: function(){return '<p class="text-justify">' + $(this).data('content') + '</p><div class="clearfix"></div>';}
        });
    });
</script>
<!-- END: tooltip_js -->
<!-- END: main -->
