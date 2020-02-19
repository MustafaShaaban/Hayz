<?php
$event = $titan->createMetaBox( array(
	'name'      => __( 'Event Options', 'resca' ),
	'id'        => 'event-options',
	'post_type' => array( 'post' ),
) );

$event->createOption( array(
	'name' => __( 'Use Page Event', 'resca' ),
	'id'   => 'use_event',
	'type' => 'checkbox',
	'desc' => ' '
) );

$event->createOption( array(
	'name'    => __( 'Desc', 'resca' ),
	'id'      => 'desc',
	'type'    => 'text',
	'default' => '',
) );

$event->createOption( array(
	'name'    => __( 'Start Date', 'resca' ),
	'id'      => 'start_date',
	'type'    => 'date',
	'desc'    => __( 'Choose a date', 'resca' ),
	'default' => ''
	
) );

$event->createOption( array(
	'name'    => __( 'End Date', 'resca' ),
	'id'      => 'end_date',
	'type'    => 'date',
	'desc'    => __( 'Choose a date', 'resca' ),
	'default' => '',
) );


