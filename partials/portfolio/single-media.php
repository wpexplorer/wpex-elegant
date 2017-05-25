<?php
/**
 * Portfolio single media
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

// Return if password protected
if ( post_password_required() ) {
	return;
}

// Get post format
$format = get_post_format();

// Portfolio Gallery
if ( 'gallery' == $format ) {

	get_template_part( 'partials/portfolio/single-gallery' );

} elseif ( 'video' == $format ) {

	get_template_part( 'partials/portfolio/single-video' );

}