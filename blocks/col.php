<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package andrewasquith
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function col_block_init() {
        $dir = get_template_directory() . '/blocks';
        $theme = wp_get_theme();
        $theme_version = $theme->get('Version');

        $index_js = 'col/index.js';
        wp_register_script(
                'col-block-editor',
                get_template_directory_uri() . "/blocks/$index_js",
                array(
                        'wp-blocks',
                        'wp-i18n',
                        'wp-element',
                        'wp-editor',
                ),
                $theme_version
        );

        $editor_css = 'col/editor.css';
        wp_register_style(
                'col-block-editor',
                get_template_directory_uri() . "/blocks/$editor_css",
                array(
                        'wp-edit-blocks',
                ),
                $theme_version
        );


        register_block_type( 'andrewasquith/col', array(
                'editor_script' => 'col-block-editor',
                'editor_style'  => 'col-block-editor',
        ) );
}
add_action( 'init', 'col_block_init' );