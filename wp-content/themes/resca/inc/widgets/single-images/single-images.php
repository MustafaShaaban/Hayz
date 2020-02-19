<?php
class Single_Images_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'single-images',
			__( 'Thim: Single Images', 'resca' ),
			array(
				'description' => __( 'Add heading text', 'resca' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'image' => array(
					'type'  => 'media',
 					'label' => __( 'Image', 'resca' ),
					'description'  => __( 'Select image from media library.', 'resca' )
				),

				'image_size'         => array(
					'type'    => 'text',
					'label'   => __( 'Image size', 'resca' ),
 					'description'    => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'resca' )
				),
				'image_link'         => array(
					'type'    => 'text',
					'label'   => __( 'Image Link', 'resca' ),
					'description'    => __( 'Enter URL if you want this image to have a link.', 'resca' )
				),
				'link_target'       => array(
					"type"    => "select",
					"label"   => __( "Link Target", "resca" ),
 					"options" => array(
						"_self"              => __( "Same window", "resca" ),
						"_blank" => __( "New window", "resca" ),
 					),
				),
				'image_alignment'       => array(
					"type"    => "select",
					"label"   => __( "Image alignment", "resca" ),
					"description"=>"Select image alignment.",
					"options" => array(
						"left"              => __( "Align Left", "resca" ),
						"right" => __( "Align Right", "resca" ),
						"center" => __( "Align Center", "resca" )
					),
				),
				'image_parallax'         => array(
					'type'    => 'checkbox',
					'label'   => __( 'Images Parallax', 'resca' ),
 				),
				'css_animation'       => array(
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
			TP_THEME_DIR . 'inc/widgets/single-images/'
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
function thim_single_images_register_widget() {
	register_widget( 'Single_Images_Widget' );
}

add_action( 'widgets_init', 'thim_single_images_register_widget' );