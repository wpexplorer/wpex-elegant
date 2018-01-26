<?php
/**
 * The default template for displaying the footer copyright
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

// Get copyright text
$copy = get_theme_mod( 'wpex_copyright' );
$copy = $copy ? $copy : '&copy; [current_year] Theme by <a href="http://www.wpexplorer.com/" target="_blank">WPExplorer</a> Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>'; ?>

<footer id="copyright-wrap" class="clr">
	<div id="copyright" role="contentinfo" class="clr">
		<?php echo wp_kses_post( do_shortcode( $copy ) ); ?>
	</div><!-- #copyright -->
</footer><!-- #footer-wrap -->