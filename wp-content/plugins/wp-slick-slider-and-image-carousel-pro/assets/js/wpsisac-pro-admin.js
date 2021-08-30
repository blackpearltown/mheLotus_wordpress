jQuery( document ).ready(function($) {

	/* Media Uploader */
	$( document ).on( 'click', '.wpsisac-image-upload', function() {

		var imgfield,showfield;
		imgfield = jQuery(this).prev('input').attr('id');
		showfield = jQuery(this).parents('td').find('.wpsisac-img-view');

		if(typeof wp == "undefined" || WpsisacProAdmin.new_ui != '1' ){ /* Check for media uploader */

			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

			window.original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html) {

				if(imgfield) {

					var mediaurl = $('img',html).attr('src');
					$('#'+imgfield).val(mediaurl);
					showfield.html('<img src="'+mediaurl+'" />');
					tb_remove();
					imgfield = '';

				} else {

					window.original_send_to_editor(html);

				}
			};
			return false;

		} else {

			var file_frame;

			/*new media uploader */
			var button = jQuery(this);

			/* If the media frame already exists, reopen it. */
			if ( file_frame ) {
				file_frame.open();
			  return;
			}

			/* Create the media frame. */
			file_frame = wp.media.frames.file_frame = wp.media({
				frame: 'post',
				state: 'insert',
				title: button.data( 'uploader-title' ),
				button: {
					text: button.data( 'uploader-button-text' ),
				},
				multiple: false  /* Set to true to allow multiple files to be selected */
			});

			file_frame.on( 'menu:render:default', function(view) {
				/* Store our views in an object. */
				var views = {};

				/* Unset default menu items */
				view.unset('library-separator');
				view.unset('gallery');
				view.unset('featured-image');
				view.unset('embed');

				/* Initialize the views in our view object. */
				view.set(views);
			});

			/* When an image is selected, run a callback. */
			file_frame.on( 'insert', function() {

				/* Get selected size from media uploader */
				var selected_size = $('.attachment-display-settings .size').val();

				var selection = file_frame.state().get('selection');
				selection.each( function( attachment, index ) {
					attachment = attachment.toJSON();

					/* Selected attachment url from media uploader */
					var attachment_url = attachment.sizes[selected_size].url;

					if(index == 0){
						/* place first attachment in field */
						$('#'+imgfield).val(attachment_url);
						showfield.html('<img src="'+attachment_url+'" />');

					} else{
						$('#'+imgfield).val(attachment_url);
						showfield.html('<img src="'+attachment_url+'" />');
					}
				});
			});

			/* Finally, open the modal */
			file_frame.open();
		}
	});

	/* Clear Media */
	$( document ).on( 'click', '.wpsisac-image-clear', function() {
		$(this).parent().find('.wpsisac-img-upload-input').val('');
		$(this).parent().find('.wpsisac-img-view').html('');
	});

	/* Click to Copy the Text */
	$(document).on('click', '.wpos-copy-clipboard', function() {
		var copyText = $(this);
		copyText.select();
		document.execCommand("copy");
	});

	/* Widget Accordian */
	$(document).on('click', '.wpsisac-wdgt-accordion-header', function() {
		var target		= $(this).attr('data-target');
		var cls_ele		= $(this).closest('.wpsisac-wdgt-accordion-wrap');
		var target_open	= cls_ele.find('.wpsisac-wdgt-accordion-cnt-'+target).is(":visible");

		cls_ele.find('.wpsisac-wdgt-accordion-cnt').slideUp();
		cls_ele.find('.wpsisac-wdgt-sel-tab').val('');

		if( ! target_open ) {
			cls_ele.find('.wpsisac-wdgt-accordion-cnt-'+target).slideDown();
			cls_ele.find('.wpsisac-wdgt-sel-tab').val( target );
		}
	});

	/* WP Code Editor */
	if( WpsisacProAdmin.code_editor == 1 && WpsisacProAdmin.syntax_highlighting == 1 ) {
		jQuery('.wpos-code-editor').each( function() {
			
			var cur_ele		= jQuery(this);
			var data_mode	= cur_ele.attr('data-mode');
			data_mode		= data_mode ? data_mode : 'css';

			var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
			editorSettings.codemirror = _.extend(
				{},
				editorSettings.codemirror,
				{
					indentUnit: 2,
					tabSize: 2,
					mode: data_mode,
				}
			);
			var editor = wp.codeEditor.initialize( cur_ele, editorSettings );

			editor.codemirror.on( 'change', function( codemirror ) {
				cur_ele.val( codemirror.getValue() ).trigger( 'change' );
			});

			/* When post metabox is toggle */
			$(document).on('postbox-toggled', function( event, ele ) {
				if( $(ele).hasClass('closed') ) {
					return;
				}

				if( $(ele).find('.wpos-code-editor').length > 0 ) {
					editor.codemirror.refresh();
				}
			});
		});
	}

	/* Drag widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.preview-rendered', wpsisac_pro_fl_render_preview );

	/* Save widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.layout-rendered', wpsisac_pro_fl_render_preview );

	/* Publish button event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.didSaveNodeSettings', wpsisac_pro_fl_render_preview );
});

/* Function to render shortcode preview for Beaver Builder */
function wpsisac_pro_fl_render_preview() {
	wpsisac_pro_slick_slider_init();
	wpsisac_pro_slick_carousel_init();
	wpsisac_pro_slick_variable_init();
}