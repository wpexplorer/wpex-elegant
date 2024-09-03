<?php
/**
 * Header Search
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
} ?>

<div id="sidr-close"><a href="#sidr-close" class="toggle-sidr-close"></a></div>
<div id="site-navigation-wrap">
	<a href="#sidr-main" id="navigation-toggle"><span class="fa fa-bars"></span><?php esc_html_e( 'Menu', 'wpex-elegant' ); ?></a>
	<nav id="site-navigation" class="navigation main-navigation clr" role="navigation">
		<?php
		// Display main menu
		wp_nav_menu( array(
			'theme_location' => 'main_menu',
			'sort_column'    => 'menu_order',
			'menu_class'     => 'dropdown-menu sf-menu',
			'fallback_cb'    => false,
			'walker'         => new WPEX_Dropdown_Walker_Nav_Menu()
		) ); ?>
	</nav><!-- #site-navigation -->
</div><!-- #site-navigation-wrap -->