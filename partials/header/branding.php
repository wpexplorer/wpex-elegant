<?php
/**
 * Header branding: Logo & Site Description
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

// Vars
$logo_img           = get_theme_mod('wpex_logo');
$blog_name          = get_bloginfo( 'name' );
$blog_description   = get_bloginfo( 'description' );
$home_url           = home_url( '/' ); ?>

<div class="site-branding clr">

	<div id="logo" class="clr">

		<?php if ( $logo_img ) : ?>

			<a href="<?php echo esc_url( $home_url ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home">
				<img src="<?php echo esc_url( $logo_img ); ?>" alt="<?php echo esc_attr( $blog_name ); ?>" height="" width="" />
			</a>

		<?php else : ?>

			<div class="site-text-logo clr">
			
				<a href="<?php echo esc_url( $home_url ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home"><?php echo esc_html( $blog_name ); ?></a>

				<?php if ( $blog_description ) : ?>

					<div class="site-description"><?php echo $blog_description; ?></div>

				<?php endif; ?>

			</div><!-- .site-text-logo -->

		<?php endif; ?>

	</div><!-- #logo -->

</div><!-- .site-branding -->