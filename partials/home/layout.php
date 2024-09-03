<?php
/**
 * Homepage Layout
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

// Display homepage content
get_template_part( 'partials/home/content' );

// Display homepage features
if ( get_theme_mod( 'wpex_home_features', true ) ) {
	include( locate_template( 'partials/home/features.php' ) );
}

// Display homepage portfolio items
if ( get_theme_mod( 'wpex_portfolio', true ) ) {
	include( locate_template( 'partials/home/portfolio.php' ) );
}

// Display homepage blog items
include( locate_template( 'partials/home/blog.php' ) );