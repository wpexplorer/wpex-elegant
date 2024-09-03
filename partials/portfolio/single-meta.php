<?php
/**
 * Portfolio single meta
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

<ul class="post-meta clr">

	<li class="meta-date">
		<?php _e( 'Posted on', 'wpex-elegant' ); ?>
		<span class="meta-date-text"><?php echo get_the_date(); ?></span>
	</li>

	<?php if ( $cats = wpex_list_post_terms( 'portfolio_category', false ) ) : ?>

		<li class="meta-category">
			<span class="meta-seperator">/</span><?php _e( 'Under', 'wpex-elegant' ); ?>
			<?php echo $cats; // already sanitized ?>
		</li>

	<?php endif; ?>

	<?php if ( comments_open() ) { ?>
		<li class="meta-comments comment-scroll">
			<span class="meta-seperator">/</span><?php _e( 'With', 'wpex-elegant' ); ?>
			<?php comments_popup_link( esc_html__( '0 Comments', 'wpex-elegant' ), esc_html__( '1 Comment',  'wpex-elegant' ), esc_html__( '% Comments', 'wpex-elegant' ), 'comments-link' ); ?>
		</li>
	<?php } ?>

</ul><!-- .post-meta -->