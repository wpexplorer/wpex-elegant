<?php
/**
 * The template for displaying image attachments.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="content" class="site-content" role="main">

			<?php get_template_part( 'partials/page', 'header' ); ?>

			<article class="single-post-content entry clr">

				<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>

				<?php the_content(); ?>

			</article><!-- .entry -->

		</main><!-- #content -->

	</div><!-- #primary -->

<?php get_footer();?>