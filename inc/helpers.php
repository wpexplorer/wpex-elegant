<?php
/**
 * This file includes helper functions used throughout the theme.
 *
 * @package     Elegant WordPress theme
 * @subpackage  Includes
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */


/**
 * Returns escaped post title
 *
 * @since 2.0.0
 */
function wpex_get_esc_title() {
	return esc_attr( the_title_attribute( 'echo=0' ) );
}

/**
 * Outputs escaped post title
 *
 * @since 2.0.0
 */
function wpex_esc_title() {
	echo wpex_get_esc_title();
}

/**
 * List categories for specific taxonomy
 * 
 * @link    http://codex.wordpress.org/Function_Reference/wp_get_post_terms
 * @since   1.0.0
 */
if ( ! function_exists( 'wpex_list_post_terms' ) ) {

    function wpex_list_post_terms( $taxonomy = 'category', $echo = true ) {
        $list_terms = array();
        $terms      = wp_get_post_terms( get_the_ID(), $taxonomy );
        foreach ( $terms as $term ) {
            $permalink      = get_term_link( $term->term_id, $taxonomy );
            $list_terms[]   = '<a href="'. $permalink .'" title="'. $term->name .'">'. $term->name .'</a>';
        }
        if ( ! $list_terms ) {
            return;
        }
        $list_terms = implode( ', ', $list_terms );
        if ( $echo ) {
            echo $list_terms;
        } else {
            return $list_terms;
        }
    }
    
}

/**
 * Custom excerpts based on wp_trim_words
 *
 * @since	1.0.0
 * @link	http://codex.wordpress.org/Function_Reference/wp_trim_words
 */
if ( ! function_exists( 'wpex_excerpt' ) ) {

	function wpex_excerpt( $length = 30, $readmore = false ) {

		// Get global post
		global $post;

		// Get post data
		$id			= $post->ID;
		$excerpt	= $post->post_excerpt;

		// Display custom excerpt
		if ( $excerpt ) {
			$output = $excerpt;
		}

		// Check for more tag
		elseif ( strpos( $post->post_content, '<!--more-->' ) ) {
			$wpex_more_tag	= apply_filters( 'wpex_more_tag', null );
			$output			= get_the_content( $wpex_more_tag );
		}

		// Generate auto excerpt
		else {
			$output = wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length );
			if ( $readmore == true ) {
				$text			= apply_filters( 'wpex_readmore_text', __( 'continue reading', 'elegant' ) );
				$readmore_link	= '<span class="wpex-readmore"><a href="'. get_permalink( $id ) .'" title="'. $text .'" rel="bookmark">'. $text .' &rarr;</a></span>';
				$output .= apply_filters( 'wpex_readmore_link', $readmore_link );
			}
		}

		// Echo output
		echo $output;

	}
}

/**
 * Numbered Pagination
 *
 * @since	1.0.0
 * @link	https://codex.wordpress.org/Function_Reference/paginate_links
 */
if ( ! function_exists( 'wpex_pagination') ) {

	function wpex_pagination( $custom_query = '' ) {

		// Get currect number of pages and define total var
		if ( $custom_query ) {
			$total = $custom_query->max_num_pages;
		} else {
			global $wp_query;
			$total = $wp_query->max_num_pages;
		}

		// Display pagination if total var is greater then 1 ( current query is paginated )
		if ( $total > 1 )  {

			// Set current page if not defined
			if ( ! $current_page = get_query_var( 'paged') ) {
				 $current_page = 1;
			 }

			// Get currect format
			if ( get_option( 'permalink_structure') ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}

			// Display pagination
			echo paginate_links(array(
				'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'format'    => $format,
				'current'   => max( 1, get_query_var( 'paged') ),
				'total'     => $total,
				'mid_size'  => 2,
				'type'      => 'list',
				'prev_text' => '<i class="fa fa-angle-left"></i>',
				'next_text' => '<i class="fa fa-angle-right"></i>',
			) );
		}
	}

}


/**
 * Next and previous pagination
 *
 * @since	1.0.0
 */
if ( ! function_exists( 'wpex_pagejump' ) ) {

	function wpex_pagejump( $pages = '' ) {

		// Set correct paged var
		global $paged;
		if ( empty( $paged ) ) {
			$paged = 1;
		}

		// Get pages var
		if ( ! $pages ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		}

		// Display next/previous pagination
		if ( 1 != $pages ) {
			echo '<div class="post-navigation clr"><div class="alignleft">';
				previous_posts_link( '&larr; ' . __( 'Newer Posts', 'elegant' ) );
			echo '</div><div class="alignright">';
				next_posts_link( __( 'Older Posts', 'elegant' ) .' &rarr;' );
			echo '</div></div>';
		}
		
	}

}