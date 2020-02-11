<?php
/**
 * Registers the "Features" custom post type
 *
 * @package     Elegant WordPress theme
 * @subpackage  Post Types
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

if ( ! class_exists( 'WPEX_Features_Post_Type' ) ) {

	class WPEX_Features_Post_Type {

		/**
		 * Class Constructor
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function __construct() {

			// Adds the features post type and taxonomies
			add_action( 'init', array( $this, 'register' ), 0 );

			// Thumbnail support for features posts
			add_theme_support( 'post-thumbnails', array( 'features' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-features_columns', array( $this, 'edit_cols' ) );
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

			// Declare post type labels
			$labels = array(
				'name'					=> __( 'Features', 'wpex-elegant' ),
				'menu_name'				=> __( 'Home Features', 'wpex-elegant' ),
				'singular_name'			=> __( 'Features Item', 'wpex-elegant' ),
				'add_new'				=> __( 'Add New Item', 'wpex-elegant' ),
				'add_new_item'			=> __( 'Add New Features Item', 'wpex-elegant' ),
				'edit_item'				=> __( 'Edit Features Item', 'wpex-elegant' ),
				'new_item'				=> __( 'Add New Features Item', 'wpex-elegant' ),
				'view_item'				=> __( 'View Item', 'wpex-elegant' ),
				'search_items'			=> __( 'Search Features', 'wpex-elegant' ),
				'not_found'				=> __( 'No features items found', 'wpex-elegant' ),
				'not_found_in_trash'	=> __( 'No features items found in trash', 'wpex-elegant' )
			);

			// Declare post type args
			$args = array(
				'labels'				=> $labels,
				'public'				=> true,
				'supports'				=> array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
				'capability_type'		=> 'post',
				'rewrite'				=> array("slug" => "features"), // Permalinks format
				'has_archive'			=> false,
				'menu_icon'				=> 'dashicons-star-filled',
				'exclude_from_search'	=> true,
			);

			// Apply filters for child theming
			$args = apply_filters( 'wpex_features_args', $args );

			// Register the features post type
			register_post_type( 'features', $args );

		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function edit_cols( $features_columns ) {
			$features_columns = array(
				"cb"					=> "<input type=\"checkbox\" />",
				"title"					=> __( 'Title', 'wpex-elegant' ),
				"features_thumbnail"	=> __( 'Thumbnail', 'wpex-elegant' )
			);
			return $features_columns;
		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function cols_display( $features_columns, $post_id ) {

			switch ( $features_columns ) {

				// Display the thumbnail in the column view
				case "features_thumbnail":

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
new WPEX_Features_Post_Type;