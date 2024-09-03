<?php
/**
 * Header theme options
 *
 * @package     Elegant WordPress theme
 * @subpackage  Customizer
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       2.0.0
 */

function wpex_customizer_general( $wp_customize ) {

	// General Section
	$wp_customize->add_section( 'wpex_header_section' , array(
		'title'      => esc_html__( 'Header', 'wpex-elegant' ),
		'priority'   => 210,
	) );

	// Logo Image
	$wp_customize->add_setting( 'wpex_logo', array(
		'type'              => 'theme_mod',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpex_logo', array(
		'label'    => esc_html__('Image Logo','wpex-elegant'),
		'section'  => 'wpex_header_section',
		'settings' => 'wpex_logo',
	) ) );
		
}
add_action( 'customize_register', 'wpex_customizer_general' );