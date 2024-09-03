<?php
/**
 * Registers the "Slides" custom post type
 *
 * @package     Elegant WordPress theme
 * @subpackage  Post Types
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       2.0.0
 */

if ( ! class_exists( 'WPEX_Slides_Post_Type' ) ) {

	class WPEX_Slides_Post_Type {

		/**
		 * Class Constructor
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function __construct() {

			// Adds the slides post type and taxonomies
			add_action( 'init', array( $this, 'register' ), 0 );

			// Thumbnail support for slides posts
			add_theme_support( 'post-thumbnails', array( 'slides' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-slides_columns', array( $this, 'edit_cols' ) );
			add_action( 'manage_posts_custom_column', array( $this, 'cols_display' ), 10, 2 );

		}


		/**
		 * Register the post type
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 * @link	http://codex.wordpress.org/Function_Reference/register_post_type
		 */
		public function register() {

			// Define post type labels
			$labels = array(
				'name'					=> esc_html__( 'Slides', 'wpex-elegant' ),
				'menu_name'				=> esc_html__( 'Home Slides', 'wpex-elegant' ),
				'singular_name'			=> esc_html__( 'Slides Item', 'wpex-elegant' ),
				'add_new'				=> esc_html__( 'Add New Item', 'wpex-elegant' ),
				'add_new_item'			=> esc_html__( 'Add New Slides Item', 'wpex-elegant' ),
				'edit_item'				=> esc_html__( 'Edit Slides Item', 'wpex-elegant' ),
				'new_item'				=> esc_html__( 'Add New Slides Item', 'wpex-elegant' ),
				'view_item'				=> esc_html__( 'View Item', 'wpex-elegant' ),
				'search_items'			=> esc_html__( 'Search Slides', 'wpex-elegant' ),
				'not_found'				=> esc_html__( 'No slides items found', 'wpex-elegant' ),
				'not_found_in_trash'	=> esc_html__( 'No slides items found in trash', 'wpex-elegant' )
			);

			// Define post type args
			$args = array(
				'labels'			  => $labels,
				'public'			  => true,
				'supports'			  => array( 'title', 'thumbnail', 'custom-fields' ),
				'capability_type'	  => 'post',
				'rewrite'			  => array( 'slug' => 'slides' ),
				'has_archive'		  => false,
				'menu_icon'			  => 'dashicons-images-alt2',
				'exclude_from_search' => true,
			);

			// Apply filters for child theming
			$args = apply_filters( 'wpex_slides_args', $args);

			// Register the post type
			register_post_type( 'slides', $args );

		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 */
		public function edit_cols( $columns ) {
			$slides_columns = array(
				'cb'				=> '<input type=\"checkbox\" />',
				'title'				=> esc_html__( 'Title', 'wpex-elegant' ),
				'slides_thumbnail'	=> esc_html__( 'Thumbnail', 'wpex-elegant' )
			);
			return $slides_columns;
		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function cols_display( $slides_columns, $post_id ) {

			switch ( $slides_columns ) {

				// Display the thumbnail in the column view
				case 'slides_thumbnail':

					$thumb = get_post_thumbnail_id();

					if ( ! empty( $thumb ) ) {
						echo wp_get_attachment_image( $thumb, array( '80', '80' ), true );
					} else {
						echo '&mdash;';
					}

				break;

			}

		}

	}

}
new WPEX_Slides_Post_Type;