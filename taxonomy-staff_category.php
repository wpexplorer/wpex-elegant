<?php
/**
 * The template for displaying your Staff Category custom taxonomy archives.
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

				<div id="staff-wrap" class="wpex-grid wpex-grid-cols-<?php echo sanitize_html_class( get_theme_mod( 'wpex_staff_columns' ) ?: 3 ); ?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'partials/staff/entry' ); ?>
					<?php endwhile; ?>
				</div><!-- #staff-wrap -->

				<?php wpex_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #content -->

	</div><!-- #primary -->

<?php get_footer(); ?>