<?php
/**
 * Dashboard Widget
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
 * Dashboard class
 *
 * Handles dashboard widgets and statistics.
 *
 * @since 2.0.0
 */
class Dashboard {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
	}

	/**
	 * Add dashboard widget
	 *
	 * @return void
	 */
	public function add_dashboard_widget() {
		wp_add_dashboard_widget(
			'bizzdocmaker_dashboard_widget',
			__( 'BizzDocMaker Statistics', 'post-classified-for-docs' ),
			array( $this, 'render_dashboard_widget' )
		);
	}

	/**
	 * Render dashboard widget
	 *
	 * @return void
	 */
	public function render_dashboard_widget() {
		$stats = $this->get_statistics();
		?>
		<div class="bizzdocmaker-dashboard-widget">
			<div class="bizzdocmaker-stats">
				<div class="bizzdocmaker-stat-item">
					<span class="bizzdocmaker-stat-number"><?php echo esc_html( $stats['total_posts'] ); ?></span>
					<span class="bizzdocmaker-stat-label"><?php esc_html_e( 'Total Posts', 'post-classified-for-docs' ); ?></span>
				</div>
				<div class="bizzdocmaker-stat-item">
					<span class="bizzdocmaker-stat-number"><?php echo esc_html( $stats['total_categories'] ); ?></span>
					<span class="bizzdocmaker-stat-label"><?php esc_html_e( 'Categories', 'post-classified-for-docs' ); ?></span>
				</div>
				<div class="bizzdocmaker-stat-item">
					<span class="bizzdocmaker-stat-number"><?php echo esc_html( $stats['ordered_posts'] ); ?></span>
					<span class="bizzdocmaker-stat-label"><?php esc_html_e( 'Ordered Posts', 'post-classified-for-docs' ); ?></span>
				</div>
			</div>
			
			<div class="bizzdocmaker-quick-links">
				<h4><?php esc_html_e( 'Quick Links', 'post-classified-for-docs' ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=bizzdocmaker-settings' ) ); ?>"><?php esc_html_e( 'Settings', 'post-classified-for-docs' ); ?></a></li>
					<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=bizzdocmaker-help' ) ); ?>"><?php esc_html_e( 'Help & Documentation', 'post-classified-for-docs' ); ?></a></li>
					<li><a href="https://wordpress.org/support/plugin/post-classified-for-docs/" target="_blank"><?php esc_html_e( 'Support Forum', 'post-classified-for-docs' ); ?></a></li>
				</ul>
			</div>
		</div>
		<style>
			.bizzdocmaker-stats {
				display: flex;
				gap: 15px;
				margin-bottom: 20px;
			}
			.bizzdocmaker-stat-item {
				flex: 1;
				text-align: center;
				padding: 15px;
				background: #f0f0f1;
				border-radius: 4px;
			}
			.bizzdocmaker-stat-number {
				display: block;
				font-size: 32px;
				font-weight: bold;
				color: #2271b1;
			}
			.bizzdocmaker-stat-label {
				display: block;
				font-size: 12px;
				color: #646970;
				margin-top: 5px;
			}
			.bizzdocmaker-quick-links h4 {
				margin-top: 0;
			}
			.bizzdocmaker-quick-links ul {
				margin: 0;
			}
		</style>
		<?php
	}

	/**
	 * Get plugin statistics
	 *
	 * @return array
	 */
	private function get_statistics() {
		// Get total published posts.
		$total_posts = wp_count_posts( 'post' );
		$total_posts = isset( $total_posts->publish ) ? $total_posts->publish : 0;

		// Get total categories.
		$categories = get_categories( array( 'hide_empty' => false ) );
		$total_categories = count( $categories );

		// Get ordered posts count.
		$ordered_posts = $this->get_ordered_posts_count();

		return array(
			'total_posts'      => $total_posts,
			'total_categories' => $total_categories,
			'ordered_posts'    => $ordered_posts,
		);
	}

	/**
	 * Get count of posts with custom ordering
	 *
	 * @return int
	 */
	private function get_ordered_posts_count() {
		global $wpdb;
		
		$count = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE meta_key = %s",
				'bizzdocmaker_post_order'
			)
		);

		return absint( $count );
	}
}
