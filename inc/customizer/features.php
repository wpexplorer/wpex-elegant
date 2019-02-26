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

function wpex_customizer_features( $wp_customize ) {

	$wp_customize->add_section( 'wpex_features' , array(
		'title'    => __( 'Home Features', 'wpex-elegant' ),
		'priority' => 210,
	) );
	
	$wp_customize->add_setting( 'wpex_home_features', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'wpex_home_features', array(
		'label'		=> __( 'Enable Home Features Post Type', 'wpex-elegant' ),
		'section'	=> 'wpex_features',
		'settings'	=> 'wpex_home_features',
		'type'		=> 'checkbox',
	) );

	// Columns
	$wp_customize->add_setting( 'wpex_features_columns', array(
		'type'		=> 'theme_mod',
		'default'	=> '4',
		'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'wpex_features_columns', array(
		'label'		=> __( 'Homepage Columns', 'wpex-elegant' ),
		'section'	=> 'wpex_features',
		'settings'	=> 'wpex_features_columns',
		'type'		=> 'select',
		'choices'   => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

}
add_action( 'customize_register', 'wpex_customizer_features' );