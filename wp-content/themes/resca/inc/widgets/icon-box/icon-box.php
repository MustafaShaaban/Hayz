<?php

class Icon_Box_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'icon-box',
			__( 'Thim: Icon Box', 'resca' ),
			array(
				'description'   => __( 'Add icon box', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
 			),
			array(),
			array(
				'sub-title'           => array(
					'type'  => 'text',
					'label' => __( 'Sub Title', 'resca' ),
				),
				'title_group'         => array(
					'type'   => 'section',
					'label'  => __( 'Title Options', 'resca' ),
					'hide'   => true,
					'fields' => array(
						'title'            => array(
							'type'                  => 'text',
							'label'                 => __( 'Title', 'resca' ),
							"default"               => "This is an icon box.",
							"description"           => __( "Provide the title for this icon box.", "resca" ),
							'allow_html_formatting' => true
						),
						'color_title'      => array(
							'type'  => 'color',
							'label' => __( 'Color Title', 'resca' ),
						),
						'size'             => array(
							"type"        => "select",
							"label"       => __( "Size Heading", "resca" ),
							"default"     => "h3",
							"options"     => array(
								"h2" => __( "h2", "resca" ),
								"h3" => __( "h3", "resca" ),
								"h4" => __( "h4", "resca" ),
								"h5" => __( "h5", "resca" ),
								"h6" => __( "h6", "resca" )
							),
							"description" => __( "Select size heading.", "resca" )
						),
						'font_heading'     => array(
							"type"          => "select",
							"label"         => __( "Font Heading", "resca" ),
							"options"       => array(
								"default" => __( "Default", "resca" ),
								"custom"  => __( "Custom", "resca" )
							),
							"description"   => __( "Select Font heading.", "resca" ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'custom_font_heading' )
							)
						),
						'custom_heading'   => array(
							'type'          => 'section',
							'label'         => __( 'Custom Heading Option', 'resca' ),
							'hide'          => true,
							'state_handler' => array(
								'custom_font_heading[custom]'  => array( 'show' ),
								'custom_font_heading[default]' => array( 'hide' ),
							),
							'fields'        => array(
								'custom_font_size'   => array(
									"type"        => "number",
									"label"       => __( "Font Size", "resca" ),
									"suffix"      => "px",
									"default"     => "14",
									"description" => __( "custom font size", "resca" ),
									"class"       => "color-mini"
								),
								'custom_font_weight' => array(
									"type"        => "select",
									"label"       => __( "Custom Font Weight", "resca" ),
									"class"       => "color-mini",
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
								'custom_mg_bt'       => array(
									"type"   => "number",
									"class"  => "color-mini",
									"label"  => __( "Margin Bottom Value", "aloxo" ),
									"value"  => 0,
									"suffix" => "px",
								),
							)
						),
						'line_after_title' => array(
							'type'  => 'checkbox',
							'label' => __( 'Show Separator', 'resca' ),
						),
					),
				),
				'desc_group'          => array(
					'type'   => 'section',
					'label'  => __( 'Description', 'resca' ),
					'hide'   => true,
					'fields' => array(
						'content'              => array(
							"type"                  => "textarea",
							"label"                 => __( "Add description", "resca" ),
							"default"               => "Write a short description, that will describe the title or something informational and useful.",
							"description"           => __( "Provide the description for this icon box.", "resca" ),
							'allow_html_formatting' => true
						),
						'custom_font_size_des' => array(
							"type"        => "number",
							"label"       => __( "Custom Font Size", "resca" ),
							"suffix"      => "px",
							"default"     => "",
							"description" => __( "custom font size", "resca" ),
							"class"       => "color-mini",
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
				'read_more_group'     => array(
					'type'   => 'section',
					'label'  => __( 'Link Icon Box', 'resca' ),
					'hide'   => true,
					'fields' => array(
						// Add link to existing content or to another resource
						'link'                   => array(
							"type"        => "text",
							"label"       => __( "Add Link", "resca" ),
							"description" => __( "Provide the link that will be applied to this icon box.", "resca" )
						),
						// Select link option - to box or with read more text
						'read_more'              => array(
							"type"          => "select",
							"label"         => __( "Apply link to:", "resca" ),
							"options"       => array(
								"complete_box" => "Complete Box",
								"title"        => "Box Title",
								"more"         => "Display Read More"
							),
							"description"   => __( "Select whether to use color for icon or not.", "resca" ),
							'state_emitter' => array(
								'callback' => 'select',
								'args'     => array( 'read_more_op' )
							)
						),
						// Link to traditional read more
						'button_read_more_group' => array(
							'type'          => 'section',
							'label'         => __( 'Option Button Read More', 'resca' ),
							'hide'          => true,
							'state_handler' => array(
								'read_more_op[more]'         => array( 'show' ),
								'read_more_op[complete_box]' => array( 'hide' ),
								'read_more_op[title]'        => array( 'hide' ),
							),
							'fields'        => array(
								'read_text'                  => array(
									"type"        => "text",
									"label"       => __( "Read More Text", "resca" ),
									"default"     => "Read More",
									"description" => __( "Customize the read more text.", "resca" ),
								),
								'read_more_text_color'       => array(
									"type"        => "color",
									"class"       => "",
									"label"       => __( "Text Color Read More", "resca" ),
									"description" => __( "Select whether to use text color for Read More Text or default.", "resca" ),
									"class"       => "color-mini",
								),
								'border_read_more_text'      => array(
									"type"        => "color",
									"label"       => __( "Border Color Read More Text:", "resca" ),
									"description" => __( "Select whether to use border color for Read More Text or none.", "resca" ),
									"class"       => "color-mini",
								),
								'bg_read_more_text'          => array(
									"type"        => "color",
									"class"       => "mini",
									"label"       => __( "Background Color Read More Text:", "resca" ),
									"description" => __( "Select whether to use background color for Read More Text or default.", "resca" ),
									"class"       => "color-mini",
								),
								'read_more_text_color_hover' => array(
									"type"        => "color",
									"class"       => "",
									"label"       => __( "Text Hover Color Read More", "resca" ),
									"description" => __( "Select whether to use text color for Read More Text or default.", "resca" ),
									"class"       => "color-mini",
								),

								'bg_read_more_text_hover'    => array(
									"type"        => "color",
									"label"       => __( "Background Hover Color Read More Text:", "resca" ),
									"description" => __( "Select whether to use background color when hover Read More Text or default.", "resca" ),
									"class"       => "color-mini",
								),

							)
						),
					),
				),
				// Play with icon selector
				'icon_type'           => array(
					"type"          => "select",
					"class"         => "",
					"label"         => __( "Icon to display:", "resca" ),
					"default"       => "font-awesome",
					"options"       => array(
						"font-awesome"  => "Font Awesome Icon",
						"font-7-stroke" => "Font 7 stroke Icon",
						"custom"        => "Custom Image Icon",
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'icon_type_op' )
					)
				),
				'font_7_stroke_group' => array(
					'type'          => 'section',
					'label'         => __( 'Font 7 Stroke Icon', 'resca' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'hide' ),
						'icon_type_op[custom]'        => array( 'hide' ),
						'icon_type_op[font-7-stroke]' => array( 'show' ),
					),
					'fields'        => array(
						'icon'      => array(
							"type"        => "icon-7-stroke",
							"class"       => "",
							"label"       => __( "Select Icon:", "resca" ),
							"description" => __( "Select the icon from the list.", "resca" ),
							"class_name"  => 'font-7-stroke',
						),
						// Resize the icon
						'icon_size' => array(
							"type"        => "number",
							"class"       => "",
							"label"       => __( "Icon Font Size ", "resca" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => __( "Select the icon font size.", "resca" ),
							"class_name"  => 'font-7-stroke'
						),
					),
				),
				'font_awesome_group'  => array(
					'type'          => 'section',
					'label'         => __( 'Font Awesome Icon', 'resca' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'show' ),
						'icon_type_op[custom]'        => array( 'hide' ),
						'icon_type_op[font-7-stroke]' => array( 'hide' ),
					),
					'fields'        => array(
						'icon'      => array(
							"type"        => "icon",
							"class"       => "",
							"label"       => __( "Select Icon:", "resca" ),
							"description" => __( "Select the icon from the list.", "resca" ),
							"class_name"  => 'font-awesome',
						),
						// Resize the icon
						'icon_size' => array(
							"type"        => "number",
							"class"       => "",
							"label"       => __( "Icon Font Size ", "resca" ),
							"suffix"      => "px",
							"default"     => "14",
							"description" => __( "Select the icon font size.", "resca" ),
							"class_name"  => 'font-awesome'
						),
					),
				),
				'font_image_group'    => array(
					'type'          => 'section',
					'label'         => __( 'Custom Image Icon', 'resca' ),
					'hide'          => true,
					'state_handler' => array(
						'icon_type_op[font-awesome]'  => array( 'hide' ),
						'icon_type_op[custom]'        => array( 'show' ),
						'icon_type_op[font-7-stroke]' => array( 'hide' ),
					),
					'fields'        => array(
						// Play with icon selector
						'icon_img' => array(
							"type"        => "media",
							"label"       => __( "Upload Image Icon:", "resca" ),
							"description" => __( "Upload the custom image icon.", "resca" ),
							"class_name"  => 'custom',
						),
					),
				),
				// // Resize the icon
				'width_icon_box'      => array(
					"type"    => "number",
					"class"   => "",
					"default" => "100",
					"label"   => __( "Width Box Icon", "resca" ),
					"suffix"  => "px",
				),
				'color_group'         => array(
					'type'   => 'section',
					'label'  => __( 'Color Options', 'resca' ),
					'hide'   => true,
					'fields' => array(
						// Customize Icon Color
						'icon_color'              => array(
							"type"        => "color",
							"class"       => "color-mini",
							"label"       => __( "Select Icon Color:", "resca" ),
							"description" => __( "Select the icon color.", "resca" ),
						),
						'icon_border_color'       => array(
							"type"        => "color",
							"label"       => __( "Icon Border Color:", "resca" ),
							"description" => __( "Select the color for icon border.", "resca" ),
							"class"       => "color-mini",
						),
						'icon_bg_color'           => array(
							"type"        => "color",
							"label"       => __( "Icon Background Color:", "resca" ),
							"description" => __( "Select the color for icon background.", "resca" ),
							"class"       => "color-mini",
						),
						'icon_hover_color'        => array(
							"type"        => "color",
							"label"       => __( "Hover Icon Color:", "resca" ),
							"description" => __( "Select the color hover for icon.", "resca" ),
							"class"       => "color-mini",
						),
						'icon_border_color_hover' => array(
							"type"        => "color",
							"label"       => __( "Hover Icon Border Color:", "resca" ),
							"description" => __( "Select the color hover for icon border.", "resca" ),
							"class"       => "color-mini",
						),
						// Give some background to icon
						'icon_bg_color_hover'     => array(
							"type"        => "color",
							"label"       => __( "Hover Icon Background Color:", "resca" ),
							"description" => __( "Select the color hover for icon background .", "resca" ),
							"class"       => "color-mini",
						),
					)
				),
				'layout_group'        => array(
					'type'   => 'section',
					'label'  => __( 'Layout Options', 'resca' ),
					'hide'   => true,
					'fields' => array(
						'box_icon_style' => array(
							"type"    => "select",
							"class"   => "",
							"label"   => __( "Icon Shape", "resca" ),
							"options" => array(
								""       => __( "None", "resca" ),
								"circle" => __( "Circle", "resca" ),
							),
							"std"     => "circle",
						),
						'pos'            => array(
							"type"        => "select",
							"class"       => "",
							"label"       => __( "Box Style:", "resca" ),
							"default"     => "top",
							"options"     => array(
								"left"  => "Icon at Left",
								"right" => "Icon at Right",
								"top"   => "Icon at Top"
							),
							"description" => __( "Select icon position. Icon box style will be changed according to the icon position.", "resca" ),
						),
						'text_align_sc'  => array(
							"type"    => "select",
							"class"   => "",
							"label"   => __( "Text Align Shortcode:", "resca" ),
							"options" => array(
								"text-left"   => "Text Left",
								"text-right"  => "Text Right",
								"text-center" => "Text Center"
							)
						),
					),
				),

				'widget_background'   => array(
					"type"          => "select",
					"label"         => __( "Widget Background", "resca" ),
					"default"       => "none",
					"options"       => array(
						"none"     => "None",
						"bg_video" => "Video Background",
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args'     => array( 'bg_video_style' )
					)
				),
				'self_video'          => array(
					'type'          => 'media',
					'fallback'      => true,
					'label'         => __( 'Select video', 'resca' ),
					'description'   => __( "Select an uploaded video in mp4 format. Other formats, such as webm and ogv will work in some browsers. You can use an online service such as <a href='http://video.online-convert.com/convert-to-mp4' target='_blank'>online-convert.com</a> to convert your videos to mp4.", "resca" ),
					'default'       => '',
					'library'       => 'video',
					'state_handler' => array(
						'bg_video_style[bg_video]' => array( 'show' ),
						'bg_video_style[none]'     => array( 'hide' ),
					)
				),
				'self_poster'         => array(
					'type'          => 'media',
					'label'         => __( 'Select cover image', 'resca' ),
					'default'       => '',
					'library'       => 'image',
					'state_handler' => array(
						'bg_video_style[bg_video]' => array( 'show' ),
						'bg_video_style[none]'     => array( 'hide' ),
					)
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
				)
			),
			TP_THEME_DIR . 'inc/widgets/icon-box/'
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

	function update($new_instance, $old_instance){
		$instance = parent::update($new_instance, $old_instance);
		//WMPL
		/**
		 * register strings for translation
		 */
		if( function_exists('wpml_register_single_string') )
		{
			do_action( 'wpml_register_single_string', 'Widgets', $this->get_field_id('title') , $instance['title_group']['title'] );
			do_action( 'wpml_register_single_string', 'Widgets', $this->get_field_id('sub-title') , $instance['sub-title'] );
			do_action( 'wpml_register_single_string', 'Widgets', $this->get_field_id('content') , $instance['desc_group']['content'] );
		}
		elseif( function_exists ( 'icl_register_string' ) )
		{
			icl_register_string( 'Widgets', $this->get_field_id('title') , $instance['title_group']['title'] );
			icl_register_string( 'Widgets', $this->get_field_id('sub-title') , $instance['sub-title'] );
			icl_register_string( 'Widgets', $this->get_field_id('content') , $instance['desc_group']['content'] );
		}
		//\WMPL
		return $instance;
	}
}

function icon_box_register_widget() {
	register_widget( 'Icon_Box_Widget' );
}

add_action( 'widgets_init', 'icon_box_register_widget' );
function icon_box_update_option(){
	if ( isset($_POST['delete_widget']) && $_POST['delete_widget'] ) {
		// Delete the settings for this instance of the widget
		if ( isset( $_POST['the-widget-id'] ) ) {
			$del_id = $_POST['the-widget-id'];
			icl_unregister_string ( 'Widgets', $del_id.'-title' );
			icl_unregister_string ( 'Widgets', $del_id.'-sub-title' );
			icl_unregister_string ( 'Widgets', $del_id.'-content' );
		}
	}
}
add_action('updated_option','icon_box_update_option');