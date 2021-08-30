<?php
/**
 * Shortcode Widget Functionality
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once( WPSISAC_PRO_DIR . '/includes/widgets/shortcode/class-wpsisac-abstract-widget.php' );
require_once( WPSISAC_PRO_DIR . '/includes/widgets/shortcode/class-wpsisac-slider.php' );
require_once( WPSISAC_PRO_DIR . '/includes/widgets/shortcode/class-wpsisac-carousel.php' );
require_once( WPSISAC_PRO_DIR . '/includes/widgets/shortcode/class-wpsisac-variable-slider.php' );

/**
 * Register Shortcode Widgets
 */
function wpsisac_register_shortcode_widgets() {
	register_widget( 'Wpsisac_Slider_Shrt' );
	register_widget( 'Wpsisac_Carousel_Slider_Shrt' );
	register_widget( 'Wpsisac_Variable_Slider_Shrt' );
}
add_action( 'widgets_init', 'wpsisac_register_shortcode_widgets' );