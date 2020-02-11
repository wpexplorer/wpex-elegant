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
			add_action( 'init', array( $this, 'register' ), 0 );

			// Thumbnail support for staff posts
			add_theme_support( 'post-thumbnails', array( 'staff' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-staff_columns', array( $this, 'edit_cols' ) );
			add_action( 'manage_posts_custom_column', array( $this, 'cols_display' ), 10, 2 );

			// Allows filtering of posts by taxonomy in the admin view
			add_action( 'restrict_manage_posts', array( $this, 'tax_filters' ) );

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
				'name'					=> __( 'Staff', 'wpex-elegant' ),
				'singular_name'			=> __( 'Staff Member', 'wpex-elegant' ),
				'add_new'				=> __( 'Add New Member', 'wpex-elegant' ),
				'add_new_item'			=> __( 'Add New Staff Member', 'wpex-elegant' ),
				'edit_item'				=> __( 'Edit Staff Member', 'wpex-elegant' ),
				'new_item'				=> __( 'Add New Staff Member', 'wpex-elegant' ),
				'view_item'				=> __( 'View Member', 'wpex-elegant' ),
				'search_items'			=> __( 'Search Staff', 'wpex-elegant' ),
				'not_found'				=> __( 'No staff items found', 'wpex-elegant' ),
				'not_found_in_trash'	=> __( 'No staff items found in trash', 'wpex-elegant' )
			);

			// Define post type args
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'supports'			=> array(
					'title',
					'editor',
					'excerpt',
					'thumbnail',
					'comments',
					'custom-fields',
					'revisions'
				),
				'capability_type'	=> 'post',
				'rewrite'			=> array(
					'slug' => 'staff-member'
				),
				'has_archive'		=> false,
				'menu_icon'			=> 'dashicons-groups',
			);

			// Apply filters for child theming
			$args = apply_filters( 'wpex_staff_args', $args);

			// Register the post type
			register_post_type( 'staff', $args );


			// Define staff category taxonomy labels
			$cat_labels = array(
				'name'							=> __( 'Staff Categories', 'wpex-elegant' ),
				'singular_name'					=> __( 'Staff Category', 'wpex-elegant' ),
				'search_items'					=> __( 'Search Staff Categories', 'wpex-elegant' ),
				'popular_items'					=> __( 'Popular Staff Categories', 'wpex-elegant' ),
				'all_items'						=> __( 'All Staff Categories', 'wpex-elegant' ),
				'parent_item'					=> __( 'Parent Staff Category', 'wpex-elegant' ),
				'parent_item_colon'				=> __( 'Parent Staff Category:', 'wpex-elegant' ),
				'edit_item'						=> __( 'Edit Staff Category', 'wpex-elegant' ),
				'update_item'					=> __( 'Update Staff Category', 'wpex-elegant' ),
				'add_new_item'					=> __( 'Add New Staff Category', 'wpex-elegant' ),
				'new_item_name'					=> __( 'New Staff Category Name', 'wpex-elegant' ),
				'separate_items_with_commas'	=> __( 'Separate staff categories with commas', 'wpex-elegant' ),
				'add_or_remove_items'			=> __( 'Add or remove staff categories', 'wpex-elegant' ),
				'choose_from_most_used'			=> __( 'Choose from the most used staff categories', 'wpex-elegant' ),
				'menu_name'						=> __( 'Categories', 'wpex-elegant' ),
			);

			// Define staff category taxonomy args
			$cat_args = array(
				'labels'			=> $cat_labels,
				'public'			=> true,
				'show_in_nav_menus'	=> true,
				'show_ui'			=> true,
				'show_tagcloud'		=> true,
				'hierarchical'		=> true,
				'rewrite'			=> array(
					'slug' => 'staff-category'
				),
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
			$columns[ 'staff_thumbnail' ] = __( 'Thumbnail', 'wpex-elegant' );
			$columns[ 'staff_category' ]  = __( 'Category', 'wpex-elegant' );
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
				case 'staff_thumbnail':

					$thumb = get_post_thumbnail_id();

					if ( ! empty( $thumb ) ) {
						echo wp_get_attachment_image( $thumb, array( '80', '80' ), true );
					} else {
						echo '&mdash;';
					}

				break;

				// Display the staff tags in the column view
				case 'staff_category':

					if ( get_the_terms( $post_id, 'staff_category' ) ) {
						echo get_the_term_list( $post_id, 'staff_category', '', ', ', '' );
					} else {
						echo '&mdash;';
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
							echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( $current_tax_slug, $term->slug ) . '>' . esc_html( $term->name ) .' ( ' . absint( $term->count ) . ')</option>';
						}
						echo "</select>";
					}

				}

			}

		}

	}

}
new WPEX_Staff_Post_Type;