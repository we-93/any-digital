<?php
/**
 * Plugin Name:       Any Digital
 * Plugin URI:        https://anydigital.id
 * Description:       Plugin Elementor Addon untuk Any Digital yang menyediakan widget Copy Text, Cover Undangan, Countdown Timer, Timeline Story, Date Kit 2, WhatsApp Button, dan Scroll Navigation.
 * Version:           1.0.0
 * Author:            Any Digital
 * Author URI:        https://anydigital.id
 * Text Domain:       any-digital
 * Domain Path:       /languages
 * Requires at least: 5.8
 * Requires PHP:      7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access prevention
}

define( 'ANY_DIGITAL_VERSION', '1.0.0' );
define( 'ANY_DIGITAL_PATH', plugin_dir_path( __FILE__ ) );
define( 'ANY_DIGITAL_URL', plugin_dir_url( __FILE__ ) );

/**
 * Initialize Any Digital Plugin after all plugins are loaded.
 */
function any_digital_init() {
	// Check if Elementor is active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'any_digital_fail_load_elementor' );
		return;
	}

	require_once ANY_DIGITAL_PATH . 'includes/class-any-digital.php';
	Any_Digital::instance();
}
add_action( 'plugins_loaded', 'any_digital_init' );

/**
 * Admin notice if Elementor is not installed or activated.
 */
function any_digital_fail_load_elementor() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$message = sprintf(
		/* translators: %s: Elementor plugin link */
		__( 'Plugin <strong>Any Digital</strong> membutuhkan <strong>Elementor</strong> untuk diaktifkan. Silakan aktifkan Elementor.', 'any-digital' )
	);

	printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
}
