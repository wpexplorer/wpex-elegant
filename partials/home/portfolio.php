<?php
/**
 * Homepage Portfolio
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

// Get count
$count = intval( get_theme_mod( 'wpex_home_portfolio_count', 4 ) );

// Return if disabled
if ( ! $count || ! get_theme_mod( 'wpex_homepage_portfolio', true ) ) {
	return;
}

// Query posts
$args = apply_filters( 'wpex_homepage_portfolio_args', array(
	'post_type'			=> 'portfolio',
	'posts_per_page'	=> $count,
	'no_found_rows'		=> true,
) );
if ( $term = get_theme_mod( 'wpex_home_portfolio_category' ) ) {
	$args['tax_query'] = array( array(
		'taxonomy' => 'portfolio_category',
		'field'    => 'id',
		'terms'    => array( $term )
	) );
}
$wpex_query = new WP_Query( $args );

// Display portfolio posts
if ( $wpex_query->posts ) : ?>

	<div id="homepage-portfolio" class="clr">

		<?php
		// Get heading text
		$heading = get_theme_mod( 'wpex_homepage_portfolio_heading' );
		if ( ! $heading ) {
			if ( $term ) {
				$term = get_term( $term, 'portfolio_category' );
			}
			$heading = ( $term && $term->name ) ? $term->name : esc_html__( 'Recent Work', 'wpex-elegant' );
		}
		if ( $heading ) : ?>
			<h2 class="heading">
				<span><?php echo esc_html( $heading ); ?></span>
			</h2>
		<?php endif; ?>

		<div class="wpex-grid wpex-grid-cols-<?php echo sanitize_html_class( get_theme_mod( 'wpex_home_portfolio_columns' ) ?: 4 ); ?>">
			<?php
			foreach( $wpex_query->posts as $post ) : setup_postdata( $post );
				get_template_part( 'partials/portfolio/entry', get_post_format() );
			endforeach; ?>
		</div><!-- .wpex-row -->

	</div><!-- #homepage-portfolio -->

<?php
// End posts check
endif;

// Reset post data
wp_reset_postdata();