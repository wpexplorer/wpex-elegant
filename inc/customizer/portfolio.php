<?php
/**
 * Portfolio theme options
 *
 * @package     Elegant WordPress theme
 * @subpackage  Customizer
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       2.0.0
 */

function wpex_customizer_portfolio( $wp_customize ) {

	// Portfolio Section
	$wp_customize->add_section( 'wpex_portfolio' , array(
		'title'    => esc_html__( 'Portfolio', 'wpex-elegant' ),
		'priority' => 210,
	) );
	
	// Enable/Disable Portfolio
	$wp_customize->add_setting( 'wpex_portfolio', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_portfolio', array(
		'label'		=> esc_html__( 'Portfolio Post Type', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_portfolio',
		'type'		=> 'checkbox',
	) );

	// Enable/Disable Portfolio Comments
	$wp_customize->add_setting( 'wpex_portfolio_comments', array(
		'type'		=> 'theme_mod',
		'default'	=> '',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_portfolio_comments', array(
		'label'		=> esc_html__( 'Portfolio Comments', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_portfolio_comments',
		'type'		=> 'checkbox',
	) );

	// Enable/Disable Portfolio Related
	$wp_customize->add_setting( 'wpex_portfolio_related', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_portfolio_related', array(
		'label'		=> esc_html__( 'Portfolio Related', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_portfolio_related',
		'type'		=> 'checkbox',
	) );

	// Columns
	$wp_customize->add_setting( 'wpex_portfolio_columns', array(
		'type'		=> 'theme_mod',
		'default'	=> '4',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_portfolio_columns', array(
		'label'		=> esc_html__( 'Archive Columns', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_portfolio_columns',
		'type'		=> 'select',
		'choices'   => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	// Posts Per Page - Archive
	$wp_customize->add_setting( 'wpex_portfolio_posts_per_page', array(
		'type'		        => 'theme_mod',
		'default'	        => '12',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_portfolio_posts_per_page', array(
		'label'		=> esc_html__( 'Archive Items Per Page', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_portfolio_posts_per_page',
		'type'		=> 'text',
	) );

	// Homepage Portfolio Category
	if ( taxonomy_exists( 'portfolio_category' ) ) {
		$choices = array(
			'all'	=> esc_html__( 'All', 'wpex-elegant' )
		);
		$cats = get_terms( 'portfolio_category' );
			if ( $cats ) {
			foreach ( $cats as $cat ) {
				$choices[$cat->term_id] = $cat->name;
			}
		}
		$wp_customize->add_setting( 'wpex_home_portfolio_category', array(
			'type' => 'theme_mod',
			'default' => '',
			'sanitize_callback' => 'esc_html',
		) );
		
		$wp_customize->add_control( 'wpex_home_portfolio_category', array(
			'label'		=> esc_html__( 'Portfolio Homepage Category','wpex-elegant' ),
			'section'	=> 'wpex_portfolio',
			'settings'	=> 'wpex_home_portfolio_category',
			'type'		=> 'select',
			'choices'	=> $choices,
		) );
	}

	// Homepage Count
	$wp_customize->add_setting( 'wpex_home_portfolio_count', array(
		'type'		=> 'theme_mod',
		'default'	=> '4',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_home_portfolio_count', array(
		'label'		=> esc_html__( 'Homepage Count', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_home_portfolio_count',
		'type'		=> 'text',
	) );

	// Home Columns.
	$wp_customize->add_setting( 'wpex_home_portfolio_columns', array(
		'type'		=> 'theme_mod',
		'default'	=> '4',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_home_portfolio_columns', array(
		'label'		=> esc_html__( 'Homepage Columns', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_home_portfolio_columns',
		'type'		=> 'select',
		'choices'   => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	// Related Count
	$wp_customize->add_setting( 'wpex_related_portfolio_count', array(
		'type'		=> 'theme_mod',
		'default'	=> '4',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_related_portfolio_count', array(
		'label'		=> esc_html__( 'Related Count', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_related_portfolio_count',
		'type'		=> 'text',
	) );

	// Related Columns
	$wp_customize->add_setting( 'wpex_related_portfolio_columns', array(
		'type'		=> 'theme_mod',
		'default'	=> '4',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_related_portfolio_columns', array(
		'label'		=> esc_html__( 'Related Columns', 'wpex-elegant' ),
		'section'	=> 'wpex_portfolio',
		'settings'	=> 'wpex_related_portfolio_columns',
		'type'		=> 'select',
		'choices'   => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

}
add_action( 'customize_register', 'wpex_customizer_portfolio' );

// Output custom taxonomy array for the homepage portfolio query
if ( ! function_exists( 'wpex_home_portfolio_taxonomy' ) ) {
	function wpex_home_portfolio_taxonomy() {
		$cat = get_theme_mod( 'wpex_home_portfolio_category' );
		if ( !$cat ) {
			return;
		} elseif ( 'all' == $cat ) {
			return;
		} else {
			return array(
				array(
					'taxonomy'	=> 'portfolio_category',
					'field'		=> 'id',
					'terms'		=> $cat,
				),
			);
		}
	}
}