<?php
/**
 * Admin Settings Page
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

namespace BizzDocMaker\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Settings class
 *
 * Handles admin settings page and options.
 *
 * @since 2.0.0
 */
class Settings {

	/**
	 * Settings page slug
	 *
	 * @var string
	 */
	private $page_slug = 'bizzdocmaker-settings';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Add admin menu page
	 *
	 * @return void
	 */
	public function add_menu_page() {
		add_menu_page(
			__( 'BizzDocMaker', 'post-classified-for-docs' ),
			__( 'BizzDocMaker', 'post-classified-for-docs' ),
			'manage_options',
			$this->page_slug,
			array( $this, 'render_settings_page' ),
			'dashicons-media-document',
			30
		);

		// Add submenu pages.
		add_submenu_page(
			$this->page_slug,
			__( 'Settings', 'post-classified-for-docs' ),
			__( 'Settings', 'post-classified-for-docs' ),
			'manage_options',
			$this->page_slug
		);

		add_submenu_page(
			$this->page_slug,
			__( 'Help & Support', 'post-classified-for-docs' ),
			__( 'Help & Support', 'post-classified-for-docs' ),
			'manage_options',
			'bizzdocmaker-help',
			array( $this, 'render_help_page' )
		);
	}

	/**
	 * Register settings
	 *
	 * @return void
	 */
	public function register_settings() {
		// Register setting.
		register_setting(
			'bizzdocmaker_settings',
			'bizzdocmaker_options',
			array( $this, 'sanitize_settings' )
		);

		// General settings section.
		add_settings_section(
			'bizzdocmaker_general',
			__( 'General Settings', 'post-classified-for-docs' ),
			array( $this, 'render_general_section' ),
			$this->page_slug
		);

		// Default template.
		add_settings_field(
			'default_template',
			__( 'Default Template', 'post-classified-for-docs' ),
			array( $this, 'render_template_field' ),
			$this->page_slug,
			'bizzdocmaker_general'
		);

		// Enable caching.
		add_settings_field(
			'enable_caching',
			__( 'Enable Caching', 'post-classified-for-docs' ),
			array( $this, 'render_caching_field' ),
			$this->page_slug,
			'bizzdocmaker_general'
		);

		// Display settings section.
		add_settings_section(
			'bizzdocmaker_display',
			__( 'Display Settings', 'post-classified-for-docs' ),
			array( $this, 'render_display_section' ),
			$this->page_slug
		);

		// Posts per page.
		add_settings_field(
			'posts_per_page',
			__( 'Posts Per Page', 'post-classified-for-docs' ),
			array( $this, 'render_posts_per_page_field' ),
			$this->page_slug,
			'bizzdocmaker_display'
		);

		// Show post count.
		add_settings_field(
			'show_count',
			__( 'Show Post Count', 'post-classified-for-docs' ),
			array( $this, 'render_show_count_field' ),
			$this->page_slug,
			'bizzdocmaker_display'
		);
	}

	/**
	 * Sanitize settings
	 *
	 * @param array $input Input values.
	 * @return array
	 */
	public function sanitize_settings( $input ) {
		$sanitized = array();

		if ( isset( $input['default_template'] ) ) {
			$sanitized['default_template'] = sanitize_text_field( $input['default_template'] );
		}

		if ( isset( $input['enable_caching'] ) ) {
			$sanitized['enable_caching'] = (bool) $input['enable_caching'];
		}

		if ( isset( $input['posts_per_page'] ) ) {
			$sanitized['posts_per_page'] = absint( $input['posts_per_page'] );
		}

		if ( isset( $input['show_count'] ) ) {
			$sanitized['show_count'] = (bool) $input['show_count'];
		}

		return $sanitized;
	}

	/**
	 * Render settings page
	 *
	 * @return void
	 */
	public function render_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Check if settings saved.
		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error(
				'bizzdocmaker_messages',
				'bizzdocmaker_message',
				__( 'Settings saved successfully!', 'post-classified-for-docs' ),
				'success'
			);
		}

		settings_errors( 'bizzdocmaker_messages' );
		?>
		<div class="wrap bizzdocmaker-settings">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			
			<div class="bizzdocmaker-settings-wrapper">
				<div class="bizzdocmaker-settings-tabs">
					<nav class="nav-tab-wrapper">
						<a href="#general" class="nav-tab nav-tab-active"><?php esc_html_e( 'General', 'post-classified-for-docs' ); ?></a>
						<a href="#display" class="nav-tab"><?php esc_html_e( 'Display', 'post-classified-for-docs' ); ?></a>
						<a href="#advanced" class="nav-tab"><?php esc_html_e( 'Advanced', 'post-classified-for-docs' ); ?></a>
					</nav>

					<form action="options.php" method="post">
						<?php
						settings_fields( 'bizzdocmaker_settings' );
						do_settings_sections( $this->page_slug );
						submit_button( __( 'Save Settings', 'post-classified-for-docs' ) );
						?>
					</form>
				</div>

				<div class="bizzdocmaker-sidebar">
					<div class="bizzdocmaker-widget">
						<h3><?php esc_html_e( 'Quick Start', 'post-classified-for-docs' ); ?></h3>
						<p><?php esc_html_e( 'Use these shortcodes to display your documentation:', 'post-classified-for-docs' ); ?></p>
						<code>[bizzdocmaker]</code>
						<p><?php esc_html_e( 'Or with the legacy shortcode:', 'post-classified-for-docs' ); ?></p>
						<code>[WPPCD_Post]</code>
					</div>

					<div class="bizzdocmaker-widget">
						<h3><?php esc_html_e( 'Need Help?', 'post-classified-for-docs' ); ?></h3>
						<ul>
							<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=bizzdocmaker-help' ) ); ?>"><?php esc_html_e( 'Documentation', 'post-classified-for-docs' ); ?></a></li>
							<li><a href="https://wordpress.org/support/plugin/post-classified-for-docs/" target="_blank"><?php esc_html_e( 'Support Forum', 'post-classified-for-docs' ); ?></a></li>
							<li><a href="https://github.com/codersaiful/post-classified-for-docs" target="_blank"><?php esc_html_e( 'GitHub', 'post-classified-for-docs' ); ?></a></li>
						</ul>
					</div>

					<div class="bizzdocmaker-widget">
						<h3><?php esc_html_e( 'Rate Us', 'post-classified-for-docs' ); ?></h3>
						<p><?php esc_html_e( 'If you like this plugin, please leave a review!', 'post-classified-for-docs' ); ?></p>
						<a href="https://wordpress.org/support/plugin/post-classified-for-docs/reviews/#new-post" target="_blank" class="button button-primary">
							<?php esc_html_e( 'Leave a Review', 'post-classified-for-docs' ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render help page
	 *
	 * @return void
	 */
	public function render_help_page() {
		?>
		<div class="wrap bizzdocmaker-help">
			<h1><?php esc_html_e( 'Help & Support', 'post-classified-for-docs' ); ?></h1>
			
			<div class="bizzdocmaker-help-content">
				<div class="bizzdocmaker-help-section">
					<h2><?php esc_html_e( 'Getting Started', 'post-classified-for-docs' ); ?></h2>
					<p><?php esc_html_e( 'BizzDocMaker helps you create beautiful documentation pages and organized post lists.', 'post-classified-for-docs' ); ?></p>
					
					<h3><?php esc_html_e( 'Basic Usage', 'post-classified-for-docs' ); ?></h3>
					<p><?php esc_html_e( 'Simply add the shortcode to any page or post:', 'post-classified-for-docs' ); ?></p>
					<pre>[bizzdocmaker]</pre>
					
					<h3><?php esc_html_e( 'Shortcode Attributes', 'post-classified-for-docs' ); ?></h3>
					<ul>
						<li><code>template</code> - <?php esc_html_e( 'Display template: list, grid, accordion, table', 'post-classified-for-docs' ); ?></li>
						<li><code>post_type</code> - <?php esc_html_e( 'Post type to display (default: post)', 'post-classified-for-docs' ); ?></li>
						<li><code>term_name</code> - <?php esc_html_e( 'Taxonomy name (default: category)', 'post-classified-for-docs' ); ?></li>
						<li><code>taxs</code> - <?php esc_html_e( 'Comma-separated taxonomy IDs', 'post-classified-for-docs' ); ?></li>
						<li><code>posts_per_page</code> - <?php esc_html_e( 'Number of posts to show (-1 for all)', 'post-classified-for-docs' ); ?></li>
					</ul>

					<h3><?php esc_html_e( 'Examples', 'post-classified-for-docs' ); ?></h3>
					<pre>[bizzdocmaker template="grid" columns="3"]</pre>
					<pre>[bizzdocmaker post_type="product" term_name="product_cat"]</pre>
					<pre>[bizzdocmaker taxs="1,2,3" template="accordion"]</pre>
				</div>

				<div class="bizzdocmaker-help-section">
					<h2><?php esc_html_e( 'Support Resources', 'post-classified-for-docs' ); ?></h2>
					<ul>
						<li><a href="https://wordpress.org/support/plugin/post-classified-for-docs/" target="_blank"><?php esc_html_e( 'WordPress Support Forum', 'post-classified-for-docs' ); ?></a></li>
						<li><a href="https://github.com/codersaiful/post-classified-for-docs" target="_blank"><?php esc_html_e( 'GitHub Repository', 'post-classified-for-docs' ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render general section
	 *
	 * @return void
	 */
	public function render_general_section() {
		echo '<p>' . esc_html__( 'Configure general plugin settings.', 'post-classified-for-docs' ) . '</p>';
	}

	/**
	 * Render display section
	 *
	 * @return void
	 */
	public function render_display_section() {
		echo '<p>' . esc_html__( 'Configure display and appearance settings.', 'post-classified-for-docs' ) . '</p>';
	}

	/**
	 * Render template field
	 *
	 * @return void
	 */
	public function render_template_field() {
		$options = get_option( 'bizzdocmaker_options', array() );
		$value = isset( $options['default_template'] ) ? $options['default_template'] : 'list';
		?>
		<select name="bizzdocmaker_options[default_template]">
			<option value="list" <?php selected( $value, 'list' ); ?>><?php esc_html_e( 'List', 'post-classified-for-docs' ); ?></option>
			<option value="grid" <?php selected( $value, 'grid' ); ?>><?php esc_html_e( 'Grid', 'post-classified-for-docs' ); ?></option>
			<option value="accordion" <?php selected( $value, 'accordion' ); ?>><?php esc_html_e( 'Accordion', 'post-classified-for-docs' ); ?></option>
			<option value="table" <?php selected( $value, 'table' ); ?>><?php esc_html_e( 'Table', 'post-classified-for-docs' ); ?></option>
		</select>
		<p class="description"><?php esc_html_e( 'Select the default template for displaying posts.', 'post-classified-for-docs' ); ?></p>
		<?php
	}

	/**
	 * Render caching field
	 *
	 * @return void
	 */
	public function render_caching_field() {
		$options = get_option( 'bizzdocmaker_options', array() );
		$checked = isset( $options['enable_caching'] ) && $options['enable_caching'];
		?>
		<label>
			<input type="checkbox" name="bizzdocmaker_options[enable_caching]" value="1" <?php checked( $checked ); ?>>
			<?php esc_html_e( 'Enable query result caching for better performance', 'post-classified-for-docs' ); ?>
		</label>
		<?php
	}

	/**
	 * Render posts per page field
	 *
	 * @return void
	 */
	public function render_posts_per_page_field() {
		$options = get_option( 'bizzdocmaker_options', array() );
		$value = isset( $options['posts_per_page'] ) ? $options['posts_per_page'] : -1;
		?>
		<input type="number" name="bizzdocmaker_options[posts_per_page]" value="<?php echo esc_attr( $value ); ?>" min="-1">
		<p class="description"><?php esc_html_e( 'Number of posts to display per taxonomy (-1 for all).', 'post-classified-for-docs' ); ?></p>
		<?php
	}

	/**
	 * Render show count field
	 *
	 * @return void
	 */
	public function render_show_count_field() {
		$options = get_option( 'bizzdocmaker_options', array() );
		$checked = isset( $options['show_count'] ) && $options['show_count'];
		?>
		<label>
			<input type="checkbox" name="bizzdocmaker_options[show_count]" value="1" <?php checked( $checked ); ?>>
			<?php esc_html_e( 'Show post count next to taxonomy names', 'post-classified-for-docs' ); ?>
		</label>
		<?php
	}

	/**
	 * Enqueue admin assets
	 *
	 * @param string $hook Current admin page hook.
	 * @return void
	 */
	public function enqueue_assets( $hook ) {
		// Only load on our pages.
		if ( false === strpos( $hook, 'bizzdocmaker' ) ) {
			return;
		}

		wp_enqueue_style(
			'bizzdocmaker-admin',
			BIZZDOCMAKER_ASSETS_URL . 'css/admin.css',
			array(),
			BIZZDOCMAKER_VERSION
		);

		wp_enqueue_script(
			'bizzdocmaker-admin',
			BIZZDOCMAKER_ASSETS_URL . 'js/admin.js',
			array( 'jquery' ),
			BIZZDOCMAKER_VERSION,
			true
		);
	}
}
