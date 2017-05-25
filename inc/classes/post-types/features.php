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
			add_action( 'init', array( &$this, 'register' ), 0 );

			// Thumbnail support for features posts
			add_theme_support( 'post-thumbnails', array( 'features' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-features_columns', array( &$this, 'edit_cols' ) );
			add_action( 'manage_posts_custom_column', array( &$this, 'cols_display' ), 10, 2 );
			
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
				'name'					=> __( 'Features', 'elegant' ),
				'menu_name'				=> __( 'Home Features', 'elegant' ),
				'singular_name'			=> __( 'Features Item', 'elegant' ),
				'add_new'				=> __( 'Add New Item', 'elegant' ),
				'add_new_item'			=> __( 'Add New Features Item', 'elegant' ),
				'edit_item'				=> __( 'Edit Features Item', 'elegant' ),
				'new_item'				=> __( 'Add New Features Item', 'elegant' ),
				'view_item'				=> __( 'View Item', 'elegant' ),
				'search_items'			=> __( 'Search Features', 'elegant' ),
				'not_found'				=> __( 'No features items found', 'elegant' ),
				'not_found_in_trash'	=> __( 'No features items found in trash', 'elegant' )
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
				"title"					=> __('Title', 'column name'),
				"features_thumbnail"	=> __('Thumbnail', 'elegant')
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

					// Get post thumbnail ID
					$thumbnail_id = get_post_thumbnail_id();

					// Display the featured image in the column view if possible
					if ( $thumbnail_id ) {
						$thumb = wp_get_attachment_image( $thumbnail_id, array( '80', '80' ), true );
					}
					if ( isset( $thumb ) ) {
						echo $thumb;
					} else {
						echo '&mdash;';
					}

				break;
			
			}
		}

	}

}
$wpex_features_post_type = new WPEX_Features_Post_Type;