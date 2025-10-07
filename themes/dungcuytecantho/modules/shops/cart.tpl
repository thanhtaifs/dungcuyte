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
            <div class="cart-products d-flex flex-wrap">
                <!-- BEGIN: rows -->
                <div class="card mb-3 mr-3" style="width: 180px; text-align:center;" id="{id}">
                    <img src="{homeimgthumb}" class="card-img-top" alt="{title_pro}" style="height:150px; object-fit:contain;">
                    <div class="card-body p-2">
                        <h6 class="card-title"> {title_pro}</h6>
                        <p class="card-text"><strong>{PRICE.sale_format}</strong></p>

                        <div class="input-group mb-2">
                            <button type="button" class="btn btn-sm btn-secondary qty-decrease">-</button>
                            <input type="number" size="1" value="{pro_num}" name="listproid[{id}]" class="form-control text-center qty-input"/>
                            <button type="button" class="btn btn-sm btn-secondary qty-increase">+</button>
                        </div>

                        <button type="button" class="btn btn-sm btn-danger remove_cart" title="{LANG.cart_remove_pro}" data-href="{link_remove}">
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
                    <p><strong>{LANG.cart_total}:</strong> <span id="total"></span> {unit_config}</p>
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
