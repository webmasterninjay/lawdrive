<?php

define('LAWDRIVE_SETTINGS_FIELD','lawdrive-settings');

class LAWDRIVE_THEME_SETTINGS extends Genesis_Admin_Boxes {

	function __construct() {

		$page_id = 'lawdrive';

		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => 'Law Drive Theme Settings',
				'menu_title'  => 'Law Drive Settings',
				)
			);

		$page_ops = array(
			'screen_icon'       => 'options-general',
			'save_button_text'  => 'Save Settings',
			'reset_button_text' => 'Reset Settings',
			'save_notice_text'  => 'Your Settings has been saved.',
			'reset_notice_text' => 'Your Settings has been reset.',
			);

		$settings_field = 'lawdrive-settings';

		$default_settings = array(
			'lawdrive-facebook' => '',
			'lawdrive-twitter' => '',
			'lawdrive-phone' => '',
			);

		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );

	}

	// SANITIZATION
	function sanitization_filters() {
		genesis_add_option_filter( 'safe_html', $this->settings_field, array(
			'lawdrive-facebook',
			'lawdrive-twitter',
			'lawdrive-phone',
			)
		);
	}

	// HELP TAB
	function help() {
		$screen = get_current_screen();
		$screen->add_help_tab( array(
			'id'      => 'lawdrive-help',
			'title'   => 'Law Drive Theme Help',
			'content' => '<p>No help option for Law Drive Theme.</p><p>- Jayson Antipuesto</p>',
			) );
	}

	// METABOXES
	function metaboxes() {
		add_meta_box('company_metabox', 'Company Details', array( $this, 'company_metabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('social_metabox', 'Social Media Options', array( $this, 'social_metabox' ), $this->pagehook, 'main', 'high');
	}

	// SOCIAL METABOX CALLBACK
	function social_metabox() { ?>

		<p><?php _e( 'Facebook URL:', 'lawdrive' );?><br />
		<input type="text" name="<?php echo LAWDRIVE_SETTINGS_FIELD; ?>[lawdrive-facebook]" value="<?php echo esc_url( genesis_get_option('lawdrive-facebook', 'lawdrive-settings') ); ?>" size="50" class="widefat" /> </p>

		<p><?php _e( 'Twitter URL:', 'lawdrive' );?><br />
		<input type="text" name="<?php echo LAWDRIVE_SETTINGS_FIELD; ?>[lawdrive-twitter]" value="<?php echo esc_url( genesis_get_option('lawdrive-twitter', 'lawdrive-settings') ); ?>" size="50" class="widefat" /> </p>

    <p><?php _e( 'Linkedin URL:', 'lawdrive' );?><br />
    <input type="text" name="<?php echo LAWDRIVE_SETTINGS_FIELD; ?>[lawdrive-linkedin]" value="<?php echo esc_url( genesis_get_option('lawdrive-linkedin', 'lawdrive-settings') ); ?>" size="50" class="widefat" /> </p>

	<?php }

	// COMPANY METABOX CALLBACK
	function company_metabox() { ?>

		<p><?php _e( 'Company Phone #:', 'lawdrive' );?><br />
		<input type="text" name="<?php echo LAWDRIVE_SETTINGS_FIELD; ?>[lawdrive-phone]" value="<?php echo strip_tags( genesis_get_option('lawdrive-phone', 'lawdrive-settings') ); ?>" size="50" class="widefat" /> </p>

	<?php }


}

function lawdrive_child_theme_settings() {
	global $_child_theme_settings;
	$_child_theme_settings = new LAWDRIVE_THEME_SETTINGS;
}
add_action( 'genesis_admin_menu', 'lawdrive_child_theme_settings' );
