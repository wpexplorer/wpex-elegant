<?php
/**
 * Displays the post entry thumbmnail
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
if ( ! has_post_thumbnail() || ! get_theme_mod( 'wpex_blog_entry_thumb', true ) ) {
	return;
} ?>

<div class="loop-entry-thumbnail">

	<a href="<?php the_permalink(); ?>" title="<?php wpex_esc_title(); ?>">

		<?php
		// Display post thumbnail
		the_post_thumbnail( 'wpex-entry', array(
			'alt'	=> wpex_get_esc_title(),
		) ); ?>
		
	</a>

</div><!-- .post-entry-thumbnail -->