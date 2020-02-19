<?php

$header->addSubSection( array(
	'name'     =>  __('Drawer','resca'),
	'id'       => 'display_right_header',
	'position' => 2,
) );

$header->createOption( array(
	'name'    => __( 'Show or Hide Drawer', 'resca' ),
	'id'      => 'show_drawer',
	'type'    => 'checkbox',
	"desc"    => "show/hide",
	'default' => false,
	'livepreview' => '
		if(value == false){
			$("#rt-drawer").css("display", "none");
		}else{
			$("#rt-drawer").css("display", "block");
		}
	'
) );

$header->createOption( array(
	'name'        => __( 'Drawer Background color', 'resca' ),
	'id'          => 'bg_drawer_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$("#rt-drawer").css("background-color", value);'
) );

$header->createOption( array(
	'name'        => __( 'Drawer Text color', 'resca' ),
	'id'          => 'drawer_text_color',
	'type'        => 'color-opacity',
	'default'     => '#ffffff',
	'livepreview' => '$("#rt-drawer a,#rt-drawer,#rt-drawer .widget-title").css("color", value)'
) );

$header->createOption( array(
	'name'    => __( 'Drawer Style', 'resca' ),
	'id'      => 'drawer_style',
	'type'    => 'radio-image',
	'options' => array(
		"style1" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/drawer_1.jpg",
		"style2" => get_template_directory_uri( 'template_directory' ) . "/images/patterns/drawer_2.jpg",
	),
	'livepreview' => '
		if(value == "style1"){
			$("#rt-drawer").addClass("style1");
			$("#rt-drawer").removeClass("style2");
		}else{
			$("#rt-drawer").addClass("style2");
			$("#rt-drawer").removeClass("style1");
		}
	'
) );

$header->createOption( array(
	'name'    => __( 'Drawer Open or Close', 'resca' ),
	'id'      => 'drawer_open',
	'type'    => 'checkbox',
	"desc"    => "open/close",
	'livepreview' => '
		if(value == false){
			$("#collapseDrawer").css("height", "0");
			$("#collapseDrawer").removeClass("in");
		}else{
			$("#collapseDrawer").css("height", "auto");
			$("#collapseDrawer").addClass("in");
		}
	'
) );
