<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpsisac_Pro_Script {

	function __construct() {

		// Action to add style and script in backend
		add_action( 'admin_enqueue_scripts', array( $this, 'wpsisac_pro_admin_style_script' ) );

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpsisac_pro_front_style' ) );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpsisac_pro_front_script' ) );

		// Action to add admin script and style when edit with elementor at admin side
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'wpsisac_pro_admin_builder_script_style' ) );

		// Action to add admin script and style when edit with SiteOrigin at admin side
		add_action( 'siteorigin_panel_enqueue_admin_scripts', array( $this, 'wpsisac_pro_admin_builder_script_style' ), 10, 2 );

		// Action to add custom css in head
		add_action( 'wp_head', array( $this, 'wpsisac_pro_add_custom_css' ), 20 );
	}

	/**
	 * Function to register admin scripts and styles
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.6
	 */
	function wpsisac_pro_register_admin_assets() {

		global $wp_version;

		// Check wordpress version for older scripts
		$new_ui = $wp_version >= '3.5' ? '1' : '0';

		/* Styles */
		// Registring admin css
		wp_register_style( 'wpsisac-pro-admin-style', WPSISAC_PRO_URL.'assets/css/wpsisac-pro-admin.css', array(), WPSISAC_PRO_VERSION );

		/* Scripts */
		// Registring admin script
		wp_register_script( 'wpsisac-pro-admin-script', WPSISAC_PRO_URL.'assets/js/wpsisac-pro-admin.js', array('jquery'), WPSISAC_PRO_VERSION, true );
		wp_localize_script( 'wpsisac-pro-admin-script', 'WpsisacProAdmin', array(
																'new_ui'				=>	$new_ui,
																'code_editor'			=> ( version_compare( $wp_version, '4.9' ) >= 0 ) ? 1 : 0,
																'syntax_highlighting'	=> ( 'false' === wp_get_current_user()->syntax_highlighting ) ? 0 : 1,
															));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.2.5
	 */
	function wpsisac_pro_admin_style_script( $hook ) {

		global $typenow, $wp_query, $post_type, $wp_version;

		$this->wpsisac_pro_register_admin_assets();

		// Use minified libraries if SCRIPT_DEBUG is turned off
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '_' : '.min';

		// If page is plugin setting page then enqueue script
		if( $typenow == WPSISAC_PRO_POST_TYPE ) {

			// Registring admin script
			wp_enqueue_style( 'wpsisac-pro-admin-style' );

			// Registring admin script
			wp_register_script( 'wpsisac-pro-ordering', WPSISAC_PRO_URL . 'assets/js/wpsisac-pro-ordering.js', array( 'jquery-ui-sortable' ), WPSISAC_PRO_VERSION, true );

			wp_register_script( 'wpsisac-shortcode-mapper', WPSISAC_PRO_URL."assets/js/wpsisac-shrt-mapper{$suffix}.js", array('jquery'), WPSISAC_PRO_VERSION, true );
			wp_localize_script( 'wpsisac-shortcode-mapper', 'Wpsisac_Shrt_Mapper', array(
																	'shortocde_err' => __("Sorry, Something happened wrong. Kindly please be sure that you have choosen relevant shortocde from the dropdown.", 'wp-slick-slider-and-image-carousel'),
															));
		
			// Slider sorting - only when sorting by menu order on the blog listing page
			if ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
				wp_enqueue_script( 'wpsisac-pro-ordering' );
			}
		
			// If page is plugin setting page then enqueue script
			if( ( version_compare( $wp_version, '4.9' ) >= 0 ) && $hook == WPSISAC_PRO_POST_TYPE . '_page_wpsisac-pro-settings' ) {

				// WP CSS Code Editor
				wp_enqueue_code_editor( array(
					'type' 			=> 'text/css',
					'codemirror' 	=> array(
						'indentUnit' 	=> 2,
						'tabSize'		=> 2,
						'lint'			=> false,
					),
				) );

				wp_enqueue_script( 'wpsisac-pro-admin-script' );
				wp_enqueue_media(); // For media uploader
			}
		}
		
		// Getting Started Page
		if( $hook == WPSISAC_PRO_POST_TYPE.'_page_wpsisacm-designs' ) {
			wp_enqueue_script( 'wpsisac-pro-admin-script' );
		}

		// Shortcode Builder
		if( $hook == WPSISAC_PRO_POST_TYPE . '_page_wpsisac-shrt-mapper' ) {
			wp_enqueue_script('shortcode');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('wpsisac-shortcode-mapper');
		}

		// VC Page Builder Frontend
		if( function_exists('vc_is_inline') && vc_is_inline() ) {
			wp_register_script( 'wpsisac-vc', WPSISAC_PRO_URL . 'assets/js/vc/wpsisac-vc.js', array(), WPSISAC_PRO_VERSION, true );
			wp_enqueue_script( 'wpsisac-vc' );
		}
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.0.0
	 */
	function wpsisac_pro_front_style() {

		// Use minified libraries if SCRIPT_DEBUG is turned off
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '_' : '.min';

		// Registring and enqueing slick slider css
		if( ! wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WPSISAC_PRO_URL.'assets/css/slick.css', array(), WPSISAC_PRO_VERSION );
		}

		// Registring and enqueing public css
		wp_register_style( 'wpsisac-pro-public-style', WPSISAC_PRO_URL."assets/css/wpsisac-pro-public{$suffix}.css", array(), WPSISAC_PRO_VERSION );
		wp_enqueue_style( 'wpsisac-pro-public-style' );

		wp_enqueue_style( 'wpos-slick-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.0.0
	 */
	function wpsisac_pro_front_script() {

		global $post;

		// Use minified libraries if SCRIPT_DEBUG is turned off
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '_' : '.min';

		// Registring slick slider script
		if( ! wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPSISAC_PRO_URL.'assets/js/slick.min.js', array('jquery'), WPSISAC_PRO_VERSION, true );
		}

		// Register Elementor script
		wp_register_script( 'wpsisac-pro-elementor-script', WPSISAC_PRO_URL.'assets/js/elementor/wpsisac-pro-elementor.js', array('jquery'), WPSISAC_PRO_VERSION, true );

		// Registring and enqueing public script
		wp_register_script( 'wpsisac-pro-public-script', WPSISAC_PRO_URL."assets/js/wpsisac-pro-public{$suffix}.js", array('jquery'), WPSISAC_PRO_VERSION, true );
		wp_localize_script( 'wpsisac-pro-public-script', 'Wpsisac_Pro', array(
																		'is_mobile' => (wp_is_mobile()) ? 1 : 0,
																		'is_rtl' 	=> (is_rtl()) 		? 1 : 0
																	));

		// VC Page Builder Frontend
		if( function_exists('vc_is_inline') && vc_is_inline() ) {
			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'wpsisac-pro-public-script' );
		}

		// Enqueue Script for Elementor Preview
		if ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_GET['elementor-preview'] ) && $post->ID == (int) $_GET['elementor-preview'] ) {

			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'wpsisac-pro-public-script' );
			wp_enqueue_script( 'wpsisac-pro-elementor-script' );
		}

		// Enqueue Style & Script for Beaver Builder
		if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {

			$this->wpsisac_pro_register_admin_assets();

			wp_enqueue_style( 'wpsisac-pro-admin-style');
			wp_enqueue_script( 'wpsisac-pro-admin-script' );
			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'wpsisac-pro-public-script' );
		}
		
		// Enqueue Admin Style & Script for Divi Page Builder
		if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_GET['et_fb'] ) && $_GET['et_fb'] == 1 ) {
			$this->wpsisac_pro_register_admin_assets();

			wp_enqueue_style( 'wpsisac-pro-admin-style');
		}
		
		// Enqueue Admin Style for Fusion Page Builder
		if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) ) ) {
			$this->wpsisac_pro_register_admin_assets();

			wp_enqueue_style( 'wpsisac-pro-admin-style');
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.6
	 */
	function wpsisac_pro_admin_builder_script_style() {

		$this->wpsisac_pro_register_admin_assets();

		wp_enqueue_style( 'wpsisac-pro-admin-style');
		wp_enqueue_script( 'wpsisac-pro-admin-script' );
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.2.5
	 */
	function wpsisac_pro_add_custom_css() {

		$custom_css = wpsisac_pro_get_option('custom_css');

		if( ! empty( $custom_css ) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wpsisac_pro_script = new Wpsisac_Pro_Script();