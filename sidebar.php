<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package andrewasquith
 */

if ( ! is_active_sidebar( 'main-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="col-md-4 widget-area">
	<?php dynamic_sidebar( 'main-sidebar' ); ?>
</aside><!-- #secondary -->
