<?php
/**
 * Post Types Handler
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

namespace BizzDocMaker\Core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * PostTypes class
 *
 * Handles custom post types and taxonomies if needed in future.
 *
 * @since 2.0.0
 */
class PostTypes {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Reserved for future custom post types.
		// Currently, the plugin works with any existing post type.
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Initialize
	 *
	 * @return void
	 */
	public function init() {
		// Placeholder for custom post type registration.
		// Can be extended in future versions.
		do_action( 'bizzdocmaker_post_types_init' );
	}
}
