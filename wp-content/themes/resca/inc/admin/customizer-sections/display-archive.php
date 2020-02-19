<?php
/*
 * Post and Page Display Settings
 */
$display->addSubSection( array(
	'name'     => 'Archive',
	'id'       => 'display_archive',
	'position' => 2,
) );


$display->createOption( array(
	'name'    => 'Archive Layout',
	'id'      => 'archive_cate_layout',
	'type'    => 'radio-image',
	'options' => array(
		'full-content'  => $url . 'body-full.png',
		'sidebar-left'  => $url . 'sidebar-left.png',
		'sidebar-right' => $url . 'sidebar-right.png'
	),
	'default' => 'sidebar-left'
) );

$display->createOption( array(
	'name'    => 'Hide Title',
	'id'      => 'archive_cate_hide_title',
	'type'    => 'checkbox',
	"desc"    => "Check this box to hide/unhide title",
	'default' => false,
) );

$display->createOption( array(
	'name'        => 'Top Image',
	'id'          => 'archive_cate_top_image',
	'type'        => 'upload',
	'desc'        => 'Enter URL or Upload an top image file for header',
	'livepreview' => ''
) );

$display->createOption( array(
	'name'        => 'Background Heading Color',
	'id'          => 'archive_cate_heading_bg_color',
	'type'        => 'color-opacity',
	'livepreview' => ''
) );

$display->createOption( array(
	'name'    => 'Text Color Heading',
	'id'      => 'archive_cate_heading_text_color',
	'type'    => 'color-opacity',
	'default' => '#fff',
) );

$display->createOption( array(
	'name'    => __('sub Title','resca'),
	'id'      => 'archive_cate_sub_title',
	'type'    => 'text',
	'default' => '',
) );

$display->createOption( array(
	'name'    => 'Excerpt Length',
	'id'      => 'archive_excerpt_length',
	'type'    => 'number',
	"desc"    => "Enter the number of words you want to cut from the content to be the excerpt of search and archive and portfolio page.",
	'default' => '20',
	'max'     => '100',
	'min'     => '10',
) );


$display->createOption( array(
	'name'    => 'Show category',
	'id'      => 'show_category',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => true,
) );

$display->createOption( array(
	'name'    => 'Show Author',
	'id'      => 'show_author',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => true,
) );

$display->createOption( array(
	'name'    => 'Show Comment',
	'id'      => 'show_comment',
	'type'    => 'checkbox',
	"desc"    => "show/hidden",
	'default' => true,
) );
