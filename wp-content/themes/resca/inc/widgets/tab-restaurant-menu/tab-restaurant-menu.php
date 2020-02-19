<?php

class Tab_Restaurant_Menu_Widget extends Thim_Widget {
	function __construct() {
		$erm_menu_args = array(
			'post_type' => 'erm_menu',
            'posts_per_page' => -1,
        );
		$lop_menu_args = new WP_Query( $erm_menu_args );
		$cate[0]       = 'Create Menu';
		if ( $lop_menu_args->have_posts() ) {
			$cate =  array();
			while ( $lop_menu_args->have_posts() ): $lop_menu_args->the_post();
				$cate[get_the_ID()] = get_the_title( get_the_ID() );;
			endwhile;
		}
		wp_reset_postdata();

		parent::__construct(
			'tab-restaurant-menu',
			__( 'Tab Restaurant Menu', 'resca' ),
			array(
				'description'   => __( 'Tab Restaurant Menu', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'tab'  => array(
					'type'      => 'repeater',
					'label'     => __( 'Tab', 'resca' ),
					'item_name' => __( 'Tab', 'resca' ),
					'fields'    => array(
						'title'         => array(
							"type"    => "text",
							"label"   => __( "Tab Title", "resca" ),
							"default" => "Tab Title",
						),

                        'sub-title'  => array(
                            "type"  => "text",
                            "label" => __( "Sub Title", "resca" ),
                        ),
                        'icon_image' => array(
                            'type' => 'media',
                            'name' => __( 'Upload Icon', 'resca' ),
                        ),

						'id'            => array(
							'type'    => 'select',
							'label'   => __( 'Select Menu', 'resca' ),
							'options' => $cate,
						),
						'columns'       => array(
							'type'    => 'select',
							'label'   => __( 'Columns', 'resca' ),
							'options' => array( '1' => '1', '2' => '2' ),
						),
					),
				),
				'type' => array(
					'type'    => 'select',
					'label'   => 'Menu Style',
					'options' => array( '' => 'Regular', 'dotted' => 'Dotted' ),
				),
			),
			TP_THEME_DIR . 'inc/widgets/tab-restaurant-menu/'
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

function thim_tab_restaurant_menu_register_widget() {
	register_widget( 'Tab_Restaurant_Menu_Widget' );
}

add_action( 'widgets_init', 'thim_tab_restaurant_menu_register_widget' );