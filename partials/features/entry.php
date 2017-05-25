<?php
/**
 * The default template for displaying features entries
 *
 * @package Elegant WordPress theme
 * @author  Alexander Clarke
 * @link    http://www.wpexplorer.com
 * @since   1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get and sanitize data
$url  = get_post_meta( get_the_ID(), 'wpex_feature_url', true );
$url  = esc_attr( $url );
$icon = get_post_meta( get_the_ID(), 'wpex_icon_font', true ); ?>

<article id="id-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( $url ) : ?>

		<a href="<?php echo esc_url( $url ); ?>" title="<?php wpex_esc_title(); ?>" target="_blank" class="feature-entry-url clr">

	<?php endif; ?>

	<?php
	// Display icon
	if ( $icon ) : ?>

		<div class="feature-icon-font"><i class="fa fa-<?php echo esc_attr( $icon ); ?>"></i></div>

	<?php
	// Display featured image
	elseif ( has_post_thumbnail() ) : ?>

		<div class="feature-thumbnail">
			<?php
			// Display post thumbnail
			the_post_thumbnail( 'full', array(
				'alt' => wpex_get_esc_title(),
			) ); ?>
		</div><!-- .feature-thumbnail -->

	<?php endif; ?>

	<?php if ( $url ) echo '</a>'; ?>

	<header class="feature-entry-header clr">
		<h2 class="feature-entry-title">
			<?php if ( $url ) : ?>
				<a href="<?php echo esc_url( $url ); ?>" title="<?php wpex_esc_title(); ?>" target="_blank" class="feature-entry-url clr">
					<?php the_title(); ?>
				</a>
			<?php else : ?>
				<?php the_title(); ?>
			<?php endif; ?>
		</h2>
	</header>

	<div class="feature-entry-content entry clr">
		<?php the_content(); ?>
	</div>

</article>