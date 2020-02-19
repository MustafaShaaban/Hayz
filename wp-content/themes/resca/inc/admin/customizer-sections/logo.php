<?php
/*
 * Creating a logo Options
 */
$logo = $titan->createThemeCustomizerSection( array(
	'name'     => __( 'Logo', 'resca' ),
	'position' => 1,
) );

$logo->createOption( array(
	'name'    => __( 'Header Logo', 'resca' ),
	'id'      => 'logo',
	'type'    => 'upload',
	'desc'    => __( 'Upload your logo', 'resca' ),
	'default' => get_template_directory_uri( 'template_directory' ) . "/images/logo.png",
) );

$logo->createOption( array(
	'name' => __( 'Sticky Logo', 'resca' ),
	'id'   => 'sticky_logo',
	'type' => 'upload',
	'desc' => __( 'Upload your sticky logo', 'resca' ),
) );

$logo->createOption( array(
	'name'    => __( 'Width Logo In The Desktop', 'resca' ),
	'id'      => 'width_logo',
	'type'    => 'number',
	'default' => '50',
	'max'     => '1024',
	'min'     => '0',
	'step'    => '1',
	'desc'    => 'width logo (px)'
) );

$logo->createOption( array(
	'name'  => __( 'Width Logo In The Mobile', 'resca' ),
	'id'    => 'width_logo_mobile',
	'type'  => 'number',
	'default' => '50',
	'max'   => '1024',
	'min'   => '0',
	'step'  => '1',
	'desc'  => 'width logo (px)'
) );

$logo->createOption( array(
	'name' => __( 'Favicon', 'resca' ),
	'id'   => 'favicon',
	'type' => 'upload',
	'desc' => __( 'Upload your favicon', 'resca' ),
) );
?>