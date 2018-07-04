jQuery( document ).ready(function($) {
	"use strict";
	$('.customize-control-tinymce-editor').each(function(){
		wp.editor.initialize( $(this).attr('id'), {
			tinymce: {
				teeny: true,
				statusbar: false,
				wpautop: true,
			},
			quicktags: true
		});
	});
	$(document).on( 'tinymce-editor-init', function( event, editor ) {
		editor.on('change', function(e) {
			tinyMCE.triggerSave();
			$('#'+editor.id).trigger('change');
		});
	});
});