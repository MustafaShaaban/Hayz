<?php

$styling->addSubSection( array(
	'name'     => 'Theme Support',
	'id'       => 'styling_theme_support',
	'position' => 14,
) );

$styling->createOption( array(
	'name'    => 'Preload',
	'id'      => 'preload',
	'type'    => 'checkbox',
	"desc"    => "Enable/Disable",
	'default' => false,
) );

$styling->createOption( array(
		'name'        => 'Custom Preload Image',
		'id'          => 'custom_preload_image',
		'type'        => 'upload',
		'desc'        => 'Upload an preload image.',
		'livepreview' => ''
	)
);

$styling->createOption(array(
	'name' => 'Custom Preload Title',
	'id'          => 'custom_preload_title',
	'type'        => 'text',
	'desc'        => '',
));

$styling->createOption( array(
	'name'    => 'RTL Support',
	'id'      => 'rtl_support',
	'type'    => 'checkbox',
	"desc"    => "Enable/Disable",
	'default' => false,
) );
