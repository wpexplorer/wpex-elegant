<?php
/**
 * Single post thumbnail
 *
 * @package		WordPress
 * @subpackage	Corporate WPExplorer Theme
 * @since		Corporate 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// REturn if disabled or there isn't a thumbnail defined
if ( ! has_post_thumbnail() || ! get_theme_mod( 'wpex_blog_post_thumb', true ) ) {
	return;
} ?>

<div class="post-thumbnail">
	<?php
	// Display post thumbnail
	the_post_thumbnail( 'wpex-post', array(
		'alt'	=> wpex_get_esc_title(),
	) ); ?>
</div><!-- .post-entry-thumbnail -->