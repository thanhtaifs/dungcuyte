(function () {
    'use strict';
    function loadQr() {
        document.querySelectorAll('.bank-transfer-qr[data-qr-src]').forEach(function (img) {
            if (img.closest('[hidden]') || img.hasAttribute('src')) return;
            img.onerror = function () {
                img.style.display = 'none';
                img.parentNode.querySelector('.bank-qr-error').hidden = false;
            };
            img.src = img.getAttribute('data-qr-src');
        });
    }
    function init() {
        var panel = document.getElementById('bankTransferPanel');
        function toggle() {
            var method = document.querySelector('input[name="payment_method"]:checked');
            if (panel) panel.hidden = !method || method.value !== 'banking';
            loadQr();
        }
        document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
            radio.addEventListener('change', toggle);
        });
        document.querySelectorAll('.bank-copy').forEach(function (button) {
            button.addEventListener('click', function () {
                var status = button.closest('.bank-transfer-card').querySelector('.bank-copy-status');
                var value = button.getAttribute('data-copy');
                function fallback() {
                    var field = document.createElement('textarea');
                    field.value = value; field.style.position = 'fixed'; field.style.opacity = '0';
                    document.body.appendChild(field); field.select();
                    var copied = document.execCommand('copy'); field.remove();
                    status.textContent = copied ? 'Đã sao chép.' : 'Vui lòng sao chép: ' + value;
                }
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(value).then(function () { status.textContent = 'Đã sao chép.'; }, fallback);
                } else fallback();
            });
        });
        toggle();
        window.addEventListener('pageshow', toggle);
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();
}());
