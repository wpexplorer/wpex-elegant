<?php
/**
 * Displays next/previous links
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

<ul class="single-post-pagination clr">
	<?php next_post_link( '<li class="post-prev">%link</li>', '<i class="fa fa-angle-left"></i>' ); ?><?php previous_post_link( '<li class="post-next">%link</li>', '<i class="fa fa-angle-right"></i>' ); ?>
</ul><!-- .post-post-pagination -->
