<!-- BEGIN: main -->
<div class="step_bar alert alert-success clearfix">
    <a class="step step_current" title="{LANG.cart_check_cart}" href="#"><span>1</span>{LANG.cart_check_cart}</a>
    <a class="step step_disable" title="{LANG.cart_order}" href="{link_order_all}" id="cart_next"><span>2</span>{LANG.cart_order}</a>
</div>

<form action="{LINK_CART}" method="post" id="fpro">
    <input type="hidden" value="1" name="save"/>
    <div class="row">
        <!-- Cột trái: danh sách sản phẩm -->
        <div class="col-md-8">
            <div class="cart-products">
                <!-- BEGIN: rows -->
                <div class="cart-item" id="{id}">
                    <!-- Ảnh sản phẩm -->
                    <div class="cart-item-image">
                        <img src="{img_pro}" alt="{title_pro}" class="img-fluid rounded" style="max-height: 150px; object-fit: contain;">
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="cart-item-info">
                        <!-- Tiêu đề -->
                        <h6 class="cart-item-title">{title_pro}</h6>

                        <!-- Ô tăng giảm số lượng -->
                        <div class="quantity-control">
                            <button type="button" class="qty-btn qty-decrease">-</button>
                            <input type="number" value="{pro_num}" name="listproid[{id}]" class="qty-input" min="1">
                            <button type="button" class="qty-btn qty-increase">+</button>
                        </div>

                        <!-- Giá và thành tiền -->
                        <div class="price-info">
                            <div><strong>Giá:</strong> {PRICE.sale_format}</div>                            
                            <div><strong>Thành tiền:</strong> <span class="text-danger">{PRICE_TOTAL.sale_format}</span></div>
                        </div>

                        <!-- Nút xóa -->
                        <button type="button" class="btn-remove mt-2" title="{LANG.cart_remove_pro}" data-href="{link_remove}">
                            <i class="fa fa-times-circle"></i> Xóa
                        </button>
                    </div>
                </div>
                <!-- END: rows -->                
            </div>
            <!-- Khi giỏ hàng trống -->
                <div id="emptyCart" class="text-center py-5" style="display:none;">
                    <h5 class="text-muted mb-3">🛍️ Giỏ hàng của bạn đang trống!</h5>
                    <button type="button" class="btn btn-primary" id="continueShopping">
                        <i class="fa fa-arrow-left mr-1"></i> Tiếp tục mua sắm
                    </button>
                </div>
        </div>

        <!-- Cột phải: tổng chi phí -->
        <div class="col-md-4">
              <div class="cart-products">
                    <h4 class="cart-title">Thông tin giỏ hàng</h4>
                    <p class="cart-total">
                        <strong>Tổng chi phí:</strong> 
                        <span class="cart-amount">{TOTAL}</span> 
                    </p>                         
                     <p class="cart-time">
                        <strong>Thời gian:</strong> 
                        <span id="cartTime">10/9/2025, 7:19:52 AM</span>
                    </p>
                    <button type="button" class="btn btn-success btn-block" id="goToPayment">
                        <i class="fa fa-credit-card mr-1"></i> Thanh toán
                    </button>
              
           </div>
        </div>
    </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    // --- Hàm tính lại tổng chi phí ---
    function updateCartTotal() {
        let total = 0;
        $('.cart-item').each(function() {
            let price = parseFloat($(this).find('.price').data('price')) || 0;
            let qty = parseInt($(this).find('.qty-input').val()) || 1;
            total += price * qty;
        });
        $('.cart-amount').text(total.toLocaleString('vi-VN') + ' VND');
        // --- Kiểm tra nếu không còn sản phẩm ---
        if ($('.cart-item').length === 0) {
            console.log("🧾 Không còn sản phẩm trong giỏ. Hiển thị #emptyCart...");
            // Ẩn danh sách sản phẩm + phần tổng chi phí
            $('.cart-products').fadeOut(200, function() {
                // Sau khi ẩn xong thì hiển thị giỏ hàng trống
                $('#emptyCart').removeAttr('style').hide().fadeIn(300);
            });
        }
    }

    // --- Cập nhật thời gian ---
    let now = new Date();
    $("#cartTime").text(now.toLocaleString('vi-VN'));

    // --- Nút Xóa sản phẩm ---
    $(".btn-remove").on("click", function() {
        let btn = $(this);
        let item = btn.closest(".cart-item");
        let href = btn.data("href");

        if(!confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?")) return;

        $.ajax({
            type: "GET",
            url: href,
            success: function(res){
                // Nếu server trả JSON ok thì xử lý
                try {
                    let data = JSON.parse(res);
                    if(data.status === 'ok'){
                        item.fadeOut(300, function(){
                            $(this).remove();
                            updateCartTotal();
                        });
                    } else {
                        item.fadeOut(300, function(){
                            $(this).remove();
                            updateCartTotal();
                        });
                    }
                } catch (e) {
                    // Nếu không trả JSON vẫn xóa
                    item.fadeOut(300, function(){
                        $(this).remove();
                        updateCartTotal();
                    });
                }
            },
            error: function(){
                alert("Lỗi kết nối, vui lòng thử lại!");
            }
        });
    });

    // --- Tăng giảm số lượng ---
    $(".qty-increase").click(function(){
        let input = $(this).siblings('.qty-input');
        input.val(parseInt(input.val()) + 1).trigger('change');
    });

    $(".qty-decrease").click(function(){
        let input = $(this).siblings('.qty-input');
        let val = parseInt(input.val()) - 1;
        if(val < 1) val = 1;
        input.val(val).trigger('change');
    });

    $(".qty-input").change(function(){
        $("#fpro").submit(); // Cập nhật lại session giỏ hàng
    });

    // --- Nút Tiếp tục mua sắm ---
    $("#continueShopping").click(function(){
        window.location.href = '/';
    });

    // Nút thanh toán
    $("#goToPayment").click(function(){
        window.location.href = '/index.php?nv=shops&op=payment';
    });
});
</script>
<!-- END: main -->
