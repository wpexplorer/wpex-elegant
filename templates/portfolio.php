<?php
/**
 * Template Name: Portfolio
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
			// Query portfolio posts
			global $post, $paged;
			$paged			= get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$wpex_query		= new WP_Query(
				array(
					'post_type'			=> 'portfolio',
					'posts_per_page'	=> get_theme_mod( 'wpex_portfolio_posts_per_page', '12' ),
					'paged'				=> $paged
				)
			);
			// If portfolio posts are found lets loop through them
			if ( $wpex_query->posts ) : ?>

				<div id="portfolio-wrap" class="wpex-row clr">

					<?php $wpex_count=0; ?>

					<?php foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

						<?php $wpex_count++; ?>

							<?php get_template_part( 'partials/portfolio/entry' ); ?>

						<?php if ( $wpex_count == '4' ) $wpex_count=0; ?>

					<?php endforeach; ?>

				</div><!-- #portfolio-wrap -->

				<?php wpex_pagination( $wpex_query ); ?>

			<?php endif; ?>

			<?php
			// Reset the query post data
			wp_reset_postdata(); ?>

		</main><!-- #content -->

	</div><!-- #primary -->
	
<?php get_footer(); ?>