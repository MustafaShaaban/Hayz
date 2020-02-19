<?php

class Thim_List_Post_Slider_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'list-post-slider',
			__( 'Thim: Display Posts Slider', 'resca' ),
			array(
				'description'   => __( 'Show Post', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),

			),
			array(),
			array(
				'title'        => array(
					'type'    => 'text',
					'label'   => __( 'Title', 'resca' ),
					'default' => __( "From Blog", "resca" )
				),
				'number_posts' => array(
					'type'    => 'number',
					'label'   => __( 'Number Post', 'resca' ),
					'default' => '4'
				),
				'orderby'      => array(
					"type"    => "select",
					"label"   => __( "Order by", "resca" ),
					"options" => array(
						"popular" => __( "Popular", "resca" ),
						"recent"  => __( "Recent", "resca" ),
						"title"   => __( "Title", "resca" ),
						"random"  => __( "Random", "resca" ),
					),
				),
				'order'        => array(
					"type"    => "select",
					"label"   => __( "Order by", "resca" ),
					"options" => array(
						"asc"  => __( "ASC", "resca" ),
						"desc" => __( "DESC", "resca" )
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/list-post-slider/'
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

function list_post_slider_register_widget() {
	register_widget( 'Thim_List_Post_Slider_Widget' );
}

add_action( 'widgets_init', 'list_post_slider_register_widget' );