<?php

// Right Drawer Options
$header->addSubSection( array(
	'name'     =>  __('Offcanvas Sidebar','resca'),
	'id'       => 'display_right_drawer',
	'position' => 16,
) );


$header->createOption( array(
	'name'    => __( 'Show or Hide', 'resca' ),
	'id'      => 'show_offcanvas_sidebar',
	'type'    => 'checkbox',
	"desc"    => "show/hide",
	'default' => false,
) );

$header->createOption( array(
	'name'        => __( 'Background color', 'resca' ),
	'id'          => 'bg_offcanvas_sidebar_color',
	'type'        => 'color-opacity',
	'default'     => '#141414',
	'livepreview' => '$(".slider_sidebar").css("background-color", value);'
) );

$header->createOption( array(
	'name'        => __( 'Text Color', 'resca' ),
	'id'          => 'offcanvas_sidebar_text_color',
	'type'        => 'color-opacity',
	'default'     => '#a9a9a9',
	'livepreview' => '$(".slider_sidebar,.slider_sidebar .widget-title,caption").css("color", value)'
) );

$header->createOption( array(
	'name'        => __( 'Link Color', 'resca' ),
	'id'          => 'offcanvas_sidebar_link_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$(".slider_sidebar a").css("color", value)'
) );

$header->createOption( array(
	'name'    => __( 'Icon', 'resca' ),
	'id'      => 'icon_offcanvas_sidebar',
	'type'    => 'text',
	'default' => 'fa-bars',
	"desc"    => "Enter <a href=\"http://fontawesome.io/icons/\" target=\"_blank\" >FontAwesome</a> icon name. For example: fa-bars, fa-user",
) );

