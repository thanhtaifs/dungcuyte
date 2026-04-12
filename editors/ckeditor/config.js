/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.enterMode = CKEDITOR.ENTER_BR;
	config.language = nv_sitelang;
	config.allowedContent = true;
	config.extraPlugins = 'video,eqneditor,switchbar,tbvdownload,googledocs';
	config.entities = false;
	config.youtube_width = '640';
	config.youtube_height = '480';
	config.youtube_related = false;
	config.youtube_older = false;
	config.youtube_privacy = false;
	config.youtube_autoplay = true;
	config.codeSnippet_theme = 'github';
	config.font_names = 'Roboto/Roboto, Arial, Helvetica, sans-serif;Arial/Arial, Helvetica, sans-serif;Comic Sans MS/Comic Sans MS, cursive;Courier New/Courier New, Courier, monospace;Georgia/Georgia, serif;Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;Tahoma/Tahoma, Geneva, sans-serif;Times New Roman/Times New Roman, Times, serif;Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;Verdana/Verdana, Geneva, sans-serif';
	config.font_defaultLabel = 'Roboto';
	// Default setting.
	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'insert' },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		'/',
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'editing', groups: [ 'find', 'selection'] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'tools' }
	];

	config.toolbar_Basic =
	[
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'styles', items : [ 'Font', 'FontSize', 'TextColor', 'BGColor' ] },
		{ name: 'tools', items : ['SwitchBar',  'Maximize'] }
	];
};;

