( function($) {
	'use strict';
	
	$( document ).ready( function() {

		// Returns current viewport width
		function wpexViewportWidth() {
			var e = window, a = 'inner';
			if ( ! ( 'innerWidth' in window ) ) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return e[ a+'Width' ];
		}
		
		// Main menu superfish
		$( 'ul.sf-menu' ).superfish( {
			delay     : 200,
			animation : {
				opacity :'show',
				height  :'show'
			},
			speed     : 'fast',
			cssArrows : false,
			disableHI : true
		} );
		
		// Mobile Menu
		$( '#navigation-toggle' ).sidr( {
			name   : 'sidr-main',
			source : '#sidr-close, #site-navigation, #mobile-search',
			side   : 'left'
		} );
		$( '.sidr-class-toggle-sidr-close' ).click( function() {
			$.sidr( 'close', 'sidr-main' );
			return false;
		} );
		
		// Close the menu on window change
		$( window ).resize( function() {
			if ( wpexViewportWidth() >= 959 ) {
				$.sidr( 'close', 'sidr-main' );
			}
		} );
		
		// Prettyphoto => for desktops only
		if ( $( window ).width() > 767 ) {
		
			// PrettyPhoto Without gallery
			$( '.wpex-lightbox' ).prettyPhoto( {
				show_title         : false,
				social_tools       : false,
				slideshow          : false,
				autoplay_slideshow : false,
				wmode              : 'opaque'
			} );
		
			//PrettyPhoto With Gallery
			$( "a[rel^='wpexLightboxGallery']" ).prettyPhoto( {
				show_title         : false,
				social_tools       : false,
				autoplay_slideshow : false,
				overlay_gallery    : true,
				wmode              : 'opaque'
			} );
		
		}

	} ); // End doc ready

	$( window ).load( function() {

		// Homepage FlexSlider
		$( '#homepage-slider' ).flexslider( {
			animation         : 'slide',
			slideshow         : true,
			smoothHeight      : true,
			controlNav        : false,
			directionNav      : true,
			prevText          : '<span class="fa fa-angle-left"></span>',
			nextText          : '<span class="fa fa-angle-right"></span>',
			controlsContainer : ".flexslider-container"
		} );

		// Post FlexSlider
		$( 'div.post-slider' ).flexslider( {
			animation         : 'slide',
			slideshow         : true,
			smoothHeight      : true,
			controlNav        : false,
			directionNav      : true,
			prevText          : '<span class="fa fa-angle-left"></span>',
			nextText          : '<span class="fa fa-angle-right"></span>',
			controlsContainer : ".flexslider-container"
		} );
		
	} ); // End on window load
	
} ) ( jQuery );