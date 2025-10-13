<!-- BEGIN: main -->
<div class="step_bar alert alert-success clearfix">
    <a class="step" title="{LANG.cart_check_cart}" href="{LINK_CART}"><span>1</span>{LANG.cart_check_cart}</a>
    <a class="step step_current" title="{LANG.cart_order}" href="#"><span>2</span>{LANG.cart_order}</a>
</div>
<form action="/index.php?nv=shops&op=order" method="post" name="fpost" id="fpost" id="paymentForm">
    <input type="hidden" value="1" name="postorder">    
    <div class="row">
        <!-- Cột trái: Thông tin khách hàng và giỏ hàng -->
        <div class="col-md-8">
            <!-- Thông tin khách hàng -->
            <div class="cart-products mb-4">
                <!-- Vùng hiển thị lỗi -->
                <div id="formErrorContainer"></div>
                <h4 class="cart-title mb-3">Thông tin khách hàng</h4>                
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label"><strong>Họ và tên:</strong></label>
                    <div class="col-md-9">
                        <input type="text" name="order_name" class="form-control" placeholder="Nhập họ và tên" required>
                    </div>
                </div>
                
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label"><strong>Email:</strong></label>
                    <div class="col-md-9">
                        <input type="email" name="order_email" class="form-control" placeholder="Nhập email" required>
                    </div>
                </div>
                
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label"><strong>Số điện thoại:</strong></label>
                    <div class="col-md-9">
                        <input type="text" name="order_phone" class="form-control" placeholder="Nhập số điện thoại" required>
                    </div>
                </div>
                
                <div class="form-group row mb-3">
                    <label class="col-md-3 col-form-label"><strong>Địa chỉ:</strong></label>
                    <div class="col-md-9">
                        <textarea name="order_address" class="form-control" rows="3" placeholder="Nhập địa chỉ giao hàng" required></textarea>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label>
                        <input type="checkbox" name="check" value="1" require checked>
                        {LANG.cart_confirm_info}
                    </label>
                </div>
            </div>

            <!-- Giỏ hàng -->
            <div class="cart-products">
                <h4 class="cart-title mb-3">Chi tiết đơn hàng</h4>                
                <!-- BEGIN: loop -->
                <div class="cart-item">
                    <!-- Số thứ tự -->
                    <div class="cart-item-number">
                        <span class="badge_no badge__secondary">{pro_no}</span>
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="cart-item-info">
                        <!-- Tiêu đề -->
                        <h6 class="cart-item-title">{title}</h6>
                        <!-- Giá và số lượng -->
                        <div class="price-info">
                            <div><strong>Đơn giá:</strong> {product_price}</div>
                            <div><strong>Số lượng:</strong> {product_number}</div>
                            <div><strong>Thành tiền:</strong> <span class="text-danger">{product_price_total}</span></div>
                        </div>
                    </div>
                </div>
                <!-- END: loop -->
            </div>
        </div>

        <!-- Cột phải: Tổng kết đơn hàng -->
        <div class="col-md-4">
            <div class="cart-products-total">
                <h4 class="cart-title">Tổng kết đơn hàng</h4>
                
                <div>
                    <p class="cart-total">
                        <strong>Tổng tiền hàng:</strong> 
                        <span class="cart-amount text-danger">{PRICE_TOTAL} {unit}</span>
                    </p>
                    
                    <p class="cart-time">
                        <strong>Thời gian đặt hàng:</strong> 
                        <span id="orderTime"></span>
                    </p>
                </div>

                <hr>

                <div class="payment-method mb-3">
                    <h6><strong>Phương thức thanh toán:</strong></h6>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                        <label class="form-check-label" for="cod">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="banking" value="banking">
                        <label class="form-check-label" for="banking">
                            Chuyển khoản ngân hàng
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">
                    <i class="fa fa-credit-card mr-1"></i> Xác nhận đặt hàng
                </button>
                <div class="back_to_cart" id="back_to_cart">
                  <button type="button" class="btn-outline-secondary btn-block mt-2">
                    <i class="fa fa-arrow-left mr-1"></i> Quay lại giỏ hàng
                  </button>
                </div>            
                
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
$(document).ready(function() {


    let now = new Date();
    $("#orderTime").text(now.toLocaleString('vi-VN'));
    
    $("#").on("submit", function(e) {
        e.preventDefault();
        // Nếu form hợp lệ
        if (this.checkValidity()) {           
            let formData = $(this).serialize() + "&postorder=1";
            $.ajax({
                type: "POST",
                url: '/index.php?nv=shops&op=order&t=json',               
                data: formData,
                dataType: "json",
                beforeSend: function() 
                {
                    $(".btn-success").prop("disabled", true).text("Đang xử lý...");
                },
                success: function(res) {
                    console.log("Kết quả đặt hàng:", res);
                    if (res.status === "success") {     
                        // Chuyển hướng theo link mà PHP trả về
                        window.location.href = res.redirect || 
                            (nv_base_siteurl + "index.php?" + nv_lang_variable + "=" + nv_lang_data 
                            + "&" + nv_name_variable + "=shops&" + nv_op_variable + "=complete");
                    } 
                    else if (res.status === "error") {
                        $(".error-message").remove();
                        $("#paymentForm").prepend(
                            '<div class="alert alert-danger error-message">' + res.message + "</div>"
                        );
                        $('html, body').animate({ scrollTop: $("#paymentForm").offset().top - 100 }, 400);
                    } else {
                        alert(res.message || "Có lỗi xảy ra khi đặt hàng!");
                    }
                },
                error: function(xhr) {
                    alert("Không thể kết nối tới máy chủ. Mã lỗi: " + xhr.status);
                },
                complete: function() {
                    $(".btn-success").prop("disabled", false).html('<i class="fa fa-credit-card mr-1"></i> Xác nhận đặt hàng');
                }
            });
        } else {
            alert("Vui lòng điền đầy đủ thông tin!");
        }
    });
});
</script>
<!-- END: main -->