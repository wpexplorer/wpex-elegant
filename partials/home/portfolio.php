<?php
/**
 * Homepage Portfolio
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
if ( ! get_theme_mod( 'wpex_homepage_portfolio', true ) ) {
	return;
}

// Query posts
$args = apply_filters( 'wpex_homepage_portfolio_args', array(
	'post_type'			=> 'portfolio',
	'posts_per_page'	=> get_theme_mod('wpex_home_portfolio_count', '4'),
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
			$heading = $term->name ? $term->name : __( 'Recent Work', 'elegant' );
		}
		if ( $heading ) : ?>
			<h2 class="heading">
				<span><?php echo esc_html( $heading ); ?></span>
			</h2>
		<?php endif; ?>

		<div class="wpex-row clr">
			<?php
			$wpex_count=0;
			foreach( $wpex_query->posts as $post ) : setup_postdata( $post );
				$wpex_count++;
				get_template_part( 'partials/portfolio/entry', get_post_format() );
				if ( '4' == $wpex_count ) {
					$wpex_count=0;
				}
			endforeach; ?>
		</div><!-- .wpex-row -->

	</div><!-- #homepage-portfolio -->

<?php
// End posts check
endif;

// Reset post data
wp_reset_postdata();