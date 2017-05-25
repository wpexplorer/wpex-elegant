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
		'title' => __( 'Blog', 'elegant' ),
		'priority' => 210,
	) );
	
	// Enable/Disable Readmore
	$wp_customize->add_setting( 'wpex_blog_readmore', array(
		'type' => 'theme_mod',
		'default' => '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_blog_readmore', array(
		'label' => __('Read More Link','elegant'),
		'section' => 'wpex_blog',
		'settings' => 'wpex_blog_readmore',
		'type' => 'checkbox',
		'priority' => '1',
	) );

	// Enable/Disable Featured Images on Entries
	$wp_customize->add_setting( 'wpex_blog_entry_thumb', array(
		'type' => 'theme_mod',
		'default' => '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_blog_entry_thumb', array(
		'label' => __('Featured Image on Entries','elegant'),
		'section' => 'wpex_blog',
		'settings' => 'wpex_blog_entry_thumb',
		'type' => 'checkbox',
		'priority' => '1',
	) );

	// Enable/Disable Featured Images on Posts
	$wp_customize->add_setting( 'wpex_blog_post_thumb', array(
		'type' => 'theme_mod',
		'default' => '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_blog_post_thumb', array(
		'label' => __('Featured Image on Posts','elegant'),
		'section' => 'wpex_blog',
		'settings' => 'wpex_blog_post_thumb',
		'type' => 'checkbox',
		'priority' => '1',
	) );
		
		
}
add_action( 'customize_register', 'wpex_customizer_blog' );