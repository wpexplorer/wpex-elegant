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
$copy = get_theme_mod( 'wpex_copyright', '<a href="http://www.wpexplorer.com/elegant-free-wordpress-theme/" target="_blank" title="Elegant WordPress Theme">Elegant</a> Theme by <a href="http://themeforest.net/user/wpexplorer?ref=WPExplorer" title="WPExplorer Themes">WPExplorer</a> Powered by <a href="https://wordpress.org/" title="WordPress" target="_blank">WordPress</a>' ); ?>

<footer id="copyright-wrap" class="clr">

	<div id="copyright" role="contentinfo" class="clr">

		<?php
		// Display custom copyright
		if ( $copy ) : ?>
			<?php echo wp_kses_post( do_shortcode( $copy ) ); ?>
		<?php
		// Copyright fallback
		else : ?>
			&copy; <?php _e( 'Copyright', 'elegant' ); ?> <?php the_date( 'Y' ); ?> &middot; <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php endif; ?>

	</div><!-- #copyright -->

</footer><!-- #footer-wrap -->