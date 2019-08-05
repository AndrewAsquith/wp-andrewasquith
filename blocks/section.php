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
function section_block_init() {
        $dir = get_template_directory() . '/blocks';
        $theme = wp_get_theme();
        $theme_version = $theme->get('Version');

        $index_js = 'section/index.js';
        wp_register_script(
                'section-block-editor',
                get_template_directory_uri() . "/blocks/$index_js",
                array(
                        'wp-blocks',
                        'wp-i18n',
                        'wp-element',
                ),
                $theme_version
        );

        $editor_css = 'section/editor.css';
        wp_register_style(
                'section-block-editor',
                get_template_directory_uri() . "/blocks/$editor_css",
                array(
                        'wp-blocks',
                ),
                $theme_version
        );

        $style_css = 'section/style.css';
        wp_register_style(
                'section-block',
                get_template_directory_uri() . "/blocks/$style_css",
                array(
                        'wp-blocks',
                ),
                $theme_version
        );

        register_block_type( 'andrewasquith/section', array(
                'editor_script' => 'section-block-editor',
                'editor_style'  => 'section-block-editor',
                'style'         => 'section-block',
        ) );
}
add_action( 'init', 'section_block_init' );