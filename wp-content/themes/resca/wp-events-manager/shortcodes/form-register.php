<?php
/**
 * @Author: ducnvtt
 * @Date  :   2016-02-19 09:11:26
 * @Last  Modified by:     ducnvtt
 * @Last  Modified time: 2 2016-03-02 10:53:18
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
} 
?>

<?php wpems_print_notices(); ?>

<div class="row thim-loginpage" id="customer_login">

    <div class="col-xs-12 login-area" id="panel-login">
        <form name="event_auth_registerform" action="<?php echo esc_url( wp_registration_url() ); ?>" method="post" novalidate="novalidate">

            <p class="form-row">
                <input type="text" placeholder="<?php esc_html_e( 'Username *', 'resca' ); ?>" name="user_login" id="user_login" class="input" value="<?php echo esc_attr( !empty( $_POST['user_login'] ) ? sanitize_text_field( $_POST['user_login'] ) : '' ); ?>" />
            </p>
            <p class="form-row">
                <input type="email" placeholder="<?php esc_html_e( 'Email *', 'resca' ); ?>" name="user_email" id="user_email" class="input" value="<?php echo esc_attr( !empty( $_POST['user_email'] ) ? sanitize_text_field( $_POST['user_email'] ) : '' ); ?>" />
            </p>

			<?php do_action( 'tp_event_register_form' ); ?>

            <br class="clear" />

            <p class="submit form-row">
                <input type="hidden" name="redirect_to" value="<?php echo esc_attr( $atts['redirect_to'] ); ?>" />
				<?php wp_nonce_field( 'event_auth_register_form', 'event_auth_register_action' ); ?>
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Register', 'resca' ); ?>" />
            </p>

        </form>

        <div class="text-center bottom-link">
            <p>
                <a href="<?php echo esc_attr( wpems_login_url() ) ?>"><?php esc_html_e( 'Login', 'resca' ); ?></a> | <a href="<?php echo esc_attr( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'resca' ) ?></a>
            </p>
        </div>

    </div>

</div>

