<?php
/**
 * andrewasquith functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package andrewasquith
 */


$includes_folder = get_template_directory() . '/inc/';

/**
 * Theme setup hook
 */
require $includes_folder . 'setup.php';

/**
 * Widget setup
 */
require $includes_folder . 'widgets.php';


/**
 * Bootstrap custom nav walker
 */
require $includes_folder . 'bootstrap-nav-walker.php';

/**
 * Implement the Custom Header feature.
 */
require $includes_folder . 'custom-header.php';

/**
 * Custom template tags for this theme.
 */
require $includes_folder . 'template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require $includes_folder . 'template-functions.php';

/**
 * Customizer additions.
 */
require $includes_folder . 'customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require $includes_folder . 'jetpack.php';
}

