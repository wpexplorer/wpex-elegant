<?php
/**
 * Main Header Layout
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
} ?>

<div id="header-wrap" class="fixed-header clr">

    <header id="header" class="site-header container clr" role="banner">

        <?php get_template_part( 'partials/header/branding' ); ?>
        
        <?php get_template_part( 'partials/header/nav' ); ?>

    </header><!-- #header -->

</div><!-- #header-wrap -->