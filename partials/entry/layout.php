<?php
/**
 * Default post entry layout
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

// Get post format
$format = get_post_format(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	// Display video
	if ( 'video' == $format ) :

		get_template_part( 'partials/entry/video' );

	else:

		// Display entry thumbnail
		get_template_part( 'partials/entry/thumbnail' );

	endif; ?>

	<div class="loop-entry-text clr">

		<?php
		// Display entry header
		get_template_part( 'partials/entry/header' ); ?>

		<?php
		// Display entry content
		get_template_part( 'partials/entry/content' ); ?>

	</div><!-- .loop-entry-text -->

</article><!-- .loop-entry -->