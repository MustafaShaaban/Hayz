<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/*********************** ARISE TESTIMONIALS WIDGETS ****************************/
class arise_widget_testimonial extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_testimonial', 'description' => __( 'Display Testimonial on FrontPage', 'arise' ) );
		$control_ops = array( 'width' => 200, 'height' =>250 ); 
		parent::__construct( false, $name = __( 'TF: FP Testimonial', 'arise' ), $widget_ops, $control_ops);
	}
	function form($instance) {
		$instance = wp_parse_args(( array ) $instance, array('number' => '3','post_type'=> 'latest','category' => ''));
		$number = absint( $instance[ 'number' ] );
		$post_type = $instance[ 'post_type' ];
		$category = $instance[ 'category' ];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'arise' ); ?>:</label>
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">
			<?php _e( 'Number of Testimonial:', 'arise' ); ?>
			</label>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
	<?php }
	function update($new_instance, $old_instance) {
		$instance  = $old_instance;
		$instance[ 'number' ] = absint( $new_instance[ 'number' ] );
		$instance[ 'post_type' ] = sanitize_text_field($new_instance[ 'post_type' ]);
		$instance[ 'category' ] = sanitize_text_field($new_instance[ 'category' ]);
		return $instance;
	}

	function widget( $args, $instance ) {
		global $arise_settings;
		extract($args);
		extract($instance);
		$number = empty( $instance[ 'number' ] ) ? 3 : $instance[ 'number' ];
		$post_type = isset( $instance[ 'post_type' ] ) ? $instance[ 'post_type' ] : 'latest' ;
		$category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' 			=> absint($number),
				'post_type'					=> 'post',
				'category__in'				=> esc_attr($category),
				'ignore_sticky_posts' 	=> true
			) );
		echo '<!-- Testimonial Widget ============================================= -->' .$before_widget; ?>
			<div class="container clearfix">
			<?php echo $before_title . get_cat_name( $category ) . $after_title; ?>
				<div class="testimonials">
					<div class="quote-wrapper">
					<?php
			 			$i=1;
			 			while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
						<div class="quotes">
							<div class="quote">
								<?php if( has_post_thumbnail() ) {
									the_post_thumbnail();
								}
								the_content(); ?>
								<cite><?php the_title(); ?></cite>
							</div>
						</div><!-- end .quotes -->
					<?php endwhile; ?>
					</div> <!-- end .quote-wrapper -->
				</div> <!-- end .testimonials -->
			</div> <!-- end .container -->
		<?php 
		echo $after_widget .'<!-- end .widget_testimonial -->';
	}
}