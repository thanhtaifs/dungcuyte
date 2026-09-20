/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC ( contact@vinades.vn )
 * @Copyright ( C ) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 9 - 8 - 2013 15 : 40
 */

$(document).ready(function() {
	initSeoCounters();

	$("#publ_date,#exp_date").datepicker({
		showOn : "both",
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
		buttonImage : nv_siteroot + "images/calendar.gif",
		buttonImageOnly : true
	});

	$("#gift_from, #gift_to").datepicker({
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
		showOn : 'focus'
	});
	$('#to-btn').click(function(){
		$("#to").datepicker('show');
	});
	$('#from-btn').click(function(){
		$("#from").datepicker('show');
	});

	$("#keywords-search").bind("keydown", function(event) {
		if (event.keyCode === $.ui.keyCode.TAB && $(this).data("ui-autocomplete").menu.active) {
			event.preventDefault();
		}

		if (event.keyCode == 13) {
			var keywords_add = $("#keywords-search").val();
			keywords_add = trim(keywords_add);
			if (keywords_add != '') {
				nv_add_element('keywords', keywords_add, keywords_add);
				$(this).val('');
			}
			return false;
		}

	}).autocomplete({
		source : function(request, response) {
			$.getJSON(script_name + "?" + nv_name_variable + "=" + nv_module_name + "&" + nv_fc_variable + "=tagsajax", {
				term : extractLast(request.term)
			}, response);
		},
		search : function() {
			// custom minLength
			var term = extractLast(this.value);
			if (term.length < 2) {
				return false;
			}
		},
		focus : function() {
			//no action
		},
		select : function(event, ui) {
			// add placeholder to get the comma-and-space at the end
			if (event.keyCode != 13) {
				nv_add_element('keywords', ui.item.value, ui.item.value);
				$(this).val('');
			}
			return false;
		}
	});

	$("#keywords-search").blur(function() {
		// add placeholder to get the comma-and-space at the end
		var keywords_add = $("#keywords-search").val();
		keywords_add = trim(keywords_add);
		if (keywords_add != '') {
			nv_add_element('keywords', keywords_add, keywords_add);
			$(this).val('');
		}
		return false;
	});
	$("#keywords-search").bind("keyup", function(event) {
		var keywords_add = $("#keywords-search").val();
		if (keywords_add.search(',') > 0) {
			keywords_add = keywords_add.split(",");
			for ( i = 0; i < keywords_add.length; i++) {
				var str_keyword = trim(keywords_add[i]);
				if (str_keyword != '') {
					nv_add_element('keywords', str_keyword, str_keyword);
				}
			}
			$(this).val('');
		}
		return false;
	});

});

function initSeoCounters() {
	var counterFields = {
		title: $('#idtitle'),
		hometext: $('#shops_hometext, #hometext'),
		bodytext: $('#shops_bodytext, #bodytext')
	};

	$.each(counterFields, function(type, field) {
		if (!field.length) {
			return;
		}

		var updateCounter = function(value) {
			var counter = $('[data-seo-counter="' + type + '"]');
			var text = $('<div>').html(value || '').text().replace(/\s+/g, ' ').trim();
			var count = Array.from(text).length;
			var min = parseInt(counter.data('min'), 10) || 0;
			var max = parseInt(counter.data('max'), 10) || 0;
			var state = count < min ? 'bad' : (max && count > max ? 'warn' : 'good');

			counter.removeClass('seo-counter--good seo-counter--warn seo-counter--bad')
				.addClass('seo-counter--' + state)
				.text(type === 'bodytext' ? 'Đã nhập ' + count + ' ký tự (khuyến nghị tối thiểu ' + min + ')' : 'Đã nhập ' + count + ' ký tự (khuyến nghị ' + min + '-' + max + ')');
		};

		field.on('input keyup change', function() {
			updateCounter(field.val());
		});
		updateCounter(field.val());

		if (typeof CKEDITOR !== 'undefined') {
			var editor = CKEDITOR.instances[field.attr('id')];
			if (editor) {
				editor.on('change key', function() {
					updateCounter(editor.getData());
				});
				editor.on('instanceReady', function() {
					updateCounter(editor.getData());
				});
			}
		}
	});
}

function split(val) {
	return val.split(/,\s*/);
}

function extractLast(term) {
	return split(term).pop();
}

function nv_add_element(idElment, key, value) {
	var html = "<span title=\"" + value + "\" class=\"uiToken removable\">" + value + "<input type=\"hidden\" value=\"" + key + "\" name=\"" + idElment + "[]\" autocomplete=\"off\"><a onclick=\"$(this).parent().remove();\" href=\"javascript:void(0);\" class=\"remove uiCloseButton uiCloseButtonSmall\"></a></span>";
	$("#" + idElment).append(html);
	return false;
};