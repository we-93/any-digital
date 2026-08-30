<?php
/**
 * Core Plugin Class for Any Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Any_Digital {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_category' ], 1 );

		// Register Widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Enqueue Scripts & Styles
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_assets' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
	}

	/**
	 * Register Any Digital category in Elementor editor
	 */
	public function register_category( $elements_manager ) {
		$elements_manager->add_category(
			'any-digital',
			[
				'title' => __( 'Any Digital', 'any-digital' ),
				'icon'  => 'eicon-code',
			]
		);
	}

	/**
	 * Register widgets
	 */
	public function register_widgets( $widgets_manager ) {
		require_once ANY_DIGITAL_PATH . 'includes/widgets/widget-copy-text.php';
		require_once ANY_DIGITAL_PATH . 'includes/widgets/widget-cover.php';
		require_once ANY_DIGITAL_PATH . 'includes/widgets/widget-countdown.php';
		require_once ANY_DIGITAL_PATH . 'includes/widgets/widget-timeline.php';
		require_once ANY_DIGITAL_PATH . 'includes/widgets/widget-datekit2.php';
		require_once ANY_DIGITAL_PATH . 'includes/widgets/widget-whatsapp.php';
		require_once ANY_DIGITAL_PATH . 'includes/widgets/widget-autoscroll.php';

		$widgets_manager->register( new \AnyDigital_Widget_Copy_Text() );
		$widgets_manager->register( new \AnyDigital_Widget_Cover() );
		$widgets_manager->register( new \AnyDigital_Widget_Countdown() );
		$widgets_manager->register( new \AnyDigital_Widget_Timeline() );
		$widgets_manager->register( new \AnyDigital_Widget_Datekit2() );
		$widgets_manager->register( new \AnyDigital_Widget_Whatsapp() );
		$widgets_manager->register( new \AnyDigital_Widget_Scroll_Navigation() );
	}

	/**
	 * Enqueue scripts for frontend & Elementor editor preview
	 */
	public function enqueue_frontend_assets() {
		// Stylesheets
		wp_enqueue_style( 'any-digital-copy-text', ANY_DIGITAL_URL . 'assets/css/copy-text.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-cover', ANY_DIGITAL_URL . 'assets/css/cover.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-countdown', ANY_DIGITAL_URL . 'assets/css/countdown.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-timeline', ANY_DIGITAL_URL . 'assets/css/timeline.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-datekit2', ANY_DIGITAL_URL . 'assets/css/datekit2.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-whatsapp', ANY_DIGITAL_URL . 'assets/css/whatsapp.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-autoscroll', ANY_DIGITAL_URL . 'assets/css/autoscroll.css', [], ANY_DIGITAL_VERSION );

		// Scripts
		wp_enqueue_script( 'any-digital-copy-text', ANY_DIGITAL_URL . 'assets/js/copy-text.js', [ 'jquery' ], ANY_DIGITAL_VERSION, true );
		wp_enqueue_script( 'any-digital-cover', ANY_DIGITAL_URL . 'assets/js/cover.js', [ 'jquery' ], ANY_DIGITAL_VERSION, true );
		wp_enqueue_script( 'any-digital-countdown', ANY_DIGITAL_URL . 'assets/js/countdown.js', [ 'jquery' ], ANY_DIGITAL_VERSION, true );
		wp_enqueue_script( 'any-digital-timeline', ANY_DIGITAL_URL . 'assets/js/timeline.js', [ 'jquery' ], ANY_DIGITAL_VERSION, true );
		wp_enqueue_script( 'any-digital-autoscroll', ANY_DIGITAL_URL . 'assets/js/autoscroll.js', [ 'jquery' ], ANY_DIGITAL_VERSION, true );
	}

	/**
	 * Enqueue styles specifically for Elementor editor
	 */
	public function enqueue_frontend_styles() {
		wp_enqueue_style( 'any-digital-cover', ANY_DIGITAL_URL . 'assets/css/cover.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-countdown', ANY_DIGITAL_URL . 'assets/css/countdown.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-timeline', ANY_DIGITAL_URL . 'assets/css/timeline.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-datekit2', ANY_DIGITAL_URL . 'assets/css/datekit2.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-whatsapp', ANY_DIGITAL_URL . 'assets/css/whatsapp.css', [], ANY_DIGITAL_VERSION );
		wp_enqueue_style( 'any-digital-autoscroll', ANY_DIGITAL_URL . 'assets/css/autoscroll.css', [], ANY_DIGITAL_VERSION );
	}
}
