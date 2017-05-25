<?php
/**
 * The default template for displaying staff entries
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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="staff-entry-media clr">
			<?php
			// Display post thumbnail
			the_post_thumbnail( 'wpex-staff-entry', array(
				'alt'	=> wpex_get_esc_title(),
				'class'	=> 'staff-entry-img',
			) ); ?>
		</div><!-- .staff-entry-media -->

	<?php endif; ?>

	<header class="staff-entry-header">
		<h2 class="staff-entry-title"><?php the_title(); ?></h2>
	</header><!-- .staff-entry-header -->

	<div class="staff-entry-content clr entry">
		<?php the_content(); ?>
	</div><!-- staff-entry-content -->

</article><!-- .staff-entry -->