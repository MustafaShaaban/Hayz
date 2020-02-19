<?php

class Thim_Menu_Details_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'menu-details',
			__( 'Thim: Menu Details', 'resca' ),
			array(
				'description' => __( 'View Menu Details.', 'resca' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),

			array(
				'image'           => array(
					'type'  => 'media',
					'label' => __( 'Image', 'resca' ),
				),
				'title_group'     => array(
					'type'   => 'section',
					'label'  => __( 'Title Options', 'resca' ),
					'hide'   => true,
					'fields' => array(
						'title'          => array(
							'type'                  => 'text',
							'label'                 => __( 'Title', 'resca' ),
							"default"               => "",
							"description"           => __( "Provide the title for this view menu.", "resca" ),
							'allow_html_formatting' => true,
						),
						'color_title'    => array(
							'type'  => 'color',
							'label' => __( 'Color Title', 'resca' ),
							"class" => "color-mini"
						),
						'size'           => array(
							"type"        => "select",
							"label"       => __( "Size Heading", "resca" ),
                            "default"        => "h6",
							"options"     => array(
								"h3" => __( "h3", "resca" ),
								"h2" => __( "h2", "resca" ),
								"h4" => __( "h4", "resca" ),
								"h5" => __( "h5", "resca" ),
								"h6" => __( "h6", "resca" )
							),
							"description" => __( "Select size heading.", "resca" )
						),
						'font_heading'   => array(
							"type"        => "select",
							"label"       => __( "Font Heading", "resca" ),
							"options"     => array(
								"default" => __( "Default", "resca" ),
								"custom"  => __( "Custom", "resca" )
							),
							"description" => __( "Select Font heading.", "resca" )
						),
						'custom_heading' => array(
							'type'   => 'section',
							'label'  => __( 'Custom Heading Option', 'resca' ),
							'hide'   => true,
							'fields' => array(
								'custom_font_size'   => array(
									"type"        => "number",
									"label"       => __( "Font Size", "resca" ),
									"suffix"      => "px",
									"default"     => "18",
									"description" => __( "custom font size", "resca" ),
									"class"       => "color-mini"
								),
								'custom_font_weight' => array(
									"type"        => "select",
									"label"       => __( "Custom Font Weight", "resca" ),
									"class"       => "color-mini",
                                    "default"     => "700",
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
								),
                                'custom_text_transform' => array(
                                    "type"        => "select",
                                    "label"       => __( "Custom Text-transform", "resca" ),
                                    "class"       => "color-mini",
                                    "default"     => "uppercase",
                                    "options"     => array(
                                        "none" => __( "None", "resca" ),
                                        "capitalize"   => __( "Capitalize", "resca" ),
                                        "uppercase"    => __( "Uppercase", "resca" ),
                                        "lowercase"    => __( "Lowercase", "resca" ),
                                        "inherit"    => __( "Inherit", "resca" ),
                                    ),
                                    "description" => __( "Select Custom Text-transform", "resca" ),
                                ),
								'custom_mg_bt'       => array(
									"type"   => "number",
									"class"  => "color-mini",
									"label"  => __( "Margin Bottom Value", "resca" ),
									"value"  => 0,
									"suffix" => "px",
								),
							)
						),
					),
				),

                'icon_image' => array(
                    'label'  => __( 'Icon Image', 'resca' ),
                    'type' => 'media',
                    'name' => __( 'Upload Icon', 'resca' ),
                ),

                'show_icon'                => array(
                    'type'    => 'checkbox',
                    'label'   => __( 'Show Icon Image', 'resca' ),
                    'default' => true
                ),

				'desc_group'      => array(
					'type'   => 'section',
					'label'  => __( 'Description', 'resca' ),
					'hide'   => true,
					'fields' => array(
						'content'              => array(
							"type"                  => "textarea",
							"label"                 => __( "Add description", "resca" ),
							"default"               => "",
							"description"           => __( "Provide the description for this icon box.", "resca" ),
							'allow_html_formatting' => true
						),
						'custom_font_size_des' => array(
							"type"        => "number",
							"label"       => __( "Custom Font Size", "resca" ),
							"suffix"      => "px",
							"default"     => "13",
							"description" => __( "custom font size", "resca" ),
							"class"       => "color-mini",
						),
						'margin_bottom'        => array(
							'type'   => 'number',
							'label'  => __( 'Margin Bottom: ', 'resca' ),
							"suffix" => "px",
							"class"  => "color-mini",
						),
						'custom_font_weight'   => array(
							"type"        => "select",
							"label"       => __( "Custom Font Weight", "resca" ),
							"class"       => "color-mini",
							"options"     => array(
								""     => __( "Normal", "resca" ),
								"bold" => __( "Bold", "resca" ),
								"100"  => __( "100", "resca" ),
								"200"  => __( "200", "resca" ),
								"300"  => __( "300", "resca" ),
								"400"  => __( "400", "resca" ),
								"500"  => __( "500", "resca" ),
								"600"  => __( "600", "resca" ),
								"700"  => __( "700", "resca" ),
								"800"  => __( "800", "resca" ),
								"900"  => __( "900", "resca" )
							),
							"description" => __( "Select Custom Font Weight", "resca" ),
						),
						'color_description'    => array(
							"type"  => "color",
							"label" => __( "Color Description", "resca" ),
							"class" => "color-mini",
						),
					),
				),

				'read_more_group' => array(
					'type'   => 'section',
					'label'  => __( 'Link Read More', 'resca' ),
					'hide'   => true,
					'fields' => array(

						'link'                         => array(
							"type"        => "text",
							"label"       => __( "Add Link", "resca" ),
							"description" => __( "Provide the link that will be applied to this view menu.", "resca" )
						),
						'read_text'                    => array(
							"type"                  => "text",
							"label"                 => __( "Read More Text", "resca" ),
							"default"               => "Read More",
							"description"           => __( "Customize the read more text.", "resca" ),
							'allow_html_formatting' => true,
						),

						'read_more_font_size'          => array(
							"type"        => "number",
							"label"       => __( "Font Size Read More Text: ", "resca" ),
							"suffix"      => "px",
							"description" => __( "custom font size", "resca" ),
							"class"       => "mini",
						),
						'read_more_font_weight'        => array(
							"type"    => "select",
							"label"   => __( "Font Weight Read More Text: ", "resca" ),
							"options" => array(
								""     => __( "Normal", "resca" ),
								"bold" => __( "Bold", "resca" ),
								"100"  => __( "100", "resca" ),
								"200"  => __( "200", "resca" ),
								"300"  => __( "300", "resca" ),
								"400"  => __( "400", "resca" ),
								"500"  => __( "500", "resca" ),
								"600"  => __( "600", "resca" ),
								"700"  => __( "700", "resca" ),
								"800"  => __( "800", "resca" ),
								"900"  => __( "900", "resca" )
							),
						),
						'border_read_more_color'       => array(
							"type"  => "color",
							"class" => "color-mini",
							"label" => __( "Border Color Read More Text:", "resca" ),
						),

						'bg_read_more_text'            => array(
							"type"  => "color",
							"class" => "mini",
							"label" => __( "Background Color Read More Text:", "resca" ),
							"class" => "color-mini",
						),

						'read_more_text_color'         => array(
							"type"    => "color",
							"class"   => "",
							"label"   => __( "Text Color Read More Text:", "resca" ),
							"default" => "#fff",
							"class"   => "color-mini",
						),

					),
				),

                'text_align_sc'   => array(
                    "type"    => "select",
                    "class"   => "",
                    "label"   => __( "Text Align:", "resca" ),
                    "default" => 'text-center',
                    "options" => array(
                        "text-left"   => "Text Left",
                        "text-right"  => "Text Right",
                        "text-center" => "Text Center"
                    )
                ),

			),
			TP_THEME_DIR . 'inc/widgets/menu-details/'
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



function thim_menu_details_register_widget() {
	register_widget( 'Thim_Menu_Details_Widget' );
}

add_action( 'widgets_init', 'thim_menu_details_register_widget' );