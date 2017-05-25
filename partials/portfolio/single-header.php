<?php
/**
 * Portfolio single header
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

<header class="page-header clr">

	<?php get_template_part( 'partials/next-prev' ); ?>

	<h1 class="page-header-title">
		<?php the_title(); ?>
	</h1>

	<?php get_template_part( 'partials/portfolio/single-meta' ); ?>

</header><!-- .page-header -->
