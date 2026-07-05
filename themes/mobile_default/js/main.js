/* *
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 31/05/2010, 00:36
 */

// NukeViet Default Custom JS
$(document).ready(function(){
	// Modify all empty link
	$('a[href="#"], a[href=""]').attr('href','javascript:void(0);');

	// Smooth scroll to top
	$('#totop').click(function(){
		$('body').animate({scrollTop : 0}, 'slow');
		return false;
	});

	// Trigger tooltip
	$('.form-tooltip').tooltip({
		selector: "[data-toggle=tooltip]",
		container: "body"
	});

	$('#btn-search').click(function(){
		if( $('#search').css('display') == 'none' ){
			$('#search').slideDown('fast');
			$('#nav').slideUp('fast');
			$('#topmenu_search_query').focus();
		}
		else{
			$('#search').slideUp('fast');
		}
	});

	$('#btn-bars').click(function(){
		if( $('#nav').css('display') == 'none' ){
			$('#nav').slideDown('fast');
			$('#search').slideUp('fast');
		}
		else{
			$('#nav').slideUp('fast');
		}
	});
});

function mobileThemeSiteUrl(path) {
	var base = typeof nv_base_siteurl !== 'undefined' && nv_base_siteurl ? nv_base_siteurl : '/';
	return base.replace(/\/?$/, '/') + String(path || '').replace(/^\//, '');
}

function mobileShowCartMessage(message) {
	if ($('#msgshow').length) {
		$('#msgshow').stop(true, true).html(message).fadeIn(200).delay(2000).fadeOut(300);
		return;
	}

	alert(message);
}

function addToCart(id) {
	if (typeof id === 'object' && id !== null) {
		id = $(id).data('id') || $(id).attr('data-id') || 0;
	}

	id = parseInt(id, 10);
	if (!id || id < 1) {
		mobileShowCartMessage('Khong xac dinh duoc san pham can them vao gio hang');
		return false;
	}

	var moduleName = (typeof nv_module_name !== 'undefined' && nv_module_name) ? nv_module_name : 'shops';
	var langVar = (typeof nv_lang_variable !== 'undefined' && nv_lang_variable) ? nv_lang_variable : 'language';
	var siteLang = (typeof nv_sitelang !== 'undefined' && nv_sitelang) ? nv_sitelang : 'vi';
	var nameVar = (typeof nv_name_variable !== 'undefined' && nv_name_variable) ? nv_name_variable : 'nv';
	var fcVar = (typeof nv_fc_variable !== 'undefined' && nv_fc_variable) ? nv_fc_variable : 'op';

	$.ajax({
		type: 'POST',
		url: mobileThemeSiteUrl('index.php?' + langVar + '=' + siteLang + '&' + nameVar + '=' + moduleName + '&' + fcVar + '=setcart&t=json'),
		data: {
			id: id,
			variant_id: $('#selected_variant_id').val() || '',
			variant_label: $('#selected_variant_label').val() || '',
			variant_price: $('#selected_variant_price').val() || ''
		},
		dataType: 'json',
		success: function(res) {
			if (res && res.status === 'success') {
				mobileShowCartMessage(res.message || 'Da them vao gio hang');
				$('.cart-badge, .cart-count, #cartBadge, #cartBadgeMobile').text(res.cart_count || 0);
				if (typeof loadCart === 'function') {
					loadCart();
				}
				return;
			}

			mobileShowCartMessage((res && res.message) ? res.message : 'Them vao gio hang khong thanh cong');
		},
		error: function() {
			mobileShowCartMessage('Khong the them vao gio hang, vui long thu lai');
		}
	});

	return false;
}
