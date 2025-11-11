<?php
/**
 * Shortcode Handler
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

namespace BizzDocMaker\Frontend;

use WP_Query;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcode class
 *
 * Handles shortcode rendering and display logic.
 *
 * @since 2.0.0
 */
class Shortcode {

	/**
	 * Taxonomy IDs
	 *
	 * @var array
	 */
	private $taxs = array();

	/**
	 * Taxonomy name
	 *
	 * @var string
	 */
	private $term_name = 'category';

	/**
	 * Post type
	 *
	 * @var string
	 */
	private $post_type = 'post';

	/**
	 * Posts per page
	 *
	 * @var int
	 */
	private $posts_per_page = -1;

	/**
	 * Show term link
	 *
	 * @var string
	 */
	private $term_link = 'on';

	/**
	 * Open in new tab
	 *
	 * @var string
	 */
	private $_blank = 'off';

	/**
	 * Order by number
	 *
	 * @var string
	 */
	private $order_by_number = 'on';

	/**
	 * Template type
	 *
	 * @var string
	 */
	private $template = 'list';

	/**
	 * Shortcode attributes
	 *
	 * @var array
	 */
	private $atts = array();

	/**
	 * Render shortcode
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
	public function render( $atts ) {
		// Default attributes.
		$defaults = array(
			'taxs'             => '',
			'term_name'        => 'category',
			'post_type'        => 'post',
			'posts_per_page'   => -1,
			'term_link'        => 'on',
			'_blank'           => 'off',
			'order_by_number'  => 'on',
			'template'         => 'list',
			'show_count'       => 'off',
			'show_description' => 'off',
			'columns'          => 3,
		);

		// Merge with defaults.
		$this->atts = shortcode_atts( $defaults, $atts, 'bizzdocmaker' );

		// Parse attributes.
		$this->parse_attributes();

		// Get taxonomies.
		if ( empty( $this->taxs ) ) {
			$this->taxs = $this->get_taxonomies();
		}

		// Return empty if no taxonomies.
		if ( empty( $this->taxs ) || ! is_array( $this->taxs ) ) {
			return '';
		}

		// Generate and return HTML.
		return $this->generate_html();
	}

	/**
	 * Parse shortcode attributes
	 *
	 * @return void
	 */
	private function parse_attributes() {
		// Parse taxonomy IDs.
		if ( ! empty( $this->atts['taxs'] ) ) {
			$taxs = rtrim( $this->atts['taxs'], ',' );
			$taxs = explode( ',', $taxs );
			$this->taxs = array_filter( array_map( 'intval', $taxs ) );
		}

		// Set post type.
		$this->post_type = sanitize_text_field( $this->atts['post_type'] );

		// Auto-set term_name for products.
		if ( 'product' === $this->post_type ) {
			$this->term_name = 'product_cat';
		}

		// Set other attributes.
		$this->term_name        = sanitize_text_field( $this->atts['term_name'] );
		$this->posts_per_page   = intval( $this->atts['posts_per_page'] );
		$this->term_link        = sanitize_text_field( $this->atts['term_link'] );
		$this->_blank           = sanitize_text_field( $this->atts['_blank'] );
		$this->order_by_number  = sanitize_text_field( $this->atts['order_by_number'] );
		$this->template         = sanitize_text_field( $this->atts['template'] );
	}

	/**
	 * Get all taxonomies for the term name
	 *
	 * @return array
	 */
	private function get_taxonomies() {
		$taxonomies = get_terms(
			array(
				'taxonomy'   => $this->term_name,
				'hide_empty' => true,
			)
		);

		if ( is_wp_error( $taxonomies ) ) {
			return array();
		}

		$tax_ids = array();
		foreach ( $taxonomies as $taxonomy ) {
			$tax_ids[] = $taxonomy->term_id;
		}

		return $tax_ids;
	}

	/**
	 * Generate HTML output
	 *
	 * @return string
	 */
	private function generate_html() {
		ob_start();

		// Get template path.
		$template_file = $this->get_template_path();

		// Load template if exists.
		if ( file_exists( $template_file ) ) {
			include $template_file;
		} else {
			// Fallback to default list template.
			$this->render_list_template();
		}

		return ob_get_clean();
	}

	/**
	 * Get template file path
	 *
	 * @return string
	 */
	private function get_template_path() {
		$template = $this->template;
		$template_file = BIZZDOCMAKER_TEMPLATES_DIR . $template . '/template.php';

		// Allow theme override.
		$theme_template = locate_template( "bizzdocmaker/{$template}/template.php" );
		if ( $theme_template ) {
			return $theme_template;
		}

		return $template_file;
	}

	/**
	 * Render list template (default)
	 *
	 * @return void
	 */
	private function render_list_template() {
		$current_id = get_queried_object_id();
		?>
		<div class="bizzdocmaker-wrapper bizzdocmaker-list">
			<?php foreach ( $this->taxs as $taxonomy_id ) : ?>
				<?php $this->render_taxonomy_section( $taxonomy_id, $current_id ); ?>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Render taxonomy section
	 *
	 * @param int $taxonomy_id Taxonomy term ID.
	 * @param int $current_id  Current post/page ID.
	 * @return void
	 */
	private function render_taxonomy_section( $taxonomy_id, $current_id ) {
		$term = get_term( $taxonomy_id, $this->term_name );

		if ( is_wp_error( $term ) || ! $term ) {
			return;
		}

		$term_link_enabled = ( 'on' === $this->term_link );
		?>
		<div class="bizzdocmaker-section bizzdocmaker-section-<?php echo esc_attr( $taxonomy_id ); ?>">
			<div class="bizzdocmaker-section-inner">
				<h3 class="bizzdocmaker-heading">
					<?php if ( $term_link_enabled ) : ?>
						<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="bizzdocmaker-heading-link">
							<?php echo esc_html( $term->name ); ?>
						</a>
					<?php else : ?>
						<?php echo esc_html( $term->name ); ?>
					<?php endif; ?>

					<?php if ( 'on' === $this->atts['show_count'] ) : ?>
						<span class="bizzdocmaker-count">(<?php echo esc_html( $term->count ); ?>)</span>
					<?php endif; ?>
				</h3>

				<?php if ( 'on' === $this->atts['show_description'] && ! empty( $term->description ) ) : ?>
					<div class="bizzdocmaker-description">
						<?php echo wp_kses_post( $term->description ); ?>
					</div>
				<?php endif; ?>

				<?php $this->render_post_list( $taxonomy_id, $current_id ); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render post list for a taxonomy
	 *
	 * @param int $taxonomy_id Taxonomy term ID.
	 * @param int $current_id  Current post/page ID.
	 * @return void
	 */
	private function render_post_list( $taxonomy_id, $current_id ) {
		// Build query args.
		$args = array(
			'post_type'      => $this->post_type,
			'post_status'    => 'publish',
			'posts_per_page' => $this->posts_per_page,
			'tax_query'      => array(
				array(
					'taxonomy' => $this->term_name,
					'field'    => 'term_id',
					'terms'    => $taxonomy_id,
				),
			),
		);

		// Order by custom meta if enabled.
		if ( 'on' === $this->order_by_number ) {
			$args['meta_key'] = 'bizzdocmaker_post_order';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'ASC';
		}

		// Allow filtering.
		$args = apply_filters( 'bizzdocmaker_query_args', $args, $taxonomy_id, $this->atts );

		// Run query.
		$query = new WP_Query( $args );

		if ( ! $query->have_posts() ) {
			return;
		}

		$target = ( 'on' === $this->_blank ) ? '_blank' : '_self';
		?>
		<ul class="bizzdocmaker-list">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				$active_class = ( $current_id === get_the_ID() ) ? 'active' : '';
				?>
				<li class="bizzdocmaker-item <?php echo esc_attr( $active_class ); ?>">
					<a href="<?php echo esc_url( get_permalink() ); ?>" 
					   target="<?php echo esc_attr( $target ); ?>"
					   class="bizzdocmaker-link">
						<?php echo esc_html( get_the_title() ); ?>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
		<?php

		wp_reset_postdata();
	}
}
