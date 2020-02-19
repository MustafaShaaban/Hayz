<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( wpems_get_option( 'allow_register_event' ) == 'no'  ) {
	return;
}

$event    = new WPEMS_Event( get_the_ID() );
$user_reg = $event->booked_quantity( get_current_user_id() );

if ( absint( $event->qty ) == 0 || $event->post->post_status === 'tp-event-expired' ) {
	return;
}

?>

<div class="entry-register">

    <ul class="event-info">
        <li class="total">
            <span class="label"><?php _e( 'Total Slot:', 'resca' ) ?></span>
            <span clsas="detail"><?php echo esc_html( absint( $event->qty ) ) ?></span>
        </li>
        <li class="booking_slot">
            <span class="label"><?php _e( 'Booked Slot:', 'resca' ) ?></span>
            <span clsas="detail"><?php echo esc_html( absint( $event->booked_quantity() ) ) ?></span>
        </li>
        <li class="price">
            <span class="label"><?php _e( 'Cost:', 'resca' ) ?></span>
            <span clsas="detail"><?php printf( '%s', $event->is_free() ? __( 'Free', 'resca' ) : wpems_format_price( $event->get_price() ) ) ?></span>
        </li>
    </ul>
	
	<div class="register-inner">
		<a class="event_register_submit event_auth_button event-load-booking-form" data-event="<?php echo esc_attr( get_the_ID() ) ?>"><?php _e( 'Register Now', 'resca' ); ?></a>
		<?php if ( !is_user_logged_in() ) { ?>
			<span class="inner-notice">
				<?php
				printf( wp_kses( __( '<span class="event_auth_user_is_not_login">You must <a href="%s">Login</a> to Our site to register this event!</span>', 'resca' ), array( 'a' => array( 'href' => array() ), 'br' => array() ) ), esc_url( wpems_login_url() ) . '?redirect_to=' . esc_url( wpems_get_current_url() ) );
				return;
				?>
			</span>
		<?php } ?>
	</div>

</div>
