<?php

class Event_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'event',
			__( 'Thim: Event', 'resca' ),
			array(
				'description'   => __( 'event', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'post_type' => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Select a post type', 'resca' ),
					'options' => array(
						'normal_post' => esc_html__( 'Normal Post', 'resca' ),
						'event'       => esc_html__( 'Event', 'resca' )
					),
					'default' => 'normal_post'
				),
				'number'    => array(
					'type'    => 'slider',
					'label'   => esc_html__( 'Number Post', 'resca' ),
					'min'     => '1',
					'max'     => '10',
					'default' => '3',
				),
				'order'     => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Order by', 'resca' ),
					'default' => 'desc',
					'options' => array(
						'asc'  => esc_html__( 'ASC', 'resca' ),
						'desc' => esc_html__( 'DESC', 'resca' )
					),
				),
				'orderby'   => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Order by', 'resca' ),
					'default' => 'time',
					'options' => array(
						'popular' => esc_html__( 'Popular', 'resca' ),
						'recent'  => esc_html__( 'Recent', 'resca' ),
						'title'   => esc_html__( 'Title', 'resca' ),
						'random'  => esc_html__( 'Random', 'resca' ),
						'time'    => esc_html__( 'Time', 'resca' ),
					),
				),

				'open_link' => array(
					'type'    => 'select',
					'label'   => esc_html__( 'Open link', 'resca' ),
					'default' => 'current_tab',
					'options' => array(
						'new_tab'     => esc_html__( 'New tab', 'resca' ),
						'current_tab' => esc_html__( 'Current tab', 'resca' ),
						'archive'     => esc_html__( 'Open page archive', 'resca' )
					)
				)
			),
			TP_THEME_DIR . 'inc/widgets/event/'
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

function thim_event_register_widget() {
	register_widget( 'Event_Widget' );
}

add_action( 'widgets_init', 'thim_event_register_widget' );