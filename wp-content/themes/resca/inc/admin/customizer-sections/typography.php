<?php

$typography = $titan->createThimCustomizerSection( array(
	'name'     => 'Typography',
	'position' => 7,
	'id'       => 'typography'
) );

$typography->addSubSection( array(
	'name'     => __( 'Body', 'resca' ),
	'id'       => 'typography_font_body',
	'position' => 1,
) );
$typography->createOption( array(
	'name'                => __( 'Select Font', 'resca' ),
	'id'                  => 'font_body',
	'type'                => 'font-color',
	'show_font_family'    => true,
	'show_font_weight'    => true,
	'show_font_style'     => false,
	'show_font_size'      => true,
	'show_line_height'    => true,
	'show_letter_spacing' => false,
	'show_text_transform' => false,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'default'             => array(
		'font-family'   => 'Aileron',
		'font-weight'   => 'normal',
		'color-opacity' => '#666666',
		'line-height'   => '1.6em',
		'font-size'     => '16px'
	)
) );
$typography->addSubSection( array(
	'name'     => __( 'Font Sub Title', 'resca' ),
	'id'       => 'typography_font_title',
	'position' => 2,
) );


$typography->createOption( array(
	'name'                => __( 'Select Font', 'resca' ),
	'id'                  => 'font_title',
	'type'                => 'font-color',
	'show_font_family'    => true,
	'show_color'          => false,
	'show_font_weight'    => false,
	'show_font_style'     => false,
	'show_font_size'      => false,
	'show_line_height'    => false,
	'show_letter_spacing' => false,
	'show_text_transform' => false,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'default'             => array(
		'font-family' => 'Pacifico',
	)
) );

$typography->addSubSection( array(
	'name'     => __( 'H1', 'resca' ),
	'id'       => 'typography_font_h1',
	'position' => 3,
) );
$typography->createOption( array(
	'name'                => __( 'Select Font', 'resca' ),
	'id'                  => 'font_h1',
	'type'                => 'font-color',
	'show_font_family'    => false,
	'show_font_weight'    => true,
	'show_font_style'     => true,
	'show_font_size'      => true,
	'show_line_height'    => true,
	'show_text_transform' => true,
	'show_letter_spacing' => false,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'default'             => array(
		'font-family'    => 'Aileron',
		'font-weight'    => '800',
		'color-opacity'  => '#2a2a2a',
		'font-style'     => 'normal',
		'line-height'    => '1.3em',
		'text-transform' => 'none',
		'font-size'      => '56px'
	)
) );

$typography->addSubSection( array(
	'name'     => __( 'H2', 'resca' ),
	'id'       => 'typography_font_h2',
	'position' => 4,
) );

$typography->createOption( array(
	'name'                => __( 'Select Font', 'resca' ),
	'id'                  => 'font_h2',
	'type'                => 'font-color',
	'show_font_family'    => false,
	'show_font_weight'    => true,
	'show_font_style'     => true,
	'show_font_size'      => true,
	'show_line_height'    => true,
	'show_letter_spacing' => false,
	'show_text_transform' => true,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'default'             => array(
		'font-family'    => 'Aileron',
		'font-weight'    => '800',
		'color-opacity'  => '#2a2a2a',
		'font-style'     => 'normal',
		'line-height'    => '1.6em',
		'text-transform' => 'none',
		'font-size'      => '54px'
	)
) );

$typography->addSubSection( array(
	'name'     => __( 'H3', 'resca' ),
	'id'       => 'typography_font_h3',
	'position' => 5,
) );

$typography->createOption( array(
	'name'                => __( 'Select Font', 'resca' ),
	'id'                  => 'font_h3',
	'type'                => 'font-color',
	'show_font_family'    => false,
	'show_font_size'      => true,
	'show_font_weight'    => true,
	'show_font_style'     => true,
	'show_line_height'    => true,
	'show_letter_spacing' => false,
	'show_text_transform' => true,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'default'             => array(
		'font-family'    => 'Aileron',
		'font-weight'    => 'normal',
		'color-opacity'  => '#333',
		'font-style'     => 'normal',
		'line-height'    => '1.6em',
		'text-transform' => 'none',
		'font-size'      => '34px'
	)
) );

$typography->addSubSection( array(
	'name'     => __( 'H4', 'resca' ),
	'id'       => 'typography_font_h4',
	'position' => 6,
) );

$typography->createOption( array(
	'name'                => __( 'Select Font', 'resca' ),
	'id'                  => 'font_h4',
	'type'                => 'font-color',
	'show_font_family'    => false,
	'show_font_size'      => true,
	'show_font_weight'    => true,
	'show_font_style'     => true,
	'show_line_height'    => true,
	'show_letter_spacing' => false,
	'show_text_transform' => true,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'default'             => array(
		'font-family'    => 'Aileron',
		'font-weight'    => 'normal',
		'color-opacity'  => '#2a2a2a',
		'font-style'     => 'normal',
		'line-height'    => '1.8em',
		'text-transform' => 'capitalize',
		'font-size'      => '30px'
	),
) );

$typography->addSubSection( array(
	'name'     => __( 'H5', 'resca' ),
	'id'       => 'typography_font_h5',
	'position' => 7,
) );

$typography->createOption( array(
	'name'                => __( 'Select Font', 'resca' ),
	'id'                  => 'font_h5',
	'type'                => 'font-color',
	'show_font_family'    => false,
	'show_font_weight'    => true,
	'show_font_style'     => true,
	'show_line_height'    => true,
	'show_font_size'      => true,
	'show_letter_spacing' => false,
	'show_text_transform' => true,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'default'             => array(
		'font-family'    => 'Aileron',
		'font-weight'    => 'normal',
		'color-opacity'  => '#2a2a2a',
		'font-style'     => 'normal',
		'line-height'    => '1.6em',
		'text-transform' => 'none',
		'font-size'      => '26px'
	)
) );

$typography->addSubSection( array(
	'name'     => __( 'H6', 'resca' ),
	'id'       => 'typography_font_h6',
	'position' => 8,
) );

$typography->createOption( array(
	'name'                => __( 'Select Font', 'resca' ),
	'id'                  => 'font_h6',
	'type'                => 'font-color',
	'show_font_family'    => false,
	'show_font_weight'    => true,
	'show_font_size'      => true,
	'show_font_style'     => true,
	'show_line_height'    => true,
	'show_letter_spacing' => false,
	'show_text_transform' => true,
	'show_font_variant'   => false,
	'show_text_shadow'    => false,
	'default'             => array(
		'font-family'    => 'Aileron',
		'font-weight'    => 'normal',
		'color-opacity'  => '#2a2a2a',
		'font-style'     => 'normal',
		'line-height'    => '1.4em',
		'text-transform' => 'none',
		'font-size'      => '20px'
	)
) );
