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

	} ); // End doc ready
	
} ) ( jQuery );