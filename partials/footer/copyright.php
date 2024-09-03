<?php
/**
 * The default template for displaying the footer copyright
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

// Get copyright text
$copy = get_theme_mod( 'wpex_copyright' ) ?: 'Copyright ' . get_the_date( 'Y' ) . ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>'; ?>

<footer id="copyright-wrap" class="clr">
	<div id="copyright" role="contentinfo" class="clr">
		<?php echo wp_kses_post( do_shortcode( $copy ) ); ?>
	</div><!-- #copyright -->
</footer><!-- #footer-wrap -->