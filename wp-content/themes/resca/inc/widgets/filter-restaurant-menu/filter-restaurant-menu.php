<?php

class Filter_Restaurant_Menu_Widget extends Thim_Widget {
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
			'filter-restaurant-menu',
			__( 'Filter Restaurant Menu', 'resca' ),
			array(
				'description'   => __( 'Filter Restaurant Menu', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'id'      => array(
					'type'    => 'text',
					'label'   => __( 'ID Menu', 'resca' ),
					'description' => __( 'Enter ID Menu. (Example: 1,2,3,...)', 'resca' )
				),
 			),
			TP_THEME_DIR . 'inc/widgets/filter-restaurant-menu/'
		);
	}

	function get_template_name( $instance ) {
		return 'base';
	}


	function get_style_name( $instance ) {
		return false;
	}
}

function thim_filter_restaurant_menu_register_widget() {
	register_widget( 'Filter_Restaurant_Menu_Widget' );
}

add_action( 'widgets_init', 'thim_filter_restaurant_menu_register_widget' );