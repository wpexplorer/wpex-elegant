<?php
/**
 * Features theme options
 *
 * @package     Elegant WordPress theme
 * @subpackage  Customizer
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

function wpex_customizer_homepage_slider( $wp_customize ) {

	$wp_customize->add_section( 'wpex_home_slides' , array(
		'title'    => __( 'Home Slider', 'wpex-elegant' ),
		'priority' => 210,
	) );
	
	$wp_customize->add_setting( 'wpex_homepage_slider', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_homepage_slider', array(
		'label'		=> __( 'Enable Home Slider', 'wpex-elegant' ),
		'section'	=> 'wpex_home_slides',
		'settings'	=> 'wpex_homepage_slider',
		'type'		=> 'checkbox',
	) );

	$wp_customize->add_setting( 'wpex_homepage_slider_center', array(
		'type'		=> 'theme_mod',
		'default'	=> false,
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_homepage_slider_center', array(
		'label'		=> __( 'Center (Box) Home Slider', 'wpex-elegant' ),
		'section'	=> 'wpex_home_slides',
		'settings'	=> 'wpex_homepage_slider_center',
		'type'		=> 'checkbox',
	) );

	$wp_customize->add_setting( 'wpex_homepage_slider_title', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_homepage_slider_title', array(
		'label'		=> __( 'Show Title', 'wpex-elegant' ),
		'section'	=> 'wpex_home_slides',
		'settings'	=> 'wpex_homepage_slider_title',
		'type'		=> 'checkbox',
	) );

}
add_action( 'customize_register', 'wpex_customizer_homepage_slider' );