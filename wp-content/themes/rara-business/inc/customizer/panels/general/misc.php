<?php
/**
 * Misc Section
 *
 * @package Rara_Business
 */

if ( ! function_exists( 'rara_business_customize_register_misc_section' ) ) :
    /**
     * Add social media section controls
     */
    function rara_business_customize_register_misc_section( $wp_customize ) {
        /** Load default theme options */
        $default_options =  rara_business_default_theme_options();

        /** Misc Settings */
        $wp_customize->add_section(
            'misc_settings',
            array(
                'title'    => __( 'Misc Settings', 'rara-business' ),
                'priority' => 50,
                'panel'    => 'general_settings_panel',
            )
        );

        /** Show Animation */
        $wp_customize->add_setting( 
            'ed_animation', 
            array(
                'default'           => $default_options['ed_animation'],
                'sanitize_callback' => 'rara_business_sanitize_checkbox'
            ) 
        );
        
        $wp_customize->add_control(
    		new Rara_Business_Toggle_Control( 
    			$wp_customize,
    			'ed_animation',
    			array(
    				'section'     => 'misc_settings',
    				'label'	      => __( 'Enable Animation', 'rara-business' ),
                    'description' => __( 'Enable/Disable Animation on the theme', 'rara-business' ),
    			)
    		)
    	);
        
        /** Misc Settings Ends */
    }
endif;
add_action( 'customize_register', 'rara_business_customize_register_misc_section' );
