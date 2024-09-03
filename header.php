<?php
/**
 * The Header for our theme.
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      WPExplorer
 * @link        https://www.wpexplorer.com
 * @since       1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<div id="wrap" class="clr">

		<?php get_template_part( 'partials/header/layout' ); ?>

		<?php if ( is_front_page() && get_theme_mod( 'wpex_homepage_slider', true ) ) {
			get_template_part( 'partials/home/slider' );
		} ?>
		
		<div id="main" class="site-main container clr">