<?php
$url = TP_THEME_URI . 'images/admin/layout/';
$event = $titan->createThimCustomizerSection( array(
	'name'     => esc_html__('Event', 'resca'),
	'position' => 7,
	'id'       => 'event',
) );

$event->addSubSection( array(
	'name'     => esc_html__('Settings', 'resca'),
	'id'       => 'event_archive',
	'position' => 1,
) );


$event->createOption( array(
	'name'    => esc_html__('Events Layout','resca'),
	'id'      => 'event_layout',
	'type'    => 'radio-image',
	'options' => array(
		'full-content'  => $url . 'body-full.png',
		'sidebar-left'  => $url . 'sidebar-left.png',
		'sidebar-right' => $url . 'sidebar-right.png'
	),
	'default' => 'sidebar-right'
) );

$event->createOption( array(
	'name'        => esc_html__('Top Image','resca'),
	'id'          => 'event_top_image',
	'type'        => 'upload',
	'desc'        => esc_html__('Enter URL or Upload an top image file for header','resca'),
	'livepreview' => '',
	'default' => get_template_directory_uri( 'template_directory' ) . "/images/page_top_image.jpg",
) );

$event->createOption( array(
	'name'    => 'Hide Title',
	'id'      => 'event_hide_title',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide title",
	'default' => false,
) );

$event->createOption( array(
	'name'    => 'Custom Title',
	'id'      => 'event_custom_title',
	'type'    => 'text',
	'default' => '',
) );
$event->createOption( array(
	'name'    => __('sub Title','resca'),
	'id'      => 'event_sub_title',
	'type'    => 'text',
	'default' => '',
) );

$event->createOption( array(
	'name'    => esc_html__('Column', 'resca'),
	'id'      => 'event_column',
	'type'    => 'select',
	'options' => array(
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
	),
	'default' => '3'
) );

$event->createOption( array(
	'name'    => esc_html__('Number of Events per Page', 'resca'),
	'id'      => 'event_per_page',
	'type'    => 'number',
	'desc'    => esc_html__('Insert the number of posts to display per page.', 'resca'),
	'default' => '9',
	'max'     => '1000',
	'min'	  => '1',
) );

$event->createOption( array(
	'name'    => esc_html__( 'Facebook', 'resca' ),
	'id'      => 'event_sharing_facebook',
	'type'    => 'checkbox',
	"desc"    => esc_html__("Show the facebook sharing option in event.",'resca' ),
	'default' => true,
) );

$event->createOption( array(
	'name'    => esc_html__( 'Twitter', 'resca' ),
	'id'      => 'event_sharing_twitter',
	'type'    => 'checkbox',
	"desc"    => esc_html__("Show the twitter sharing option in event.",'resca' ),
	'default' => true,
) );


$event->createOption( array(
	'name'    => esc_html__( 'Google Plus', 'resca' ),
	'id'      => 'event_sharing_google',
	'type'    => 'checkbox',
	"desc"    => esc_html__("Show the g+ sharing option in event.",'resca' ),
	'default' => true,
) );

$event->createOption( array(
	'name'    => esc_html__( 'Pinterest', 'resca' ),
	'id'      => 'event_sharing_pinterest',
	'type'    => 'checkbox',
	"desc"    => esc_html__("Show the pinterest sharing option in event.",'resca' ),
	'default' => true,
) );

$event->createOption( array(
	'name'    => esc_html__( 'Fancy', 'resca' ),
	'id'      => 'event_sharing_fancy',
	'type'    => 'checkbox',
	"desc"    => esc_html__("Show the Fancy sharing option in event.",'resca' ),
	'default' => true,
) );