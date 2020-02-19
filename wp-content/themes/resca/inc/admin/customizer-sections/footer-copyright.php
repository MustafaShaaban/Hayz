<?php
$footer->addSubSection( array(
	'name'     => __( 'Copyright Options', 'resca' ),
	'id'       => 'display_copyright',
	'position' => 12,
) );

$footer->createOption( array(
	'name'    => __( 'Back To Top', 'resca' ),
	'id'      => 'show_to_top',
	'type'    => 'checkbox',
	'des'     => 'show or hide back to top',
	'default' => true,
) );

$footer->createOption( array(
	'name'        => __( 'Text Color', 'resca' ),
	'id'          => 'copyright_text_color',
	'type'        => 'color-opacity',
	'default'     => '#aaa',
	'livepreview' => '$("#powered").css("color", value);'
) );

$copy_right = 'http://www.thimpress.com';
$footer->createOption( array(
	'name'        => __( 'Copyright Text', 'resca' ),
	'id'          => 'copyright_text',
	'type'        => 'textarea',
	'default'     => 'Designed by <a href="' . $copy_right . '">ThimPress.</a>Powered by WordPress.',
	'livepreview' => '$("#powered").html(function(){return "<p>"+ value + "</p>";})'
) );