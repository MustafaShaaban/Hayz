<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/******************** ARISE CONTACT US WIDGETS *****************************/
class arise_contact_widgets extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_contact', 'description' => __( 'Display Contact Us Information', 'arise') );
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct( false, $name=__('TF: Contact Us','arise'), $widget_ops, $control_ops );
	}	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '','address1' => '','address_link1' => '','phone_no1' => '','phone_no2' => '', 'email_1' => '', 'skype_id1' => ''));
		$title = strip_tags($instance['title']);
		$address1 = strip_tags($instance['address1']);
		$address_link1 = esc_url($instance['address_link1']);
		$phone_no1 = esc_attr($instance['phone_no1']);
		$phone_no2 = esc_attr($instance['phone_no2']);
		$email_1 = is_email($instance['email_1']);
		$skype_id1 = esc_attr($instance['skype_id1']); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Contact Title:', 'arise'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset ( $instance['title'] ) ) echo strip_tags( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address1'); ?>">
				<?php _e('Address:', 'arise'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('address1'); ?>" name="<?php echo $this->get_field_name('address1'); ?>" type="text" value="<?php if(isset ( $instance['address1'] ) ) echo strip_tags( $instance['address1'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address_link1'); ?>">
				<?php _e('Address Link:', 'arise'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('address_link1'); ?>" name="<?php echo $this->get_field_name('address_link1'); ?>" type="text" value="<?php if(isset ( $instance['address_link1'] ) ) echo esc_url( $instance['address_link1'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone_no1'); ?>">
				<?php _e('Phone No 1:', 'arise'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('phone_no1'); ?>" name="<?php echo $this->get_field_name('phone_no1'); ?>" type="text" value="<?php if(isset ( $instance['phone_no1'] ) ) echo esc_attr( $instance['phone_no1'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone_no2'); ?>">
				<?php _e('Phone No 2:', 'arise'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('phone_no2'); ?>" name="<?php echo $this->get_field_name('phone_no2'); ?>" type="text" value="<?php if(isset ( $instance['phone_no2'] ) ) echo esc_attr( $instance['phone_no2'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('skype_id1'); ?>">
				<?php _e('Skype ID:', 'arise'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('skype_id1'); ?>" name="<?php echo $this->get_field_name('skype_id1'); ?>" type="text" value="<?php if(isset ( $instance['skype_id1'] ) ) echo esc_attr( $instance['skype_id1'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email_1'); ?>">
				<?php _e('Email ID:', 'arise'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('email_1'); ?>" name="<?php echo $this->get_field_name('email_1'); ?>" type="text" value="<?php if(isset ( $instance['email_1'] ) ) echo esc_attr( $instance['email_1'] ); ?>" />
		</p>
		<?php }
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field($new_instance['title']);
			$instance['address1'] = sanitize_text_field($new_instance['address1']);
			$instance['address_link1'] = esc_url_raw($new_instance['address_link1']);
			$instance['phone_no1'] = sanitize_text_field($new_instance['phone_no1']);
			$instance['phone_no2'] = sanitize_text_field($new_instance['phone_no2']);
			$instance['email_1'] = sanitize_text_field($new_instance['email_1']);
			$instance['skype_id1'] = sanitize_text_field($new_instance['skype_id1']);
			return $instance;
		}
		function widget( $args, $instance ) {
			extract($args);
		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$address1 = empty( $instance['address1'] ) ? '' : $instance['address1'];
		$address_link1 = empty( $instance['address_link1'] ) ? '' : $instance['address_link1'];
		$phone_no1 = empty( $instance['phone_no1'] ) ? '' : $instance['phone_no1'];
		$phone_no2 = empty( $instance['phone_no2'] ) ? '' : $instance['phone_no2'];
		$email_1 = empty( $instance['email_1'] ) ? '' : $instance['email_1'];
		$skype_id1 = empty( $instance['skype_id1'] ) ? '' : $instance['skype_id1'];
		echo '<!-- Contact Us ============================================= -->' .$before_widget;
		if(!empty($title)): ?>
		<h3 class="widget-title"><?php echo esc_html($title); ?></h3> <!-- end .widget-title -->
		<?php endif;
		if(!empty($address1) || !empty($phone_no1) || !empty($phone_no2) || !empty($email_1) || !empty($skype_id1)): ?>
		<ul>
			<?php if(!empty($address1)): ?>
			<li class="address"><a href="<?php if(!empty($address_link1)) echo esc_url($address_link1); ?>" title="<?php echo esc_attr($address1); ?>" target="_blank"><?php echo esc_attr($address1); ?></a></li>
			<?php endif;
			if(!empty($phone_no1)): ?>
			<li class="phone-number"><a href="tel:<?php echo preg_replace("/[^0-9+]/",'',$phone_no1); ?>" title="<?php echo esc_attr($phone_no1); ?>"><?php echo esc_attr($phone_no1); ?></a></li>
			<?php endif;
			if(!empty($phone_no2)): ?>
			<li class="phone-number"><a href="tel:<?php echo preg_replace("/[^0-9+]/",'',$phone_no2); ?>" title="<?php echo esc_attr($phone_no2); ?>"><?php echo esc_attr($phone_no2); ?></a></li>
			<?php endif;
			if(!empty($email_1)): ?>
			<li class="email"><a href="mailto:<?php echo is_email($email_1); ?>" title="<?php is_email($email_1); ?>"><?php echo is_email($email_1); ?></a></li>
			<?php endif;
			if(!empty($skype_id1)): ?>
			<li class="skype"><a href="skype:<?php echo esc_attr($skype_id1); ?>?chat" title="<?php echo esc_attr($skype_id1); ?>"><?php echo esc_attr($skype_id1); ?></a></li>
			<?php endif; ?>
		</ul>
	<?php endif;
	echo $after_widget .'<!-- end .contact_widget -->';
	}
}