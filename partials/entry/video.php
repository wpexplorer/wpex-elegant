<?php
/**
 * Displays the post entry video
 *
 * @package		WordPress
 * @subpackage	Corporate WPExplorer Theme
 * @since		Corporate 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get video
$video = get_post_meta( get_the_ID(), 'wpex_post_video', true );
$video = wp_oembed_get( $video );

// If there isn't any video display thumbnail
if ( ! $video ) {
	get_template_part( 'partials/entry-thumbnail' );
	return;
} ?>

<div class="loop-entry-video wpex-video-embed clr">
	<?php
	// Display video
	echo $video; ?>
</div><!-- .loop-entry-video -->