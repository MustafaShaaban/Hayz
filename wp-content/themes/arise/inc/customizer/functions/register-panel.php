<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/******************** ARISE CUSTOMIZE REGISTER *********************************************/
add_action( 'customize_register', 'arise_customize_register_wordpress_default' );
function arise_customize_register_wordpress_default( $wp_customize ) {
	$wp_customize->add_panel( 'arise_wordpress_default_panel', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Arise WordPress Settings', 'arise' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'arise_customize_register_options', 20 );
function arise_customize_register_options( $wp_customize ) {
	$wp_customize->add_panel( 'arise_options_panel', array(
		'priority' => 6,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Arise Theme Options', 'arise' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'arise_customize_register_featuredcontent' );
function arise_customize_register_featuredcontent( $wp_customize ) {
	$wp_customize->add_panel( 'arise_featuredcontent_panel', array(
		'priority' => 7,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Arise Slider Options', 'arise' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'arise_customize_register_widgets' );
function arise_customize_register_widgets( $wp_customize ) {
	$wp_customize->add_panel( 'widgets', array(
		'priority' => 8,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Arise Widgets', 'arise' ),
		'description' => '',
	) );
}