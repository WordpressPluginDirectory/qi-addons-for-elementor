<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QiAddonsForElementor_Elementor_Section_Handler {
	private static $instance;

	public function __construct() {
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9 );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function enqueue_scripts() {
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters
		// script is loading in footer since there may be some issue with swiper sliders and other themes/plugins when user is logged in and view frontend, some background sliders are not working.
		wp_enqueue_script( 'qi-addons-for-elementor-elementor', QI_ADDONS_FOR_ELEMENTOR_PLUGINS_URL_PATH . '/elementor/assets/js/elementor.js', array( 'jquery', 'elementor-frontend', 'wp-i18n' ), '', true );
	}
}

if ( ! function_exists( 'qi_addons_for_elementor_init_elementor_section_handler' ) ) {
	/**
	 * Function that initialize main page builder handler
	 */
	function qi_addons_for_elementor_init_elementor_section_handler() {
		QiAddonsForElementor_Elementor_Section_Handler::get_instance();
	}

	add_action( 'init', 'qi_addons_for_elementor_init_elementor_section_handler', 1 );
}
