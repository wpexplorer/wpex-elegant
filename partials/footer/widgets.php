<?php
/**
 * Footer widgets
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

<div id="footer-widgets" class="wpex-row clr">

	<div class="footer-box span_1_of_3 col col-1">
		<?php dynamic_sidebar( 'footer-one' ); ?>
	</div><!-- .footer-box -->

	<div class="footer-box span_1_of_3 col col-2">
		<?php dynamic_sidebar( 'footer-two' ); ?>
	</div><!-- .footer-box -->

	<div class="footer-box span_1_of_3 col col-3">
		<?php dynamic_sidebar( 'footer-three' ); ?>
	</div><!-- .footer-box -->
	
</div><!-- #footer-widgets -->