<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/******************** ARISE LAYOUT OPTIONS ******************************************/
	$wp_customize->add_section('arise_layout_options', array(
		'title' => __('Layout Options', 'arise'),
		'priority' => 102,
		'panel' => 'arise_options_panel'
	));
		$wp_customize->add_setting('arise_theme_options[arise_responsive]', array(
		'default' => 'on',
		'sanitize_callback' => 'arise_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('arise_theme_options[arise_responsive]', array(
		'priority' =>10,
		'label' => __('Responsive Layout', 'arise'),
		'section' => 'arise_layout_options',
		'settings' => 'arise_theme_options[arise_responsive]',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'on' => __('ON ','arise'),
			'off' => __('OFF','arise'),
		),
	));
	$wp_customize->add_setting('arise_theme_options[arise_sidebar_layout_options]', array(
		'default' => 'right',
		'sanitize_callback' => 'arise_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('arise_theme_options[arise_sidebar_layout_options]', array(
		'priority' =>20,
		'label' => __('Sidebar Layout Options', 'arise'),
		'section' => 'arise_layout_options',
		'settings' => 'arise_theme_options[arise_sidebar_layout_options]',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'right' => __('Right Sidebar','arise'),
			'left' => __('Left Sidebar','arise'),
			'nosidebar' => __('No Sidebar','arise'),
			'fullwidth' => __('Full Width','arise'),
		),
	));
	$wp_customize->add_setting('arise_theme_options[arise_blog_layout_temp]', array(
		'default' => 'large_image_display',
		'sanitize_callback' => 'arise_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control('arise_theme_options[arise_blog_layout_temp]', array(
		'priority' =>30,
		'label' => __('Blog Image Display Layout', 'arise'),
		'section'    => 'arise_layout_options',
		'settings'	=> 'arise_theme_options[arise_blog_layout_temp]',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'large_image_display' => __('Blog large image display','arise'),
			'medium_image_display' => __('Blog medium image display','arise'),
		),
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_entry_format_blog]', array(
		'default' => 'show',
		'sanitize_callback' => 'arise_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_entry_format_blog]', array(
		'priority'=>40,
		'label' => __('Disable Entry Format from Blog Page', 'arise'),
		'section' => 'arise_layout_options',
		'settings' => 'arise_theme_options[arise_entry_format_blog]',
		'type' => 'select',
		'choices' => array(
		'show' => __('Display Entry Format','arise'),
		'hide' => __('Hide Entry Format','arise'),
		'show-button' => __('Show Button Only','arise'),
		'hide-button' => __('Hide Button Only','arise'),
	),
	));
	$wp_customize->add_setting( 'arise_theme_options[arise_entry_meta_blog]', array(
		'default' => 'show-meta',
		'sanitize_callback' => 'arise_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'arise_theme_options[arise_entry_meta_blog]', array(
		'priority'=>45,
		'label' => __('Disable Entry Meta from Blog Page', 'arise'),
		'section' => 'arise_layout_options',
		'settings' => 'arise_theme_options[arise_entry_meta_blog]',
		'type' => 'select',
		'choices' => array(
		'show-meta' => __('Display Entry Meta','arise'),
		'hide-meta' => __('Hide Entry Meta','arise'),
	),
	));
	$wp_customize->add_setting('arise_theme_options[arise_design_layout]', array(
		'default'        => 'on',
		'sanitize_callback' => 'arise_sanitize_select',
		'type'                  => 'option',
	));
	$wp_customize->add_control('arise_theme_options[arise_design_layout]', array(
	'priority'  =>50,
	'label'      => __('Design Layout', 'arise'),
	'section'    => 'arise_layout_options',
	'settings'  => 'arise_theme_options[arise_design_layout]',
	'type'       => 'select',
	'checked'   => 'checked',
	'choices'    => array(
		'wide-layout' => __('Full Width Layout','arise'),
		'boxed-layout' => __('Boxed Layout','arise'),
		'small-boxed-layout' => __('Small Boxed Layout','arise'),
	),
));