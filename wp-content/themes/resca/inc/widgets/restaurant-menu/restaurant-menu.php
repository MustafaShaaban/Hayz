<?php

class Restaurant_Menu_Widget extends Thim_Widget {
	function __construct() {
		$erm_menu_args = array(
			'post_type' => 'erm_menu',
            'posts_per_page' => -1,
		);
		$lop_menu_args = new WP_Query( $erm_menu_args );
		$cate[0]       = 'Create Menu';
		if ( $lop_menu_args->have_posts() ) {
			$cate = array();
			while ( $lop_menu_args->have_posts() ): $lop_menu_args->the_post();
				$cate[get_the_ID()] = get_the_title( get_the_ID() );;
			endwhile;
		}
		wp_reset_postdata();

		parent::__construct(
			'restaurant-menu',
			__( 'Restaurant Menu', 'resca' ),
			array(
				'description'   => __( 'Restaurant Menu', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'title'    => array(
					'type'    => 'text',
					'label'   => __( 'Title', 'resca' ),
					'options' => $cate,
				),
				'bg_image' => array(
					'type' => 'media',
					'name' => __( 'Upload Background Title Image', 'resca' ),
				),
				'color'    => array(
					'type'  => 'color',
					'label' => __( 'Color', 'resca' ),
				),
				'size'     => array(
					'type'    => 'select',
					'label'   => __( 'Size', 'resca' ),
					'options' => array( 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6' ),
					'default' => 'h3'
				),
				'id'       => array(
					'type'    => 'select',
					'label'   => __( 'Select Menu', 'resca' ),
					'options' => $cate,
				),
				'columns'  => array(
					'type'    => 'select',
					'label'   => __( 'Columns', 'resca' ),
					'options' => array( '1' => '1', '2' => '2' ),
				),
				'type'     => array(
					'type'    => 'select',
					'label'   => 'Menu Style',
					'options' => array( '' => 'Regular', 'dotted' => 'Dotted' ),
				),

			),
			TP_THEME_DIR . 'inc/widgets/restaurant-menu/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */


	function get_template_name( $instance ) {
		if ( $instance['type'] == 'dotted' ) {
			return 'base';
		} else {
			return 'default';
		}
	}


	function get_style_name( $instance ) {
		return false;
	}
}

function thim_restaurant_menu_register_widget() {
	register_widget( 'Restaurant_Menu_Widget' );
}

add_action( 'widgets_init', 'thim_restaurant_menu_register_widget' );