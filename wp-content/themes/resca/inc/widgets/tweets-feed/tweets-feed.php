<?php

class Tweets_Feed_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'tweets-feed',
			__( 'Thim: Tweets Feed', 'resca' ),
			array(
				'description'   => __( 'List Tweets Feed', 'resca' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' )
			),
			array(),
			array(
				'title'               => array(
					'type'    => 'text',
					'label'   => __( 'Heading Text', 'resca' ),
					'default' => __( "TWITTER", "resca" )
				),
				'consumer_key'        => array(
					'type'    => 'text',
					'label'   => __( 'Consumer Key', 'resca' ),
					'default' => __( "8MLtU0vPrqY5ID5f9R5w", "resca" )
				),
				'consumer_secret'     => array(
					'type'    => 'text',
					'label'   => __( 'Consumer Secret', 'resca' ),
					'default' => __( "H7wIO5OUFgbNlq5h8pzXOhyubR7awP9VCO37b2JU1A", "resca" )
				),
				'access_token'        => array(
					'type'    => 'text',
					'label'   => __( 'Access Token', 'resca' ),
					'default' => __( "624443553-wJTdW8WTORDnggzV9C0mUFJ1nbv4kCZgxy5JKlYu", "resca" )
				),
				'access_token_secret' => array(
					'type'    => 'text',
					'label'   => __( 'Access Token Secret', 'resca' ),
					'default' => __( "dsLFF01Hn3a3YcDt0DjCofoxxABkoyJkhLSa302S3fzJj", "resca" )
				),
				'twitter_id'          => array(
					'type'    => 'text',
					'label'   => __( 'Twitter Name', 'resca' ),
					'default' => __( "themeforest", "resca" )
				),
				'count'               => array(
					'type'    => 'number',
					'label'   => __( 'Number of Tweets', 'resca' ),
					'default' => __( "4", "resca" )
				),

			),
			TP_THEME_DIR . 'inc/widgets/tweets-feed/'
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

function thim_tweets_feed_register_widget() {
	register_widget( 'Tweets_Feed_Widget' );
}

add_action( 'widgets_init', 'thim_tweets_feed_register_widget' );