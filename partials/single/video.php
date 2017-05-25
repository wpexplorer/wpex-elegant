<?php
/**
 * Post single video
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

// Get video
$video_url = get_post_meta( get_the_ID(), 'wpex_post_video', true );

// Return if there isn't any video
if ( ! $video_url ) {
	return;
}

// Get embed
$embed_code = wp_oembed_get( $video_url );

// Return if embed code returns false or empty
if ( ! $embed_code || is_wp_error( $embed_code ) ) {
	return;
} ?>

<div class="post-video wpex-video-embed clr">
	<?php echo $embed_code; ?>
</div><!-- .post-video -->