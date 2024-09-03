<?php
/**
 * The default template for displaying portfolio entries
 *
 * @package     Elegant WordPress theme
 * @subpackage  Partials
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="portfolio-entry-media">

			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
				<?php the_post_thumbnail( 'wpex-portfolio-entry', array(
					'class'	=> 'portfolio-entry-img',
				) ); ?>
			</a>

		</div><!-- .portfolio-entry-media -->

	<?php endif; ?>

	<div class="portfolio-entry-details clr">

		<h3 class="portfolio-entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>

		<div class="portfolio-entry-categories clr">
			<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?> 
		</div><!-- .portfolio-entry-categories -->

	</div><!-- .portfolio-entry-details -->

</article><!-- .portfolio-entry -->