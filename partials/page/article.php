<?php
/**
 * Outputs page article
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

<article class="entry clr">

	<?php the_content(); ?>

	<?php wp_link_pages( array(
		'before'		=> '<div class="page-links clr">',
		'after'			=> '</div>',
		'link_before'	=> '<span>',
		'link_after'	=> '</span>'
	) ); ?>

</article><!-- #post -->