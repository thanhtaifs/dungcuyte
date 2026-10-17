<!-- BEGIN: main -->
<section class="payment-invoice-request checkout-note" aria-labelledby="invoiceNoteTitle">
    <h5 id="invoiceNoteTitle">Thông tin xuất hóa đơn</h5>
    <label for="invoiceRequested">
        <input type="checkbox" id="invoiceRequested" name="invoice_requested" value="1" aria-controls="invoiceDetails" {INVOICE_CHECKED}>
        Tôi cần xuất hóa đơn
    </label>
    <p class="help-block">Nếu cần xuất hóa đơn, vui lòng chọn và điền đầy đủ thông tin bên dưới.</p>
    <!-- BEGIN: error -->
    <div class="alert alert-danger" role="alert">{MESSAGE}</div>
    <!-- END: error -->
    <div id="invoiceDetails">
        <!-- BEGIN: field -->
        <div class="form-group">
            <label for="{FIELD.name}">{FIELD.label} <span class="text-danger">*</span></label>
            <input class="form-control" type="{FIELD.type}" id="{FIELD.name}" name="{FIELD.name}" value="{FIELD.value}" maxlength="{FIELD.maxlength}">
        </div>
        <!-- END: field -->
    </div>
</section>
<script>
(function () {
    var checkbox = document.getElementById('invoiceRequested');
    var details = document.getElementById('invoiceDetails');
    function updateInvoiceFields() {
        details.hidden = !checkbox.checked;
        checkbox.setAttribute('aria-expanded', checkbox.checked ? 'true' : 'false');
        var inputs = details.querySelectorAll('input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = !checkbox.checked;
            inputs[i].required = checkbox.checked;
        }
    }
    checkbox.addEventListener('change', updateInvoiceFields);
    updateInvoiceFields();
}());
</script>
<!-- END: main -->
