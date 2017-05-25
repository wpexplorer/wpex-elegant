<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

if ( is_active_sidebar( 'sidebar' ) ) : ?>

	<aside id="secondary" class="sidebar-container" role="complementary">

		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</div>
		</div>
		
	</aside><!-- #secondary -->

<?php endif; ?>