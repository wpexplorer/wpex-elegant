<?php
/**
 * MCE Editor Tweaks
 *
 * @package     Elegant WordPress theme
 * @subpackage  Includes
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */


// Enable font size buttons in the editor
if ( ! function_exists( 'wpex_fontsizeselect_mce' ) ) {
	function wpex_fontsizeselect_mce( $buttons ) {
		$buttons[] = 'fontsizeselect';
			return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'wpex_fontsizeselect_mce' );

// Add hr to editor
if ( ! function_exists( 'wpex_hr_mce' ) ) {
	function wpex_hr_mce( $buttons ) {
		$buttons[] = 'hr';
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'wpex_hr_mce' );

// Customize mce editor font sizes
if ( ! function_exists( 'wpex_customize_text_sizes' ) ) {
	function wpex_customize_text_sizes( $initArray ) {
		$initArray['theme_advanced_font_sizes'] = '9px,10px,12px,13px,14px,16px,18px,21px,24px,28px,32px,36px';
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'wpex_customize_text_sizes' );