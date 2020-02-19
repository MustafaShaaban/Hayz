<?php

// main menu

$header->addSubSection( array(
	'name'     => __( 'Mobile Menu', 'resca' ),
	'id'       => 'display_mobile_menu',
	'position' => 15,
) );


$header->createOption( array(
	"name"    => __( "Background color", "resca" ),
	"desc"    => "Pick a background color for main menu",
	"id"      => "bg_mobile_menu_color",
	"default" => "#fff",
	"type"    => "color-opacity"
) );


$header->createOption( array(
	"name"    => __( "Text color", "resca" ),
	"desc"    => __( "Pick a text color for main menu", "resca" ),
	"id"      => "mobile_menu_text_color",
	"default" => "#0e2a36",
	"type"    => "color-opacity"
) );


$header->createOption( array(
	"name"    => __( "Text Hover color", "resca" ),
	"desc"    => __( "Pick a text hover color for main menu", "resca" ),
	"id"      => "mobile_menu_text_hover_color",
	"default" => "#01b888",
	"type"    => "color-opacity"
) );