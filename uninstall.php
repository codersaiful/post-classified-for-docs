<?php
/**
 * Uninstall Script
 *
 * Fired when the plugin is uninstalled.
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete plugin options
 */
function bizzdocmaker_uninstall() {
	// Delete options.
	delete_option( 'bizzdocmaker_options' );
	delete_option( 'bizzdocmaker_version' );
	
	// Delete transients.
	global $wpdb;
	
	// Delete all transients starting with 'bizzdocmaker_'.
	$wpdb->query(
		"DELETE FROM {$wpdb->options} 
		WHERE option_name LIKE '_transient_bizzdocmaker_%' 
		OR option_name LIKE '_transient_timeout_bizzdocmaker_%'"
	);
	
	// Optional: Delete post meta (uncomment if you want to remove post order data).
	// $wpdb->query(
	// 	"DELETE FROM {$wpdb->postmeta} WHERE meta_key = 'bizzdocmaker_post_order'"
	// );
	
	// Clear any cached data.
	wp_cache_flush();
}

// Run uninstall.
bizzdocmaker_uninstall();
