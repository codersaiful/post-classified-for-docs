<?php
/**
 * Meta Box Handler
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
 * MetaBox class
 *
 * Handles custom meta boxes for post ordering.
 *
 * @since 2.0.0
 */
class MetaBox {

	/**
	 * Meta key for post order
	 *
	 * @var string
	 */
	private $meta_key = 'bizzdocmaker_post_order';

	/**
	 * Supported post types
	 *
	 * @var array
	 */
	private $post_types = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
		$this->set_post_types();
	}

	/**
	 * Set supported post types
	 *
	 * @return void
	 */
	private function set_post_types() {
		$this->post_types = apply_filters(
			'bizzdocmaker_meta_box_post_types',
			array( 'post', 'page', 'product' )
		);
	}

	/**
	 * Add meta box
	 *
	 * @return void
	 */
	public function add_meta_box() {
		add_meta_box(
			'bizzdocmaker-post-order',
			__( 'BizzDocMaker - Post Order', 'post-classified-for-docs' ),
			array( $this, 'render_meta_box' ),
			$this->post_types,
			'side',
			'default'
		);
	}

	/**
	 * Render meta box content
	 *
	 * @param \WP_Post $post Current post object.
	 * @return void
	 */
	public function render_meta_box( $post ) {
		// Add nonce for security.
		wp_nonce_field( 'bizzdocmaker_meta_box', 'bizzdocmaker_meta_box_nonce' );

		// Get current value.
		$order_number = get_post_meta( $post->ID, $this->meta_key, true );
		$order_number = $order_number ? $order_number : 10;
		?>
		<div class="bizzdocmaker-meta-box">
			<p>
				<label for="bizzdocmaker-order-number">
					<?php esc_html_e( 'Order Number', 'post-classified-for-docs' ); ?>
				</label>
				<input 
					type="number" 
					id="bizzdocmaker-order-number"
					name="bizzdocmaker_order_number" 
					value="<?php echo esc_attr( $order_number ); ?>" 
					class="widefat"
					min="0"
					step="1"
				>
			</p>
			<p class="description">
				<?php esc_html_e( 'Set the order number for this post. Lower numbers appear first.', 'post-classified-for-docs' ); ?>
			</p>
		</div>
		<style>
			.bizzdocmaker-meta-box input[type="number"] {
				width: 100%;
				padding: 5px;
			}
		</style>
		<?php
	}

	/**
	 * Save meta box data
	 *
	 * @param int $post_id Post ID.
	 * @return void
	 */
	public function save_meta_box( $post_id ) {
		// Verify nonce.
		if ( ! isset( $_POST['bizzdocmaker_meta_box_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['bizzdocmaker_meta_box_nonce'], 'bizzdocmaker_meta_box' ) ) {
			return;
		}

		// Check autosave.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check if revision.
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		// Save/update meta.
		if ( isset( $_POST['bizzdocmaker_order_number'] ) ) {
			$order_number = absint( $_POST['bizzdocmaker_order_number'] );
			update_post_meta( $post_id, $this->meta_key, $order_number );
		} else {
			delete_post_meta( $post_id, $this->meta_key );
		}
	}
}
