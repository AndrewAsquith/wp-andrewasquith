<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package andrewasquith
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses andrewasquith_header_style()
 */
function andrewasquith_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'andrewasquith_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 2000,
		'height'                 => 1200,
		'flex-height'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'andrewasquith_custom_header_setup' );


