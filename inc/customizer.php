<?php
/**
 * JPKCom Wp Starter Theme Customizer
 *
 * @package JPKCom_Wp_Starter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jpkcom_wp_starter_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'jpkcom_wp_starter_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'jpkcom_wp_starter_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'jpkcom_wp_starter_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function jpkcom_wp_starter_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function jpkcom_wp_starter_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jpkcom_wp_starter_customize_preview_js() {
	wp_enqueue_script( 'jpkcom-wp-starter-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'jpkcom_wp_starter_customize_preview_js' );
