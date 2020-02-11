<?php
/**
 * Adds all Typography options to the Customizer and outputs the custom CSS for them
 *
 * @package		Typography Class
 * @subpackage	Premium
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'WPEX_Typography' ) ) {

	class WPEX_Typography {

		/**
		 * Main constructor
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this , 'register' ) );
			add_action( 'customize_save_after', array( $this, 'reset_cache' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'load_fonts' ) );
			add_action( 'wp_head', array( $this, 'output_css' ) );
			add_filter( 'tiny_mce_before_init', array( $this, 'mce_fonts' ) );
			add_action( 'after_setup_theme', array( $this, 'mce_scripts' ) );
		}

		/**
		 * Array of Typography settings to add to the customizer
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function elements() {

			// Array of typography settings
			$array = array(
				'body'  => array(
					'label'  =>  __( 'Body', 'wpex-elegant' ),
					'target' =>  'body',
				),
				'logo' => array(
					'label'  => __( 'Logo', 'wpex-elegant' ),
					'target' => '.site-text-logo a',
				),
				'site_description' => array(
					'label'  => __( 'Site Description', 'wpex-elegant' ),
					'target' => '.site-description',
				),
				'headings' => array(
					'label'   => __( 'Headings', 'wpex-elegant' ),
					'target'  => 'h1, h2, h3, h4, h5, h6',
					'exclude' => array( 'font-color', 'font-size' ),
				),
				'page_title' => array(
					'label'   => __( 'Page Title', 'wpex-elegant' ),
					'target'  => '.page-header-title',
					'include' => array( 'margin' ),
				),
				'archive_description' => array(
					'label'   => __( 'Archive Descriptions', 'wpex-elegant' ),
					'target'  => '#archive-description',
					'include' => array( 'margin' ),
				),
				'entry_title' => array(
					'label'   => __( 'Blog Entry Title', 'wpex-elegant' ),
					'target'  => '.loop-entry-title a',
				),
				'post_title' => array(
					'label'   => __( 'Blog Post Title', 'wpex-elegant' ),
					'target'  => '.page-header-title',
				),
				'sidebar_headings' => array(
					'label'   => __( 'Sidebar Headings', 'wpex-elegant' ),
					'target'  => '.sidebar-container .sidebar-widget .widget-title',
				),
				'footer_headings' => array(
					'label'   => __( 'Footer Headings', 'wpex-elegant' ),
					'target'  => '#footer-widgets .widget-title',
				),
				'copyright' => array(
					'label'   => __( 'Copyright', 'wpex-elegant' ),
					'target'  => '#copyright',
				),
			);

			// Portfolio typography
			if ( get_theme_mod( 'wpex_portfolio', true ) ) {
				$array['portfolio_entry_title'] = array(
					'label'   => __( 'Portfolio Entry Title', 'wpex-elegant' ),
					'target'  => '.portfolio-entry-title a',
				);
			}

			// Staff typography
			if ( get_theme_mod( 'wpex_staff', true ) ) {
				$array['staff_entry_title'] = array(
					'label'   => __( 'Staff Entry Title', 'wpex-elegant' ),
					'target'  => '.staff-entry-title',
				);
			}


			// Return typography settings
			return apply_filters( 'wpex_typography_settings', $array );

		}

		/**
		 * Register typography options to the Customizer
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function register ( $wp_customize ) {

			// Get elements
			$elements = $this->elements();

			// Return if elements are empty. This check is needed due to the filter added above
			if ( empty( $elements ) ) {
				return;
			}

			// Add General Panel
			$wp_customize->add_panel( 'wpex_typography', array(
				'priority'      => 9999,
				'capability'    => 'edit_theme_options',
				'title'         => __( 'Typography', 'wpex-elegant' ),
			) );

			// Lopp through elements
			$count = '1';

			foreach( $elements as $element => $array ) {

				$count++;

				// Get label
				$label            = ! empty( $array['label'] ) ? $array['label'] : '';
				$exclude_settings = ! empty( $array['exclude'] ) ? $array['exclude'] : '';
				$include_settings = ! empty( $array['include'] ) ? $array['include'] : '';

				// Get settings
				$settings = array(
					'font-family',
					'font-weight',
					'font-style',
					'text-transform',
					'font-size',
					'line-height',
					'letter-spacing',
					'font-color',
				);

				// Set keys equal to vals
				$settings = array_combine( $settings, $settings );

				// Exclude options
				if ( $exclude_settings ) {
					foreach ( $exclude_settings as $key => $val ) {
						unset( $settings[ $val ] );
					}
				}

				// Include settings not normally included
				if ( $include_settings ) {
					foreach ( $include_settings as $key => $val ) {
						$settings[] = $val;
					}
				}

				// Define Section
				$wp_customize->add_section( 'wpex_typography_'. $element , array(
					'title'     => $label,
					'priority'  => $count,
					'panel'     => 'wpex_typography',
				) );

				// Font Family
				if ( in_array( 'font-family', $settings ) ) {

					// Get default
					$default = isset( $array['defaults']['font-family'] ) ? $array['defaults']['font-family'] : NULL;

					// Add setting
					$wp_customize->add_setting( $element .'_typography[font-family]', array(
						'type'              => 'theme_mod',
						'default'           => $default,
						'sanitize_callback' => 'esc_html',
					) );

					// Get fonts
					$choices   = array(
						'' => __( 'Default', 'wpex-elegant' ),
					);
					$std_fonts = array_combine( $this->std_fonts(), $this->std_fonts() );
					$g_fonts   = array_combine( $this->g_fonts(), $this->g_fonts() );
					$fonts     = array_merge( $std_fonts, $g_fonts );
					$choices   = array_merge( $choices, $fonts );

					// Add Control
					$wp_customize->add_control( $element .'_typography[font-family]', array(
						'label'    => __( 'Font Family', 'wpex-elegant' ),
						'section'  => 'wpex_typography_'. $element,
						'settings' => $element .'_typography[font-family]',
						'priority' => 1,
						'type'     => 'select',
						'choices'  => $choices,
					) );

				}

				// Font Weight
				if ( in_array( 'font-weight', $settings ) ) {
					$wp_customize->add_setting( $element .'_typography[font-weight]', array(
						'type'              => 'theme_mod',
						'sanitize_callback' => 'esc_html',
					) );
					$wp_customize->add_control( $element .'_typography[font-weight]', array(
						'label'    => __( 'Font Weight', 'wpex-elegant' ),
						'section'  => 'wpex_typography_'. $element,
						'settings' => $element .'_typography[font-weight]',
						'priority' => 2,
						'type'     => 'select',
						'choices'  => array (
							''    => __( 'Default', 'wpex-elegant' ),
							'100' => __( 'Extra Light: 100', 'wpex-elegant' ),
							'200' => __( 'Light: 200', 'wpex-elegant' ),
							'300' => __( 'Book: 300', 'wpex-elegant' ),
							'400' => __( 'Normal: 400', 'wpex-elegant' ),
							'600' => __( 'Semibold: 600', 'wpex-elegant' ),
							'700' => __( 'Bold: 700', 'wpex-elegant' ),
							'800' => __( 'Extra Bold: 800', 'wpex-elegant' ),
						),
					) );
				}

				// Font Style
				if ( in_array( 'font-style', $settings ) ) {
					$wp_customize->add_setting( $element .'_typography[font-style]', array(
						'type'              => 'theme_mod',
						'sanitize_callback' => 'esc_html',
					) );
					$wp_customize->add_control( $element .'_typography[font-style]', array(
						'label'    => __( 'Font Style', 'wpex-elegant' ),
						'section'  => 'wpex_typography_'. $element,
						'settings' => $element .'_typography[font-style]',
						'priority' => 3,
						'type'     => 'select',
						'choices'  => array (
							''       => __( 'Default', 'wpex-elegant' ),
							'normal' => __( 'Normal', 'wpex-elegant' ),
							'italic' => __( 'Italic', 'wpex-elegant' ),
						),
					) );
				}

				// Text-Transform
				if ( in_array( 'text-transform', $settings ) ) {
					$wp_customize->add_setting( $element .'_typography[text-transform]', array(
						'type'              => 'theme_mod',
						'sanitize_callback' => 'esc_html',
					) );
					$wp_customize->add_control( $element .'_typography[text-transform]', array(
						'label'    => __( 'Text Transform', 'wpex-elegant' ),
						'section'  => 'wpex_typography_'. $element,
						'settings' => $element .'_typography[text-transform]',
						'priority' => 4,
						'type'     => 'select',
						'choices'  => array (
							''           => __( 'Default', 'wpex-elegant' ),
							'capitalize' => __( 'Capitalize', 'wpex-elegant' ),
							'lowercase'  => __( 'Lowercase', 'wpex-elegant' ),
							'uppercase'  => __( 'Uppercase', 'wpex-elegant' ),
						),
					) );
				}

				// Font Size
				if ( in_array( 'font-size', $settings ) ) {
					$wp_customize->add_setting( $element .'_typography[font-size]', array(
						'type'              => 'theme_mod',
						'sanitize_callback' => 'esc_html',
					) );
					$wp_customize->add_control( $element .'_typography[font-size]', array(
						'label'       => __( 'Font Size', 'wpex-elegant' ),
						'section'     => 'wpex_typography_'. $element,
						'settings'    => $element .'_typography[font-size]',
						'priority'    => 5,
						'type'        => 'text',
						'description' => __( 'Value in pixels.', 'wpex-elegant' ),
					) );
				}

				// Font Color
				if ( in_array( 'font-color', $settings ) ) {
					$wp_customize->add_setting( $element .'_typography[color]', array(
						'type'              => 'theme_mod',
						'default'           => '',
						'sanitize_callback' => 'esc_html',
					) );
					$wp_customize->add_control(
						new WP_Customize_Color_Control(
							$wp_customize,
							$element .'_typography_color',
							array(
								'label'    => __( 'Font Color', 'wpex-elegant' ),
								'section'  => 'wpex_typography_'. $element,
								'settings' => $element .'_typography[color]',
								'priority' => 6,
							)
						)
					);
				}

				// Line Height
				if ( in_array( 'line-height', $settings ) ) {
					$wp_customize->add_setting( $element .'_typography[line-height]', array(
						'type'              => 'theme_mod',
						'sanitize_callback' => 'esc_html',
					) );
					$wp_customize->add_control( $element .'_typography[line-height]',
						array(
							'label'    => __( 'Line Height', 'wpex-elegant' ),
							'section'  => 'wpex_typography_'. $element,
							'settings' => $element .'_typography[line-height]',
							'priority' => 7,
							'type'     => 'text',
					) );
				}

				// Letter Spacing
				if ( in_array( 'letter-spacing', $settings ) ) {
					$wp_customize->add_setting( $element .'_typography[letter-spacing]', array(
						'type'              => 'theme_mod',
						'sanitize_callback' => 'esc_html',
					) );
					$wp_customize->add_control(
						new WP_Customize_Control(
							$wp_customize,
							$element .'_typography_letter_spacing',
							array(
								'label'    => __( 'Letter Spacing', 'wpex-elegant' ),
								'section'  => 'wpex_typography_'. $element,
								'settings' => $element .'_typography[letter-spacing]',
								'priority' => 8,
								'type'     => 'text',
							)
						)
					);
				}

				// Margin
				if ( in_array( 'margin', $settings ) ) {
					$wp_customize->add_setting( $element .'_typography[margin]', array(
						'type'              => 'theme_mod',
						'sanitize_callback' => 'esc_html',
					) );
					$wp_customize->add_control( $element .'_typography[margin]',
						array(
							'label'    => __( 'Margin', 'wpex-elegant' ),
							'section'  => 'wpex_typography_'. $element,
							'settings' => $element .'_typography[margin]',
							'priority' => 9,
							'type'     => 'text',
					) );
				}

			}
		}

		/**
		 * Clear CSS cache when the customizer is saved
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function reset_cache() {
			remove_theme_mod( 'wpex_customizer_typography_cache' );
		}

		/**
		 * Loop through settings and store typography options into a cached theme mod
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function loop( $return = 'css' ) {

			// Get typography data cache
			$data = get_theme_mod( 'wpex_customizer_typography_cache', false );

			// If theme mod cache empty or is live customizer loop through elements and set output
			if ( empty( $data ) || is_customize_preview() ) {
				// Define Vars
				$css      = '';
				$fonts    = array();
				$elements = $this->elements();

				// Loop through each elements that need typography styling applied to them
				foreach( $elements as $element => $array ) {

					// Attributes to loop through
					$attributes = array(
						'font-family',
						'font-weight',
						'font-style',
						'font-size',
						'color',
						'line-height',
						'letter-spacing',
						'text-transform',
						'margin',
					);
					$add_css = '';
					$target  = isset( $array['target'] ) ? $array['target'] : '';
					$get_mod = get_theme_mod( $element .'_typography' );

					foreach ( $attributes as $attribute ) {

						// Get defaults
						$default = isset( $array['defaults'][$attribute] ) ? $array['defaults'][$attribute] : NULL;

						// Check val
						$val = ! empty ( $get_mod[$attribute] ) ? $get_mod[$attribute] : $default;

						// Sanitize
						$val = str_replace( '"', '', $val );

						// If there is a value lets do something
						if ( $val ) {

							// Sanitize data
							$val = ( 'font-size' == $attribute ) ? $this->sanitize( $val, 'font_size' ) : $val;
							$val = ( 'letter-spacing' == $attribute ) ? $this->sanitize( $val, 'px' ) : $val;

							// Add quotes around font-family && font family to scripts array
							if ( 'font-family' == $attribute ) {
								$fonts[] = $val;
								$val     = $val;
							}

							// Add custom CSS
							$add_css .= esc_attr( $attribute ) . ':' . esc_attr( $val ) . ';';

						}
					}

					// If there is CSS to add, then add it
					if ( $add_css ) {
						$css .= wp_strip_all_tags( $target ) . '{' . $add_css . '}';
					}

				}

				// If $css or $fonts vars aren't empty
				if ( $css || $fonts ) {

					// Only load 1 of each font
					if ( ! empty( $fonts ) ) {
						array_unique( $fonts );
					}

				}

			}

			// Set cache or get cache if not in customizer
			if ( ! is_customize_preview() ) {

				// Get Cache vars
				if ( $data ) {
					$css   = isset( $data['css'] ) ? $data['css'] : '';
					$fonts = isset( $data['fonts'] ) ? $data['fonts'] : '';
				}

				// Set Cache
				else {
					set_theme_mod( 'wpex_customizer_typography_cache', array (
						'css'   => $css,
						'fonts' => $fonts,
					) );
				}

			}

			// Return CSS
			if ( 'css' == $return && $css ) {
				$css = '<!-- Typography CSS --><style type="text/css">'. $css .'</style>';
				return $css;
			}

			// Return Fonts Array
			if ( 'fonts' == $return && ! empty( $fonts ) ) {
				return $fonts;
			}

		}

		/**
		 * Outputs the typography custom CSS
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function output_css() {
			echo $this->loop( 'css' );
		}

		/**
		 * Loads Google fonts via wp_enqueue_style
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function load_fonts() {

			// Get fonts
			$fonts = $this->loop( 'fonts' );

			// Loop through and enqueue fonts
			if ( ! empty( $fonts ) && is_array( $fonts ) ) {
				foreach ( $fonts as $font ) {
					$this->enqueue_google_font( $font );
				}
			}

		}

		/**
		 * Add loaded fonts into the TinyMCE
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function mce_fonts( $initArray ) {

			// Get fonts
			$fonts       = $this->loop( 'fonts' );
			$fonts       = apply_filters( 'wpex_mce_font_formats_array', $fonts );
			$fonts_array = array();
			$g_fonts     = $this->g_fonts();

			// Loop through fonts
			if ( is_array( $fonts ) && ! empty( $fonts ) ) {
				foreach ( $fonts as $font ) {
					if ( in_array( $font, $g_fonts ) ) {
						$fonts_array[] = $font .'=' . $font;
					}
				}
				$fonts = implode( ';', $fonts_array );

				// Add Fonts To MCE
				if ( $fonts ) {
					$initArray['font_formats'] = $fonts .';Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
				}

			}

			// Return hook array
			return $initArray;

		}

		/**
		 * Sanitize data
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function sanitize( $val, $type ) {

			if ( ! $val ) {
				return;
			}

			if ( 'px' == $type ) {

				if ( strpos( $val, 'px' ) ) {
					return $val;
				} else {
					return intval( $val ) .'px';
				}

			}

			elseif ( 'font_size' == $type ) {

				if ( strpos( $val, 'px' ) ) {
					return $val;
				} elseif ( strpos( $val, 'em' ) ) {
					return $val;
				} else {
					return intval( $val ) .'px';
				}

			}

		}

		/**
		 * Add loaded fonts to the sourcode in the admin so it can display in the editor
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function mce_scripts() {

			// Get fonts
			$fonts   = $this->loop( 'fonts' );
			$g_fonts = $this->g_fonts();

			// Add fonts to tinymce
			if ( ! empty( $fonts ) && is_array( $fonts ) ) {
				foreach ( $fonts as $font ) {
					if ( ! in_array( $font, $g_fonts ) ) {
						continue;
					}
					$font  = 'https://fonts.googleapis.com/css?family='. str_replace(' ', '%20', $font ) .':300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic';
					$style = str_replace( ',', '%2C', $font );
					add_editor_style( $style );
				}
			}
		}

		/**
		 * Array of standard fonts
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function std_fonts() {
			return array(
				'Arial, Helvetica, sans-serif',
				'Arial Black, Gadget, sans-serif',
				'Bookman Old Style, serif',
				'Comic Sans MS, cursive',
				'Courier, monospace',
				'Georgia, serif',
				'Garamond, serif',
				'Impact, Charcoal, sans-serif',
				'Lucida Console, Monaco, monospace',
				'Lucida Sans Unicode, Lucida Grande, sans-serif',
				'MS Sans Serif, Geneva, sans-serif',
				'MS Serif, New York, sans-serif',
				'Palatino Linotype, Book Antiqua, Palatino, serif',
				'Tahoma, Geneva, sans-serif',
				'Times New Roman, Times, serif',
				'Trebuchet MS, Helvetica, sans-serif',
				'Verdana, Geneva, sans-serif',
				'Paratina Linotype',
				'Trebuchet MS',
			);
		}

		/**
		 * Array of google fonts
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function g_fonts() {
			$fonts = array( 'ABeeZee', 'Abel', 'Abril Fatface', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent Pro', 'Aguafina Script', 'Akronim', 'Aladin', 'Aldrich', 'Alef', 'Alegreya', 'Alegreya SC', 'Alegreya Sans', 'Alegreya Sans SC', 'Alex Brush', 'Alfa Slab One', 'Alice', 'Alike', 'Alike Angular', 'Allan', 'Allerta', 'Allerta Stencil', 'Allura', 'Almendra', 'Almendra Display', 'Almendra SC', 'Amarante', 'Amaranth', 'Amatic SC', 'Amethysta', 'Anaheim', 'Andada', 'Andika', 'Angkor', 'Annie Use Your Telescope', 'Anonymous Pro', 'Antic', 'Antic Didone', 'Antic Slab', 'Anton', 'Arapey', 'Arbutus', 'Arbutus Slab', 'Architects Daughter', 'Archivo Black', 'Archivo Narrow', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Asap', 'Asset', 'Astloch', 'Asul', 'Atomic Age', 'Aubrey', 'Audiowide', 'Autour One', 'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre', 'Averia Sans Libre', 'Averia Serif Libre', 'Bad Script', 'Balthazar', 'Bangers', 'Basic', 'Battambang', 'Baumans', 'Bayon', 'Belgrano', 'Belleza', 'BenchNine', 'Bentham', 'Berkshire Swash', 'Bevan', 'Bigelow Rules', 'Bigshot One', 'Bilbo', 'Bilbo Swash Caps', 'Bitter', 'Black Ops One', 'Bokor', 'Bonbon', 'Boogaloo', 'Bowlby One', 'Bowlby One SC', 'Brawler', 'Bree Serif', 'Bubblegum Sans', 'Bubbler One', 'Buda', 'Buenard', 'Butcherman', 'Butterfly Kids', 'Cabin', 'Cabin Condensed', 'Cabin Sketch', 'Caesar Dressing', 'Cagliostro', 'Calligraffitti', 'Cambo', 'Candal', 'Cantarell', 'Cantata One', 'Cantora One', 'Capriola', 'Cardo', 'Carme', 'Carrois Gothic', 'Carrois Gothic SC', 'Carter One', 'Caudex', 'Cedarville Cursive', 'Ceviche One', 'Changa One', 'Chango', 'Chau Philomene One', 'Chela One', 'Chelsea Market', 'Chenla', 'Cherry Cream Soda', 'Cherry Swash', 'Chewy', 'Chicle', 'Chivo', 'Cinzel', 'Cinzel Decorative', 'Clicker Script', 'Coda', 'Coda Caption', 'Codystar', 'Combo', 'Comfortaa', 'Coming Soon', 'Concert One', 'Condiment', 'Content', 'Contrail One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Courgette', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Crete Round', 'Crimson Text', 'Croissant One', 'Crushed', 'Cuprum', 'Cutive', 'Cutive Mono', 'Damion', 'Dancing Script', 'Dangrek', 'Dawning of a New Day', 'Days One', 'Delius', 'Delius Swash Caps', 'Delius Unicase', 'Della Respira', 'Denk One', 'Devonshire', 'Didact Gothic', 'Diplomata', 'Diplomata SC', 'Domine', 'Donegal One', 'Doppio One', 'Dorsa', 'Dosis', 'Dr Sugiyama', 'Droid Sans', 'Droid Sans Mono', 'Droid Serif', 'Duru Sans', 'Dynalight', 'EB Garamond', 'Eagle Lake', 'Eater', 'Economica', 'Ek Mukta', 'Electrolize', 'Elsie', 'Elsie Swash Caps', 'Emblema One', 'Emilys Candy', 'Engagement', 'Englebert', 'Enriqueta', 'Erica One', 'Esteban', 'Euphoria Script', 'Ewert', 'Exo', 'Exo 2', 'Expletus Sans', 'Fanwood Text', 'Fascinate', 'Fascinate Inline', 'Faster One', 'Fasthand', 'Fauna One', 'Federant', 'Federo', 'Felipa', 'Fenix', 'Finger Paint', 'Fira Mono', 'Fira Sans', 'Fjalla One', 'Fjord One', 'Flamenco', 'Flavors', 'Fondamento', 'Fontdiner Swanky', 'Forum', 'Francois One', 'Freckle Face', 'Fredericka the Great', 'Fredoka One', 'Freehand', 'Fresca', 'Frijole', 'Fruktur', 'Fugaz One', 'GFS Didot', 'GFS Neohellenic', 'Gabriela', 'Gafata', 'Galdeano', 'Galindo', 'Gentium Basic', 'Gentium Book Basic', 'Geo', 'Geostar', 'Geostar Fill', 'Germania One', 'Gilda Display', 'Give You Glory', 'Glass Antiqua', 'Glegoo', 'Gloria Hallelujah', 'Goblin One', 'Gochi Hand', 'Gorditas', 'Goudy Bookletter 1911', 'Graduate', 'Grand Hotel', 'Gravitas One', 'Great Vibes', 'Griffy', 'Gruppo', 'Gudea', 'Habibi', 'Halant', 'Hammersmith One', 'Hanalei', 'Hanalei Fill', 'Handlee', 'Hanuman', 'Happy Monkey', 'Headland One', 'Henny Penny', 'Herr Von Muellerhoff', 'Hind', 'Holtwood One SC', 'Homemade Apple', 'Homenaje', 'IM Fell DW Pica', 'IM Fell DW Pica SC', 'IM Fell Double Pica', 'IM Fell Double Pica SC', 'IM Fell English', 'IM Fell English SC', 'IM Fell French Canon', 'IM Fell French Canon SC', 'IM Fell Great Primer', 'IM Fell Great Primer SC', 'Iceberg', 'Iceland', 'Imprima', 'Inconsolata', 'Inder', 'Indie Flower', 'Inika', 'Irish Grover', 'Istok Web', 'Italiana', 'Italianno', 'Jacques Francois', 'Jacques Francois Shadow', 'Jim Nightshade', 'Jockey One', 'Jolly Lodger', 'Josefin Sans', 'Josefin Slab', 'Joti One', 'Judson', 'Julee', 'Julius Sans One', 'Junge', 'Jura', 'Just Another Hand', 'Just Me Again Down Here', 'Kalam', 'Kameron', 'Kantumruy', 'Karla', 'Karma', 'Kaushan Script', 'Kavoon', 'Kdam Thmor', 'Keania One', 'Kelly Slab', 'Kenia', 'Khand', 'Khmer', 'Kite One', 'Knewave', 'Kotta One', 'Koulen', 'Kranky', 'Kreon', 'Kristi', 'Krona One', 'La Belle Aurore', 'Laila', 'Lancelot', 'Lato', 'League Script', 'Leckerli One', 'Ledger', 'Lekton', 'Lemon', 'Libre Baskerville', 'Life Savers', 'Lilita One', 'Lily Script One', 'Limelight', 'Linden Hill', 'Lobster', 'Lobster Two', 'Londrina Outline', 'Londrina Shadow', 'Londrina Sketch', 'Londrina Solid', 'Lora', 'Love Ya Like A Sister', 'Loved by the King', 'Lovers Quarrel', 'Luckiest Guy', 'Lusitana', 'Lustria', 'Macondo', 'Macondo Swash Caps', 'Magra', 'Maiden Orange', 'Mako', 'Marcellus', 'Marcellus SC', 'Marck Script', 'Margarine', 'Marko One', 'Marmelad', 'Marvel', 'Mate', 'Mate SC', 'Maven Pro', 'McLaren', 'Meddon', 'MedievalSharp', 'Medula One', 'Megrim', 'Meie Script', 'Merienda', 'Merienda One', 'Merriweather', 'Merriweather Sans', 'Metal', 'Metal Mania', 'Metamorphous', 'Metrophobic', 'Michroma', 'Milonga', 'Miltonian', 'Miltonian Tattoo', 'Miniver', 'Miss Fajardose', 'Modern Antiqua', 'Molengo', 'Molle', 'Monda', 'Monofett', 'Monoton', 'Monsieur La Doulaise', 'Montaga', 'Montez', 'Montserrat', 'Montserrat Alternates', 'Montserrat Subrayada', 'Moul', 'Moulpali', 'Mountains of Christmas', 'Mouse Memoirs', 'Mr Bedfort', 'Mr Dafoe', 'Mr De Haviland', 'Mrs Saint Delafield', 'Mrs Sheppards', 'Muli', 'Mystery Quest', 'Neucha', 'Neuton', 'New Rocker', 'News Cycle', 'Niconne', 'Nixie One', 'Nobile', 'Nokora', 'Norican', 'Nosifer', 'Nothing You Could Do', 'Noticia Text', 'Noto Sans', 'Noto Serif', 'Nova Cut', 'Nova Flat', 'Nova Mono', 'Nova Oval', 'Nova Round', 'Nova Script', 'Nova Slim', 'Nova Square', 'Numans', 'Nunito', 'Odor Mean Chey', 'Offside', 'Old Standard TT', 'Oldenburg', 'Oleo Script', 'Oleo Script Swash Caps', 'Open Sans', 'Open Sans Condensed', 'Oranienbaum', 'Orbitron', 'Oregano', 'Orienta', 'Original Surfer', 'Oswald', 'Over the Rainbow', 'Overlock', 'Overlock SC', 'Ovo', 'Oxygen', 'Oxygen Mono', 'PT Mono', 'PT Sans', 'PT Sans Caption', 'PT Sans Narrow', 'PT Serif', 'PT Serif Caption', 'Pacifico', 'Paprika', 'Parisienne', 'Passero One', 'Passion One', 'Pathway Gothic One', 'Patrick Hand', 'Patrick Hand SC', 'Patua One', 'Paytone One', 'Peralta', 'Permanent Marker', 'Petit Formal Script', 'Petrona', 'Philosopher', 'Piedra', 'Pinyon Script', 'Pirata One', 'Plaster', 'Play', 'Playball', 'Playfair Display', 'Playfair Display SC', 'Podkova', 'Poiret One', 'Poller One', 'Poly', 'Pompiere', 'Pontano Sans', 'Port Lligat Sans', 'Port Lligat Slab', 'Prata', 'Preahvihear', 'Press Start 2P', 'Princess Sofia', 'Prociono', 'Prosto One', 'Puritan', 'Purple Purse', 'Quando', 'Quantico', 'Quattrocento', 'Quattrocento Sans', 'Questrial', 'Quicksand', 'Quintessential', 'Qwigley', 'Racing Sans One', 'Radley', 'Rajdhani', 'Raleway', 'Raleway Dots', 'Rambla', 'Rammetto One', 'Ranchers', 'Rancho', 'Rationale', 'Redressed', 'Reenie Beanie', 'Revalia', 'Ribeye', 'Ribeye Marrow', 'Righteous', 'Risque', 'Roboto', 'Roboto Condensed', 'Roboto Slab', 'Rochester', 'Rock Salt', 'Rokkitt', 'Romanesco', 'Ropa Sans', 'Rosario', 'Rosarivo', 'Rouge Script', 'Rozha One', 'Rubik Mono One', 'Rubik One', 'Ruda', 'Rufina', 'Ruge Boogie', 'Ruluko', 'Rum Raisin', 'Ruslan Display', 'Russo One', 'Ruthie', 'Rye', 'Sacramento', 'Sail', 'Salsa', 'Sanchez', 'Sancreek', 'Sansita One', 'Sarina', 'Sarpanch', 'Satisfy', 'Scada', 'Schoolbell', 'Seaweed Script', 'Sevillana', 'Seymour One', 'Shadows Into Light', 'Shadows Into Light Two', 'Shanti', 'Share', 'Share Tech', 'Share Tech Mono', 'Shojumaru', 'Short Stack', 'Siemreap', 'Sigmar One', 'Signika', 'Signika Negative', 'Simonetta', 'Sintony', 'Sirin Stencil', 'Six Caps', 'Skranji', 'Slabo 13px', 'Slabo 27px', 'Slackey', 'Smokum', 'Smythe', 'Sniglet', 'Snippet', 'Snowburst One', 'Sofadi One', 'Sofia', 'Sonsie One', 'Sorts Mill Goudy', 'Source Code Pro', 'Source Sans Pro', 'Source Serif Pro', 'Special Elite', 'Spicy Rice', 'Spinnaker', 'Spirax', 'Squada One', 'Stalemate', 'Stalinist One', 'Stardos Stencil', 'Stint Ultra Condensed', 'Stint Ultra Expanded', 'Stoke', 'Strait', 'Sue Ellen Francisco', 'Sunshiney', 'Supermercado One', 'Suwannaphum', 'Swanky and Moo Moo', 'Syncopate', 'Tangerine', 'Taprom', 'Tauri', 'Teko', 'Telex', 'Tenor Sans', 'Text Me One', 'The Girl Next Door', 'Tienne', 'Tinos', 'Titan One', 'Titillium Web', 'Trade Winds', 'Trocchi', 'Trochut', 'Trykker', 'Tulpen One', 'Ubuntu', 'Ubuntu Condensed', 'Ubuntu Mono', 'Ultra', 'Uncial Antiqua', 'Underdog', 'Unica One', 'UnifrakturCook', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'VT323', 'Vampiro One', 'Varela', 'Varela Round', 'Vast Shadow', 'Vesper Libre', 'Vibur', 'Vidaloka', 'Viga', 'Voces', 'Volkhov', 'Vollkorn', 'Voltaire', 'Waiting for the Sunrise', 'Wallpoet', 'Walter Turncoat', 'Warnes', 'Wellfleet', 'Wendy One', 'Wire One', 'Yanone Kaffeesatz', 'Yellowtail', 'Yeseva One', 'Yesteryear', 'Zeyada' );
			return apply_filters( 'wpex_google_fonts_array', $fonts );
		}

		/**
		 * Enqueues a Google Font
		 *
		 * @since 2.1.0
		 * @return array
		 */
		public function enqueue_google_font( $font ) {

			// Get list of all Google Fonts
			$google_fonts = $this->g_fonts();

			// Make sure font is in our list of fonts
			if ( ! in_array( $font, $google_fonts ) ) {
				return;
			}

			// Sanitize handle
			$handle = trim( $font );
			$handle = strtolower( $handle );
			$handle = str_replace( ' ', '-', $handle );

			// Sanitize font name
			$font = trim( $font );
			$font = str_replace( ' ', '+', $font );

			// Enqueue style
			wp_enqueue_style( 'googlefont-'. $handle, '//fonts.googleapis.com/css?family='. str_replace(' ', '%20', $font ) .':300italic,400italic,600italic,700italic,800italic,700,300,600,800,400&subset=latin,cyrillic-ext,greek-ext,vietnamese,latin-ext', false, false, 'all' );

		}

	}
}
$wpex_typography = new WPEX_Typography();