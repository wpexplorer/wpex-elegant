<?php
/**
 * Single post layout
 *
 * @package     Elegant WordPress theme
 * @subpackage  Partials
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */
?>


<article>
	<?php get_template_part( 'partials/single/media' ); ?>
	<?php get_template_part( 'partials/single/header' ); ?>
	<?php get_template_part( 'partials/single/content' ); ?>
	<?php get_template_part( 'partials/link-pages' ); ?>
	<?php get_template_part( 'partials/edit-post' ); ?>
</article>

<?php get_template_part( 'partials/single/author-bio' ); ?>

<?php comments_template(); ?>