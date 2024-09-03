<?php
/**
 * Main Header Layout
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

<div id="header-wrap">

    <header id="header" class="site-header container" role="banner">

        <?php get_template_part( 'partials/header/branding' ); ?>
        
        <?php get_template_part( 'partials/header/nav' ); ?>

    </header><!-- #header -->

</div><!-- #header-wrap -->