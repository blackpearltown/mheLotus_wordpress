<?php
/**
 * Slick Carousel Slider Shortcode Widget
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpsisac_Carousel_Slider_Shrt extends Wpsisac_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_id			= 'wpsisac-carousel-shrt';
		$this->widget_cssclass		= 'wpsisac-carousel-shrt';
		$this->widget_name			= __( 'Slick Carousel - Slider Shortcode', 'wp-slick-slider-and-image-carousel' );
		$this->widget_description	= __( 'Display slick slider posts in a carousel view. Slick Carousel slider shortcode.', 'wp-slick-slider-and-image-carousel' );
		$this->widget_title			= __( 'Slick Carousel Slider', 'wp-slick-slider-and-image-carousel' );
		$this->settings				= slick_carousel_slider_shortcode_fields();
		$this->defaults				= $this->default_settings();

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {

		$instance = wp_parse_args( (array)$instance, $this->defaults );
		
		$this->widget_start( $args, $instance );

		echo wpsisac_pro_carousel_slider( $instance );

		$this->widget_end( $args, $instance );
	}
}