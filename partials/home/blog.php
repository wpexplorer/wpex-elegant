<?php
/**
 * Homepage Features
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
}

// Return if disabled
if ( ! get_theme_mod( 'wpex_homepage_features', true ) ) {
	return;
}

// Get theme settings
$posts_per_page = get_theme_mod( 'wpex_home_blog_count', '3' );
$columns = get_theme_mod( 'wpex_home_blog_columns' );
$columns = $columns ? $columns : '3';

// Query features
$wpex_query = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => $posts_per_page,
	'no_found_rows'  => true,
) );

// Display features
if ( $wpex_query->posts && '0' != $posts_per_page ) : ?>

	<div id="homepage-blog">

		<h2 class="heading"><span><?php _e( 'From The Blog', 'wpex-elegant' ); ?></span></h2>

		<div class="wpex-grid wpex-grid-cols-3">
			<?php foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

				<article class="recent-blog-entry">

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
						<h3 class="recent-blog-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<ul class="post-meta clr">
							<li class="meta-date">
								<span class="meta-date-text"><span class="fa-regular fa-calendar" aria-hidden="true"></span><?php echo get_the_date(); ?></span>
							</li>

						</ul><!-- .post-meta -->
					</header>

					<div class="recent-blog-entry-content entry clr">
						<?php wpex_excerpt( 18, false ); ?>
					</div><!-- .recent-blog-entry-content -->

				</article><!-- .recent-blog -->

			<?php endforeach; ?>
		</div>

	</div><!-- #homepage-portfolio -->

<?php endif;

// Reset post data
wp_reset_postdata();