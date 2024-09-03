<?php
/**
 * Footer widgets
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

if ( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ) : ?>

	<div id="footer" class="clr container">

		<div id="footer-widgets" class="wpex-grid wpex-grid-cols-3 wpex-grid-cols-fixed">

			<div class="footer-box">
				<?php dynamic_sidebar( 'footer-one' ); ?>
			</div><!-- .footer-box -->

			<div class="footer-box">
				<?php dynamic_sidebar( 'footer-two' ); ?>
			</div><!-- .footer-box -->

			<div class="footer-box">
				<?php dynamic_sidebar( 'footer-three' ); ?>
			</div><!-- .footer-box -->
			
		</div><!-- #footer-widgets -->

	</div><!-- #footer -->

<?php endif; ?>