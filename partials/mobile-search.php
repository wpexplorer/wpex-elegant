<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package     Elegant WordPress theme
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */
?>

<div id="mobile-search">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" id="mobile-search-form">
		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr_x( 'To search type and hit enter','elegant' ); ?>" />
	</form>
</div>