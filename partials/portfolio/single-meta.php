<?php
/**
 * Portfolio single meta
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

<ul class="post-meta clr">

	<li class="meta-date">
		<?php _e( 'Posted on', 'elegant' ); ?>
		<span class="meta-date-text"><?php echo get_the_date(); ?></span>
	</li>

	<?php if ( $cats = wpex_list_post_terms( 'portfolio_category', false ) ) : ?>

		<li class="meta-category">
			<span class="meta-seperator">/</span><?php _e( 'Under', 'elegant' ); ?>
			<?php echo $cats; ?>
		</li>

	<?php endif; ?>

	<?php if ( comments_open() ) { ?>
		<li class="meta-comments comment-scroll">
			<span class="meta-seperator">/</span><?php _e( 'With', 'elegant' ); ?>
			<?php comments_popup_link( __( '0 Comments', 'elegant' ), __( '1 Comment',  'elegant' ), __( '% Comments', 'elegant' ), 'comments-link' ); ?>
		</li>
	<?php } ?>
	
</ul><!-- .post-meta -->