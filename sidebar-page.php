<?php
/**
 * The sidebar containing the main widget area for pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package andrewasquith
 */

if ( ! is_active_sidebar( 'page-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-md-4">
	<?php dynamic_sidebar( 'page-sidebar' ); ?>
</aside><!-- #secondary -->
