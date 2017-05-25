<?php
/**
 * Header theme options
 *
 * @package     Elegant WordPress theme
 * @subpackage  Customizer
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

function wpex_customizer_general( $wp_customize ) {

	// General Section
	$wp_customize->add_section( 'wpex_header_section' , array(
		'title'      => __( 'Header', 'elegant' ),
		'priority'   => 210,
	) );

	// Logo Image
	$wp_customize->add_setting( 'wpex_logo', array(
		'type'	=> 'theme_mod',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpex_logo', array(
		'label'		=> __('Image Logo','elegant'),
		'section'	=> 'wpex_header_section',
		'settings'	=> 'wpex_logo',
	) ) );
		
}
add_action( 'customize_register', 'wpex_customizer_general' );