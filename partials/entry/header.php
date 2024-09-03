<?php
/**
 * Displays the post entry header
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

<header>
	<h2 class="loop-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php get_template_part( 'partials/entry/meta', get_post_type() );?>
</header>