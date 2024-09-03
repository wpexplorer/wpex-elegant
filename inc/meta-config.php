<?php
/**
 * Configures meta options via cmb_meta_boxes filter
 *
 * @package     Elegant WordPress theme
 * @subpackage  Includes
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       2.0.0
 */

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function wpex_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'wpex_';


	// Slides
	$meta_boxes[] = array(
		'id'			=> 'wpex-slides-meta',
		'title'			=> esc_html__( 'Slide Settings', 'wpex-elegant' ),
		'pages'			=> array( 'slides' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
			array(
				'name'	=> esc_html__( 'Hide Title', 'wpex-elegant' ),
				'desc'	=>  '',
				'id'	=> $prefix . 'slide_hide_title',
				'type'	=> 'checkbox',
				'std'	=> ''
			),
			array(
				'name'	=> esc_html__( 'URL', 'wpex-elegant' ),
				'desc'	=>  esc_html__( 'Enter a custom URL to link this slide to. Don\'t forget the http// at the front!', 'wpex-elegant' ),
				'id'	=> $prefix . 'slide_url',
				'type'	=> 'text',
				'std'	=> ''
			),
			array(
				'name'	=> esc_html__( 'Slide Caption', 'wpex-elegant' ),
				'desc'	=>  '',
				'id'	=> $prefix . 'slide_caption',
				'type'	=> 'text',
				'std'	=> ''
			),
		),
	);

	// Features
	$meta_boxes[] = array(
		'id'			=> 'wpex-features-meta',
		'title'			=> esc_html__( 'Feature Settings', 'wpex-elegant' ),
		'pages'			=> array( 'features' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
			array(
				'name'	=> esc_html__( 'URL', 'wpex-elegant' ),
				'desc'	=>  esc_html__( 'Enter a custom URL to link this feature to. Don\'t forget the http// at the front! This link will be added to the featured image and title.', 'wpex-elegant' ),
				'id'	=> $prefix . 'feature_url',
				'type'	=> 'text',
				'std'	=> ''
			),
			array(
				'name'	=> esc_html__( 'Icon Font Class', 'wpex-elegant' ),
				'desc'	=>  esc_html__( 'Enter a FontAwesome icon name to display an icon instead of a featured image.', 'wpex-elegant' ) .' <a href="https://fontawesome.com/icons" target="_blank">'. esc_html__( 'Learn More.', 'wpex-elegant' ) .'&rarr;</a>',
				'id' 	=> $prefix . 'icon_font',
				'type'	=> 'text',
				'std'	=> ''
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'wpex_metaboxes' );