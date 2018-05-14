<?php

if (!function_exists('andrewasquith_disable_editor_emoji')) :

    /**
     * Removes the wpemoji stuff from the tinymce editor
     */
    function andrewasquith_disable_editor_emoji( $plugins ) {
        if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
        return array();
        }
    }
endif;

if (!function_exists('andrewasquith_disable_wpemoji')) :


    /**
     * Removes the wpemoji stuff
     * 
     * This function hooks numerous actions for both the user 
     * and admin facing portions
     */
    function andrewasquith_disable_wpemoji() {

        //standard
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

        //dns prefetch
        add_filter( 'emoji_svg_url', '__return_false' );

        //admin
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        //editor
        add_filter( 'tiny_mce_plugins', 'andrewasquith_disable_editor_emoji' );
    }
endif;

add_action( 'init', 'andrewasquith_disable_wpemoji' );