<?php
/**
 * Main Plugin Class
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
 * Main Plugin Class
 *
 * Handles plugin initialization and bootstrapping.
 *
 * @since 2.0.0
 */
class Plugin {

	/**
	 * Plugin instance
	 *
	 * @var Plugin
	 */
	private static $instance = null;

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	public $version = '2.0.0';

	/**
	 * Get plugin instance
	 *
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->define_constants();
		$this->init_hooks();
	}

	/**
	 * Define plugin constants
	 *
	 * @return void
	 */
	private function define_constants() {
		$this->define( 'BIZZDOCMAKER_VERSION', $this->version );
		$this->define( 'BIZZDOCMAKER_PLUGIN_FILE', BIZZDOCMAKER_MAIN_FILE );
		$this->define( 'BIZZDOCMAKER_PLUGIN_BASENAME', plugin_basename( BIZZDOCMAKER_MAIN_FILE ) );
		$this->define( 'BIZZDOCMAKER_PLUGIN_DIR', plugin_dir_path( BIZZDOCMAKER_MAIN_FILE ) );
		$this->define( 'BIZZDOCMAKER_PLUGIN_URL', plugin_dir_url( BIZZDOCMAKER_MAIN_FILE ) );
		$this->define( 'BIZZDOCMAKER_ASSETS_URL', BIZZDOCMAKER_PLUGIN_URL . 'assets/' );
		$this->define( 'BIZZDOCMAKER_TEMPLATES_DIR', BIZZDOCMAKER_PLUGIN_DIR . 'templates/' );
	}

	/**
	 * Define constant if not already set
	 *
	 * @param string $name  Constant name.
	 * @param mixed  $value Constant value.
	 * @return void
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	private function init_hooks() {
		add_action( 'plugins_loaded', array( $this, 'init' ), 0 );
		add_action( 'init', array( $this, 'load_textdomain' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function init() {
		// Initialize components.
		$this->init_components();

		// Trigger action hook for extensibility.
		do_action( 'bizzdocmaker_loaded' );
	}

	/**
	 * Initialize plugin components
	 *
	 * @return void
	 */
	private function init_components() {
		// Initialize admin components.
		if ( is_admin() ) {
			new Admin\Settings();
			new Admin\MetaBox();
			new Admin\Dashboard();
			new Admin\Welcome();
		}

		// Initialize frontend components.
		new Frontend\Assets();
		new Frontend\Shortcode();

		// Initialize core components.
		new Core\PostTypes();
	}

	/**
	 * Load plugin textdomain
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'post-classified-for-docs',
			false,
			dirname( BIZZDOCMAKER_PLUGIN_BASENAME ) . '/languages'
		);
	}

	/**
	 * Get plugin version
	 *
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}
}
