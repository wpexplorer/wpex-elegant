<?php
/**
 * Portfolio single related posts
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
}

// Return if disabled
if ( ! get_theme_mod( 'wpex_portfolio_related', true ) ) {
	return;
}

// Query arguments
$args = apply_filters( 'wpex_portfolio_related_args', array(
	'post_type'      => 'portfolio',
	'posts_per_page' => get_theme_mod( 'wpex_related_portfolio_count', '4' ),
	'orderby'        => 'rand',
	'no_found_rows'  => true,
) );

// Query posts
$wpex_query = new WP_Query( $args );

// Display relatest posts if posts are found
if ( $wpex_query->posts ) : ?>
	<div id="single-portfolio-related" class="clr">
		<h3 class="heading"><span><?php echo get_theme_mod( 'wpex_portfolio_related_heading', esc_html__( 'Other Work', 'wpex-elegant' ) ); ?></span></h3>
		<div class="wpex-grid wpex-grid-cols-<?php echo sanitize_html_class( get_theme_mod( 'wpex_related_portfolio_columns' ) ?: 4 ); ?>">
			<?php foreach( $wpex_query->posts as $post ) : setup_postdata($post); ?>
				<?php get_template_part( 'partials/portfolio/entry' ); ?>
			<?php endforeach; ?>
		</div><!-- .wpex-row -->
	</div><!-- .single-portfolio-related -->
<?php
// End loop
endif;

// Reset post data
wp_reset_postdata(); ?>