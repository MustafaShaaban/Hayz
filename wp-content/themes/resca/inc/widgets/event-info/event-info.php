<?php
/**
 * Created by: Khoapq
 * Created Date: 17/02/2016
 */
class thim_event_info_widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'event-info',
			__( 'Thim: Event Info', 'resca' ),
			array(
				'description' => esc_html__( 'Display box info of event (only work in single event)', 'resca' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group'),
				'panels_icon'   => 'dashicons dashicons-info'
			),
			array(),
			array(

				'start_time'        	=> array(
					"type"    	=> "select",
					"label"   	=> esc_html__( "Display Start Time", 'resca' ),
					"options" 	=> array(
						"show"  	=> esc_html__( "Show", 'resca' ),
						"hidden" 	=> esc_html__( "Hidden", 'resca' )
					),
				),


				'finish_time'        	=> array(
					"type"    	=> "select",
					"label"   	=> esc_html__( "Display Finish Time", 'resca' ),
					"options" 	=> array(
						"show"  	=> esc_html__( "Show", 'resca' ),
						"hidden" 	=> esc_html__( "Hidden", 'resca' )
					),
				),


				'address'        	=> array(
					"type"    	=> "select",
					"label"   	=> esc_html__( "Display Address", 'resca' ),
					"options" 	=> array(
						"show"  	=> esc_html__( "Show", 'resca' ),
						"hidden" 	=> esc_html__( "Hidden", 'resca' )
					),
				),

			),
			TP_THEME_DIR . 'inc/widgets/event-info/'
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
function thim_event_info_widget_register() {
	register_widget( 'thim_event_info_widget' );
}

add_action( 'widgets_init', 'thim_event_info_widget_register' );