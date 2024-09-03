<?php
/**
 * Modify WP menu for dropdown styles
 *
 * @package     Elegant WordPress theme
 * @subpackage  Classes
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       1.0.0
 */

class WPEX_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		
		$id_field = $this->db_fields['id'];
		
		if ( !empty( $children_elements[$element->$id_field] ) && ( $depth == 0 ) ) {
			$element->classes[] = 'dropdown';
			$element->title .= ' <i class="fa fa-angle-down" aria-hidden="true"></i>';
		}
		
		if ( !empty( $children_elements[$element->$id_field] ) && ( $depth > 0 ) ) {
			$element->classes[] = 'dropdown';
			$element->title .= ' <i class="fa fa-angle-right" aria-hidden="true"></i>';
		}
		
		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);

	}
}