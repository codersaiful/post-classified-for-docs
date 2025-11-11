<?php
/**
 * Plugin Name: BizzDocMaker - Documentation & Post List Builder
 * Plugin URI: https://github.com/codersaiful/post-classified-for-docs
 * Description: A powerful WordPress plugin to create beautiful documentation pages, sitemaps, and organized post lists with multiple display templates, advanced filtering, and customization options.
 * Author: Saiful Islam
 * Author URI: https://profiles.wordpress.org/codersaiful/#content-plugins
 * Version: 2.0.0
 * Requires at least: 5.0
 * Tested up to: 6.8
 * Requires PHP: 7.0
 * Text Domain: post-classified-for-docs
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define main plugin file constant.
if ( ! defined( 'BIZZDOCMAKER_MAIN_FILE' ) ) {
	define( 'BIZZDOCMAKER_MAIN_FILE', __FILE__ );
}

// Require autoloader.
require_once __DIR__ . '/src/Autoloader.php';

// Register autoloader.
$autoloader = new BizzDocMaker\Autoloader( __DIR__ . '/src' );
$autoloader->register();

// Initialize plugin.
function bizzdocmaker_init() {
	return BizzDocMaker\Plugin::instance();
}

/**
 * Activation hook
 *
 * @return void
 */
function bizzdocmaker_activate() {
	// Set activation redirect transient.
	set_transient( 'bizzdocmaker_activation_redirect', true, 30 );
	
	// Set default options if not exists.
	if ( false === get_option( 'bizzdocmaker_options' ) ) {
		$defaults = array(
			'default_template'  => 'list',
			'enable_caching'    => false,
			'posts_per_page'    => -1,
			'show_count'        => false,
		);
		add_option( 'bizzdocmaker_options', $defaults );
	}
	
	// Store version.
	update_option( 'bizzdocmaker_version', '2.0.0' );
	
	// Flush rewrite rules.
	flush_rewrite_rules();
}
register_activation_hook( BIZZDOCMAKER_MAIN_FILE, 'bizzdocmaker_activate' );

/**
 * Deactivation hook
 *
 * @return void
 */
function bizzdocmaker_deactivate() {
	// Clear transients.
	delete_transient( 'bizzdocmaker_activation_redirect' );
	
	// Flush rewrite rules.
	flush_rewrite_rules();
}
register_deactivation_hook( BIZZDOCMAKER_MAIN_FILE, 'bizzdocmaker_deactivate' );

// Start the plugin.
bizzdocmaker_init();

// Backward compatibility - Keep old shortcode working.
if ( ! function_exists( 'bizzdocmaker_legacy_shortcode' ) ) {
	/**
	 * Legacy shortcode handler for backward compatibility
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
	function bizzdocmaker_legacy_shortcode( $atts ) {
		$shortcode = new BizzDocMaker\Frontend\Shortcode();
		return $shortcode->render( $atts );
	}
	add_shortcode( 'WPPCD_Post', 'bizzdocmaker_legacy_shortcode' );
}

// Add new shortcode.
if ( ! function_exists( 'bizzdocmaker_shortcode' ) ) {
	/**
	 * Main shortcode handler
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
	function bizzdocmaker_shortcode( $atts ) {
		$shortcode = new BizzDocMaker\Frontend\Shortcode();
		return $shortcode->render( $atts );
	}
	add_shortcode( 'bizzdocmaker', 'bizzdocmaker_shortcode' );
}


