<!-- BEGIN: main -->
<form action="{PAYMENT_ACTION}" method="post" name="fpost" id="fpost">
    <input type="hidden" value="1" name="postorder">    
    <input type="hidden" name="payment_checkss" value="{PAYMENT_CHECKSS}">
    <div class="row checkout-layout">
        <!-- Cột trái: Giỏ hàng, giao hàng và ghi chú -->
        <div class="col-md-8">
            <div id="formErrorContainer"></div>

            <!-- Giỏ hàng -->
            <div class="cart-products">
                <h4 class="cart-title mb-3">Chi tiết đơn hàng</h4>                
                <!-- BEGIN: loop -->
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="{img_pro}" alt="{title}" class="img-fluid rounded" style="max-height: 120px; object-fit: contain;">
                    </div>
                    <!-- Số thứ tự -->
                    <div class="cart-item-number">
                        <span class="badge_no badge__secondary">{pro_no}</span>
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="cart-item-info">
                        <!-- Tiêu đề -->
                        <h6 class="cart-item-title">{title}</h6>
                        <!-- BEGIN: variant -->
                        <div class="text-muted small">Loại: {variant_label}</div>
                        <!-- END: variant -->
                        <!-- Giá và số lượng -->
                        <div class="price-info">
                            <!-- BEGIN: shipping_note -->
                            <small class="price-shipping-note">Giá chưa bao gồm phí vận chuyển</small>
                            <!-- END: shipping_note -->
                            <div><strong>Đơn giá:</strong> {product_price}</div>
                            <div><strong>Số lượng:</strong> {product_number}</div>
                            <div><strong>Thành tiền:</strong> <span class="text-danger">{product_price_total}</span></div>
                        </div>
                    </div>
                </div>
                <!-- END: loop -->
            </div>
            <!-- BEGIN: checkout_details -->
            <div class="checkout-customer-details">
                <section class="payment-delivery-review" aria-labelledby="paymentDeliveryTitle">
                    <h5 id="paymentDeliveryTitle"><i class="fa fa-truck" aria-hidden="true"></i> Thông tin giao hàng</h5>
                    <dl>
                        <dt>Số điện thoại</dt>
                        <dd>{DELIVERY_PHONE}</dd>
                        <dt>Địa chỉ giao hàng</dt>
                        <dd>{DELIVERY_ADDRESS}</dd>
                    </dl>
                    <p>Vui lòng kiểm tra thông tin giao hàng trước khi đặt hàng.</p>
                    <a href="{PROFILE_URL}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa thông tin</a>
                </section>
                {INVOICE_FORM}
            </div>
            <!-- END: checkout_details -->
        </div>

        <!-- Cột phải: Tổng kết đơn hàng -->
        <div class="col-md-4">
            <div class="cart-products-total">
                <h4 class="cart-title">Tổng kết đơn hàng</h4>
                
                <div>
                    <p class="cart-total">
                        <strong>Tổng tiền hàng:</strong> 
                        <span class="cart-amount text-danger">{order_total} {unit}</span>
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
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" {PAYMENT_COD_CHECKED}>
                        <label class="form-check-label" for="cod">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="banking" value="banking" {PAYMENT_BANKING_CHECKED} {PAYMENT_BANKING_DISABLED}>
                        <label class="form-check-label" for="banking">
                            Chuyển khoản ngân hàng
                        </label>
                    </div>
                </div>

                <!-- BEGIN: banking_unavailable -->
                <p id="bankingAvailabilityNotice" class="alert alert-info">Chuyển khoản chỉ áp dụng cho tổng tiền hàng sau giảm giá trên 200.000đ. Vui lòng mua thêm sản phẩm cùng loại được gợi ý bên dưới hoặc chọn COD.</p>
                <!-- END: banking_unavailable -->
                <div id="bankTransferPanel" hidden>
                    <p class="alert alert-info">Vui lòng xác nhận đặt hàng trước khi chuyển khoản. QR chính thức sẽ hiển thị cùng mã đơn hàng sau khi đặt hàng thành công.</p>
                    {BANK_TRANSFER_PANEL}
                </div>
                <!-- BEGIN: auth_required -->
                <div class="alert alert-info payment-auth-required">
                    <p>{LANG.payment_auth_message}</p>
                    <a href="{REGISTER_URL}" class="btn btn-default">{LANG.payment_auth_register}</a>
                    <a href="{LOGIN_URL}" class="btn btn-primary">{LANG.payment_auth_login}</a>
                </div>
                <!-- END: auth_required -->
                <!-- BEGIN: profile_required -->
                <div class="alert alert-warning">
                    <p>{LANG.payment_profile_message}</p>
                    <a href="{PROFILE_URL}" class="btn btn-primary">{LANG.payment_profile_update}</a>
                </div>
                <!-- END: profile_required -->
                <!-- BEGIN: submit_error -->
                <div class="alert alert-danger">{LANG.payment_submit_error}</div>
                <!-- END: submit_error -->
                <!-- BEGIN: authenticated -->
                <div class="form-group">
                    <label><input type="checkbox" name="check" value="1" required checked> {LANG.cart_confirm_info}</label>
                </div>
                <button type="submit" id="paymentSubmitOrder" class="btn btn-success btn-block">
                    <i class="fa fa-credit-card mr-1"></i> Xác nhận đặt hàng
                </button>
                <div id="paymentSubmitStatus" class="alert alert-info mt-2" role="status" aria-live="polite" hidden>
                    <i class="fa fa-spinner fa-spin mr-1" aria-hidden="true"></i>
                    Đang xử lý đơn hàng, vui lòng chờ...
                </div>
                <!-- END: authenticated -->
                <div class="back_to_cart" id="back_to_cart">
                  <button type="button" class="btn-outline-secondary btn-block mt-2">
                    <i class="fa fa-arrow-left mr-1"></i> Quay lại giỏ hàng
                  </button>
                </div>            
                
            </div>
        </div>
    </div>
</form>
<div id="checkoutSuggestions">{CART_SUGGESTIONS}</div>

<script type="text/javascript">
$(document).ready(function() {
    let now = new Date();
    $("#orderTime").text(now.toLocaleString('vi-VN'));   

    let paymentSubmitting = false;
    $("#fpost").on("submit", function() {
        if (paymentSubmitting) {
            return false;
        }

        paymentSubmitting = true;
        $("#paymentSubmitOrder")
            .prop("disabled", true)
            .attr("aria-disabled", "true")
            .html('<i class="fa fa-spinner fa-spin mr-1" aria-hidden="true"></i> Đang xử lý...');
        $("#paymentSubmitStatus").prop("hidden", false);
    });
});
</script>
<!-- END: main -->
