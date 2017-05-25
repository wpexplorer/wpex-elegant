<?php
/**
 * Portfolio single related posts
 *
 * @package     Elegant WordPress theme
 * @subpackage  Partials
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled
if ( ! get_theme_mod( 'wpex_portfolio_related', true ) ) {
	return;
}

// Query arguments
$args = apply_filters( 'wpex_portfolio_related_args', array(
	'post_type'      => 'portfolio',
	'posts_per_page' => get_theme_mod( 'portfolio_more_count', '4' ),
	'orderby'        => 'rand',
	'no_found_rows'  => true,
) );

// Query posts
$wpex_query = new WP_Query( $args );

// Display relatest posts if posts are found
if ( $wpex_query->posts ) : ?>

	<div class="clear"></div>

	<div id="single-portfolio-related" class="clr">

		<h3 class="heading"><span><?php echo get_theme_mod( 'wpex_portfolio_related_heading', __( 'Other Work', 'elegant' ) ); ?></span></h3>

		<div class="wpex-row clr">

		<?php $wpex_count=0; ?>

		<?php foreach( $wpex_query->posts as $post ) : setup_postdata($post); ?>

			<?php $wpex_count++; ?>

			<?php get_template_part( 'partials/portfolio/entry' ); ?>

			<?php if ( $wpex_count == '4' ) $wpex_count = 0; ?>

		<?php endforeach; ?>

		</div><!-- .wpex-row -->

	</div><!-- .single-portfolio-related -->

<?php
// End loop
endif;

// Reset post data
wp_reset_postdata(); ?>