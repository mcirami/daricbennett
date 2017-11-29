<?php
/**
 * boiler Theme Customizer
 *
 * @package boiler
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function boiler_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'boiler_customize_register' );

/**
 * Add site info to footer
 */
function boiler_customize_site_info( $wp_customize ) {
	// First thing is to add a secion
	$wp_customize->add_section( 'site_info_section', array(
		'title' => __( 'Site Info', '_s' ),
		'priority' => '35',
		'description' => __( 'The label and text for the phone number', '_s' )
	) );

	// Add a setting that will be customizable
	$wp_customize->add_setting( 'site_info', array(
		'default' => 'Site Info',
		'transport' => 'postMessage'
	) );

	// Add a control to bind the setting to the section
	$wp_customize->add_control( 'site_info', array(
		'label' => __('Site Info', '_s' ),
		'section' => 'site_info_section',
		'type' => 'text'
	) );
}
add_action( 'customize_register', 'boiler_customize_site_info' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function boiler_customize_preview_js() {
	wp_enqueue_script( 'boiler_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'boiler_customize_preview_js' );