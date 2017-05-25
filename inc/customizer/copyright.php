<?php
/**
 * Copyright theme options
 *
 * @package     Elegant WordPress theme
 * @subpackage  Customizer
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

function wpex_customizer_copyright( $wp_customize ) {

	// Add textarea
	class ATT_Customize_Textarea_Control extends WP_Customize_Control {
		
		//Type of customize control being rendered.
		public $type = 'textarea';

		//Displays the textarea on the customize screen.
		public function render_content() { ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}

	// Copyright Section
	$wp_customize->add_section( 'wpex_copyright' , array(
		'title' => __( 'Copyright', 'elegant' ),
		'priority' => 900,
	) );
	
	$wp_customize->add_setting( 'wpex_copyright', array(
		'type' => 'theme_mod',
		'default' => '<a href="http://www.wpexplorer.com/elegant-free-wordpress-theme/" target="_blank" title="Elegant WordPress Theme">Elegant</a> Theme by <a href="http://themeforest.net/user/wpexplorer?ref=WPExplorer" title="WPExplorer Themes">WPExplorer</a> Powered by <a href="https://wordpress.org/" title="WordPress" target="_blank">WordPress</a>',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( new ATT_Customize_Textarea_Control( $wp_customize, 'wpex_copyright', array(
		'label' => __('Custom Copyright','elegant'),
		'section' => 'wpex_copyright',
		'settings' => 'wpex_copyright',
		'type' => 'textarea',
	) ) );
		
}
add_action( 'customize_register', 'wpex_customizer_copyright' );