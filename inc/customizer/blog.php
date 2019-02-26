<?php
/**
 * Blog theme options
 *
 * @package Elegant WordPress theme
 * @subpackage Customizer
 * @author Alexander Clarke
 * @link http://www.wpexplorer.com
 * @since 2.0.0
 */

function wpex_customizer_blog( $wp_customize ) {

	// Blog Section
	$wp_customize->add_section( 'wpex_blog' , array(
		'title' => __( 'Blog', 'wpex-elegant' ),
		'priority' => 210,
	) );

	// Homepage Count
	$wp_customize->add_setting( 'wpex_home_blog_count', array(
		'type'		=> 'theme_mod',
		'default'	=> '3',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_home_blog_count', array(
		'label'		=> __( 'Homepage Count', 'wpex-elegant' ),
		'section'	=> 'wpex_blog',
		'settings'	=> 'wpex_home_blog_count',
		'type'		=> 'text',
	) );

	// Homepage Columns
	$wp_customize->add_setting( 'wpex_home_blog_columns', array(
		'type'		=> 'theme_mod',
		'default'	=> '3',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_home_blog_columns', array(
		'label'		=> __( 'Homepage Columns', 'wpex-elegant' ),
		'section'	=> 'wpex_blog',
		'settings'	=> 'wpex_home_blog_columns',
		'type'		=> 'select',
		'choices'   => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );
	
	// Enable/Disable Readmore
	$wp_customize->add_setting( 'wpex_blog_readmore', array(
		'type' => 'theme_mod',
		'default' => '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_blog_readmore', array(
		'label' => __('Read More Link','wpex-elegant'),
		'section' => 'wpex_blog',
		'settings' => 'wpex_blog_readmore',
		'type' => 'checkbox',
	) );

	// Enable/Disable Featured Images on Entries
	$wp_customize->add_setting( 'wpex_blog_entry_thumb', array(
		'type' => 'theme_mod',
		'default' => '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_blog_entry_thumb', array(
		'label' => __('Featured Image on Entries','wpex-elegant'),
		'section' => 'wpex_blog',
		'settings' => 'wpex_blog_entry_thumb',
		'type' => 'checkbox',
	) );

	// Enable/Disable Featured Images on Posts
	$wp_customize->add_setting( 'wpex_blog_post_thumb', array(
		'type' => 'theme_mod',
		'default' => '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_blog_post_thumb', array(
		'label' => __('Featured Image on Posts','wpex-elegant'),
		'section' => 'wpex_blog',
		'settings' => 'wpex_blog_post_thumb',
		'type' => 'checkbox',
	) );
		
		
}
add_action( 'customize_register', 'wpex_customizer_blog' );