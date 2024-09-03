<?php
/**
 * Post single meta
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

// Only display for standard posts
if ( 'post' != get_post_type() ) {
	return;
}

// Get author data
$author				 = get_the_author();
$author_description	 = get_the_author_meta( 'description' );
$author_url			 = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
$author_avatar		 = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 75 ) );
$avatar_allowed_html = array(
    'img' => array(
        'src'    => array(),
        'title'  => array(),
        'height' => array(),
        'width'  => array(),
    ),
);

// Only display if author has a description
if ( ! $author_description ) {
	return;
} ?>

<div class="author-info clr">

	<h4 class="heading"><span><?php printf( esc_html__( 'Written by %s', 'wpex-elegant' ), $author ); ?></span></h4>

	<div class="author-info-inner clr">

		<?php if ( $author_avatar ) : ?>
			<a href="<?php echo esc_url( $author_url ); ?>" rel="author" class="author-avatar"><?php echo wp_kses( $author_avatar, $avatar_allowed_html ); ?></a>
		<?php endif; ?>

		<div class="author-description">
			<p><?php echo wp_kses_post( $author_description ); ?></p>
		</div><!-- .author-description -->

	</div><!-- .author-info-inner -->

</div><!-- .author-info -->