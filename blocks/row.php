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
function row_block_init() {
        $dir = get_template_directory() . '/blocks';
        $theme = wp_get_theme();
        $theme_version = $theme->get('Version');

        $index_js = 'row/index.js';
        wp_register_script(
                'row-block-editor',
                get_template_directory_uri() . "/blocks/$index_js",
                array(
                        'wp-blocks',
                        'wp-i18n',
                        'wp-element',
                        'wp-editor',
                ),
                $theme_version
        );

        $editor_css = 'row/editor.css';
        wp_register_style(
                'row-block-editor',
                get_template_directory_uri() . "/blocks/$editor_css",
                array(
                        'wp-edit-blocks',
                ),
                $theme_version
        );

        $style_css = 'row/style.css';
        wp_register_style(
                'row-block',
                get_template_directory_uri() . "/blocks/$style_css",
                array(
                        'wp-blocks',
                ),
                $theme_version
        );

        register_block_type( 'andrewasquith/row', array(
                'editor_script' => 'row-block-editor',
                'editor_style'  => 'row-block-editor',
                'style'         => 'row-block',
        ) );
}
add_action( 'init', 'row_block_init' );