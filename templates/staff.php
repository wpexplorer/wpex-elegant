<?php
/**
 * Template Name: Staff
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">

		<main id="content" class="site-content" role="main">

			<?php get_template_part( 'partials/page/header' ); ?>

			<?php get_template_part( 'partials/page/content' ); ?>

			<?php
			// Query staff posts
			global $post,$paged;
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$display_count = get_theme_mod('wpex_staff_posts_per_page', '9');
			$wpex_query = new WP_Query(
				array(
					'post_type'			=> 'staff',
					'posts_per_page'	=> $display_count,
					'paged'				=> $paged
				)
			);

			// If staff posts are found lets loop through them
			if ( $wpex_query->posts ) : ?>

				<div id="staff-wrap" class="wpex-row clr">

					<?php $wpex_count=0; ?>

					<?php foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

						<?php $wpex_count++; ?>

							<?php get_template_part( 'partials/staff/entry' ); ?>

						<?php if ( $wpex_count == '3' ) $wpex_count=0; ?>

					<?php endforeach; ?>

				</div><!-- #staff-wrap -->

				<?php wpex_pagination(); ?>

			<?php endif; ?>

			<?php
			// Reset the query
			wp_reset_postdata( $wpex_query ); ?>

		</main><!-- #content -->

	</div><!-- #primary -->
	
<?php get_footer(); ?>