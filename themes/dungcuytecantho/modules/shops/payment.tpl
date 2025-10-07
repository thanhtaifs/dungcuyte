<!-- BEGIN: main -->
<div class="block clearfix">
    <form action="" method="post" id="paymentForm">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Thông tin khách hàng</h3>
                <div class="row mb-2">
                    <div class="col-md-3"><label>Họ và tên:</label></div>
                    <div class="col-md-9"><input type="text" name="order_name" class="form-control" required></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3"><label>Email:</label></div>
                    <div class="col-md-9"><input type="email" name="order_email" class="form-control" required></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3"><label>Số điện thoại:</label></div>
                    <div class="col-md-9"><input type="text" name="order_phone" class="form-control" required></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3"><label>Địa chỉ:</label></div>
                    <div class="col-md-9"><textarea name="order_address" class="form-control" rows="2" required></textarea></div>
                </div>
            </div>
        </div>

        <!-- Giỏ hàng -->
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Giỏ hàng</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- BEGIN: loop -->
                            <tr {bg}>
                                <td>{pro_no}</td>
                                <td>{product_name}</td>
                                <td class="text-right">{product_price}</td>
                                <td class="text-center">{product_number}</td>
                                <td class="text-right">{product_price_total}</td>
                            </tr>
                            <!-- END: loop -->
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <strong>Tổng tiền: {order_total} {unit}</strong>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fa fa-credit-card mr-2"></i> Thanh toán ngay
            </button>
        </div>
    </form>
</div>
<!-- END: main -->
