<?php
/**
 * Copyright theme options
 *
 * @package     Elegant WordPress theme
 * @subpackage  Customizer
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

function wpex_customizer_copyright( $wp_customize ) {

	// Copyright Section
	$wp_customize->add_section( 'wpex_copyright' , array(
		'title' => __( 'Copyright', 'wpex-elegant' ),
		'priority' => 900,
	) );

	$wp_customize->add_setting( 'wpex_copyright', array(
		'type'    => 'theme_mod',
		'sanitize_callback' => 'wp_kses_post',
		'default' => '&copy; [current_year] Theme by <a href="//www.wpexplorer.com/" target="_blank">WPExplorer</a> Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>',
	) );

	$wp_customize->add_control( 'wpex_copyright', array(
		'label' => __('Custom Copyright','wpex-elegant'),
		'section' => 'wpex_copyright',
		'settings' => 'wpex_copyright',
		'type' => 'textarea',
	) );
		
}
add_action( 'customize_register', 'wpex_customizer_copyright' );