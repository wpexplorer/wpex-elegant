<?php
/**
 * Displays the archive header
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

// Not used on the front-page or homepage
if ( is_front_page() || is_home() ) {
	return;
} ?>

<header class="page-header">

	<h1 class="page-header-title">
	
		<?php
		// Search title
		if ( is_search() ) :

			printf( esc_html__( 'Search Results for: %s', 'wpex-elegant' ), get_search_query() );

		// Home title
		elseif ( is_home() ) :

			// Check for page title
			if ( get_option( 'page_for_posts' ) ) {
				echo get_the_title( get_option( 'page_for_posts' ) );
			} else {
				_e( 'Blog', 'wpex-elegant' );
			} 

		// All else
		else :

			the_archive_title();

		endif; ?>

	</h1>

	<?php
	// Display term description
	if ( term_description() ) : ?>

		<div id="archive-description" class="clr">

			<?php echo term_description(); ?>

		</div><!-- #archive-description -->

	<?php endif; ?>

</header><!-- .page-header -->