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
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip({
        html: true,
        placement: 'top',
        container: 'body'
    });
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
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
</script>
<!-- END: main -->