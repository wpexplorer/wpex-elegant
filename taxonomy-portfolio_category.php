<?php
/**
 * The template for displaying your Portfolio Category custom taxonomy archives.
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">

		<main id="content" class="site-content" role="main">

			<?php get_template_part( 'partials/archive-header' ); ?>

			<?php if ( have_posts( ) ) : ?>

				<div id="portfolio-wrap" class="wpex-grid wpex-grid-cols-<?php echo sanitize_html_class( get_theme_mod( 'wpex_portfolio_columns' ) ?: 4 ); ?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'partials/portfolio/entry' ); ?>
					<?php endwhile; ?>
				</div><!-- #portfolio-wrap -->

				<?php wpex_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #content -->

	</div><!-- #primary -->

<?php get_footer(); ?>