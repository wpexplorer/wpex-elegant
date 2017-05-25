<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">

		<main id="content" class="site-content left-content clr" role="main">

			<?php
			// Get archive header
			get_template_part( 'partials/archive-header' ); ?>

			<?php
			// Check if posts exist
			if ( have_posts() ) : ?>

				<?php
				// Loop through posts
				while ( have_posts() ) : the_post(); ?>

					<?php
					// Get post entry content
					get_template_part( 'partials/entry/layout' ); ?>

				<?php endwhile; ?>

				<?php
				// Display pagination
				wpex_pagination(); ?>

			<?php
			// No posts found
			else : ?>

				<?php
				// Display no post found notice
				get_template_part( 'partials/none' ); ?>

			<?php endif; ?>

		</main><!-- #content -->

		<?php get_sidebar(); ?>

	</div><!-- #primary -->

<?php get_footer(); ?>