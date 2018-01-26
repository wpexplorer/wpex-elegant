<?php
/**
 * Footer layout
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

<div id="footer-wrap" class="site-footer clr">

	<?php get_template_part( 'partials/footer/widgets' ); ?>

	<?php get_template_part( 'partials/footer/copyright' ); ?>

</div><!-- #footer-wrap -->