<?php
/**
 * Styling options
 *
 * @package     Elegant WordPress theme
 * @subpackage  Customizer
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

class WPEX_Theme_Customizer_Styling {

	// Register new customizer settings
	public static function register ( $wp_customize ) {

			// Theme Design Section
			$wp_customize->add_section( 'wpex_styling' , array(
				'title'		=> __( 'Styling', 'wpex-elegant' ),
				'priority'	=> 999,
			) );

			// Get Color Options
			$color_options = self::wpex_color_options();

			// Return if no options are defined
			if ( empty( $color_options ) ) {
				return;
			}

			// Loop through color options and add a theme customizer setting for it
			$count='2';
			foreach( $color_options as $option ) {
				$count++;

				$default = isset($option['default']) ? $option['default'] : '';
				$type    = isset( $option['type']) ? $option['type'] : '';

				$wp_customize->add_setting( 'wpex_'. $option['id'], array(
					'type'		=> 'theme_mod',
					'default'	=> $default,
					'transport'	=> 'refresh',
					'sanitize_callback' => 'esc_html',
				) );

				if ( 'text' == $type ) {
					$wp_customize->add_control( 'wpex_'. $option['id'] .'', array(
						'label'		=> $option['label'],
						'section'	=> 'wpex_styling',
						'settings'	=> 'wpex_'. $option['id'],
						'priority'	=> $count,
						'type'		=> 'text',
					) );
				} else {
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpex_'. $option['id'], array(
						'label'		=> $option['label'],
						'section'	=> 'wpex_styling',
						'settings'	=> 'wpex_' . $option['id'],
						'priority'	=> $count,
					) ) );
				}

			} // End foreach

	} // End register


	/**
	* This will output the custom styling settings to the live theme's WP head.
	* Used by hook: 'wp_head'
	*
	* @see add_action('wp_head',$func)
	* @since Fabulous 1.0
	*/
	public static function header_output() {

		$color_options = self::wpex_color_options();
		$css = '';

		foreach( $color_options as $option ) {

			$theme_mod = get_theme_mod( 'wpex_'. $option['id'] );

			if ( ! $theme_mod ) {
				continue;
			}

			if ( ! empty( $option['media_query'] ) ) {
				$css .= $option['media_query'] . '{' . $option['element'] . '{ ' . esc_attr( $option['style'] ) . ':' . esc_attr( $theme_mod ) .' !important; } }';
			} else {
				$css .= $option['element'] . '{ ' . esc_attr( $option['style'] ) . ':' . esc_attr( $theme_mod ) . ' !important; }';
			}

		}

		$css = preg_replace( '/\s+/', ' ', $css );

		if ( ! empty( $css ) ) {
			echo "<!-- Theme Customizer Styling Options -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
		}

	} // End header_output function


	/**
	* Array of styling options
	*
	* @since Fabulous 1.0
	*/
	public static function wpex_color_options() {

		$array = array();

		$array[] = array(
			'label'		=> __( 'Header Top Padding', 'wpex-elegant' ),
			'id'		=> 'header_top_pad',
			'element'	=> '#header-wrap',
			'style'		=> 'padding-top',
			'type'		=> 'text',
			'default'	=> '',
		);

		$array[] = array(
			'label'		=> __( 'Header Bottom Padding', 'wpex-elegant' ),
			'id'		=> 'header_bottom_pad',
			'element'	=> '#header-wrap',
			'style'		=> 'padding-bottom',
			'type'		=> 'text',
			'default'	=> '',
		);

		$array[] = array(
			'label'		=> __( 'Logo Text Color', 'wpex-elegant' ),
			'id'		=> 'logo_color',
			'element'	=> '#logo a',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Logo Text Color', 'wpex-elegant' ),
			'id'		=> 'logo_color',
			'element'	=> '#logo a',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Menu Link Color', 'wpex-elegant' ),
			'id'		=> 'nav_link_color',
			'element'	=> '#site-navigation .dropdown-menu > li > a',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Menu Link Hover Color', 'wpex-elegant' ),
			'id'		=> 'nav_link_hover_color',
			'element'	=> '#site-navigation .dropdown-menu > li > a:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Active Menu Link Color', 'wpex-elegant' ),
			'id'		=> 'nav_link_active_color',
			'element'	=> '#site-navigation .dropdown-menu > li > a:hover,#site-navigation .dropdown-menu > li.sfHover > a,#site-navigation .dropdown-menu > .current-menu-item > a,#site-navigation .dropdown-menu > .current-menu-item > a:hover ',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Sub-Menu Background', 'wpex-elegant' ),
			'id'		=> 'nav_drop_bg',
			'element'	=> '#site-navigation .dropdown-menu ul',
			'style'		=> 'background',
		);

		$array[] = array(
			'label'		=> __( 'Sub-Menu Link Bottom Border', 'wpex-elegant' ),
			'id'		=> 'nav_drop_link_border',
			'element'	=> '#site-navigation .dropdown-menu ul li',
			'style'		=> 'border-color',
		);

		$array[] = array(
			'label'		=> __( 'Sub-Menu Link Color', 'wpex-elegant' ),
			'id'		=> 'nav_drop_link_color',
			'element'	=> '#site-navigation .dropdown-menu ul > li > a',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Sub-Menu Link Hover Color', 'wpex-elegant' ),
			'id'		=> 'nav_drop_link_hover_color',
			'element'	=> '#site-navigation .dropdown-menu ul > li > a:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Sub-Menu Link Hover Background', 'wpex-elegant' ),
			'id'		=> 'nav_drop_link_hover_bg',
			'element'	=> '#site-navigation .dropdown-menu ul > li > a:hover',
			'style'		=> 'background',
		);

		$array[] = array(
			'label'		=> __( 'Mobile Menu Link Color', 'wpex-elegant' ),
			'id'		=> 'mobile_nav_link_color',
			'element'	=> 'a#navigation-toggle',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Footer Widgets Background', 'wpex-elegant' ),
			'id'		=> 'footer_widgets_bg',
			'element'	=> '#footer-wrap',
			'style'		=> 'background',
		);

		$array[] = array(
			'label'		=> __( 'Footer Widgets Text', 'wpex-elegant' ),
			'id'		=> 'footer_widgets_color',
			'element'	=> 'footer, #footer p',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Footer Widgets Heading', 'wpex-elegant' ),
			'id'		=> 'footer_widgets_headings',
			'element'	=> '#footer h2, #footer h3, #footer h4, #footer h5,  #footer h6, #footer-widgets .widget-title',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Footer Widgets Links', 'wpex-elegant' ),
			'id'		=> 'footer_widgets_links_color',
			'element'	=> '#footer a, #footer-widgets .widget_nav_menu ul > li li a:before',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Footer Widgets Links Hover', 'wpex-elegant' ),
			'id'		=> 'footer_widgets_links_hover_color',
			'element'	=> '#footer a:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Footer Widgets Borders', 'wpex-elegant' ),
			'id'		=> 'footer_widgets_borders',
			'element'	=> '#footer-widgets .widget_nav_menu ul > li, #footer-widgets .widget_nav_menu ul > li a, .footer-widget > ul > li:first-child, .footer-widget > ul > li, .footer-widget h6, #footer-bottom',
			'style'		=> 'border-color',
		);

		$array[] = array(
			'label'		=> __( 'Copyright Backgorund', 'wpex-elegant' ),
			'id'		=> 'copyright_bg',
			'element'	=> '#copyright-wrap',
			'style'		=> 'background-color',
		);

		$array[] = array(
			'label'		=> __( 'Copyright Color', 'wpex-elegant' ),
			'id'		=> 'copyright_color',
			'element'	=> '#copyright-wrap, #copyright-wrap p',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Copyright Link Color', 'wpex-elegant' ),
			'id'		=> 'copyright_link_color',
			'element'	=> '#copyright-wrap a',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Heading Title Hover Color', 'wpex-elegant' ),
			'id'		=> 'heading_title_hover_color',
			'element'	=> 'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Link Color', 'wpex-elegant' ),
			'id'		=> 'link_color',
			'element'	=> '.single .entry a, #sidebar a, .comment-meta a.url, .logged-in-as a',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Link Hover Color', 'wpex-elegant' ),
			'id'		=> 'link_hover_color',
			'element'	=> '.single .entry a:hover, #sidebar a:hover, .comment-meta a.url:hover, .logged-in-as a:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Sidebar Link Color', 'wpex-elegant' ),
			'id'		=> 'sidebar_link_color',
			'element'	=> '.sidebar-container a',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Sidebar Link Hover Color', 'wpex-elegant' ),
			'id'		=> 'sidebar_link_hover_color',
			'element'	=> '.sidebar-container a:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Theme Button Color', 'wpex-elegant' ),
			'id'		=> 'theme_button_color',
			'element'	=> '.wpex-readmore a, input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Theme Button Background', 'wpex-elegant' ),
			'id'		=> 'theme_button_bg',
			'element'	=> '.wpex-readmore a, input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span',
			'style'		=> 'background',
		);

		$array[] = array(
			'label'		=> __( 'Theme Button Hover Color', 'wpex-elegant' ),
			'id'		=> 'theme_button_hover_color',
			'element'	=> '.wpex-readmore a:hover, input[type="button"]:hover, input[type="submit"]:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Theme Button Hover Background', 'wpex-elegant' ),
			'id'		=> 'theme_button_hover_bg',
			'element'	=> '.wpex-readmore a:hover, input[type="button"]:hover, input[type="submit"]:hover',
			'style'		=> 'background-color',
		);

		$array[] = array(
			'label'		=> __( 'Homepage Icons', 'wpex-elegant' ),
			'id'		=> 'home_icons_color',
			'element'	=> '.features-entry .feature-icon-font .fa',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Homepage Slider Caption Background', 'wpex-elegant' ),
			'id'		=> 'home_slider_caption_bg',
			'element'	=> '.homepage-slide-caption',
			'style'		=> 'background',
		);

		$array[] = array(
			'label'		=> __( 'Homepage Slider Arrows Hover Background', 'wpex-elegant' ),
			'id'		=> 'home_slider_arrow_hover_bg',
			'element'	=> '#homepage-slider-wrap .flex-direction-nav li a:hover',
			'style'		=> 'background',
		);

		// Apply filters for child theming magic
		$array = apply_filters( 'wpex_color_options_array', $array );

		// Return array
		return $array;
	}
} // End Theme_Customizer_Styling Class


// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'WPEX_Theme_Customizer_Styling' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'WPEX_Theme_Customizer_Styling' , 'header_output' ) );