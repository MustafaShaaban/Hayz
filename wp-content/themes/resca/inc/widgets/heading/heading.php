<?php

class Heading_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'heading',
			__( 'Thim: Heading', 'resca' ),
			array(
				'description'   => __( 'Add heading text', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'sub-title'           => array(
					'type'    => 'text',
					'label'   => __( 'Sub Heading', 'resca' ),
					'default' => ''
				),
				'title'               => array(
					'type'    => 'text',
					'label'   => __( 'Heading Text', 'resca' ),
					'default' => __( "Default value", "resca" )
				),
				'line'                => array(
					'type'    => 'checkbox',
					'label'   => __( 'Show Separator', 'resca' ),
					'default' => false
				),
				'textcolor'           => array(
					'type'    => 'color',
					'label'   => __( 'Text Heading color', 'resca' ),
					'default' => '',
				),
				'size'                => array(
					"type"    => "select",
					"label"   => __( "Size Heading", "resca" ),
					"options" => array(
						"h2" => __( "h2", "resca" ),
						"h3" => __( "h3", "resca" ),
						"h4" => __( "h4", "resca" ),
						"h5" => __( "h5", "resca" ),
						"h6" => __( "h6", "resca" )
					),
					"default" => "h3"
				),
				'font_heading'        => array(
					"type"          => "select",
					"label"         => __( "Font Heading", "resca" ),
					"default"       => "default",
					"options"       => array(
						"default" => __( "Default", "resca" ),
						"custom"  => __( "Custom", "resca" )
					),
					"description"   => __( "Select Font heading.", "resca" ),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'font_heading_type' )
					)
				),
				'custom_font_heading' => array(
					'type'          => 'section',
					'label'         => __( 'Custom Font Heading', 'resca' ),
					'hide'          => true,
					'state_handler' => array(
						'font_heading_type[custom]'  => array( 'show' ),
						'font_heading_type[default]' => array( 'hide' ),
					),
					'fields'        => array(
						'custom_font_size'   => array(
							"type"        => "number",
							"label"       => __( "Font Size", "resca" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => __( "custom font size", "resca" ),
							"class"       => "color-mini",
						),
						'custom_font_weight' => array(
							"type"        => "select",
							"label"       => __( "Custom Font Weight", "resca" ),
							"options"     => array(
								"normal" => __( "Normal", "resca" ),
								"bold"   => __( "Bold", "resca" ),
								"100"    => __( "100", "resca" ),
								"200"    => __( "200", "resca" ),
								"300"    => __( "300", "resca" ),
								"400"    => __( "400", "resca" ),
								"500"    => __( "500", "resca" ),
								"600"    => __( "600", "resca" ),
								"700"    => __( "700", "resca" ),
								"800"    => __( "800", "resca" ),
								"900"    => __( "900", "resca" )
							),
							"description" => __( "Select Custom Font Weight", "resca" ),
							"class"       => "color-mini",
						),
						'custom_font_style'  => array(
							"type"        => "select",
							"label"       => __( "Custom Font Style", "resca" ),
							"options"     => array(
								"inherit" => __( "inherit", "resca" ),
								"initial" => __( "initial", "resca" ),
								"italic"  => __( "italic", "resca" ),
								"normal"  => __( "normal", "resca" ),
								"oblique" => __( "oblique", "resca" )
							),
							"description" => __( "Select Custom Font Style", "resca" ),
							"class"       => "color-mini",
						),
					),
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
			TP_THEME_DIR . 'inc/widgets/heading/'
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

function thim_heading_register_widget() {
	register_widget( 'Heading_Widget' );
}

add_action( 'widgets_init', 'thim_heading_register_widget' );