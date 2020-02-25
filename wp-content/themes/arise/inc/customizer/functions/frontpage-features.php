<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/******************** ARISE FRONTPAGE SERVICES *********************************************/
$arise_settings = arise_get_theme_options();
$wp_customize->add_section( 'arise_frontpage_features', array(
	'title' => __('Display FrontPage Features','arise'),
	'priority' => 400,
	'panel' =>'arise_options_panel'
));
$wp_customize->add_setting( 'arise_theme_options[arise_disable_features]', array(
	'default' => 0,
	'sanitize_callback' => 'arise_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'arise_theme_options[arise_disable_features]', array(
	'priority' => 405,
	'label' => __('Disable in Front Page', 'arise'),
	'section' => 'arise_frontpage_features',
	'settings' => 'arise_theme_options[arise_disable_features]',
	'type' => 'checkbox',
));
$wp_customize->add_setting( 'arise_theme_options[arise_features_title]', array(
	'default' => '',
	'sanitize_callback' => 'sanitize_textarea_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'arise_theme_options[arise_features_title]', array(
	'priority' => 412,
	'label' => __( 'Title', 'arise' ),
	'section' => 'arise_frontpage_features',
	'settings' => 'arise_theme_options[arise_features_title]',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'arise_theme_options[arise_features_description]', array(
	'default' => '',
	'sanitize_callback' => 'sanitize_textarea_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'arise_theme_options[arise_features_description]', array(
	'priority' => 415,
	'label' => __( 'Description', 'arise' ),
	'section' => 'arise_frontpage_features',
	'settings' => 'arise_theme_options[arise_features_description]',
	'type' => 'textarea',
	)
);
for ( $i=1; $i <= $arise_settings['arise_total_features'] ; $i++ ) {
	$wp_customize->add_setting('arise_theme_options[arise_frontpage_features_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'arise_sanitize_page',
		'type' => 'option',
		'capability' => 'manage_options'
	));
	$wp_customize->add_control( 'arise_theme_options[arise_frontpage_features_'. $i .']', array(
		'priority' => 420 . $i,
		'label' => __(' Feature #', 'arise') . ' ' . $i ,
		'section' => 'arise_frontpage_features',
		'settings' => 'arise_theme_options[arise_frontpage_features_'. $i .']',
		'type' => 'dropdown-pages',
	));
}