<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/********************  ARISE THEME OPTIONS ******************************************/
	$wp_customize->add_section('title_tagline', array(
	'title' => __('Site Title & Logo Options', 'arise'),
	'priority' => 10,
	'panel' => 'arise_wordpress_default_panel'
	));
	$wp_customize->add_setting( 'arise_theme_options[arise-img-upload-header-logo]',array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type' => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'arise_theme_options[arise-img-upload-header-logo]', array(
		'label' => __('Site Logo','arise'),
		'priority'	=> 101,
		'section' => 'title_tagline',
		'settings' => 'arise_theme_options[arise-img-upload-header-logo]'
		)
	));
	$wp_customize->add_setting('arise_theme_options[arise_header_display]', array(
		'capability' => 'edit_theme_options',
		'default' => 'header_text',
		'sanitize_callback' => 'arise_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('arise_theme_options[arise_header_display]', array(
		'label' => __('Site Logo/ Text Options', 'arise'),
		'priority' => 102,
		'section' => 'title_tagline',
		'settings' => 'arise_theme_options[arise_header_display]',
		'type' => 'select',
		'checked' => 'checked',
			'choices' => array(
			'header_text' => __('Display Site Title Only','arise'),
			'header_logo' => __('Display Site Logo Only','arise'),
			'show_both' => __('Show Both','arise'),
			'disable_both' => __('Disable Both','arise'),
		),
	));
	$wp_customize->add_section('header_image', array(
	'title' => __('Header Image', 'arise'),
	'priority' => 20,
	'panel' => 'arise_wordpress_default_panel'
	));
	$wp_customize->add_setting('arise_theme_options[arise_display_header_image]', array(
		'capability' => 'edit_theme_options',
		'default' => 'below',
		'sanitize_callback' => 'arise_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('arise_theme_options[arise_display_header_image]', array(
		'label' => __('Display Header Image', 'arise'),
		'priority' => 5,
		'section' => 'header_image',
		'settings' => 'arise_theme_options[arise_display_header_image]',
		'type' => 'select',
		'checked' => 'checked',
			'choices' => array(
			'below' => __('Display below Infobar','arise'),
			'top' => __('Display above Infobar','arise'),
		),
	));
	$wp_customize->add_setting('arise_theme_options[arise_custom_header_options]', array(
		'default' => 'homepage',
		'sanitize_callback' => 'arise_sanitize_select',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control('arise_theme_options[arise_custom_header_options]', array(
		'label' => __('Enable Custom Header Image', 'arise'),
		'section' => 'header_image',
		'type' => 'select',
		'settings' => 'arise_theme_options[arise_custom_header_options]',
		'checked' => 'checked',
		'choices' => array(
		'homepage' => __('Front Page','arise'),
		'enitre_site' => __('Entire Site','arise'),
		'header_disable' => __('Disable','arise'),
	),
	));
	$wp_customize->add_setting('arise_theme_options[arise_header_primary_text]', array(
		'default' =>'',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control('arise_theme_options[arise_header_primary_text]', array(
		'priority' =>25,
		'description' => __('Primary Button Text', 'arise'),
		'section' => 'header_image',
		'settings' => 'arise_theme_options[arise_header_primary_text]',
		'type' => 'text',
	));
	$wp_customize->add_setting('arise_theme_options[arise_disable_header_image_only]', array(
		'default' => 0,
		'sanitize_callback' => 'arise_checkbox_integer',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control('arise_theme_options[arise_disable_header_image_only]', array(
		'priority' => 14,
		'label' => __('Disable Header Image Only', 'arise'),
		'description' => __('Using below settings will not increase the size of header image','arise'),
		'section' => 'header_image',
		'settings' => 'arise_theme_options[arise_disable_header_image_only]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting('arise_theme_options[arise_Header_description]', array(
		'default' =>'',
		'sanitize_callback' => 'sanitize_textarea_field',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control('arise_theme_options[arise_Header_description]', array(
		'priority'  =>20,
		'description' => __('Header Description', 'arise'),
		'section' => 'header_image',
		'settings' => 'arise_theme_options[arise_Header_description]',
		'type' => 'textarea',
	));
	
	$wp_customize->add_setting('arise_theme_options[arise_header_primary_url]', array(
		'default' =>'',
		'sanitize_callback' => 'esc_url_raw',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control('arise_theme_options[arise_header_primary_url]', array(
		'priority' =>26,
		'description' => __('Primary Button Link', 'arise'),
		'section' => 'header_image',
		'settings' => 'arise_theme_options[arise_header_primary_url]',
		'type' => 'text',
	));
	$wp_customize->add_setting('arise_theme_options[arise_header_secondary_text]', array(
		'default' =>'',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control('arise_theme_options[arise_header_secondary_text]', array(
		'priority' =>27,
		'description' => __('Secondary Button Text', 'arise'),
		'section' => 'header_image',
		'settings' => 'arise_theme_options[arise_header_secondary_text]',
		'type' => 'text',
	));
	$wp_customize->add_setting('arise_theme_options[arise_Header_secondary_url]', array(
		'default' =>'',
		'sanitize_callback' => 'esc_url_raw',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control('arise_theme_options[arise_Header_secondary_url]', array(
		'priority' =>28,
		'description' => __('Secondary Button Link', 'arise'),
		'section' => 'header_image',
		'settings' => 'arise_theme_options[arise_Header_secondary_url]',
		'type' => 'text',
	));
	$wp_customize->add_section('arise_custom_header', array(
		'title' => __('Arise Options', 'arise'),
		'priority' => 503,
		'panel' => 'arise_options_panel'
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_slider_header_line]', array(
		'default' => 0,
		'sanitize_callback' => 'arise_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_slider_header_line]', array(
		'priority'=>20,
		'label' => __('Disable headerline from Slider', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_slider_header_line]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting('arise_theme_options[arise_top_bar]', array(
		'default'=>0,
		'sanitize_callback'=>'arise_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_top_bar]', array(
		'priority'=>10,
		'label' => __('Disable Top Bar', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_top_bar]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_search_custom_header]', array(
		'default' => 0,
		'sanitize_callback' => 'arise_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_search_custom_header]', array(
		'priority'=>20,
		'label' => __('Disable Search Form', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_search_custom_header]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_stick_menu]', array(
		'default' => 0,
		'sanitize_callback' => 'arise_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_stick_menu]', array(
		'priority'=>30,
		'label' => __('Disable Stick Menu', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_stick_menu]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_scroll]', array(
		'default' => 0,
		'sanitize_callback' => 'arise_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_scroll]', array(
		'priority'=>40,
		'label' => __('Disable Goto Top', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_scroll]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_top_social_icons]', array(
		'default' => 0,
		'sanitize_callback' => 'arise_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_top_social_icons]', array(
		'priority'=>43,
		'label' => __('Disable Top Social Icons', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_top_social_icons]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_buttom_social_icons]', array(
		'default' => 0,
		'sanitize_callback' => 'arise_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_buttom_social_icons]', array(
		'priority'=>46,
		'label' => __('Disable Buttom Social Icons', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_buttom_social_icons]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_display_page_featured_image]', array(
		'default' => 0,
		'sanitize_callback' => 'arise_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_display_page_featured_image]', array(
		'priority'=>48,
		'label' => __('Display Page Featured Image', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_display_page_featured_image]',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_reset_all]', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'arise_reset_alls',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_reset_all]', array(
		'priority'=>50,
		'label' => __('Reset all default settings. (Refresh it to view the effect)', 'arise'),
		'section' => 'arise_custom_header',
		'settings' => 'arise_theme_options[arise_reset_all]',
		'type' => 'checkbox',
	));
	$wp_customize->add_section( 'arise_custom_css', array(
		'title' => __('Enter your custom CSS', 'arise'),
		'priority' => 507,
		'panel' => 'arise_options_panel'
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_custom_css]', array(
		'default' => '',
		'sanitize_callback' => 'arise_sanitize_custom_css',
		'type' => 'option',
		)
	);
	$wp_customize->add_control( 'arise_theme_options[arise_custom_css]', array(
		'label' => __('Custom CSS','arise'),
		'section' => 'arise_custom_css',
		'settings' => 'arise_theme_options[arise_custom_css]',
		'type' => 'textarea'
		)
	);
/********************** ARISE WORDPRESS DEFAULT PANEL ***********************************/
	$wp_customize->add_section('colors', array(
	'title' => __('Colors', 'arise'),
	'priority' => 30,
	'panel' => 'arise_wordpress_default_panel'
	));
	$wp_customize->add_section('background_image', array(
	'title' => __('Background Image', 'arise'),
	'priority' => 40,
	'panel' => 'arise_wordpress_default_panel'
	));
	$wp_customize->add_section('nav', array(
	'title' => __('Navigation', 'arise'),
	'priority' => 50,
	'panel' => 'arise_wordpress_default_panel'
	));
	$wp_customize->add_section('static_front_page', array(
	'title' => __('Static Front Page', 'arise'),
	'priority' => 60,
	'panel' => 'arise_wordpress_default_panel'
	));