<?php

class Otreservations_Widget extends Thim_Widget {

	function __construct() {
		parent::__construct(
			'otreservations',
			__( 'OpenTable Reservations', 'resca' ),
			array(
				'description'   => __( 'OpenTable Reservations', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'subtitle'   => array(
					'type'    => 'text',
					'label'   => 'SubTitle',
					'default' => 'Book a'
				),

				'title'      => array(
					'type'    => 'text',
					'label'   => 'Title',
					'default' => 'TABLE'
				),
				'desc'       => array(
					'type'                  => 'text',
					'label'                 => 'Description',
					'default'               => 'Opening Hour <b>8:00</b> AM - <b>10:00</b> PM, every day on week.',
					'allow_html_formatting' => true,
				),

				'rid'        => array(
					'type'    => 'text',
					'label'   => 'OpenTable Restaurant ID',
					'default' => '80221'
				),

				'domain_ext' => array(
					'type'    => 'select',
					'label'   => 'Country',
					'options' => array( 'com' => 'Global / U.S.', 'de' => 'Germany', 'co.uk' => 'United Kingdom', 'jp' => 'Japan', 'com.mx' => 'Mexico' )
				),

			),
			TP_THEME_DIR . 'inc/widgets/otreservations/'
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

function thim_otreservations_register_widget() {
	register_widget( 'Otreservations_Widget' );
}

add_action( 'widgets_init', 'thim_otreservations_register_widget' );