<!-- HTML Template -->
<div class="well">
    <h3>Sitemap Generator</h3>
    
    <!-- BEGIN: info -->
    <div class="alert alert-success">
        {INFO}
    </div>
    <!-- END: info -->
    
    <!-- BEGIN: error -->
    <div class="alert alert-danger">
        {ERROR}
    </div>
    <!-- END: error -->
    
    <form method="post" action="{FORM_ACTION}">
        <input type="hidden" name="generate" value="1" />
        
        <div class="form-group">
            <label>URL Sitemap hiện tại:</label>
            <input type="text" class="form-control" value="{SITEMAP_URL}" readonly />
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-refresh"></i> Tạo Sitemap
            </button>
        </div>
        
        <div class="alert alert-info">
            <strong>Hướng dẫn:</strong><br>
            1. Nhấn "Tạo Sitemap" để tạo file sitemap.xml<br>
            2. Thêm URL sitemap vào Google Search Console: <code>{SITEMAP_URL}</code><br>
            3. Sitemap sẽ tự động cập nhật theo cronjob (nếu đã cấu hình)
        </div>
    </form>
</div>