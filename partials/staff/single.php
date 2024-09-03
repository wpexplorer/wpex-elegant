<?php
/**
 * Staff single layout
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

<article class="single-post-content entry clr">

	<header class="page-header clr">
		<h1 class="page-header-title"><?php the_title(); ?></h1>
	</header><!-- .page-header -->

	<div class="entry clr">
		<?php the_content(); ?>
	</div><!-- .entry -->

	<?php get_template_part( 'partials/edit-post' ); ?>
	
</article>

<?php if ( get_theme_mod( 'wpex_staff_comments' ) ) comments_template();  ?>