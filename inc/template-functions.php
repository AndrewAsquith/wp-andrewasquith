<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package andrewasquith
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function andrewasquith_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'main-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'andrewasquith_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function andrewasquith_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'andrewasquith_pingback_header' );


/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function andrewasquith_excerpt_more( $more ) {
    return sprintf( '<a class="pl-3 read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'andrewasquith' )
    );
}
add_filter( 'excerpt_more', 'andrewasquith_excerpt_more' );

/**
 *  Remove the anchor from the read more link
 *  @param string $link the link used for the read more
 *  @return string modified link without the anchor
 */
function andrewasquith_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'andrewasquith_remove_more_link_scroll' );