<?php
/**
 * Page links
 *
 * @package     Elegant WordPress theme
 * @subpackage  Partials
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display page links
wp_link_pages( array(
	'before'		=> '<div class="page-links clr">',
	'after'			=> '</div>',
	'link_before'	=> '<span>',
	'link_after'	=> '</span>',
) ); ?>