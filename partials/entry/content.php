<?php
/**
 * Displays post entry content
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

<div class="loop-entry-content entry clr">

	<?php
	// Display full content
	if ( get_theme_mod( 'wpex_entry_content_excerpt','excerpt' ) == 'content' ) {
		the_content();
	}
	// Display custom excerpt
	else {
		wpex_excerpt( 40, get_theme_mod( 'wpex_blog_readmore', true ) );
	} ?>

</div><!-- .loop-entry-content -->