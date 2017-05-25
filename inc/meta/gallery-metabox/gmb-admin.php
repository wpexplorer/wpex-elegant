<?php
/*
 * Creates a gallery metabox
 *
 * http://wordpress.org/plugins/easy-image-gallery/
 * https://github.com/woothemes/woocommerce
 *
 * @package WordPress
 * @subpackage AuthenticThemes
 * @since Elegant 1.0
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.



/*------------------------------------------------*/
/* Add meta boxes to selected post types
/*------------------------------------------------*/
add_action( 'add_meta_boxes', 'wpex_add_gallery_metabox' );
if ( ! function_exists( 'wpex_add_gallery_metabox' ) ) {
	function wpex_add_gallery_metabox() {
		// Portfolio
		add_meta_box( 'easy_image_gallery', __( 'Image Gallery', 'elegant' ), 'wpex_gallery_metabox', 'portfolio', 'normal', 'high' );
	}
}


/*------------------------------------------------*/
/* Check for lightbox
/*------------------------------------------------*/
if ( ! function_exists( 'wpex_gallery_has_lightbox' ) ) {
	function wpex_gallery_has_lightbox() {
		$link_images = get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true );
		if ( 'on' == $link_images ) return true;
	}
}


/*------------------------------------------------*/
/* Load metabox CSS
/*------------------------------------------------*/
add_action( 'admin_head', 'wpex_gallery_metabox_css' );
if ( ! function_exists( 'wpex_gallery_metabox_css' ) ) {
	function wpex_gallery_metabox_css() { ?>
		<style>
			.details.attachment { box-shadow: none }
			.gallery_images .attachment.details > div { width: 80px; height: 80px; box-shadow: none; }
			.gallery_images .attachment-preview { position: relative }
			.gallery_images .attachment-preview .thumbnail { cursor: move }	
			.gallery_images .wc-metabox-sortable-placeholder{width: 80px;height: 80px;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;border:4px dashed #ddd;background:#f7f7f7 url(<?php echo get_template_directory_uri(); ?>/functions/meta/gallery-metabox/image_watermark.png) no-repeat center}		
			.gallery_images .wpex-gmb-remove {background: #eee url(<?php echo get_template_directory_uri(); ?>/functions/meta/gallery-metabox/delete.png) center center no-repeat;position: absolute;top: 2px;right: 2px;border-radius: 2px;padding: 2px;display: none;width: 10px;height: 10px;margin: 0;display: none;overflow: hidden;}	
			.attachment.details div:hover .wpex-gmb-remove { display: block }
			.gallery_images:after, #gallery_images_container:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
			#gallery_images_container ul { margin: 0 !important }
			.gallery_images > li { float: left; cursor: move; margin: 9px 9px 0 0; }
			.gallery_images li.image img { width: 80px; height: 80px; }
		</style>	
	<?php }
}



/*------------------------------------------------*/
/* Render the Gallery Metabox
/*------------------------------------------------*/
function wpex_gallery_metabox() {
    global $post; ?>
    <div id="gallery_images_container">
        <ul class="gallery_images">
            <?php
			$image_gallery = get_post_meta( $post->ID, '_easy_image_gallery', true );
			$attachments = array_filter( explode( ',', $image_gallery ) );
			if ( $attachments ) {
				foreach ( $attachments as $attachment_id ) {
					if ( wp_attachment_is_image ( $attachment_id  ) ) { ?>
						<li class="image attachment details" data-attachment_id="<?php echo absint( $attachment_id ); ?>">
                        	<div class="attachment-preview"><div class="thumbnail">
								<?php echo wp_get_attachment_image( $attachment_id, 'thumbnail' ); ?></div>
								<a href="#" class="wpex-gmb-remove" title="<?php _e( 'Remove image', 'elegant' ); ?>"><div class="media-modal-icon"></div></a>	   
							</div>
                       </li>
					<?php }
				}
			} ?>
        </ul>
        <input type="hidden" id="image_gallery" name="image_gallery" value="<?php echo esc_attr( $image_gallery ); ?>" />
        <?php wp_nonce_field( 'easy_image_gallery', 'easy_image_gallery' ); ?>
    </div>
    <p class="add_gallery_images hide-if-no-js">
        <a href="#" class="button-secondary"><?php _e( 'Add/Edit Images', 'elegant' ); ?></a>
    </p>
    <?php
    // options don't exist yet, set to checked by default
    if ( ! get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true ) )
        $checked = ' checked="checked"';
    else
        $checked = wpex_gallery_has_lightbox() ? checked( get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true ), 'on', false ) : ''; ?>
    <p>
        <label for="easy_image_gallery_link_images">
            <input type="checkbox" id="easy_image_gallery_link_images" value="on" name="easy_image_gallery_link_images"<?php echo $checked; ?> /> <?php _e( 'Enable Lightbox for this gallery?', 'elegant' )?>
        </label>
    </p>


    <?php // Props to WooCommerce for the following JS code ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            // Uploading files
            var image_gallery_frame;
            var $image_gallery_ids	= $('#image_gallery');
            var $gallery_images 	= $('#gallery_images_container ul.gallery_images');
            jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {
                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();
                event.preventDefault();
                // If the media frame already exists, reopen it.
                if ( image_gallery_frame ) {
                    image_gallery_frame.open();
                    return;
                }
                // Create the media frame.
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Add Images to Gallery', 'elegant' ); ?>',
                    button: {
                        text: '<?php _e( 'Add to gallery', 'elegant' ); ?>',
                    },
                    multiple: true
                });
                // When an image is selected, run a callback.
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
                             $gallery_images.append('\
                                <li class="image attachment details" data-attachment_id="' + attachment.id + '">\
                                    <div class="attachment-preview">\
                                        <div class="thumbnail">\
                                            <img src="' + attachment.url + '" />\
                                        </div>\
                                       <a href="#" class="wpex-gmb-remove" title="<?php _e( 'Remove image', 'elegant' ); ?>"><div class="media-modal-icon"></div></a>\
                                    </div>\
                                </li>');
                        }
                    } );
                    $image_gallery_ids.val( attachment_ids );
                });
                // Finally, open the modal.
                image_gallery_frame.open();
            });
            // Image ordering
            $gallery_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity:40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'wc-metabox-sortable-placeholder',
                start:function(event,ui){
                    ui.item.css('background-color','#f6f6f6');
                },
                stop:function(event,ui){
                    ui.item.removeAttr('style');
                },
                update: function(event, ui) {
                    var attachment_ids = '';

                    $('#gallery_images_container ul li.image').css('cursor','default').each(function() {
                        var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });
                    $image_gallery_ids.val( attachment_ids );
                }
            });
            // Remove images
            $('#gallery_images_container').on( 'click', 'a.wpex-gmb-remove', function() {
                $(this).closest('li.image').remove();
                var attachment_ids = '';
                $('#gallery_images_container ul li.image').css('cursor','default').each(function() {
                    var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                    attachment_ids = attachment_ids + attachment_id + ',';
                });
                $image_gallery_ids.val( attachment_ids );
                return false;
            } );
        });
    </script>
    <?php
}



/*------------------------------------------------*/
/* Save the metabox
/*------------------------------------------------*/
add_action( 'save_post', 'wpex_save_gallery_metabox' );
function wpex_save_gallery_metabox( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    $post_types = array( 'portfolio' );
    // check user permissions
    if ( isset( $_POST[ 'post_type' ] ) && !array_key_exists( $_POST[ 'post_type' ], $post_types ) ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return;
    }
    else {
        if ( !current_user_can( 'edit_post', $post_id ) )
            return;
    }
    if ( ! isset( $_POST[ 'easy_image_gallery' ] ) || ! wp_verify_nonce( $_POST[ 'easy_image_gallery' ], 'easy_image_gallery' ) )
        return;
    if ( isset( $_POST[ 'image_gallery' ] ) && !empty( $_POST[ 'image_gallery' ] ) ) {
        $attachment_ids = sanitize_text_field( $_POST['image_gallery'] );
        // turn comma separated values into array
        $attachment_ids = explode( ',', $attachment_ids );
        // clean the array
        $attachment_ids = array_filter( $attachment_ids  );
        // return back to comma separated list with no trailing comma. This is common when deleting the images
        $attachment_ids =  implode( ',', $attachment_ids );
        update_post_meta( $post_id, '_easy_image_gallery', $attachment_ids );
    } else {
        delete_post_meta( $post_id, '_easy_image_gallery' );
    }
    // link to larger images
    if ( isset( $_POST[ 'easy_image_gallery_link_images' ] ) )
        update_post_meta( $post_id, '_easy_image_gallery_link_images', $_POST[ 'easy_image_gallery_link_images' ] );
    else
        update_post_meta( $post_id, '_easy_image_gallery_link_images', 'off' );

    do_action( 'wpex_save_gallery_metabox', $post_id );
}