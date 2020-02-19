<?php

class Thim_Social_Widget extends Thim_Widget {

	function __construct() {

		parent::__construct(
			'social',
			__( 'Thim: Social Links', 'resca' ),
			array(
				'description' => __( 'Social Links', 'resca' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'title'          => array(
					'type'  => 'text',
					'label' => __( 'Title', 'resca' )
				),
				'link_face'      => array(
					'type'  => 'text',
					'label' => __( 'Facebook Url', 'resca' )
				),
				'link_twitter'   => array(
					'type'  => 'text',
					'label' => __( 'Twitter Url', 'resca' )
				),
				'link_google'    => array(
					'type'  => 'text',
					'label' => __( 'Google Url', 'resca' )
				),
				'link_dribble'   => array(
					'type'  => 'text',
					'label' => __( 'Dribble Url', 'resca' )
				),
				'link_linkedin'  => array(
					'type'  => 'text',
					'label' => __( 'Linked in Url', 'resca' )
				),
				'link_pinterest' => array(
					'type'  => 'text',
					'label' => __( 'Pinterest Url', 'resca' )
				),
				'link_digg'      => array(
					'type'  => 'text',
					'label' => __( 'Digg Url', 'resca' )
				),
				'link_youtube'   => array(
					'type'  => 'text',
					'label' => __( 'Youtube Url', 'resca' )
				),
				'link_tripadvisor'      => array(
					'type'  => 'text',
					'label' => __( 'Tripadvisor Url', 'resca' )
				),
                'link_instagram'    => array(
                    'type'  => 'text',
                    'label' => __( 'Instagram Url', 'neon' )
                ),
				'custom_links' => array(
					'type' => 'repeater',
					'label' => __( 'Custom Links' , 'resca' ),
					'item_name'  => __( 'Custom link', 'resca' ),
					'fields' => array(
						'url' => array(
							'type' => 'text',
							'label' => __( 'Url', 'resca' )
						),
						'icon' => array(
							'type' => 'text',
							'label' => __( 'Icon Class', 'resca' )
						),
					)
				),
				'link_target'    => array(
					"type"    => "select",
					"label"   => __( "Link Target", "resca" ),
					"options" => array(
						"_self"  => __( "Same window", "resca" ),
						"_blank" => __( "New window", "resca" ),
					),
				),
			),
			TP_THEME_DIR . 'inc/widgets/social/'
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

function thim_social_register_widget() {
	register_widget( 'Thim_Social_Widget' );
}

add_action( 'widgets_init', 'thim_social_register_widget' );