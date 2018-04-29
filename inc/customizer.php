<?php
/**
 * andrewasquith Theme Customizer
 *
 * @package andrewasquith
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function andrewasquith_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'andrewasquith_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'andrewasquith_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_setting( 'featured_image_as_header', array(
        'default'   => 1, // Set default value
        'sanitize_callback' => 'esc_attr', // Sanitize input
        )
    );

	$wp_customize->add_control( 
        new WP_Customize_Control(
            $wp_customize,
            'featured_image_as_header', // Setting ID
            array(
                'label'     => __( 'Use Featured Image as Header', 'andrewasquith' ),
                'section'   => 'header_image', // No hyphen
                'settings'  => 'featured_image_as_header', // Setting ID
                'type'      => 'checkbox',
            )
        )
    );

}
add_action( 'customize_register', 'andrewasquith_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function andrewasquith_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function andrewasquith_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function andrewasquith_customize_preview_js() {
	wp_enqueue_script( 'andrewasquith-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'andrewasquith_customize_preview_js' );


function theme_name_custom_settings( $wp_customize ) {

    

    

}

add_action( 'customize_register', 'theme_name_custom_settings' );