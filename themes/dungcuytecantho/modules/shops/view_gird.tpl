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
    <!-- BEGIN: subcat_nav -->
    <div class="catalog-subcats">
        <!-- BEGIN: loop -->
        <a class="catalog-subcats__item" href="{SUBCAT.link}" title="{SUBCAT.title}">{SUBCAT.title}</a>
        <!-- END: loop -->
    </div>
    <!-- END: subcat_nav -->
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
                                <a href="{link_pro}" title="{title_pro}">
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
                     <div class="product-category-badge">
                        <a href="{CATEGORY_LINK}" title="Xem tất cả sản phẩm {CATEGORY_NAME}">
                            <i class="fa fa-tag"></i> {CATEGORY_NAME}
                        </a>
                    </div>
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
                        <p class="current-price">{LANG.price_contact}</p>
                    </div>
                    <!-- END: contact -->
                    <div class="product-info pt-0">
                        <!-- BEGIN: order -->
                        <button class="btn-add-to-cart" id="{ID}" title="{title_pro}" onclick="addToCart({ID})" data-id="{ID}" type="button">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="btn-add-to-cart__text">{LANG.add_product}</span>
                        </button>
                        <!-- END: order -->
                        <!-- BEGIN: contact_order -->
                        <button class="btn-add-to-cart btn-add-to-cart--quote" type="button" onclick="window.location.href='tel:0937037770'">
                            <i class="fa fa-phone"></i>
                            <span class="btn-add-to-cart__text">Liên hệ báo giá</span>
                        </button>
                        <!-- END: contact_order -->
                    </div>
                  </div>
        </div>
    	<!-- END: grid_rows -->
    	</div>
        	<div class="clearfix">
        	</div>
            <div class="home-products-pagination">
                <div class="home-products-pagination__inner" aria-label="Page navigation">
                    {pages}
                </div>
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
<!-- END: main -->
