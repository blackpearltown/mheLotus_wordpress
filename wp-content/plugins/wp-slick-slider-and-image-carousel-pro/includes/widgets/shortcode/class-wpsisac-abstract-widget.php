<?php
/**
 * Widget Class
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Wpsisac_Widget
 *
 * @extends  WP_Widget
 */
abstract class Wpsisac_Widget extends WP_Widget {

	/**
	 * Widget Title.
	 *
	 * @var string
	 */
	public $widget_title;

	/**
	 * CSS class.
	 *
	 * @var string
	 */
	public $widget_cssclass;

	/**
	 * Widget description.
	 *
	 * @var string
	 */
	public $widget_description;

	/**
	 * Widget ID.
	 *
	 * @var string
	 */
	public $widget_id;

	/**
	 * Widget name.
	 *
	 * @var string
	 */
	public $widget_name;

	/**
	 * Settings.
	 *
	 * @var array
	 */
	public $settings;

	/**
	 * Settings defaults.
	 *
	 * @var array
	 */
	public $defaults;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'						=> $this->widget_cssclass,
			'description'					=> $this->widget_description,
			'customize_selective_refresh'	=> true,
		);

		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );
	}

	/**
	 * Get default settings
	 *
	 */
	public function default_settings() {

		// Taking some defaults
		$default_fields = array(
								'title' => $this->widget_title
								);
		$fields			= $this->settings;

		// Creating defaults
		if( ! empty( $fields ) ) {
			foreach ( $fields as $field_key => $field_val ) {

				if( ! empty( $field_val['params'] ) ) {
					foreach ( $field_val['params'] as $param_key => $param_val ) {
						
						// If no shortcode paramter name is set
						if( empty( $param_val['name'] ) ) {
							continue;
						}

						if( isset( $param_val['default'] ) ) {
							$default_field_val = $param_val['default'];
						} else if ( isset( $param_val['value'] ) && is_scalar( $param_val['value'] ) ) {
							$default_field_val = $param_val['value'];
						} else if ( isset( $param_val['value'] ) && is_array( $param_val['value'] ) ) {
							$default_field_val = key( $param_val['value'] );
						} else {
							$default_field_val = '';
						}

						$default_fields[ $param_val['name'] ] = $default_field_val;

					} // End of inner for each

					// Some extra parameter
					$default_fields['tab'] = 'general';
				}
			}
		}

		return $default_fields;
	}

	/**
	 * Output the html at the start of a widget.
	 *
	 * @param array $args Arguments.
	 * @param array $instance Instance.
	 */
	public function widget_start( $args, $instance ) {

		echo $args['before_widget'];

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
	}

	/**
	 * Output the html at the end of a widget.
	 *
	 * @param  array $args Arguments.
	 */
	public function widget_end( $args, $instance ) {
		echo $args['after_widget'];
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @see    WP_Widget->update
	 * @param  array $new_instance New instance.
	 * @param  array $old_instance Old instance.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$instance 		= $old_instance;
		$new_instance	= wp_parse_args( (array)$new_instance, $this->defaults );
		
		if ( empty( $this->settings ) ) {
			return $instance;
		}

		// Loop settings and get values to save.
		foreach ( $this->settings as $key => $setting ) {

			if( ! empty( $setting['params'] ) ) {
				foreach ( $setting['params'] as $param_key => $param_val ) {
					
					// If shortcode paramter name or field type is not set
					if( empty( $param_val['name'] ) || empty( $param_val['type'] ) ) {
						continue;
					}

					$param_name = $param_val['name'];

					// Format the value based on settings type.
					switch ( $param_val['type'] ) {
						case 'number':
							
							// Min validation
							if( isset( $param_val['min'] ) && $new_instance[ $param_name ] < $param_val['min'] ) {
								$new_instance[ $param_name ] = $param_val['min'];
							}

							// Max Validation
							if( isset( $param_val['max'] ) && $new_instance[ $param_name ] > $param_val['max'] ) {
								$new_instance[ $param_name ] = $param_val['max'];
							}

							$validation					= isset( $param_val['validation'] )	? $param_val['validation']	: 'int';
							$default_value				= isset( $param_val['value'] )		? $param_val['value']		: '';
							$instance[ $param_name ]	= wpsisac_pro_clean_number( $new_instance[ $param_name ], $default_value, $validation );
							break;

						case 'textarea':
							$instance[ $param_name ] = sanitize_textarea_field( $new_instance[ $param_name ] );
							break;

						case 'colorpicker':
							$default_value				= isset( $param_val['value'] )				? $param_val['value']			: '';
							$color_value				= ! empty( $new_instance[ $param_name ] )	? $new_instance[ $param_name ]	: $default_value;
							$instance[ $param_name ]	= sanitize_hex_color( trim( $color_value ) );
							break;

						case 'checkbox':
							$instance[ $param_name ] = empty( $new_instance[ $param_name ] ) ? 0 : 1;
							break;

						default:
							$instance[ $param_name ] = isset( $new_instance[ $param_name ] ) ? wpsisac_pro_clean( $new_instance[ $param_name ] ) : '';
							break;
					}					
				}
			}
		}

		// Extra parameter
		$instance['title']	= wpsisac_pro_clean( $new_instance['title'] );
		$instance['tab']	= wpsisac_pro_clean( $new_instance['tab'] );

		return $instance;
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @see   WP_Widget->form
	 *
	 * @param array $instance Instance.
	 */
	public function form( $instance ) {

		if ( empty( $this->settings ) ) {
			return;
		}

		// Merge with dafaults
		$title_field_render	= false;
		$instance			= wp_parse_args( (array)$instance, $this->defaults );

		// HTML start
		echo '<div class="wpsisac-wdgt-accordion-wrap wpsisac-widget-wrap">';

		foreach ($this->settings as $setting_key => $setting_data) {

			$section_title 	= isset( $setting_data['title'] ) 		? $setting_data['title'] 			: '';
			$section_params	= !empty( $setting_data['params'] )		? (array) $setting_data['params'] 	: '';
			$section_class	= ( $instance['tab'] != $setting_key )	? 'wpsisac-hide'						: '';

			if( ! $section_params ) {
				continue;
			}

			echo '<div class="wpsisac-wdgt-accordion-header wpsisac-wdgt-accordion-header-'.$setting_key.'" data-target="'.$setting_key.'"><i class="dashicons dashicons-admin-generic"></i> '.$section_title.'<i class="dashicons dashicons-arrow-down-alt2" title="'. esc_html__('Click to toggle', 'wp-responsive-recent-post-slider') .'"></i></div>';
			echo '<div class="wpsisac-wdgt-accordion-cnt wpsisac-wdgt-accordion-cnt-'.$setting_key .' '. $section_class.'">';

			// Title Field For Widget
			if( ! $title_field_render ) {
			echo '<p>
					<label for="'. wpsisac_pro_esc_attr( $this->get_field_id( 'title' ) ) .'">' . __('Title', 'wp-responsive-recent-post-slider') . ':</label>
					<input class="widefat wpsisac-widget-title-inp" id="'. wpsisac_pro_esc_attr( $this->get_field_id( 'title' ) ) .'" name="'.wpsisac_pro_esc_attr( $this->get_field_name( 'title' ) ).'" type="text" value="'. wpsisac_pro_esc_attr( $instance['title'] ) .'" />
				</p>';

				$title_field_render = true;
			}

			foreach ($section_params as $param_key => $param_val) {

				// If field name is not there then return
				if( empty($param_val['name']) ) {
					continue;
				}

				$name		= $param_val['name'];
				$desc		= !empty( $param_val['desc'] ) 		? $param_val['desc']			: '';
				$heading	= !empty( $param_val['heading'] )	? $param_val['heading']			: '';
				$value		= isset( $instance[ $name ] )		? $instance[ $name ]			: '';
				$class 		= !empty( $param_val['class'] ) 	? 'wpsisac-'.$name.' '.$param_val['class'] : 'wpsisac-'.$name;

				switch ( $param_val['type'] ) {

					case 'text':
						?>
						<p>
							<label for="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>"><?php echo $heading; ?>:</label>
							<input class="widefat <?php echo wpsisac_pro_esc_attr( $class ); ?>" id="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>" name="<?php echo wpsisac_pro_esc_attr( $this->get_field_name( $name ) ); ?>" type="text" value="<?php echo wpsisac_pro_esc_attr( $value ); ?>" />
							<?php if( $desc ) { ?><em><?php echo $desc; ?></em><?php } ?>
						</p>
						<?php
						break;

					case 'number':
						?>
						<p>
							<label for="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>"><?php echo $heading; ?>:</label>
							<input class="widefat <?php echo wpsisac_pro_esc_attr( $class ); ?>" id="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>" name="<?php echo wpsisac_pro_esc_attr( $this->get_field_name( $name ) ); ?>" type="text" value="<?php echo wpsisac_pro_esc_attr( $value ); ?>" />
							<?php if( $desc ) { ?><em><?php echo $desc; ?></em><?php } ?>
						</p>
						<?php
						break;

					case 'dropdown':
						?>
						<p>
							<label for="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>"><?php echo $heading; ?>:</label><br/>
							<select class="widefat <?php echo wpsisac_pro_esc_attr( $class ); ?>" id="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>" name="<?php echo wpsisac_pro_esc_attr( $this->get_field_name( $name ) ); ?>">
								<?php foreach ( $param_val['value'] as $option_key => $option_value ) : ?>
									<option value="<?php echo wpsisac_pro_esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
								<?php endforeach; ?>
							</select><br/>
							<?php if( $desc ) { ?><em><?php echo $desc; ?></em><?php } ?>
						</p>
						<?php
						break;

					case 'textarea':
						?>
						<p>
							<label for="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>"><?php echo $heading; ?>:</label>
							<textarea class="widefat <?php echo wpsisac_pro_esc_attr( $class ); ?>" id="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>" name="<?php echo wpsisac_pro_esc_attr( $this->get_field_name( $name ) ); ?>" cols="20" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
							<?php if( $desc ) { ?><em><?php echo $desc; ?></em><?php } ?>
						</p>
						<?php
						break;

					case 'checkbox':
						?>
						<p>
							<input class="checkbox <?php echo wpsisac_pro_esc_attr( $class ); ?>" id="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>" name="<?php echo wpsisac_pro_esc_attr( $this->get_field_name( $name ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
							<label for="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>"><?php echo $heading; ?></label>
							<?php if( $desc ) { ?><em><?php echo $desc; ?></em><?php } ?>
						</p>
						<?php
						break;

					case 'colorpicker':
						?>
						<p>
							<label for="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>"><?php echo $heading; ?>:</label><br/>
							<input class="wpsisac-wdgt-color-box <?php echo wpsisac_pro_esc_attr( $class ); ?>" id="<?php echo wpsisac_pro_esc_attr( $this->get_field_id( $name ) ); ?>" name="<?php echo wpsisac_pro_esc_attr( $this->get_field_name( $name ) ); ?>" type="text" value="<?php echo wpsisac_pro_esc_attr( $value ); ?>" />
							<?php if( $desc ) { ?><br/><em><?php echo $desc; ?></em><?php } ?>
						</p>
						<?php
						break;
				}
			}

			echo '</div><!-- end .wpsisac-wdgt-accordion-cnt -->';

		} // End of main foreach

		echo '<input type="hidden" name="'.$this->get_field_name('tab').'" value="'.wpsisac_pro_esc_attr( $instance['tab'] ).'" class="wpsisac-wdgt-sel-tab" />';
		echo '<input type="hidden" name="'.$this->get_field_name('refresh').'" value="" class="wpsisac-wdgt-refresh-inp" />';
		echo '</div><!-- end .wpsisac-wdgt-accordion-wrap -->';
	}
}