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

if (!function_exists('andrewasquith_get_header_image()')) {
	function andrewasquith_get_header_image() {
		$queried_post = get_queried_object_id();
		
		 if ((is_singular()) && ( get_theme_mod( 'featured_image_as_header' ) == 1 ) && (has_post_thumbnail($queried_post))) {
			$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $queried_post ), 'full' );
			return $attachment[0];
		} else if (has_header_image()) {
			return get_header_image();
		} else {
			return null;
		}
	}
}