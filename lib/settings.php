<?php

define('BULLDOGCONTRACTOR_SETTINGS_FIELD','bulldogcontractor-settings');

class BULLDOGCONTRACTOR_SETTINGS extends Genesis_Admin_Boxes {

	function __construct() {

		$page_id = 'bulldogcontractor';

		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => 'Bulldog Contractor Settings',
				'menu_title'  => 'Bulldog Contractor',
				)
			);

		$page_ops = array(
			'screen_icon'       => 'options-general',
			'save_button_text'  => 'Save Settings',
			'reset_button_text' => 'Reset Settings',
			'save_notice_text'  => 'Your Settings has been saved.',
			'reset_notice_text' => 'Your Settings has been reset.',
			);

		$settings_field = 'bulldogcontractor-settings';

		$default_settings = array(
			'bulldogcontractor-facebook' => '',
			'bulldogcontractor-twitter' => '',
			'bulldogcontractor-linkedin' => '',
			'bulldogcontractor-googleplus' => '',
			'bulldogcontractor-youtube' => '',
			'bulldogcontractor-yelp' => '',
			'bulldogcontractor-mnphone' => '',
			'bulldogcontractor-cophone' => '',
			'bulldogcontractor-txphone' => '',
			'bulldogcontractor-tfphone' => '',
			'bulldogcontractor-tagline' => '',
			'bulldogcontractor-marquee-text' => '',
			'bulldogcontractor-locations' => '',
			'bulldogcontractor-projects-url' => '',
			);

		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );

	}

	// SANITIZATION
	function sanitization_filters() {
		genesis_add_option_filter( 'safe_html', $this->settings_field, array(
			'bulldogcontractor-facebook',
			'bulldogcontractor-twitter',
			'bulldogcontractor-linkedin',
			'bulldogcontractor-googleplus',
			'bulldogcontractor-youtube',
			'bulldogcontractor-yelp',
			'bulldogcontractor-mnphone',
			'bulldogcontractor-cophone',
			'bulldogcontractor-txphone',
			'bulldogcontractor-tfphone',
			'bulldogcontractor-tagline',
			'bulldogcontractor-marquee-text',
			'bulldogcontractor-locations',
			'bulldogcontractor-projects-url'
			)
		);
	}

	// HELP TAB
	function help() {
		$screen = get_current_screen();
		$screen->add_help_tab( array(
			'id'      => 'bulldogcontractor-help',
			'title'   => 'Bulldog Contractor Help',
			'content' => '<p>No help option for Bulldog Contractor.</p><p>- Jayson Antipuesto</p>',
			) );
	}

	// METABOXES
	function metaboxes() {
		add_meta_box('company_metabox', 'Company Details', array( $this, 'company_metabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('social_metabox', 'Social Media Options', array( $this, 'social_metabox' ), $this->pagehook, 'main', 'high');
	}

	// SOCIAL METABOX CALLBACK
	function social_metabox() { ?>

		<p><?php _e( 'Facebook URL:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-facebook]" value="<?php echo esc_url( genesis_get_option('bulldogcontractor-facebook', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>

		<p><?php _e( 'Twitter URL:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-twitter]" value="<?php echo esc_url( genesis_get_option('bulldogcontractor-twitter', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>

		<p><?php _e( 'Linkedin URL:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-linkedin]" value="<?php echo esc_url( genesis_get_option('bulldogcontractor-linkedin', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>

		<p><?php _e( 'Google+ URL:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-googleplus]" value="<?php echo esc_url( genesis_get_option('bulldogcontractor-googleplus', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>

		<p><?php _e( 'Youtube URL:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-youtube]" value="<?php echo esc_url( genesis_get_option('bulldogcontractor-youtube', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>
		
		<p><?php _e( 'Yelp URL:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-yelp]" value="<?php echo esc_url( genesis_get_option('bulldogcontractor-yelp', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>
		
		<p><?php _e( 'Project List URL:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-projects-url]" value="<?php echo esc_url( genesis_get_option('bulldogcontractor-projects-url', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>

	<?php }

	// COMPANY METABOX CALLBACK
	function company_metabox() { ?>

		<p><?php _e( 'Minnesota Phone #:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-mnphone]" value="<?php echo strip_tags( genesis_get_option('bulldogcontractor-mnphone', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>

		<p><?php _e( 'Colorado Phone #:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-cophone]" value="<?php echo strip_tags( genesis_get_option('bulldogcontractor-cophone', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>
		
		<p><?php _e( 'Texas Phone #:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-txphone]" value="<?php echo strip_tags( genesis_get_option('bulldogcontractor-txphone', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>
		
		<p><?php _e( 'Toll Free Phone #:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-tfphone]" value="<?php echo strip_tags( genesis_get_option('bulldogcontractor-tfphone', 'bulldogcontractor-settings') ); ?>" size="50" class="widefat" /> </p>

		<p><?php _e( 'Tagline:', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-tagline]" value="<?php echo genesis_get_option('bulldogcontractor-tagline', 'bulldogcontractor-settings'); ?>" size="50" class="widefat" /> </p>

		<p><?php _e( 'Marquee Text: (plugin short code)', 'bulldogcontractor' );?><br />
		<input type="text" name="<?php echo BULLDOGCONTRACTOR_SETTINGS_FIELD; ?>[bulldogcontractor-marquee-text]" value="<?php echo genesis_get_option('bulldogcontractor-marquee-text', 'bulldogcontractor-settings'); ?>" size="50" class="widefat" /> </p>
		
		<p><?php _e( 'Locations:', 'bulldogcontractor' );?><br />
		
	<?php
		
		$locations_value = genesis_get_option('bulldogcontractor-locations', 'bulldogcontractor-settings');
		$locations_id = 'bulldogcontractor-locations';		
		$args = array(
			'textarea_rows' => 5,
			'textarea_name' => 'bulldogcontractor-settings[bulldogcontractor-locations]'
		);
			
		wp_editor( $locations_value, $locations_id, $args );

	}


}

function bulldogcontractor_settings() {
	global $_child_theme_settings;
	$_child_theme_settings = new BULLDOGCONTRACTOR_SETTINGS;
}
add_action( 'genesis_admin_menu', 'bulldogcontractor_settings' );
