<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

// Theme info
function wpex_get_theme_info() {
	return array(
		'name'        => 'Elegant',
		'dir'         => get_template_directory_uri() .'/inc/',
		'url'         => 'http://www.wpexplorer.com/elegant-free-wordpress-theme/',
		'changelog'   => 'https://wpexplorer-updates.com/changelog/elegant/',
		'video_guide' => 'https://www.youtube.com/watch?v=SogTFYfByaY',
	);
}

class WPEX_Theme_Class {

	/**
	 * Main Theme Class Constructor
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function __construct() {

		// Auto updates
		if ( is_admin() ) {
			require_once( get_template_directory() .'/inc/updates.php' );
		}

		// Define Contstants
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Class', 'constants' ) );

		// Load theme functions
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Class', 'load_files' ) );

		// Load Classes
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Class', 'classes' ) );

		// Theme setup: Adds theme-support, image sizes, menus, etc.
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Class', 'setup' )  );

		// Flush rewrite rules on theme switch
		add_action( 'after_switch_theme', array( 'WPEX_Theme_Class', 'flush_rewrite_rules' ) );

		// Load front-end scripts
		add_action( 'wp_enqueue_scripts', array( 'WPEX_Theme_Class', 'enqueue_scripts' ) );

		// Register sidebar widget areas
		add_action( 'widgets_init', array( 'WPEX_Theme_Class', 'register_sidebars' ) );

		// Alter post formats based on custom post types
		add_action( 'load-post.php', array( 'WPEX_Theme_Class', 'adjust_formats' ) );
		add_action( 'load-post-new.php', array( 'WPEX_Theme_Class', 'adjust_formats' ) );

		// Alters posts per page for specific archives
		add_filter( 'pre_get_posts', array( 'WPEX_Theme_Class', 'pre_get_posts' ) );

		// Set default gallery metabox post types
		add_filter( 'wpex_gallery_metabox_post_types', array( 'WPEX_Theme_Class', 'gallery_metabox' ), 1 );

		// Filter the archive title
		add_filter( 'get_the_archive_title', array( 'WPEX_Theme_Class', 'get_the_archive_title' ) );

	}

	/**
	 * Define Constants
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function constants() {

		$version = self::theme_version();

		define( 'WPEX_THEME_VERSION', $version );
		define( 'WPEX_INCLUDES_DIR', get_template_directory() .'/inc/' );
		define( 'WPEX_CLASSES_DIR', WPEX_INCLUDES_DIR .'/classes/' );
		define( 'WPEX_JS_DIR_URI', get_template_directory_uri(). '/js/' );
		define( 'WPEX_CSS_DIR_URI', get_template_directory_uri(). '/css/' );

	}

	/**
	 * Returns current theme version
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function theme_version() {

		// Get theme data
		$theme = wp_get_theme();

		// Return theme version
		return $theme->get( 'Version' );

	}

	/**
	 * Load required theme functions
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function load_files() {
		$dir = WPEX_INCLUDES_DIR;

		// Configures post meta via cmb_meta_boxes filter
		require_once ( $dir .'meta-config.php' );

		// Include Customizer functions
		require_once ( $dir .'customizer/header.php' );
		require_once ( $dir .'customizer/portfolio.php' );
		require_once ( $dir .'customizer/staff.php' );
		require_once ( $dir .'customizer/blog.php' );
		require_once ( $dir .'customizer/copyright.php' );

		// Helper functions
		require_once ( $dir .'helpers.php' );

		// Adds classes to post entries
		require_once ( $dir .'post-classes.php' );

		// Comments output
		require_once ( $dir .'comments-callback.php' );

		// MCE Editor tweaks
		require_once( $dir .'mce-tweaks.php' );

		// Dashboard feeds
		if ( ! defined( 'WPEX_DISABLE_THEME_DASHBOARD_FEEDS' ) ) {
			require_once( $dir .'dashboard-feed.php' );
		}

		// Welcome page
		if ( ! defined( 'WPEX_DISABLE_THEME_ABOUT_PAGE' ) ) {
			require_once( $dir .'welcome.php' );
		}

	}

	/**
	 * Load theme classes
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function classes() {

		// Metaboxes
		if ( ! class_exists( 'cmb_Meta_Box' ) ) {
			require_once ( WPEX_CLASSES_DIR .'custom-metaboxes-and-fields/init.php' );
		}

		// Gallery metabox
		require_once( WPEX_CLASSES_DIR .'gallery-metabox/gallery-metabox.php' );

		// Post Types
		require_once( WPEX_CLASSES_DIR .'post-types/slides.php' );
		require_once( WPEX_CLASSES_DIR .'post-types/features.php' );

		if ( get_theme_mod( 'wpex_portfolio', true ) ) {
			require_once( WPEX_CLASSES_DIR .'post-types/portfolio.php' );
		}

		if ( get_theme_mod( 'wpex_staff', true ) ) {
			require_once( WPEX_CLASSES_DIR .'post-types/staff.php' );
		}

		// Menu walker
		require_once ( WPEX_CLASSES_DIR .'menu-walker.php' );

	}

	/**
	 * Theme Setup
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function setup() {

		// Set content width variable
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 980;
		}

		// Register navigation menus
		register_nav_menus (
			array(
				'main_menu'	=> __( 'Main', 'elegant' ),
			)
		);
		
		// Localization support
		load_theme_textdomain( 'elegant', get_template_directory() .'/languages' );
		
		// Enable some useful post formats for the blog
		add_theme_support( 'post-formats', array( 'video' ) );
			
		// Add theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );

		// Set default thumbnail size
		set_post_thumbnail_size( 150, 150 );

		// Add image sizes
		add_image_size( 'wpex-entry', 640, 340, true );
		add_image_size( 'wpex-post', 640, 340, true );

		if ( get_theme_mod( 'wpex_portfolio', true ) ) {
			add_image_size( 'wpex-portfolio-entry', 400, 260, true );
			add_image_size( 'wpex-portfolio-post', 9999, 9999, false );
		}

		if ( get_theme_mod( 'wpex_staff', true ) ) {
			add_image_size( 'wpex-staff-entry', 400, 9999, false );
			add_image_size( 'wpex-staff-post', 9999, 9999, false );
		}

		if ( get_theme_mod( 'wpex_homepage_slider', true ) ) {
			add_image_size( 'wpex-home-slider', 9999, 9999, false );
		}

	}

	/**
	 * Flush rewrite rules on theme switch to prevent 404 errors on built-in post types
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function flush_rewrite_rules() {
		if ( function_exists( 'flush_rewrite_rules' ) ) {
			flush_rewrite_rules();
		}
	}

	/**
	 * Load front-end scripts
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link	https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
	 */
	public static function enqueue_scripts() {

		// CSS
		wp_enqueue_style(
			'wpex-style',
			get_stylesheet_uri(),
			false,
			WPEX_THEME_VERSION
		);
		wp_enqueue_style(
			'wpex-responsive',
			WPEX_CSS_DIR_URI .'responsive.css',
			array( 'wpex-style' ),
			WPEX_THEME_VERSION
		);
		wp_enqueue_style(
			'wpex-font-awesome',
			WPEX_CSS_DIR_URI .'font-awesome.min.css',
			false,
			'4.5.0'
		);
		wp_enqueue_style(
			'open-sans',
			'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic',
			array( 'wpex-style' ),
			null
		);

		// jQuery
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script(
			'wpex-plugins',
			WPEX_JS_DIR_URI .'plugins.js',
			array( 'jquery' ),
			WPEX_THEME_VERSION,
			true
		);
		wp_enqueue_script(
			'wpex-global',
			WPEX_JS_DIR_URI .'global.js',
			array( 'jquery', 'wpex-plugins' ),
			WPEX_THEME_VERSION,
			true
		);

	}

	/**
	 * Registers sidebars
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function register_sidebars() {

		// Sidebar
		register_sidebar( array(
			'name'			=> __( 'Sidebar', 'elegant' ),
			'id'			=> 'sidebar',
			'description'	=> __( 'Widgets in this area are used in the sidebar region.', 'elegant' ),
			'before_widget'	=> '<div class="sidebar-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h5 class="widget-title">',
			'after_title'	=> '</h5>',
		) );

		// Footer 1
		register_sidebar( array(
			'name'			=> __( 'Footer 1', 'elegant' ),
			'id'			=> 'footer-one',
			'description'	=> __( 'Widgets in this area are used in the first footer region.', 'elegant' ),
			'before_widget'	=> '<div class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h6 class="widget-title">',
			'after_title'	=> '</h6>',
		) );

		// Footer 2
		register_sidebar( array(
			'name'			=> __( 'Footer 2', 'elegant' ),
			'id'			=> 'footer-two',
			'description'	=> __( 'Widgets in this area are used in the second footer region.', 'elegant' ),
			'before_widget'	=> '<div class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h6 class="widget-title">',
			'after_title'	=> '</h6>',
		) );

		// Footer 3
		register_sidebar( array(
			'name'			=> __( 'Footer 3', 'elegant' ),
			'id'			=> 'footer-three',
			'description'	=> __( 'Widgets in this area are used in the third footer region.', 'elegant' ),
			'before_widget'	=> '<div class="footer-widget %2$s clr">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h6 class="widget-title">',
			'after_title'	=> '</h6>',
		) );

	}

	/**
	 * Alter post formats based on custom post types
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function adjust_formats() {
		if ( isset( $_GET['post'] ) ) {
			$post = get_post($_GET['post']);
			if ($post) {
				$post_type = $post->post_type;
			}
		} elseif ( ! isset( $_GET['post_type'] ) ) {
			$post_type = 'post';
		} elseif ( in_array( $_GET['post_type'], get_post_types( array('show_ui' => true ) ) ) ) {
			$post_type = $_GET['post_type'];
		} else {
			return; // Page is going to fail anyway
		}
		if ( 'portfolio' == $post_type ) {
			add_theme_support( 'post-formats', array( 'video', 'gallery' ) );
		} elseif ( 'post' == $post_type ) {
			add_theme_support( 'post-formats', array( 'video' ) );
		}
	}

	/**
	 * Alters posts per page for specific archives
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function pre_get_posts( $query ) {

		// Return if wrong query
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Set posts per page for portfolio categories
		if ( is_tax( 'portfolio_category') ) {
			$query->set( 'posts_per_page', get_theme_mod( 'wpex_portfolio_posts_per_page', '12' ) );
			return;
		}

		// Set posts per page for staff categories
		elseif ( is_tax( 'staff_category') ) {
			$query->set( 'posts_per_page', get_theme_mod( 'wpex_staff_posts_per_page', '12' ) );
			return;
		}

		// Exclude types from search
		elseif ( is_search() ) {

			// Gather all searchable post types
			$types = get_post_types( array( 'exclude_from_search' => false ) );

			// Make sure you got the proper results, and that your post type is in the results
			if ( is_array( $types ) && in_array( 'slides', $types ) ) {

				// Remove the post type from the array
				unset( $types['slides'] );

				// Set the query to the remaining searchable post types
				$query->set( 'post_type', $types );

			}

		}

	}

	/**
	 * Set default gallery metabox post types
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function gallery_metabox( $types ) {
		$types = array();
		return $types;
	}

	/**
	 * Set default gallery metabox post types
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public static function get_the_archive_title( $title ) {
		if ( is_tax() || is_category() ) {
			$title = single_term_title();
		}
		return $title;
	}

}
$elegant_theme_setup = new WPEX_Theme_Class;