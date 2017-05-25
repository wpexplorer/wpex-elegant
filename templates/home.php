<?php
/**
 * Template Name: Homepage
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

			<?php while ( have_posts() ) : the_post(); ?>

				<article class="homepage-wrap clr">

					<?php include( locate_template( 'partials/home/layout.php' ) ); ?>
					
				</article><!-- #post -->

			<?php endwhile; ?>

		</main><!-- #content -->

	</div><!-- #primary -->
	
<?php get_footer(); ?>