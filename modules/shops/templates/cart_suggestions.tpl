<!-- BEGIN: main -->
<section class="cart-suggestions">
    <div class="cart-threshold-banner" role="status" aria-live="polite">
        <strong>Chuyển khoản chỉ áp dụng cho đơn hàng trên 200.000đ</strong>
        <p>Bạn có thể mua thêm ít nhất {REMAINING} để sử dụng chuyển khoản, hoặc chọn thanh toán khi nhận hàng (COD). Giá chưa bao gồm phí vận chuyển.</p>
    </div>
    <!-- BEGIN: products -->
    <h4 class="cart-suggestions-title">Sản phẩm cùng loại dưới 100.000đ để mua thêm</h4>
    <div class="cart-suggestions-grid">
        <!-- BEGIN: item -->
        <a class="cart-suggestion-card" href="{PRODUCT.url}">
            <div class="cart-suggestion-image">
                <img src="{PRODUCT.image}" alt="{PRODUCT.title}" width="500" height="500" loading="lazy" decoding="async">
            </div>
            <div class="cart-suggestion-body">
                <span class="cart-suggestion-name">{PRODUCT.title}</span>
                <strong>{PRODUCT.price}</strong>
                <small class="price-shipping-note">Giá chưa bao gồm phí vận chuyển</small>
                <span class="cart-suggestion-link">Xem sản phẩm <i class="fa fa-angle-right" aria-hidden="true"></i></span>
            </div>
        </a>
        <!-- END: item -->
    </div>
    <!-- END: products -->
</section>
<!-- END: main -->
