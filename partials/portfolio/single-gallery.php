<?php
/**
 * Portfolio single gallery
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

// Get gallery image ids
$attachments = wpex_get_gallery_ids();

// Return if there aren't any images
if ( ! $attachments ) {
	return;
}

wp_enqueue_script( 'wpex-post-slider' );

?>

<div class="post-slider-wrap clr flexslider-container">
	<div class="post-slider flexslider">
		<ul class="slides">
			<?php
			// Loop through each attachment ID
			foreach ( $attachments as $attachment ) : ?>
				<li><?php echo wp_get_attachment_image( $attachment, 'wpex-portfolio-post' ); ?></li>
			<?php endforeach; ?>
		</ul><!-- .slides -->
	</div><!-- .post-slider .flexslider -->
</div><!-- .post-slider-wrap -->