( function($) {

	'use strict';

	jQuery(window).on('elementor/frontend/init', function() {

		/* Shortcode Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/shortcode.default', function() {
			wpsisac_pro_slick_slider_init();
			wpsisac_pro_slick_carousel_init();
			wpsisac_pro_slick_variable_init();
		});

		/* Text Editor Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/text-editor.default', function() {
			wpsisac_pro_slick_slider_init();
			wpsisac_pro_slick_carousel_init();
			wpsisac_pro_slick_variable_init();
		});

		/* Tabs Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/tabs.default', function() {

			$('.wpsisac-slick-init').each(function( index ) {

				var slider_id = $(this).attr('id');
				$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

				wpsisac_pro_slick_slider_init();
				wpsisac_pro_slick_carousel_init();
				wpsisac_pro_slick_variable_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id).slick( 'setPosition' );
						$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 300);
			});
		});

		/* Accordion Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/accordion.default', function() {

			$('.wpsisac-slick-init').each(function( index ) {

				var slider_id = $(this).attr('id');
				$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

				wpsisac_pro_slick_slider_init();
				wpsisac_pro_slick_carousel_init();
				wpsisac_pro_slick_variable_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id).slick( 'setPosition' );
						$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 300);
			});
		});

		/* Toggle Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/toggle.default', function() {

			$('.wpsisac-slick-init').each(function( index ) {

				var slider_id = $(this).attr('id');
				$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

				wpsisac_pro_slick_slider_init();
				wpsisac_pro_slick_carousel_init();
				wpsisac_pro_slick_variable_init();

				setTimeout(function() {

					/* Tweak for slick slider */
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id).slick( 'setPosition' );
						$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 300);
			});
		});

		/* Slick Slider Shortcode Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/wp-widget-wpsisac-slider-shrt.default', function() {
			wpsisac_pro_slick_slider_init();
		});

		/* Slick Carousel Slider Shortcode Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/wp-widget-wpsisac-carousel-shrt.default', function() {
			wpsisac_pro_slick_carousel_init();
		});

		/* Slick Variable Slider Shortcode Element */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/wp-widget-wpsisac-variable-shrt.default', function() {
			wpsisac_pro_slick_variable_init();
		});
	});
})(jQuery);