<?php
/**
 * Homepage Slider
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

// Query slides
$wpex_query = new WP_Query( array(
	'post_type'      => 'slides',
	'posts_per_page' => '-1',
	'no_found_rows'  => true,
) );

// Display slides if we find some
if ( $wpex_query->posts ) : ?>

	<div id="homepage-slider-wrap" class="clr flexslider-container">

		<div id="homepage-slider" class="flexslider">

			<ul class="slides clr">

				<?php
				// Loop through each slide
				foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

					<?php
					// Get data
					$post_id       = get_the_ID();
					$title         = wpex_get_esc_title();
					$title_display = ( 'on' == get_post_meta( $post_id ,'wpex_slide_hide_title', true ) ) ? false : true;
					$caption       = get_post_meta( $post_id, 'wpex_slide_caption', true );
					$url           = get_post_meta( $post_id, 'wpex_slide_url', true );
					$url_target    = get_post_meta( $post_id, 'wpex_slide_target', true );
					$url_target    = ( $url_target == 'blank' ) ? 'target="_blank"' : 'blank'; ?>

					<li class="homepage-slider-slide">

						<?php if ( $url ) { ?>
							<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $title ); ?>"<?php echo $url_target; ?>>
						<?php } ?>

						<?php if ( $title_display || $caption ) : ?>
							<div class="homepage-slide-inner container">
								<div class="homepage-slide-content">
									<?php if ( $title_display ) : ?>
										<div class="homepage-slide-title"><?php the_title(); ?></div>
									<?php endif; ?>
									<?php if ( $caption ) { ?>
										<div class="clr"></div>
										<div class="homepage-slide-caption"><?php echo wp_kses_post( $caption ); ?></div>
									<?php } ?>
								</div><!-- .homepage-slider-content -->
							</div>
						<?php endif; ?>

						<?php
						// Display post thumbnail
						the_post_thumbnail( 'wpex-home-slider', array(
							'alt' => wpex_get_esc_title(),
						) ); ?>

						<?php if ( $url ) echo '</a>'; ?>

					</li>

				<?php endforeach; ?>

			</ul><!-- .slides -->

		</div><!-- .flexslider -->

	</div><!-- #homepage-slider" -->

<?php endif;

// Reset post data to prevent conflicts with the main query
wp_reset_postdata();