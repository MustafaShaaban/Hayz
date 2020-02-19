<?php

class Instagram_Feed_Widget extends Thim_Widget {

    function __construct() {
        parent::__construct(
            'instagram_feed',
            __( 'Thim: xxxx', 'resca' ),
            array(
                'description'   => __( 'Instagram feed', 'resca' ),
                'help'          => '',
                'panels_groups' => array( 'thim_widget_group' )
            ),
            array(),
            array(
                'title'               => array(
                    'type'    => 'text',
                    'label'   => __( 'Heading Text', 'resca' ),
                    'default' => __( "Default value", "resca" )
                ),

            ),
            TP_THEME_DIR . 'inc/widgets/instagram_feed/'
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

function thim_instagram_register_widget() {
    register_widget( 'Instagram_Feed_Widget' );
}

add_action( 'widgets_init', 'thim_instagram_register_widget' );