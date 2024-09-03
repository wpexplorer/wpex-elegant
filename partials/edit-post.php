<?php
/**
 * Post edit link
 *
 * @package     Elegant WordPress theme
 * @subpackage  Partials
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$p_obj = get_post_type_object( get_post_type() ); ?>

<footer class="entry-footer">
	<?php edit_post_link( esc_html__( 'Edit this ' . $p_obj->labels->singular_name, 'wpex-elegant' ), '<span class="edit-link clr">', '</span>' ); ?>
</footer><!-- .entry-footer -->