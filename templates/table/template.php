<?php
/**
 * Table Template
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$current_id = get_queried_object_id();
?>
<div class="bizzdocmaker-wrapper bizzdocmaker-table">
	<?php foreach ( $this->taxs as $taxonomy_id ) : ?>
		<?php
		$term = get_term( $taxonomy_id, $this->term_name );
		if ( is_wp_error( $term ) || ! $term ) {
			continue;
		}
		?>
		<div class="bizzdocmaker-section bizzdocmaker-section-<?php echo esc_attr( $taxonomy_id ); ?>">
			<h3 class="bizzdocmaker-heading">
				<?php if ( 'on' === $this->term_link ) : ?>
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="bizzdocmaker-heading-link">
						<?php echo esc_html( $term->name ); ?>
					</a>
				<?php else : ?>
					<?php echo esc_html( $term->name ); ?>
				<?php endif; ?>

				<?php if ( isset( $this->atts['show_count'] ) && 'on' === $this->atts['show_count'] ) : ?>
					<span class="bizzdocmaker-count">(<?php echo esc_html( $term->count ); ?>)</span>
				<?php endif; ?>
			</h3>

			<?php if ( isset( $this->atts['show_description'] ) && 'on' === $this->atts['show_description'] && ! empty( $term->description ) ) : ?>
				<div class="bizzdocmaker-description">
					<?php echo wp_kses_post( wpautop( $term->description ) ); ?>
				</div>
			<?php endif; ?>

			<?php
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

			if ( $query->have_posts() ) :
				$target = ( 'on' === $this->_blank ) ? '_blank' : '_self';
				?>
				<table class="bizzdocmaker-table-content">
					<thead>
						<tr>
							<th class="bizzdocmaker-col-number"><?php esc_html_e( '#', 'post-classified-for-docs' ); ?></th>
							<th class="bizzdocmaker-col-title"><?php esc_html_e( 'Title', 'post-classified-for-docs' ); ?></th>
							<th class="bizzdocmaker-col-date"><?php esc_html_e( 'Date', 'post-classified-for-docs' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$row_number = 1;
						while ( $query->have_posts() ) :
							$query->the_post();
							$active_class = ( $current_id === get_the_ID() ) ? 'active' : '';
							?>
							<tr class="bizzdocmaker-row <?php echo esc_attr( $active_class ); ?>">
								<td class="bizzdocmaker-col-number"><?php echo esc_html( $row_number ); ?></td>
								<td class="bizzdocmaker-col-title">
									<a href="<?php echo esc_url( get_permalink() ); ?>" 
									   target="<?php echo esc_attr( $target ); ?>"
									   class="bizzdocmaker-link">
										<?php echo esc_html( get_the_title() ); ?>
									</a>
								</td>
								<td class="bizzdocmaker-col-date"><?php echo esc_html( get_the_date() ); ?></td>
							</tr>
							<?php
							$row_number++;
						endwhile;
						?>
					</tbody>
				</table>
				<?php
				wp_reset_postdata();
			else :
				?>
				<p class="bizzdocmaker-empty"><?php esc_html_e( 'No posts found.', 'post-classified-for-docs' ); ?></p>
				<?php
			endif;
			?>
		</div>
	<?php endforeach; ?>
</div>
