<?php

class Thim_Google_Map_Widget extends Thim_Widget {
	function __construct() {
 		parent::__construct(
			'google-map',
			__( 'Thim: Google Maps', 'resca' ),
			array(
				'description' => __( 'A Google Maps widget.', 'resca' ),
				'help'        => '',
				'panels_groups' => array('thim_widget_group')
			),
			array(),
			array(
				'title'      => array(
					'type'  => 'text',
					'label' => __( 'Title', 'resca' ),
				),
				'map_center' => array(
					'type'        => 'textarea',
					'rows'        => 2,
					'label'       => __( 'Map center', 'resca' ),
					'description' => __( 'The name of a place, town, city, or even a country. Can be an exact address too.', 'resca' )
				),
				'settings'   => array(
					'type'        => 'section',
					'label'       => __( 'Settings', 'resca' ),
					'hide'        => false,
					'description' => __( 'Set map display options.', 'resca' ),
					'fields'      => array(
						'height'      => array(
							'type'    => 'text',
							'default' => 480,
							'label'   => __( 'Height', 'resca' )
						),
						'zoom'        => array(
							'type'        => 'slider',
							'label'       => __( 'Zoom level', 'resca' ),
							'description' => __( 'A value from 0 (the world) to 21 (street level).', 'resca' ),
							'min'         => 0,
							'max'         => 21,
							'default'     => 12,
							'integer'     => true,

						),
						'scroll_zoom' => array(
							'type'        => 'checkbox',
							'default'     => true,
							'state_name'  => 'interactive',
							'label'       => __( 'Scroll to zoom', 'resca' ),
							'description' => __( 'Allow scrolling over the map to zoom in or out.', 'resca' )
						),
						'draggable'   => array(
							'type'        => 'checkbox',
							'default'     => true,
							'state_name'  => 'interactive',
							'label'       => __( 'Draggable', 'resca' ),
							'description' => __( 'Allow dragging the map to move it around.', 'resca' )
						)
					)
				),
				'markers'    => array(
					'type'        => 'section',
					'label'       => __( 'Markers', 'resca' ),
					'hide'        => true,
					'description' => __( 'Use markers to identify points of interest on the map.', 'resca' ),
					'fields'      => array(
						'marker_at_center' => array(
							'type'    => 'checkbox',
							'default' => true,
							'label'   => __( 'Show marker at map center', 'resca' )
						),
						'marker_icon'      => array(
							'type'        => 'media',
							'default'     => '',
							'label'       => __( 'Marker Icon', 'resca' ),
							'description' => __( 'Replaces the default map marker with your own image.', 'resca' )
						),
//						'markers_draggable' => array(
//							'type'       => 'checkbox',
//							'default'    => false,
//							'state_name' => 'interactive',
//							'label'      => __( 'Draggable markers', 'resca' )
//						),
						'marker_positions'  => array(
							'type'       => 'repeater',
							'label'      => __( 'Marker positions', 'resca' ),
							'item_name'  => __( 'Marker', 'resca' ),
//							'item_label' => array(
//							 'selector'     => "[id*='marker_positions-place']",
//								'update_event' => 'change',
//								'value_method' => 'val'
//							),
							'fields'     => array(
								'place' => array(
									'type'  => 'textarea',
									'rows'  => 2,
									'label' => __( 'Place', 'resca' )
								)
							)
						)
					)
				),
				'map_api'   => array(
					'type'    => 'text',
					'label'   => esc_attr__( 'Google map API', 'resca' ),
					'description'  	=> esc_attr__('Enter API google map of you or create new API: https://developers.google.com/maps/documentation/javascript/get-api-key','resca'),
					'default' => 'AIzaSyARtFR6zbpjGbGNqOSu-MknQYETXvS2cBU',
				),
			)
		);
	}

	function enqueue_frontend_scripts() {
		wp_enqueue_script( 'thim-google-map', TP_THEME_URI . 'inc/widgets/google-map/js/js-google-map.js', array( 'jquery' ), true );
	}

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

	function get_template_variables( $instance, $args ) {
		$settings = $instance['settings'];
		$markers  = $instance['markers'];
 		$mrkr_src = wp_get_attachment_image_src( $instance['markers']['marker_icon'] );
		{
			return array(
				'map_id'   => md5( $instance['map_center'] ),
				'height'   => $settings['height'],
				'map_data' => array(
					'address'          => $instance['map_center'],
					'zoom'             => $settings['zoom'],
					'scroll-zoom'      => $settings['scroll_zoom'],
					'draggable'        => $settings['draggable'],
					'marker-icon'      => !empty( $mrkr_src ) ? $mrkr_src[0] : '',
 				//	'markers-draggable' => isset( $markers['markers_draggable'] ) ? $markers['markers_draggable'] : '',
					'marker-at-center'  => $markers['marker_at_center'],
					'marker-positions'  => isset( $markers['marker_positions'] ) ? json_encode( $markers['marker_positions'] ) : '',
					'google-map-api'   => isset( $instance['map_api'] ) ? $instance['map_api'] : 'AIzaSyARtFR6zbpjGbGNqOSu-MknQYETXvS2cBU',
				)
			);
		}
	}
}
//
function thim_google_map_widget() {
	register_widget( 'Thim_Google_Map_Widget' );
}

add_action( 'widgets_init', 'thim_google_map_widget' );