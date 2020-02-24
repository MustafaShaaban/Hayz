<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/******************** ARISE SLIDER SETTINGS ******************************************/
$arise_settings = arise_get_theme_options();
$wp_customize->add_section( 'featured_content', array(
	'title' => __( 'Slider Settings', 'arise' ),
	'priority' => 140,
	'panel' => 'arise_featuredcontent_panel'
));
$wp_customize->add_setting( 'arise_theme_options[arise_enable_slider]', array(
	'default' => 'frontpage',
	'sanitize_callback' => 'arise_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'arise_theme_options[arise_enable_slider]', array(
	'priority'=>12,
	'label' => __('Enable Slider', 'arise'),
	'section' => 'featured_content',
	'settings' => 'arise_theme_options[arise_enable_slider]',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
	'frontpage' => __('Front Page','arise'),
	'enitresite' => __('Entire Site','arise'),
	'disable' => __('Disable Slider','arise'),
),
));
$wp_customize->add_setting('arise_theme_options[arise_secondary_text]', array(
	'default' =>'',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('arise_theme_options[arise_secondary_text]', array(
	'priority' =>15,
	'label' => __('Secondary Button Text', 'arise'),
	'section' => 'featured_content',
	'settings' => 'arise_theme_options[arise_secondary_text]',
	'type' => 'text',
));
$wp_customize->add_setting('arise_theme_options[arise_secondary_url]', array(
	'default' =>'',
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('arise_theme_options[arise_secondary_url]', array(
	'priority' =>16,
	'label' => __('Secondary Button Url', 'arise'),
	'section' => 'featured_content',
	'settings' => 'arise_theme_options[arise_secondary_url]',
	'type' => 'text',
));
$wp_customize->add_section( 'arise_page_post_options', array(
	'title' => __('Display Page Slider','arise'),
	'priority' => 200,
	'panel' =>'arise_featuredcontent_panel'
));
for ( $i=1; $i <= $arise_settings['arise_slider_no'] ; $i++ ) {
	$wp_customize->add_setting('arise_theme_options[arise_featured_page_slider_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'arise_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'arise_theme_options[arise_featured_page_slider_'. $i .']', array(
		'priority' => 220 . $i,
		'label' => __(' Page Slider #', 'arise') . ' ' . $i ,
		'section' => 'arise_page_post_options',
		'settings' => 'arise_theme_options[arise_featured_page_slider_'. $i .']',
		'type' => 'dropdown-pages',
	));
}