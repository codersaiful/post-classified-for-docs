<?php
/**
 * Welcome Screen
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
 * Welcome class
 *
 * Handles welcome screen for first-time users.
 *
 * @since 2.0.0
 */
class Welcome {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_welcome_page' ) );
		add_action( 'admin_init', array( $this, 'maybe_redirect' ) );
		add_action( 'admin_head', array( $this, 'hide_menu_item' ) );
	}

	/**
	 * Add welcome page
	 *
	 * @return void
	 */
	public function add_welcome_page() {
		add_submenu_page(
			'',
			__( 'Welcome to BizzDocMaker', 'post-classified-for-docs' ),
			__( 'Welcome', 'post-classified-for-docs' ),
			'manage_options',
			'bizzdocmaker-welcome',
			array( $this, 'render_welcome_page' )
		);
	}

	/**
	 * Hide menu item from submenu
	 *
	 * @return void
	 */
	public function hide_menu_item() {
		remove_submenu_page( '', 'bizzdocmaker-welcome' );
	}

	/**
	 * Maybe redirect to welcome page on activation
	 *
	 * @return void
	 */
	public function maybe_redirect() {
		// Check if we should redirect.
		if ( ! get_transient( 'bizzdocmaker_activation_redirect' ) ) {
			return;
		}

		// Delete transient.
		delete_transient( 'bizzdocmaker_activation_redirect' );

		// Bail if activating from network, or bulk.
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}

		// Redirect to welcome page.
		wp_safe_redirect( admin_url( 'admin.php?page=bizzdocmaker-welcome' ) );
		exit;
	}

	/**
	 * Render welcome page
	 *
	 * @return void
	 */
	public function render_welcome_page() {
		?>
		<div class="wrap bizzdocmaker-welcome">
			<h1><?php esc_html_e( 'Welcome to BizzDocMaker', 'post-classified-for-docs' ); ?></h1>
			
			<div class="about-text">
				<?php esc_html_e( 'Thank you for installing BizzDocMaker! Create beautiful documentation pages and organized post lists with ease.', 'post-classified-for-docs' ); ?>
			</div>

			<div class="bizzdocmaker-badge">
				<span><?php printf( esc_html__( 'Version %s', 'post-classified-for-docs' ), BIZZDOCMAKER_VERSION ); ?></span>
			</div>

			<div class="bizzdocmaker-welcome-content">
				<div class="bizzdocmaker-feature-section">
					<h2><?php esc_html_e( 'Getting Started', 'post-classified-for-docs' ); ?></h2>
					
					<div class="bizzdocmaker-feature-grid">
						<div class="bizzdocmaker-feature">
							<h3><?php esc_html_e( '1. Create Your First Documentation', 'post-classified-for-docs' ); ?></h3>
							<p><?php esc_html_e( 'Add the shortcode to any page or post to display your documentation:', 'post-classified-for-docs' ); ?></p>
							<code>[bizzdocmaker]</code>
						</div>

						<div class="bizzdocmaker-feature">
							<h3><?php esc_html_e( '2. Customize Display', 'post-classified-for-docs' ); ?></h3>
							<p><?php esc_html_e( 'Choose from multiple templates: List, Grid, Accordion, or Table.', 'post-classified-for-docs' ); ?></p>
							<code>[bizzdocmaker template="grid"]</code>
						</div>

						<div class="bizzdocmaker-feature">
							<h3><?php esc_html_e( '3. Order Your Posts', 'post-classified-for-docs' ); ?></h3>
							<p><?php esc_html_e( 'Use the post order meta box in the editor to control the display order.', 'post-classified-for-docs' ); ?></p>
						</div>
					</div>
				</div>

				<div class="bizzdocmaker-feature-section">
					<h2><?php esc_html_e( 'Key Features', 'post-classified-for-docs' ); ?></h2>
					
					<div class="bizzdocmaker-features-list">
						<ul class="bizzdocmaker-features-columns">
							<li><?php esc_html_e( 'Multiple display templates', 'post-classified-for-docs' ); ?></li>
							<li><?php esc_html_e( 'Custom post ordering', 'post-classified-for-docs' ); ?></li>
							<li><?php esc_html_e( 'Support for any post type', 'post-classified-for-docs' ); ?></li>
							<li><?php esc_html_e( 'Taxonomy-based organization', 'post-classified-for-docs' ); ?></li>
							<li><?php esc_html_e( 'Responsive design', 'post-classified-for-docs' ); ?></li>
							<li><?php esc_html_e( 'Easy customization', 'post-classified-for-docs' ); ?></li>
						</ul>
					</div>
				</div>

				<div class="bizzdocmaker-cta-section">
					<h2><?php esc_html_e( 'Ready to Get Started?', 'post-classified-for-docs' ); ?></h2>
					<p>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=bizzdocmaker-settings' ) ); ?>" class="button button-primary button-hero">
							<?php esc_html_e( 'Go to Settings', 'post-classified-for-docs' ); ?>
						</a>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=bizzdocmaker-help' ) ); ?>" class="button button-secondary button-hero">
							<?php esc_html_e( 'View Documentation', 'post-classified-for-docs' ); ?>
						</a>
					</p>
				</div>
			</div>
		</div>

		<style>
			.bizzdocmaker-welcome {
				max-width: 1200px;
				margin: 20px auto;
			}
			.bizzdocmaker-badge {
				position: absolute;
				top: 0;
				right: 0;
				background: #2271b1;
				color: white;
				padding: 10px 20px;
				border-radius: 4px;
				font-weight: bold;
			}
			.bizzdocmaker-feature-grid {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
				gap: 20px;
				margin: 20px 0;
			}
			.bizzdocmaker-feature {
				padding: 20px;
				background: #f0f0f1;
				border-radius: 8px;
			}
			.bizzdocmaker-feature h3 {
				margin-top: 0;
				color: #2271b1;
			}
			.bizzdocmaker-features-columns {
				column-count: 2;
				column-gap: 40px;
			}
			.bizzdocmaker-features-columns li {
				margin-bottom: 10px;
			}
			.bizzdocmaker-cta-section {
				text-align: center;
				padding: 40px 20px;
				background: #f0f0f1;
				border-radius: 8px;
				margin-top: 30px;
			}
			.bizzdocmaker-feature-section {
				margin: 40px 0;
			}
		</style>
		<?php
	}
}
