<?php

$footer->addSubSection( array(
	'name'     => __( 'Footer', 'resca' ),
	'id'       => 'display_footer',
	'position' => 10,
) );

$footer->createOption( array(
	'name'    => __( 'Background footer images', 'resca' ),
	'id'      => 'footer_background_img',
	'type'    => 'upload',
	'desc'    => __( 'Upload your background', 'resca' ),
) );
$footer->createOption( array(
	'name'        => 'Text Color',
	'id'          => 'footer_text_font_color',
	'type'        => 'color-opacity',
	'default'     => '#fff',
) );

$footer->createOption( array(
	'name'        => 'Background Color',
	'id'          => 'footer_bg_color',
	'type'        => 'color-opacity',
	'default'     => '#181818',
	'livepreview' => '$("footer#colophon .footer").css("background-color", value);'
) );
