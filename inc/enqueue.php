<?php
/**
 * Enqueue scripts and styles.
 */
function andrewasquith_scripts() {

    $theme = wp_get_theme();
    $theme_version = $theme->get('Version');

    //version for cache busting
    $css_version = $theme_version . '.' . filemtime(get_template_directory() . '/css/theme.min.css');
    $js_version = $theme_version . '.' . filemtime(get_template_directory() . '/js/theme.min.js'); 

	wp_enqueue_style( 'andrewasquith-style', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $css_version );

    //need jquery for BS4
    wp_enqueue_script('andrewasquith-scripts', get_template_directory() . '/js/theme.min.js', array('jquery'), $js_version);

//	wp_enqueue_script( 'andrewasquith-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

//	wp_enqueue_script( 'andrewasquith-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'andrewasquith_scripts' );