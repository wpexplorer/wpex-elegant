<?php
/**
 * The template for displaying image attachments.
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

	<div id="primary" class="content-area">

		<main id="content" class="site-content" role="main">

			<?php get_template_part( 'partials/page', 'header' ); ?>

			<article class="entry clr">

				<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>

				<?php the_content(); ?>

			</article><!-- .entry -->

		</main><!-- #content -->

	</div><!-- #primary -->

<?php get_footer();?>