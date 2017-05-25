<?php
/**
 * Homepage Features
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

// Return if disabled
if ( ! get_theme_mod( 'wpex_homepage_features', true ) ) {
	return;
}

// Get data
$posts_per_page = get_theme_mod( 'wpex_home_blog_count', '3' );

// Query features
$wpex_query = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => $posts_per_page,
	'no_found_rows'  => true,
) );

// Display features
if ( $wpex_query->posts && '0' != $posts_per_page ) : ?>

	<div id="homepage-blog" class="clr">

		<h2 class="heading"><span><?php _e( 'From The Blog', 'elegant' ); ?></span></h2>

		<?php $wpex_count=0; ?>

		<?php foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

			<?php $wpex_count++; ?>

				<article class="recent-blog-entry clr col span_1_of_3 col-<?php echo $wpex_count; ?>">

					<?php
					// Display post thumbnail
					if ( has_post_thumbnail() ) { ?>
						<div class="recent-blog-entry-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
								<?php the_post_thumbnail( 'wpex-entry', array(
									'alt' => wpex_get_esc_title(),
								) ); ?>
							</a>
						</div><!-- .recent-blog-entry-thumbnail -->
					<?php } ?>

					<header>
						<h3 class="recent-blog-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h3>
						<ul class="post-meta clr">
							<li class="meta-date">
								<?php _e( 'Posted on', 'elegant' ); ?>
								<span class="meta-date-text"><?php echo get_the_date(); ?></span>
							</li>
							
						</ul><!-- .post-meta -->
					</header>

					<div class="recent-blog-entry-content entry clr">
						<?php wpex_excerpt( 18, false ); ?>
					</div><!-- .recent-blog-entry-content -->

				</article><!-- .recent-blog -->

			<?php if ( $wpex_count == '3' ) $wpex_count=0; ?>

		<?php endforeach; ?>

	</div><!-- #homepage-portfolio -->

<?php endif;

// Reset post data
wp_reset_postdata();