<!-- BEGIN: main -->
<form id="search_form_shops" action="{NV_BASE_SITEURL}index.php" method="get" role="form" name="frm_search">
    <input type="hidden" name="{NV_NAME_VARIABLE}" value="seek">
    <input type="text" name="q" id="keyword" class="text" placeholder="Từ khóa tìm kiếm...">
    <input type="submit" value="Tìm kiếm" class="btn2">

    <input type="hidden" name="nv" value="shops">
    <input type="hidden" name="op" value="search">
    <input type="hidden" name="module" value="shops"> <!-- Thêm tham số module -->

    <label style="display:none">{LANG.keyword}</label>
    <input id="keyword" type="text" value="{value_keyword}" name="q" class="text">

    <input type="submit" name="submit" id="submit" value="" class="btn2">

    <div class="form-group" style="display:none">
        <label>{LANG.price1}</label>
        <input id="price1" type="text" value="{value_price1}" name="price1" class="form-control input-sm">
    </div>

    <div class="form-group" style="display:none">
        <label>{LANG.price2}</label>
        <input id="price2" type="text" value="{value_price2}" name="price2" class="form-control input-sm">
    </div>

    <div class="form-group" style="display:none">
        <label>{LANG.moneyunit}</label>
        <select name="typemoney" id="typemoney" class="form-control input-sm">
            <option value="0"></option>
            <!-- BEGIN: typemoney -->
            <option {ROW.selected} value="{ROW.code}">{ROW.currency}</option>
            <!-- END: typemoney -->
        </select>
    </div>

    <div class="form-group" style="display:none">
        <label>{LANG.catagories}</label>
        <select name="cata" id="cata" class="form-control input-sm">
            <option value="0"></option>
            <!-- BEGIN: loopcata -->
            <option {ROW.selected} value="{ROW.catid}">{ROW.xtitle}</option>
            <!-- END: loopcata -->
        </select>
    </div>  
</form>
<!-- END: main -->
