<?php
/**
 * The Template for displaying your single portfolio posts
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<div id="primary" class="content-area clr">

		<main id="content" class="site-content" role="main">

			<?php include( locate_template( 'partials/portfolio/single.php' ) ); ?>

		</main><!-- #content -->

	</div><!-- #primary -->

<?php endwhile; ?>

<?php get_footer(); ?>