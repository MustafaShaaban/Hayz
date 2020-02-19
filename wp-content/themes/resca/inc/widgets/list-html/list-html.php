<?php
 class List_Html_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'list-html',
			__( 'Thim: List Html Two Columns', 'resca' ),
			array(
				'description' => __( 'Add html', 'resca' ),
				'help'        => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'list-html' => array(
					'type'      => 'repeater',
					'label'     => __( 'Text', 'resca' ),
					'item_name' => __( 'Text', 'resca' ),
					'fields'    => array(
						'title'   => array(
							"type"    => "text",
							"label"   => __( "Title", "resca" ),
							"default" => "Title",
						),
						'content' => array(
							"type"  => "textarea",
							"label" => __( "Content", "resca" ),
							'allow_html_formatting' => true
						),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/list-html/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return 'basic';
	}
}


function thim_list_html_register_widget() {
	register_widget( 'List_Html_Widget' );
}

add_action( 'widgets_init', 'thim_list_html_register_widget' );