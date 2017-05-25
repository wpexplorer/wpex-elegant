<?php
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments
 * template simply create your own wpex_comment(), and that function
 * will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @package     Elegant WordPress theme
 * @subpackage  Includes
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 */

if ( ! function_exists( 'wpex_comment' ) ) {
	function wpex_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments. ?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<p><?php _e( 'Pingback:', 'elegant' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'elegant' ), '<span class="ping-meta"><span class="edit-link">', '</span></span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
		?>
		<li id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 50 ); ?>
				</div><!-- .comment-author -->
				<div class="comment-details clr">
					<header class="comment-meta">
						<cite class="fn"><?php comment_author_link(); ?></cite>
						<span class="comment-date">
						<?php
							printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( _x( '%1$s', '1: date', 'elegant' ), get_comment_date() )
							);
							//edit_comment_link( __( 'Edit', 'elegant' ), '<span class="edit-link">', '<span>' );
						?>
						</span><!-- .comment-date -->
						<span class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'elegant' ) . '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</span><!-- .reply -->
					</header><!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'elegant' ); ?></p>
					<?php endif; ?>
					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->
				</div><!-- .comment-details -->
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // End comment_type check.
	}
}