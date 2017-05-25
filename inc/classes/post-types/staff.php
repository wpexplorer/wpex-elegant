<?php
/**
 * Registers the "Staff" custom post type
 *
 * @package     Elegant WordPress theme
 * @subpackage  Post Types
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

if ( ! class_exists( 'WPEX_Staff_Post_Type' ) ) {

	class WPEX_Staff_Post_Type {

		/**
		 * Class Constructor
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function __construct() {

			// Adds the staff post type and taxonomies
			add_action( 'init', array( &$this, 'register' ), 0 );

			// Thumbnail support for staff posts
			add_theme_support( 'post-thumbnails', array( 'staff' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-staff_columns', array( &$this, 'edit_cols' ) );
			add_action( 'manage_posts_custom_column', array( &$this, 'cols_display' ), 10, 2 );

			// Allows filtering of posts by taxonomy in the admin view
			add_action( 'restrict_manage_posts', array( &$this, 'tax_filters' ) );

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
				'name'					=> __( 'Staff', 'elegant' ),
				'singular_name'			=> __( 'Staff Item', 'elegant' ),
				'add_new'				=> __( 'Add New Item', 'elegant' ),
				'add_new_item'			=> __( 'Add New Staff Item', 'elegant' ),
				'edit_item'				=> __( 'Edit Staff Item', 'elegant' ),
				'new_item'				=> __( 'Add New Staff Item', 'elegant' ),
				'view_item'				=> __( 'View Item', 'elegant' ),
				'search_items'			=> __( 'Search Staff', 'elegant' ),
				'not_found'				=> __( 'No staff items found', 'elegant' ),
				'not_found_in_trash'	=> __( 'No staff items found in trash', 'elegant' )
			);
			
			// Define post type args
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'supports'			=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', 'revisions' ),
				'capability_type'	=> 'post',
				'rewrite'			=> array("slug" => "staff-member"), // Permalinks format
				'has_archive'		=> false,
				'menu_icon'			=> 'dashicons-groups',
			); 
			
			// Apply filters for child theming
			$args = apply_filters( 'wpex_staff_args', $args);
			
			// Register the post type
			register_post_type( 'staff', $args );


			// Define staff category taxonomy labels
			$cat_labels = array(
				'name'							=> __( 'Staff Categories', 'elegant' ),
				'singular_name'					=> __( 'Staff Category', 'elegant' ),
				'search_items'					=> __( 'Search Staff Categories', 'elegant' ),
				'popular_items'					=> __( 'Popular Staff Categories', 'elegant' ),
				'all_items'						=> __( 'All Staff Categories', 'elegant' ),
				'parent_item'					=> __( 'Parent Staff Category', 'elegant' ),
				'parent_item_colon'				=> __( 'Parent Staff Category:', 'elegant' ),
				'edit_item'						=> __( 'Edit Staff Category', 'elegant' ),
				'update_item'					=> __( 'Update Staff Category', 'elegant' ),
				'add_new_item'					=> __( 'Add New Staff Category', 'elegant' ),
				'new_item_name'					=> __( 'New Staff Category Name', 'elegant' ),
				'separate_items_with_commas'	=> __( 'Separate staff categories with commas', 'elegant' ),
				'add_or_remove_items'			=> __( 'Add or remove staff categories', 'elegant' ),
				'choose_from_most_used'			=> __( 'Choose from the most used staff categories', 'elegant' ),
				'menu_name'						=> __( 'Staff Categories', 'elegant' ),
			);

			// Define staff category taxonomy args
			$cat_args = array(
				'labels'			=> $cat_labels,
				'public'			=> true,
				'show_in_nav_menus'	=> true,
				'show_ui'			=> true,
				'show_tagcloud'		=> true,
				'hierarchical'		=> true,
				'rewrite'			=> array( 'slug' => 'staff-category' ),
				'query_var'			=> true
			);

			// Apply filters for child theming
			$cat_args = apply_filters( 'wpex_taxonomy_staff_category_args', $cat_args );
			
			// Register the staff_category taxonomy
			register_taxonomy( 'staff_category', array( 'staff' ), $cat_args );

		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 */
		public function edit_cols( $columns ) {
			$columns['staff_thumbnail']	= __( 'Thumbnail', 'elegant' );
			$columns['staff_category']	= __( 'Category', 'elegant' );
			return $columns;
		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function cols_display( $staff_columns, $post_id ) {

			switch ( $staff_columns ) {

				// Display the thumbnail in the column view
				case "staff_thumbnail":
					
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

				// Display the staff tags in the column view
				case "staff_category":

					if ( $category_list = get_the_term_list( $post_id, 'staff_category', '', ', ', '' ) ) {
						echo $category_list;
					} else {
						echo __( 'None', 'elegant' );
					}

				break;	
		
			}
		}

		/**
		 * Adds taxonomy filters to the portfolio admin page
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function tax_filters() {

			global $typenow;

			// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
			$taxonomies = array( 'staff_category' );

			// must set this to the post type you want the filter(s) displayed on
			if ( $typenow == 'staff' ) {

				foreach ( $taxonomies as $tax_slug ) {

					$current_tax_slug	= isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
					$tax_obj			= get_taxonomy( $tax_slug );
					$tax_name			= $tax_obj->labels->name;
					$terms				= get_terms( $tax_slug );

					if ( count( $terms ) > 0 ) {
						echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
						echo "<option value=''>$tax_name</option>";
						foreach ( $terms as $term ) {
							echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' ( ' . $term->count .')</option>';
						}
						echo "</select>";
					}

				}
			}
		}

	}

}
$wpex_staff_post_type = new WPEX_Staff_Post_Type;