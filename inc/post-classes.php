<?php
/**
 * Adds classes to entries
 *
 * @package     Elegant WordPress theme
 * @subpackage  Includes
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

if ( ! function_exists( 'wpex_post_entry_classes' ) ) {

	function wpex_post_entry_classes( $classes ) {
		
		// Post Data
		global $post, $wpex_count;
		$post_id = $post->ID;
		$post_type = get_post_type($post_id);

		// Do nothing for slides
		if ( $post_type == 'slides' ) {
			return $classes;
		}

		// Search results
		if ( is_search() ) {
			$classes[] = 'search-entry';
			if ( ! has_post_thumbnail() ) {
				$classes[] = 'no-featured-image';
			}
			return $classes;
		}

		// Custom class for non standard post types
		if ( $post_type !== 'post' ) {
			$classes[] = $post_type .'-entry';
		}

		// Counter
		if ( $wpex_count ) {
			$classes[] = 'count-'. $wpex_count;
		}

		// Portfolio
		if ( $post_type == 'portfolio' ) {
			$classes[] = 'span_1_of_4 col clr';
		}

		// Staff
		elseif ( $post_type == 'staff' ) {
			$classes[] = 'span_1_of_3 col clr';
		}


		// Features
		elseif ( $post_type == 'features' ) {
			$classes[] = 'span_1_of_4 col clr';
		}

		// All other posts
		else {
			$classes[] = 'loop-entry clr';
		}

		// Return classes
		return $classes;
		
	} // End function
	
} // End if
add_filter('post_class', 'wpex_post_entry_classes');