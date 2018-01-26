<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */
?>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wpex-elegant' ), admin_url( 'post-new.php' ) ); ?></p>
	<?php } elseif ( is_search() ) { ?>
		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'wpex-elegant' ); ?></p>
	<?php } elseif ( is_category() ) { ?>
		<p><?php _e( 'There aren\'t any posts currently published in this category.', 'wpex-elegant' ); ?></p>
	<?php } elseif ( is_tax() ) { ?>
		<p><?php _e( 'There aren\'t any posts currently published under this taxonomy.', 'wpex-elegant' ); ?></p>
	<?php } elseif ( is_tag() ) { ?>
		<p><?php _e( 'There aren\'t any posts currently published under this tag.', 'wpex-elegant' ); ?></p>
	<?php } else { ?>
		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'wpex-elegant' ); ?></p>
	<?php } ?>
</div><!-- .page-content -->