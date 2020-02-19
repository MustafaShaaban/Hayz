<?php

class Gallery_Widget extends Thim_Widget {
	function __construct() {
		$categories = get_terms( 'category', array( 'hide_empty' => 0, 'orderby' => 'ASC' ) );
		$cate       = '';
		if ( is_array( $categories ) ) {
			foreach ( $categories as $cat ) {
				$cate[$cat->term_id] = $cat->name;
			}
		}
		parent::__construct(
			'gallery',
			__( 'Thim: Filter Gallery ', 'resca' ),
			array(
				'description'   => __( 'gallery', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
			),
			array(),
			array(
				'cat' => array(
					'type'    => 'select',
					'label'   => __( 'Select Category', 'resca' ),
					'options' => $cate
				),
			),
			TP_THEME_DIR . 'inc/widgets/gallery/'
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

	function enqueue_frontend_scripts() {
		wp_enqueue_style( 'thim-fancybox', TP_THEME_URI . 'inc/widgets/gallery/css/jquery.fancybox.css' );
	}
}

function thim_gallery_register_widget() {
	register_widget( 'Gallery_Widget' );
}

add_action( 'widgets_init', 'thim_gallery_register_widget' );