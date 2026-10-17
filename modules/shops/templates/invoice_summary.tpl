<!-- BEGIN: main -->
<div class="order-invoice-summary" style="margin:20px 0;border:1px solid #dce5ed;border-radius:12px;overflow:hidden;background:#fff;color:#334155;text-align:left;font-style:normal;">
    <div style="padding:16px 20px;background:#f6f9fc;border-bottom:1px solid #e4ebf2;">
        <h3 style="margin:0 0 10px;font-size:16px;font-weight:600;line-height:1.5;color:#1e293b;">Thông tin xuất hóa đơn</h3>
        <span style="display:inline-block;padding:4px 10px;border-radius:6px;font-size:13px;font-weight:600;line-height:1.5;color:{STATUS_COLOR};background:{STATUS_BACKGROUND};">{STATUS}</span>
    </div>
    <!-- BEGIN: details -->
    <table style="width:100%;table-layout:fixed;border-collapse:collapse;font-size:14px;line-height:1.6;">
        <tbody>
            <!-- BEGIN: field -->
            <tr>
                <th scope="row" style="width:34%;padding:12px 16px;vertical-align:top;text-align:left;font-weight:500;color:#64748b;border-bottom:1px solid #edf2f7;overflow-wrap:anywhere;">{FIELD.label}</th>
                <td style="padding:12px 16px;vertical-align:top;font-weight:500;color:#1e293b;border-bottom:1px solid #edf2f7;overflow-wrap:anywhere;word-wrap:break-word;">{FIELD.value}</td>
            </tr>
            <!-- END: field -->
        </tbody>
    </table>
    <!-- END: details -->
</div>
<!-- END: main -->
