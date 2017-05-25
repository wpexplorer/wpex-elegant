<?php
/**
 * Post edit link
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
} ?>

<footer class="entry-footer">
	<?php edit_post_link( __( 'Edit Post', 'elegant' ), '<span class="edit-link clr">', '</span>' ); ?>
</footer><!-- .entry-footer -->