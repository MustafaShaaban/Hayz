<?php
class Empty_Space_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'empty-space',
			__( 'Thim: Empty Space', 'resca' ),
			array(
				'description' => __( 'Add space width custom height', 'resca' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'height' => array(
					'type'  => 'number',
					'label' => __( 'Height', 'resca' ),
					'default'=>'30',
					'desc'  => __( "Enter empty space height.", "resca" ),
					'suffix'     => 'px',
				)
  			),
			TP_THEME_DIR . 'inc/widgets/empty-space/'
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
function thim_empty_space_register_widget() {
	register_widget( 'Empty_Space_Widget' );
}

add_action( 'widgets_init', 'thim_empty_space_register_widget' );