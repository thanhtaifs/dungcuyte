<!-- BEGIN: main -->
<form action="{LINK_CART}" method="post" id="fpro">
    <input type="hidden" value="1" name="save"/>
    <div class="row">
        <!-- Cột trái: danh sách sản phẩm -->
        <div class="col-md-8">
            <div class="cart-products" id="cart-products">
                <!-- BEGIN: rows -->
                <div class="cart-item" id="{cart_id}">
                    <!-- Ảnh sản phẩm -->
                    <div class="cart-item-image">
                        <img src="{img_pro}" alt="{title_pro}" class="img-fluid rounded" style="max-height: 150px; object-fit: contain;">
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="cart-item-info">
                        <!-- Tiêu đề -->
                        <h6 class="cart-item-title">{title_pro}</h6>
                        <!-- BEGIN: variant -->
                        <div class="text-muted small">Loại: {variant_label}</div>
                        <!-- END: variant -->
                        <!-- Ô tăng giảm số lượng -->
                        <div class="quantity-control">
                            <button type="button" class="qty-btn qty-decrease">-</button>
                            <input type="number" value="{pro_num}" name="listproid[{cart_id}]" class="qty-input" min="1" data-cart-id="{cart_id}">
                            <button type="button" class="qty-btn qty-increase">+</button>
                        </div>

                        <!-- Giá và thành tiền -->
                        <div class="price-info">
                            <div><strong>Giá:</strong> <span class="text-danger">{PRICE.sale_format}</span><!-- BEGIN: discounts --> <small class="text-muted"><del>{PRICE.price_format}</del></small><!-- END: discounts --></div>
                            <div><strong>Thành tiền:</strong> <span class="text-danger">{PRICE_TOTAL.sale_format}</span><!-- BEGIN: total_discounts --> <small class="text-muted"><del>{PRICE_TOTAL.price_format}</del></small><!-- END: total_discounts --></div>
                        </div>

                        <!-- Nút xóa -->
                        <button type="button" class="btn-remove mt-2" title="{LANG.cart_remove_pro}" data-id="{cart_id}">
                            <i class="fa fa-times-circle"></i> Xóa
                        </button>
                    </div>
                </div>
                <!-- END: rows -->
            </div>
            <!-- Khi giỏ hàng trống -->
            <div id="emptyCart" class="text-center py-5" style="display:none;">
                <h5 class="text-muted mb-3">Giỏ hàng của bạn đang trống!</h5>
                <button type="button" class="btn btn-primary" id="continueShopping">
                    <i class="fa fa-arrow-left mr-1"></i> Tiếp tục mua sắm
                </button>
            </div>
        </div>

        <!-- Cột phải: tổng chi phí -->
        <div class="col-md-4">
            <div class="cart-products-total">
                <h4 class="cart-title">Thông tin giỏ hàng</h4>
                <div class="coupon-box mb-3">
                    <form action="{LINK_CART}" method="post">
                        <div class="form-group">
                            <label for="coupons_code"><strong>Mã giảm giá</strong></label>
                            <input type="text" class="form-control" id="coupons_code" name="coupons_code" value="{C_CODE}" placeholder="Nhập mã giảm giá">
                        </div>
                        <button type="submit" name="coupon_apply_submit" value="1" class="btn btn-primary btn-block">Áp dụng mã</button>
                        <button type="submit" name="coupon_clear_submit" value="1" class="btn btn-default btn-block">Xóa mã</button>
                    </form>
                </div>
                <!-- BEGIN: coupon_error -->
                <div class="alert alert-danger">{COUPON_ERROR}</div>
                <!-- END: coupon_error -->
                <!-- BEGIN: coupon_success -->
                <div class="alert alert-success">{COUPON_SUCCESS}</div>
                <!-- END: coupon_success -->
                <p class="cart-total">
                    <strong>Tạm tính:</strong>
                    <span class="cart-amount">{SUBTOTAL}</span>
                </p>
                <!-- BEGIN: coupon_summary -->
                <p class="cart-total">
                    <strong>Giảm giá:</strong>
                    <span class="cart-amount text-success">- {COUPON_DISCOUNT}</span>
                </p>
                <!-- END: coupon_summary -->
                <p class="cart-total">
                    <strong>Tổng chi phí:</strong>
                    <span id="totalPrice" class="cart-amount">{TOTAL}</span>
                </p>
                <p class="cart-time">
                    <strong>Thời gian:</strong>
                    <span id="cartTime"></span>
                </p>
                <button type="button" class="btn btn-success btn-block" id="goToPayment">
                    <i class="fa fa-credit-card mr-1"></i> Thanh toán
                </button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
$(document).ready(function() {
    let now = new Date();
    $("#cartTime").text(now.toLocaleString('vi-VN'));

    $("#continueShopping").click(function() {
        window.location.href = '/';
    });

    $("#goToPayment").click(function() {
        if ($('.cart-item').length === 0) {
            alert('Giỏ hàng trống!');
            return false;
        }
        $('#fpro').submit();
        window.location.href = '/index.php?nv=shops&op=payment';
    });
});
</script>
<!-- END: main -->
