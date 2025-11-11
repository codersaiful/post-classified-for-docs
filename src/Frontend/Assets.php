<?php
/**
 * Frontend Assets Handler
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

namespace BizzDocMaker\Frontend;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Assets class
 *
 * Handles enqueueing of frontend CSS and JavaScript.
 *
 * @since 2.0.0
 */
class Assets {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue frontend styles
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			'bizzdocmaker-frontend',
			BIZZDOCMAKER_ASSETS_URL . 'css/frontend.css',
			array(),
			BIZZDOCMAKER_VERSION,
			'all'
		);

		// Allow custom styles.
		do_action( 'bizzdocmaker_enqueue_styles' );
	}

	/**
	 * Enqueue frontend scripts
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery' );

		wp_enqueue_script(
			'bizzdocmaker-frontend',
			BIZZDOCMAKER_ASSETS_URL . 'js/frontend.js',
			array( 'jquery' ),
			BIZZDOCMAKER_VERSION,
			true
		);

		// Localize script.
		wp_localize_script(
			'bizzdocmaker-frontend',
			'BizzDocMaker',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'bizzdocmaker_nonce' ),
				'siteUrl' => site_url(),
			)
		);

		// Allow custom scripts.
		do_action( 'bizzdocmaker_enqueue_scripts' );
	}
}
