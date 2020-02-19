<?php

class Gallery_Images_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'gallery-images',
			__( 'Thim: Gallery Images', 'resca' ),
			array(
				'description' => __( 'Add gallery image', 'resca' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'image'         => array(
					'type'        => 'multimedia',
					'label'       => __( 'Image', 'resca' ),
					'description' => __( 'Select image from media library.', 'resca' )
				),

				'image_size'    => array(
					'type'        => 'text',
					'label'       => __( 'Image size', 'resca' ),
					'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full"', 'resca' )
				),
				'image_link'    => array(
					'type'        => 'text',
					'label'       => __( 'Image Link', 'resca' ),
					'description' => __( 'Enter URL if you want this image to have a link. These links are separated by comma (Ex: #,#,#,#)', 'resca' )
				),
//				'number'        => array(
//					'type'    => 'number',
//					'default' => '4',
//					'label'   => __( 'Number Image Per View', 'resca' ),
//				),
				'link_target'   => array(
					"type"    => "select",
					"label"   => __( "Link Target", "resca" ),
					"options" => array(
						"_self"  => __( "Same window", "resca" ),
						"_blank" => __( "New window", "resca" ),
					),
				),
				'gallery_layout'   => array(
					"type"    => "select",
					"label"   => __( "Gallery Layout", "resca" ),
					"options" => array(
						"default"  => __( "Default", "resca" ),
						"slider" => __( "Slider", "resca" ),
					),
				),

				'css_animation' => array(
					"type"    => "select",
					"label"   => __( "CSS Animation", "resca" ),
					"options" => array(
						""              => __( "No", "resca" ),
						"top-to-bottom" => __( "Top to bottom", "resca" ),
						"bottom-to-top" => __( "Bottom to top", "resca" ),
						"left-to-right" => __( "Left to right", "resca" ),
						"right-to-left" => __( "Right to left", "resca" ),
						"appear"        => __( "Appear from center", "resca" )
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/gallery-images/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */


	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}
}


function thim_gallery_images_widget() {
	register_widget( 'Gallery_Images_Widget' );
}

add_action( 'widgets_init', 'thim_gallery_images_widget' );