<?php
/**
 * Homepage Features
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
if ( ! get_theme_mod( 'wpex_homepage_features', true ) ) {
	return;
}

// Query features
$wpex_query = new WP_Query( array(
	'order'          => 'ASC',
	'orderby'        => 'menu_order',
	'post_type'      => 'features',
	'posts_per_page' => '-1',
	'no_found_rows'  => true,
) );

// Display features
if ( $wpex_query->posts ) : ?>

	<div id="homepage-features" class="wpex-grid wpex-grid-cols-4">
		<?php foreach ( $wpex_query->posts as $post ) : setup_postdata( $post );
			get_template_part( 'partials/features/entry' );
		endforeach; ?>
	</div><!-- #homepage-features -->

<?php endif;

// Reset post data
wp_reset_postdata();