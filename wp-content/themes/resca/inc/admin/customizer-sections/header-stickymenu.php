<?php

// header Options
$header->addSubSection( array(
	'name'     => __( 'Sticky Menu', 'resca' ),
	'id'       => 'display_header_menu',
	'position' => 14,
) );

$header->createOption( array(
	'name' => __( 'Sticky Menu on scroll', 'resca' ),
	'desc' => __( 'Check to enable a fixed header when scrolling, uncheck to disable.', 'resca' ),
	'id'   => 'header_sticky',
	'type' => 'checkbox'
) );

$header->createOption( array(
	'name'    => __( 'Config Sticky Menu?', 'resca' ),
	'desc'    => '',
	'id'      => 'config_att_sticky',
	'options' => array( 'sticky_same'   => 'The same with main menu',
						'sticky_custom' => 'Custom'
	),
	'type'    => 'select'
) );

$header->createOption( array(
	'name'    => __( 'Sticky Background color', 'resca' ),
	'desc'    => __( 'Pick a background color for main menu', 'resca' ),
	'id'      => 'sticky_bg_main_menu_color',
	'default' => '#222222',
	'type'    => 'color-opacity'
) );

$header->createOption( array(
	'name'    => __( 'Text color', 'resca' ),
	'desc'    => __( 'Pick a text color for main menu', 'resca' ),
	'id'      => 'sticky_main_menu_text_color',
	'default' => '#fff',
	'type'    => 'color-opacity'
) );

$header->createOption( array(
	'name'    => __( 'Text Hover color', 'resca' ),
	'desc'    => __( 'Pick a text hover color for main menu', 'resca' ),
	'id'      => 'sticky_main_menu_text_hover_color',
	'default' => '#01b888',
	'type'    => 'color-opacity'
) );