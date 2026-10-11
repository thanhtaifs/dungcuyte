<!-- BEGIN: main -->
<link rel="stylesheet" href="{ASSET_BASE}/css/bank-transfer.css">
<section class="bank-transfer-card" aria-label="Thông tin chuyển khoản">
    <h4>Quét QR để chuyển khoản</h4>
    <img class="bank-transfer-qr" data-qr-src="{BANK.qr_url}" alt="QR chuyển khoản MB Bank, số tiền {BANK.amount_display} đồng" width="270" height="320" referrerpolicy="no-referrer">
    <p class="bank-qr-error" hidden>Không tải được QR. Bạn có thể chuyển khoản theo thông tin bên dưới.</p>
    <dl>
        <dt>Ngân hàng</dt><dd>{BANK.bank}</dd>
        <dt>Chủ tài khoản</dt><dd>{BANK.owner}</dd>
        <dt>Số tài khoản</dt><dd><strong>{BANK.account_display}</strong> <button type="button" class="bank-copy" data-copy="{BANK.account}">Sao chép</button></dd>
        <dt>Số tiền</dt><dd><strong>{BANK.amount_display} VND</strong> <button type="button" class="bank-copy" data-copy="{BANK.amount}">Sao chép</button></dd>
        <dt>Nội dung chuyển khoản</dt><dd><strong>{BANK.reference}</strong> <button type="button" class="bank-copy" data-copy="{BANK.reference}">Sao chép</button></dd>
    </dl>
    <p>Giữ đúng nội dung chuyển khoản để cửa hàng đối chiếu đơn hàng. Đơn hàng được xác nhận thanh toán sau khi cửa hàng kiểm tra tiền nhận được.</p>
    <p class="bank-copy-status" role="status" aria-live="polite"></p>
</section>
<script src="{ASSET_BASE}/js/bank-transfer.js" defer></script>
<!-- END: main -->
