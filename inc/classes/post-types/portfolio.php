<?php
/**
 * Registers the "Portfolio" custom post type
 *
 * @package     Elegant WordPress theme
 * @subpackage  Post Types
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

if ( ! class_exists( 'WPEX_Portfolio_Post_Type' ) ) {

	class WPEX_Portfolio_Post_Type {

		/**
		 * Class Constructor
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function __construct() {

			// Adds image sizes for portfolio items
			add_action( 'after_setup_theme', array( $this, 'image_sizes' ) );

			// Adds the portfolio post type and taxonomies
			add_action( 'init', array( $this, 'register' ), 0 );

			// Thumbnail support for portfolio posts
			add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-portfolio_columns', array( $this, 'edit_cols' ) );
			add_action( 'manage_posts_custom_column', array( $this, 'cols_display' ), 10, 2 );

			// Allows filtering of posts by taxonomy in the admin view
			add_action( 'restrict_manage_posts', array( $this, 'tax_filters' ) );

			// Enable the gallery metabox for portfolio items
			add_filter( 'wpex_gallery_metabox_post_types', array( $this, 'gallery_metabox' ) );

		}

		/**
		 * Adds image sizes for portfolio items
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 * @link	http://codex.wordpress.org/Function_Reference/add_image_size
		 */
		public function image_sizes() {
			add_image_size( 'wpex-portfolio-entry', 400, 340, true );
			add_image_size( 'wpex-portfolio-post', 9999, 9999, false );
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
				'name'                  => __( 'Portfolio', 'wpex-elegant' ),
				'singular_name'         => __( 'Project', 'wpex-elegant' ),
				'add_new'               => __( 'Add New Project', 'wpex-elegant' ),
				'add_new_item'          => __( 'Add New Project', 'wpex-elegant' ),
				'edit_item'             => __( 'Edit Project', 'wpex-elegant' ),
				'new_item'              => __( 'Add New Project', 'wpex-elegant' ),
				'view_item'             => __( 'View Project', 'wpex-elegant' ),
				'search_items'          => __( 'Search Projects', 'wpex-elegant' ),
				'not_found'             => __( 'No Projects Found', 'wpex-elegant' ),
				'not_found_in_trash'    => __( 'No Projects Found In Trash', 'wpex-elegant' )
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
					'revisions',
					'post-formats'
				),
				'capability_type'	=> 'post',
				'rewrite'			=> array(
					'slug' => 'portfolio-item',
				),
				'has_archive'		=> false,
				'menu_icon'			=> 'dashicons-portfolio',
			);

			// Apply filters for child theming
			$args = apply_filters( 'wpex_portfolio_args', $args);

			// Register the post type
			register_post_type( 'portfolio', $args );

			// Define portfolio category taxonomy labels
			$labels = array(
				'name'                       => __( 'Portfolio Categories', 'wpex-elegant' ),
				'singular_name'              => __( 'Portfolio Category', 'wpex-elegant' ),
				'menu_name'                  => __( 'Categories', 'wpex-elegant' ),
				'search_items'               => __( 'Search','wpex-elegant' ),
				'popular_items'              => __( 'Popular', 'wpex-elegant' ),
				'all_items'                  => __( 'All', 'wpex-elegant' ),
				'parent_item'                => __( 'Parent', 'wpex-elegant' ),
				'parent_item_colon'          => __( 'Parent', 'wpex-elegant' ),
				'edit_item'                  => __( 'Edit', 'wpex-elegant' ),
				'update_item'                => __( 'Update', 'wpex-elegant' ),
				'add_new_item'               => __( 'Add New', 'wpex-elegant' ),
				'new_item_name'              => __( 'New', 'wpex-elegant' ),
				'separate_items_with_commas' => __( 'Separate with commas', 'wpex-elegant' ),
				'add_or_remove_items'        => __( 'Add or remove', 'wpex-elegant' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'wpex-elegant' ),
			);

			// Define portfolio category taxonomy args
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'show_in_nav_menus'	=> true,
				'show_ui'			=> true,
				'show_tagcloud'		=> true,
				'hierarchical'		=> true,
				'rewrite'			=> array(
					'slug' => 'portfolio-category'
				),
				'query_var'			=> true
			);

			// Apply filters for child theming
			$args = apply_filters( 'wpex_portfolio_category_args', $args );

			// Register the portfolio_category taxonomy
			register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );

		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 */
		public function edit_cols( $columns ) {
			$columns[ 'portfolio_thumbnail' ] = __( 'Thumbnail', 'wpex-elegant' );
			$columns[ 'portfolio_category' ]  = __( 'Category', 'wpex-elegant' );
			return $columns;
		}

		/**
		 * Adds columns in the admin view for thumbnail and taxonomies
		 *
		 * @since   2.0.0
		 * @access  public
		 */
		public function cols_display( $portfolio_columns, $post_id ) {

			switch ( $portfolio_columns ) {

				// Display the thumbnail in the column view
				case 'portfolio_thumbnail':

					$thumb = get_post_thumbnail_id();

					if ( ! empty( $thumb ) ) {
						echo wp_get_attachment_image( $thumb, array( '80', '80' ), true );
					} else {
						echo '&mdash;';
					}

				break;

				// Display the portfolio tags in the column view
				case 'portfolio_category':

					if ( get_the_terms( $post_id, 'portfolio_category' ) ) {
						echo get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' );
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
			$taxonomies = array( 'portfolio_category' );

			// must set this to the post type you want the filter(s) displayed on
			if ( $typenow == 'portfolio' ) {

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

		/**
		 * Enable the gallery metabox for portfolio items
		 *
		 * @since   2.0.0
		 * @access  public
		 *
		 */
		public function gallery_metabox( $types ) {

			// Enable for portfolio
			$types[] = 'portfolio';

			// Return types
			return $types;

		}

	}
}
new WPEX_Portfolio_Post_Type;