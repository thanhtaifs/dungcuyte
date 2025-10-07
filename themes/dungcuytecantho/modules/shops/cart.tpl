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
                            <div><strong>Thành tiền:</strong> <span class="text-danger">{PRICE.total_format}</span></div>
                        </div>

                        <!-- Nút xóa -->
                        <button type="button" class="btn-remove" title="{LANG.cart_remove_pro}" data-href="{link_remove}">
                            <i class="fa fa-times-circle"></i> Xóa
                        </button>
                    </div>
                </div>
                <!-- END: rows -->
            </div>
        </div>

        <!-- Cột phải: tổng chi phí -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h4>Thông tin thanh toán</h4>
                    <p><span id="total"></span> {PRICE_TOTAL}</p>
                    <p><strong>Thời gian:</strong> <span id="cartTime"></span></p>
                    <button type="button" class="btn btn-success btn-block" id="goToPayment">
                        <i class="fa fa-credit-card mr-1"></i> Thanh toán
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    // Load tổng tiền và thời gian
    var urload = nv_siteroot + 'index.php?' + nv_lang_variable + '=' + nv_sitelang + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=loadcart';
    $("#total").load(urload + '&t=2');
    var now = new Date();
    $("#cartTime").text(now.toLocaleString());

    // Xóa sản phẩm
    $(".remove_cart").click(function() {
        var href = $(this).data('href');
        var card = $(this).closest('.card');
        $.ajax({
            type: "GET",
            url: href,
            success: function(data){
                card.remove();
                $("#total").load(urload + '&t=2');
            }
        });
    });

    // Tăng giảm số lượng
    $(".qty-increase").click(function(){
        var input = $(this).siblings('.qty-input');
        input.val(parseInt(input.val()) + 1).trigger('change');
    });
    $(".qty-decrease").click(function(){
        var input = $(this).siblings('.qty-input');
        var val = parseInt(input.val()) - 1;
        if(val < 1) val = 1;
        input.val(val).trigger('change');
    });

    $(".qty-input").change(function(){
        $("#fpro").submit(); // submit form để cập nhật session
    });

    // Nút thanh toán
    $("#goToPayment").click(function(){
        window.location.href = '/index.php?nv=shops&op=payment';
    });
});
</script>
<!-- END: main -->
