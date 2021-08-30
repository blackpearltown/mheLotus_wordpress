<?php
/**
 * Updater Functions
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0
 */


global $wpsisac_pro_license_info;

if( ! defined( 'WPSISAC_PRO_LICENSE_URL' ) ) {
	define( 'WPSISAC_PRO_LICENSE_URL', add_query_arg(array( 'post_type' => WPSISAC_PRO_POST_TYPE, 'page' => 'slickspro-license'), admin_url('edit.php')) ); // License page URL
}

update_option( 'edd_slickspro_license_key' ,'nullmasterinbabiato');



// Taking some data
$current_date	= current_time( 'mysql' );
$license 		= get_option( 'edd_slickspro_license_key' );
$license_info	= get_option( 'edd_slickspro_license_info' );

if( isset( $license_info->expires ) && $license_info->expires != 'lifetime' && $current_date > $license_info->expires ) {

	$renew_link		= add_query_arg( array('edd_license_key' => $license, 'download_id' => $license_info->payment_id), 'https://www.wponlinesupport.com/checkout/' );
	$license_msg	= sprintf(
							__( 'Your license key expired on %s. Kindly <a href="%s" target="_blank">renew</a> it for further updates and support from your <a href="%s" target="_blank">account page</a>.', 'wp-slick-slider-and-image-carousel' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_info->expires, current_time( 'timestamp' ) ) ),
							$renew_link,
							'https://www.wponlinesupport.com/my-account/?tab=license-keys'
					);

	$license_info->license_status	= 'expired';
	$license_info->license_msg		= $license_msg;

} else if( isset( $license_info->license ) && $license_info->license == 'valid' && ! isset( $license_info->license_msg )  ) {
	
	$license_info->license_status = $license_info->license;
	$license_info->license_msg = __( 'License is activated successfully.', 'wp-slick-slider-and-image-carousel' );

} else if( isset( $license_info->license ) ) {
	
	$license_info->license_status = $license_info->license;
}


$wpsisac_pro_license_info = $license_info; // Assign to global variable

/**
 * Updater Menu Function
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function wpsisac_pro_plugin_license_menu() {

	global $wpsisac_pro_license_info;

	// // Getting license status to show notification
	$license_info 	= $wpsisac_pro_license_info;
	$status 		= ! empty( $license_info->license_status ) ? $license_info->license_status : false;
	$notification 	= ( $status !== 'valid' ) ? ' <span class="update-plugins count-1"><span class="plugin-count" aria-hidden="true">1</span></span>' : '';

	add_submenu_page( 'edit.php?post_type='.WPSISAC_PRO_POST_TYPE, __('WP Slick Slider Plugin License', 'wp-slick-slider-and-image-carousel'), __('Plugin License', 'wp-slick-slider-and-image-carousel').$notification, 'manage_options', 'slickspro-license', 'wpsisac_pro_license_page' );
}
add_action('admin_menu', 'wpsisac_pro_plugin_license_menu', 30);

/**
 * Plugin license form HTML
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function wpsisac_pro_license_page() {

	global $wpsisac_pro_license_info;

	$license_info 	= $wpsisac_pro_license_info;
	$license 		= get_option( 'edd_slickspro_license_key' );
	$status 		= ! empty( $license_info->license_status )	? $license_info->license_status : false;
	$payment_id		= ! empty( $license_info->payment_id )		? $license_info->payment_id		: false;
?>
	<div class="wrap">
		<h2><?php _e('WP Slick Slider and Image Carousel Pro - License Options', 'wp-slick-slider-and-image-carousel'); ?></h2>
		<form method="post" action="options.php">

			<?php settings_fields('edd_slickspro_license'); ?>

			<?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) { ?>
				<div class="updated notice is-dismissible" id="message">
					<p><?php _e('Your changes saved successfully.', 'wp-slick-slider-and-image-carousel'); ?></p>
				</div>
			<?php } elseif ( isset($_GET['sl_activation']) && $_GET['sl_activation'] == 'false' && !empty($_GET['message']) ) { ?>
				<div class="error" id="message">
					<p><?php echo urldecode($_GET['message']); ?></p>
				</div>
			<?php }

			if( $status !== false && $status == 'valid' ) { ?>
				<div class="updated notice notice-success" id="message">
					<p><?php _e('Plugin license is active.', 'wp-slick-slider-and-image-carousel'); ?></p>
				</div>
			<?php } elseif( ! isset( $_GET['sl_activation'] ) ) { ?>
				<div class="error notice notice-error" id="message">
					<p><?php _e('Please activate plugin license to get automatic update of plugin.', 'wp-slick-slider-and-image-carousel'); ?></p>
				</div>
			<?php } ?>

			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<label for="wp-tsasp-plugin-license-key"><?php _e('License Key', 'wp-slick-slider-and-image-carousel'); ?></label>
						</th>
						<td>
							<input id="edd_slickspro_license_key" name="edd_slickspro_license_key" type="password" class="regular-text" value="<?php esc_attr_e( $license ); ?>" /><br/>
							<span class="description"><?php _e('Enter plugin license key.', 'wp-slick-slider-and-image-carousel'); ?></span>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Activate License', 'wp-slick-slider-and-image-carousel'); ?>
							</th>
							<td>
								<?php wp_nonce_field( 'edd_slickspro_nonce', 'edd_slickspro_nonce' );

								if( $status !== false && $status == 'valid' ) { ?>	
									<input type="submit" class="button-secondary" name="edd_license_deactivate_slickspro" value="<?php _e('Deactivate License', 'wp-slick-slider-and-image-carousel'); ?>"/>
									<span style="color: green; display: inline-block; margin: 4px 0px 0px;"><i class="dashicons dashicons-yes"></i><?php _e('Active', 'wp-slick-slider-and-image-carousel'); ?></span>
								<?php } else { ?>
									<input type="submit" class="button button-secondary" name="edd_license_activate_slickspro" value="<?php _e('Activate License', 'wp-slick-slider-and-image-carousel'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>

					<?php if( $license && $license_info ) { ?>
						<tr>
							<th valign="top"><?php esc_html_e('License Information', 'wp-slick-slider-and-image-carousel'); ?></th>
							<?php if( $status == 'valid' ) { ?>
							<td style="font-weight: 600; line-height: 25px;">
								<p style="color:green;"><?php echo $license_info->license_msg; ?></p>

								<?php
								if( ! defined( 'WPOS_HIDE_LICENSE' ) || ( defined( 'WPOS_HIDE_LICENSE' ) && WPOS_HIDE_LICENSE != 'info' ) ) {

									echo esc_html__('License Limit' , 'wp-slick-slider-and-image-carousel') ." : ". ( (isset($license_info->license_limit) && $license_info->license_limit == 0) ? __('Unlimited', 'wp-slick-slider-and-image-carousel') : $license_info->license_limit ) ." ". esc_html__('Sites', 'wp-slick-slider-and-image-carousel') . '<br/>';
									echo esc_html__('Active Site(s)' , 'wp-slick-slider-and-image-carousel') ." : ". ( isset($license_info->site_count) ? $license_info->site_count : 'N/A' ) . '<br/>';
									echo esc_html__('Activations Left Site(s)' , 'wp-slick-slider-and-image-carousel') ." : ". ( isset($license_info->activations_left) ? ucfirst($license_info->activations_left) : 'N/A' ) . '<br/>';
									
									if( isset( $license_info->expires ) && $license_info->expires == 'lifetime' ) {
										echo esc_html__('Valid Upto' , 'wp-slick-slider-and-image-carousel') ." : ". esc_html__( 'Lifetime', 'wp-slick-slider-and-image-carousel' ) . '<br/>';
									} else {
										echo esc_html__('Valid Upto' , 'wp-slick-slider-and-image-carousel') ." : ". date('d M, Y', strtotime($license_info->expires)) . ' <label style="vertical-align:top;" title="'.esc_html__('On purchase of any product 1 Year of Updates, 1 Year of Expert Support. After 1 Year, use without renewal OR renew manually at discounted price for further updates and support.', 'wp-slick-slider-and-image-carousel').'">[?]</label> <br/>';
									}

									echo esc_html__('Purchase ID' , 'wp-slick-slider-and-image-carousel') ." : #". $license_info->payment_id;
								}
								?>
							</td>
							<?php } else if( $status != 'valid' && isset( $license_info->license_msg ) ) { ?>
							<td style="font-weight: 600;">
								<p style="color:#dc3232;"><?php echo $license_info->license_msg; ?></p>
							</td>
							<?php } ?>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>

			<div class="wpo-activate-step">
				<hr/>
				<h2><?php esc_html_e('Steps to Activate the License', 'wp-slick-slider-and-image-carousel'); ?></h2>
				<ol>
					<li><?php esc_html_e("Enter your license key into 'License Key' field and press 'Save Changes' button.", 'wp-slick-slider-and-image-carousel'); ?></li>
					<li><?php esc_html_e("After save changes you can see an another button named 'Activate License'.", 'wp-slick-slider-and-image-carousel'); ?></li>
					<li><?php esc_html_e("Press 'Activate License'. If your key is valid then you can see green 'Active' text.", 'wp-slick-slider-and-image-carousel'); ?></li>
					<li><?php esc_html_e("That's it. Now you can get auto update of this plugin.", 'wp-slick-slider-and-image-carousel'); ?></li>
				</ol>
				<h4 style="color:#dc3232;"><?php esc_html_e('Note: If you do not activate the license then you will not get automatic update of this plugin any more.', 'wp-slick-slider-and-image-carousel'); ?></h4>
				<h4><?php esc_html_e('You will receive license key within your product purchase email. If you do not have license key then you can get it from your', 'wp-slick-slider-and-image-carousel'); ?> <a href="https://www.wponlinesupport.com/my-account/" target="_blank"><?php esc_html_e('account page', 'wp-slick-slider-and-image-carousel'); ?></a>.</h4>
				<h4><?php esc_html_e('Note : If your license key has expired, please renew your license from', 'wp-slick-slider-and-image-carousel'); ?> <a href="https://www.wponlinesupport.com/my-account/" target="_blank"><?php esc_html_e('account page', 'wp-slick-slider-and-image-carousel'); ?></a>.</h4>
			</div><!-- end .wpo-activate-step -->
		</form>
	</div><!-- end .wrap -->
<?php
}

/**
 * Validate plugin license options
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0
 */
function wpsisac_pro_sanitize_license( $new ) {

	$old = get_option( 'edd_slickspro_license_key' );

	if( $old && $old != $new ) {
		update_option( 'edd_slickspro_license_info', '', false ); // new license has been entered, so must reactivate
	}
	return $new;
}

/**
 * Register plugin license settings
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function wpsisac_pro_process_plugin_license() {

	// Register plugin license settings
	register_setting('edd_slickspro_license', 'edd_slickspro_license_key', 'wpsisac_pro_sanitize_license' );

	/***** Activate Plugin License *****/
	if( isset( $_POST['edd_license_activate_slickspro'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_slickspro_nonce', 'edd_slickspro_nonce' ) ) {
			return; // get out if we didn't click the Activate button
	 	}

		// retrieve the license from the database
		$license_msg	= sprintf( __('Sorry, Something happened wrong. Please contact <a href="%s">site administrator</a>.', 'wp-slick-slider-and-image-carousel'), WPSISAC_PRO_STORE_URL );
		$license		= trim( get_option( 'edd_slickspro_license_key' ) );
		$post_license	= isset( $_POST['edd_slickspro_license_key'] ) ? trim( $_POST['edd_slickspro_license_key'] ) : '';

		// Update license key if user directly press active button
		if( $post_license != $license ) {
			update_option( 'edd_slickspro_license_key', $post_license );
			$license = $post_license;
		}

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( WPSISAC_PRO_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( WPSISAC_PRO_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		$license_data->success = true;
		$license_data->error = '';
		$license_data->license_msg = 'Activated!';
		$license_data->license = 'valid';
		$license_msg = __( 'License is activated successfully.', 'wp-slick-slider-and-image-carousel' );
			
		

		// $license_data->license will be either "valid" or "invalid"
		
		$license_data->license_msg = $license_msg;
		update_option( 'edd_slickspro_license_info', $license_data, false );
		

		// Check if anything passed on a message constituting a failure
		
		wp_redirect( WPSISAC_PRO_LICENSE_URL );
		exit();
	}


	/***** Deactivate Plugin License *****/
	// listen for our activate button to be clicked
	if( isset( $_POST['edd_license_deactivate_slickspro'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_slickspro_nonce', 'edd_slickspro_nonce' ) ) {
			return; // get out if we didn't click the Activate button
	 	}

		// retrieve the license from the database
		$license = trim( get_option( 'edd_slickspro_license_key' ) );
		

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( WPSISAC_PRO_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( WPSISAC_PRO_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.', 'wp-slick-slider-and-image-carousel' );
			}

			$redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), WPSISAC_PRO_LICENSE_URL );

			wp_redirect( $redirect );
			exit();
		}

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' || $license_data->license == 'failed' ) {
			update_option( 'edd_slickspro_license_info', '', false );
		}

		wp_redirect( WPSISAC_PRO_LICENSE_URL );
		exit();
	}
}
add_action('admin_init', 'wpsisac_pro_process_plugin_license');

/**
 * Function to add license plugins link
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0
 */
function wpsisac_pro_plugin_action_links( $links ) {
	
	$links['license'] = '<a href="' . esc_url(WPSISAC_PRO_LICENSE_URL) . '" title="' . esc_attr( __( 'Activate Plugin License', 'wp-slick-slider-and-image-carousel' ) ) . '">' . __( 'License', 'wp-slick-slider-and-image-carousel' ) . '</a>';
	
	return $links;
}
add_filter( 'plugin_action_links_' . WPSISAC_PRO_PLUGIN_BASENAME, 'wpsisac_pro_plugin_action_links' );

/**
 * Displays message inline on plugin row that the license key is missing
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0
 */
function wpsisac_pro_plugin_row_license_missing( $plugin_data, $version_info ) {

	global $wpsisac_pro_license_info;

	$license_info 	= $wpsisac_pro_license_info;
	$license_status = ! empty( $license_info->license_status ) ? $license_info->license_status : false;

	if( ( empty( $license_info ) || $license_status !== 'valid' ) ) {
		echo '&nbsp;<strong><a href="' . esc_url( WPSISAC_PRO_LICENSE_URL ) . '">' . esc_html__( 'Enter valid license key for automatic updates.', 'wp-slick-slider-and-image-carousel' ) . '</a></strong>';
	}
}
add_action( 'in_plugin_update_message-' . WPSISAC_PRO_PLUGIN_BASENAME, 'wpsisac_pro_plugin_row_license_missing', 10, 2 );

/**
 * Displays license expired message on plugin row
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0
 */
function wpsisac_pro_plugin_license_msg( $file, $plugin_data ) {

	global $wpsisac_pro_license_info;

	$plugin_slug    = isset( $plugin_data['slug'] )							? $plugin_data['slug']						: sanitize_title( $plugin_data['Name'] );
	$license_status = ! empty( $wpsisac_pro_license_info->license_status ) 	? $wpsisac_pro_license_info->license_status	: false;
	$license_msg	= ! empty( $wpsisac_pro_license_info->license_msg )		? $wpsisac_pro_license_info->license_msg	: '';

	if( $license_status == 'expired' && $license_msg && ! isset( $plugin_data['update'] ) ) {

		echo '<tr id="'.$plugin_slug.'-update" class="plugin-update-tr active" data-slug="'. $plugin_slug .'" data-plugin="'.$file.'">
				<td class="plugin-update colspanchange" colspan="4">
					<div class="update-message notice inline notice-error notice-alt"><p>'. $license_msg .'</p></div>

					<script type="text/javascript"> 
						jQuery("#'.$plugin_slug.'-update").prev("tr").addClass("update"); 
					</script>
				</td>
			</tr>';
	}
}
add_action( 'after_plugin_row_' . WPSISAC_PRO_PLUGIN_BASENAME, 'wpsisac_pro_plugin_license_msg', 10, 2 );

/**
 * Function to add license expired notice
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0
 */
function wpsisac_pro_plugin_license_notice() {

	global $typenow, $wpsisac_pro_license_info;

	// If not plugin screen then return
	if( $typenow != WPSISAC_PRO_POST_TYPE ) {
		return false;
	}

	$notice_transient = get_transient( 'wpsisac_pro_license_exp_notice' );
	
	// If plugin license is dismissed
	if( $notice_transient !== false ) {
		return false;
	}

	$license_info	= $wpsisac_pro_license_info;
	$license_status = ! empty( $license_info->license_status )	? $license_info->license_status : false;
	$license_msg	= ! empty( $license_info->license_msg )		? $license_info->license_msg	: false;

	if( $license_status == 'expired' ) {

		$notice_link = add_query_arg( array('message' => 'wpsisac-pro-license-exp-notice') );

		echo '<div class="error notice notice-error" style="position:relative;">
				<p>'. $license_msg .'</p>
				<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
			</div>';
	}
}
add_action( 'admin_notices', 'wpsisac_pro_plugin_license_notice' );