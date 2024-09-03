<?php
/**
 * Customizer Staff Settings
 *
 * @package     Elegant WordPress theme
 * @subpackage  Customizer
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       2.0.0
 */

function wpex_customizer_staff( $wp_customize ) {

	// Staff Section
	$wp_customize->add_section( 'wpex_staff' , array(
		'title' => esc_html__( 'Staff', 'wpex-elegant' ),
		'priority' => 210,
	) );
	
	// Enable/Disable Staff
	$wp_customize->add_setting( 'wpex_staff', array(
		'type' => 'theme_mod',
		'default' => '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_staff', array(
		'label'		=> esc_html__( 'Staff Post Type', 'wpex-elegant' ),
		'section'	=> 'wpex_staff',
		'settings'	=> 'wpex_staff',
		'type'		=> 'checkbox',
		'priority'	=> '1',
	) );

	// Enable/Disable Staff Comments
	$wp_customize->add_setting( 'wpex_staff_comments', array(
		'type' => 'theme_mod',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'wpex_staff_comments', array(
		'label' => esc_html__( 'Staff Comments', 'wpex-elegant' ),
		'section' => 'wpex_staff',
		'settings' => 'wpex_staff_comments',
		'type' => 'checkbox',
		'priority' => '1',
	) );

	// Columns
	$wp_customize->add_setting( 'wpex_staff_columns', array(
		'type'		=> 'theme_mod',
		'default'	=> '4',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_staff_columns', array(
		'label'		=> esc_html__( 'Columns', 'wpex-elegant' ),
		'section'	=> 'wpex_staff',
		'settings'	=> 'wpex_staff_columns',
		'type'		=> 'select',
		'choices'   => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	// Posts Per Page - Archive
	$wp_customize->add_setting( 'wpex_staff_posts_per_page', array(
		'type' => 'theme_mod',
		'default' => '9',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_staff_posts_per_page', array(
		'label' => esc_html__( 'Archive Posts Per Page', 'wpex-elegant' ),
		'section' => 'wpex_staff',
		'settings' => 'wpex_staff_posts_per_page',
		'type' => 'text',
		'priority' => '2',
	) );

}
add_action( 'customize_register', 'wpex_customizer_staff' );