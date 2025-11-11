<?php
/**
 * PSR-4 Autoloader for BizzDocMaker
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

namespace BizzDocMaker;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoloader class
 *
 * Implements PSR-4 autoloading for the plugin classes.
 *
 * @since 2.0.0
 */
class Autoloader {

	/**
	 * Namespace prefix
	 *
	 * @var string
	 */
	private $namespace_prefix = 'BizzDocMaker\\';

	/**
	 * Base directory for the namespace prefix
	 *
	 * @var string
	 */
	private $base_dir;

	/**
	 * Initialize the autoloader
	 *
	 * @param string $base_dir Base directory for the namespace.
	 */
	public function __construct( $base_dir ) {
		$this->base_dir = rtrim( $base_dir, '/' ) . '/';
	}

	/**
	 * Register the autoloader
	 *
	 * @return void
	 */
	public function register() {
		spl_autoload_register( array( $this, 'load_class' ) );
	}

	/**
	 * Load the class file for a given class name
	 *
	 * @param string $class The fully-qualified class name.
	 * @return void
	 */
	private function load_class( $class ) {
		// Check if the class uses the namespace prefix.
		if ( strpos( $class, $this->namespace_prefix ) !== 0 ) {
			return;
		}

		// Remove the namespace prefix.
		$relative_class = substr( $class, strlen( $this->namespace_prefix ) );

		// Replace namespace separators with directory separators.
		$file = $this->base_dir . str_replace( '\\', '/', $relative_class ) . '.php';

		// If the file exists, require it.
		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
}
