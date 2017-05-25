<?php
/**
 * The template for displaying your Staff Category custom taxonomy archives.
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

			<?php get_template_part( 'partials/archive-header' ); ?>

			<?php if ( have_posts( ) ) : ?>

				<div id="portfolio-wrap" class="wpex-row clr">

					<?php $wpex_count=0; ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php $wpex_count++; ?>

							<?php get_template_part( 'partials/staff/entry' ); ?>

						<?php if ( $wpex_count == '3' ) $wpex_count=0; ?>
						
					<?php endwhile; ?>

				</div><!-- #portfolio-wrap -->

				<?php wpex_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #content -->

	</div><!-- #primary -->

<?php get_footer(); ?>