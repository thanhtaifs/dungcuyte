<!-- BEGIN: main -->
<div class="panel panel-default">
    <div class="panel-heading">
    </div>
    <div class="panel-body">
       <div class="container">
            <div id="products">
          <!-- BEGIN: featured_section -->
            <div class="section-header">
                <div class="section-title-wrapper">
                    <h2 class="section-title">{SECTION_TITLE}</h2>
                </div>
                <div class="section-divider">
                    <span class="divider-icon"> <i class="fa fa-fire"></i></span>
                </div>
            </div>
            <div class="row">
                    <div class="categories__slider owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                            <!-- BEGIN: items -->
                             <div class="owl-item"> 
                                <div class="col-lg-3">
                                    <div class="product-card">
                                        <div class="product-hot">
                                            <span class="hot-item badge-new">
                                                    Hot
                                            </span>
                                        </div>
                                        <div class="product-image">
                                            <a href="{LINK}" title="{TITLE}">
                                                <img src="{SRC_PRO_LAGE}" alt="{TITLE}" class="img-fluid" loading="lazy"/>
                                            </a>
                                             <div class="product-overlay">
                                                <div class="quick-actions">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                             <h3 class="product-title">
                                                <a href="{LINK}" title="{TITLE}">{TITLE0}</a>
                                              </h3>
                                        </div>
                                        <div class="product-price">
                                            <p class="current-price"> {PRICE.sale_format}</p>
                                       </div> 
                                       <div class="product-action">
                                            <button class="btn-add-to-cart" onclick="addToCart({ID})" data-id="{ID}">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 13C5.5 13.8284 4.82843 14.5 4 14.5C3.17157 14.5 2.5 13.8284 2.5 13C2.5 12.1716 3.17157 11.5 4 11.5C4.82843 11.5 5.5 12.1716 5.5 13Z" fill="currentColor"/>
                                                    <path d="M13.5 13C13.5 13.8284 12.8284 14.5 12 14.5C11.1716 14.5 10.5 13.8284 10.5 13C10.5 12.1716 11.1716 11.5 12 11.5C12.8284 11.5 13.5 12.1716 13.5 13Z" fill="currentColor"/>
                                                    <path d="M0.5 1.5H2.5L4.5 9.5H13.5L15.5 3.5H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Thêm vào giỏ hàng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <!-- END: items -->
                        </div>
                        </div>
                        
                             
                    </div>
                </div>
        <!-- END: featured_section -->


        <div class="medical-section-separator">
            <div class="medical-cross-divider">
                <div class="cross-line"></div>
                <div class="medical-cross">
                    <i class="fa fa-plus"></i>
                </div>
            </div>
        </div>

        <!-- BEGIN: new_section  -->
        <div class="section-header">
                <div class="section-title-wrapper">
                    <h2 class="section-title">{SECTION_TITLE}</h2>
                </div>
                <div class="section-divider">
                    <span class="divider-icon"> <i class="fa fa-star"></i></span>
                </div>
        </div>
        <div class="row">
          <!-- BEGIN: items -->
          <div class="col-12 col-sm-6 col-md-3">
              <div class="product-card">
                  <div class="product-badges">
                       <span class="badge badge-new">
                            New
                        </span>
                  </div>
                  <div class="product-image">
                    <a href="{LINK}" title="{TITLE}">
                        <img src="{SRC_PRO_LAGE}" alt="{TITLE}" class="img-fluid" loading="lazy"/>
                    </a>
                    <div class="product-overlay">
                        <div class="quick-actions">
                        </div>
                    </div>
                  </div>
                  <div class="product-info">
                      <h3 class="product-title">
                        <a href="{LINK}" title="{TITLE}">{TITLE0}</a>
                      </h3>
                  </div>
                   <div class="product-price">
                        <p class="current-price"> {PRICE.sale_format}</p>
                  </div> 
                  <div class="product-action">
                                            <button class="btn-add-to-cart" onclick="addToCart({ID})" data-id="{ID}">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 13C5.5 13.8284 4.82843 14.5 4 14.5C3.17157 14.5 2.5 13.8284 2.5 13C2.5 12.1716 3.17157 11.5 4 11.5C4.82843 11.5 5.5 12.1716 5.5 13Z" fill="currentColor"/>
                                                    <path d="M13.5 13C13.5 13.8284 12.8284 14.5 12 14.5C11.1716 14.5 10.5 13.8284 10.5 13C10.5 12.1716 11.1716 11.5 12 11.5C12.8284 11.5 13.5 12.1716 13.5 13Z" fill="currentColor"/>
                                                    <path d="M0.5 1.5H2.5L4.5 9.5H13.5L15.5 3.5H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Thêm vào giỏ hàng
                                            </button>
                    </div>
              </div>
        </div>
          <!-- END: items -->
        </div>
        <!-- END: new_section  -->

         <div class="medical-section-separator">
            <div class="medical-cross-divider">
                <div class="cross-line"></div>
                <div class="medical-cross">
                    <i class="fa fa-plus"></i>
                </div>
            </div>
        </div>

        <!-- BEGIN: other_section -->
            <div class="section-header">
                <div class="section-title-wrapper">
                    <h2 class="section-title">{SECTION_TITLE}</h2>
                </div>
                <div class="section-divider">
                    <span class="divider-icon"> <i class="fa fa-medkit"></i></span>
                </div>
            </div>
            <div class="row">
              <!-- BEGIN: items -->
              <div class="col-12 col-sm-6 col-md-3">
                  <div class="product-card">
                      <div class="product-badges">
                      </div>
                      <div class="product-image">
                          <div class="image_center">
                                <a href="{LINK}" title="{TITLE}">
                                <img src="{SRC_PRO_LAGE}" alt="{TITLE}" class="img-fluid" loading="lazy"/>
                                </a>
                                 <div class="product-overlay">
                                    <div class="quick-actions">
                                    </div>
                                </div>
                          </div>
                    </div>
                     <div class="product-info">
                               <h3 class="product-title">
                                    <a href="{LINK}" title="{TITLE}">{TITLE0}</a>
                                </h3>
                    </div>
                    <div class="product-price">
                        <p class="current-price"> {PRICE.sale_format}</p>
                    </div>
                    <div class="product-action">
                                            <button class="btn-add-to-cart" onclick="addToCart({ID})" data-id="{ID}">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.5 13C5.5 13.8284 4.82843 14.5 4 14.5C3.17157 14.5 2.5 13.8284 2.5 13C2.5 12.1716 3.17157 11.5 4 11.5C4.82843 11.5 5.5 12.1716 5.5 13Z" fill="currentColor"/>
                                                    <path d="M13.5 13C13.5 13.8284 12.8284 14.5 12 14.5C11.1716 14.5 10.5 13.8284 10.5 13C10.5 12.1716 11.1716 11.5 12 11.5C12.8284 11.5 13.5 12.1716 13.5 13Z" fill="currentColor"/>
                                                    <path d="M0.5 1.5H2.5L4.5 9.5H13.5L15.5 3.5H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Thêm vào giỏ hàng
                                            </button>
                                        </div>
                  </div>
            </div>
            <!-- END: items -->
            </div>
        <!-- END: other_section -->
        
                <!-- BEGIN: section_end -->
                <div class="section-separator"></div>
                <!-- END: section_end -->
        </div>
        <!-- BEGIN: pages -->
        <div aria-label="Page navigation" class="d-flex justify-content-center my-4">
             {generate_page}
        </div>
        <!-- END: pages -->
    </div>
    </div>
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        html: true,
        placement: 'top',
        container: 'body'
    });
    if ('IntersectionObserver' in window) 
    {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));
    }
});
</script>
<!-- END: main -->