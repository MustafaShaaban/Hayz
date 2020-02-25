<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/**************** ARISE PARALLAX WIDGETGS ***************************/
class arise_parallax_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array('classname' => 'widget_parallax', 'description' => __('Display Parallax widgets for Front Page', 'arise'));
		$control_ops = array('width' => 200, 'height' => 250);
		parent::__construct(false, $name = __('TF: FP Parallax', 'arise'), $widget_ops, $control_ops);
	}
	function form($instance) {
		$instance           = wp_parse_args((array) $instance, array('page_id' => '','arise_redirect_text' => '', 'arise_widget_redirecturl' => ''));
		$var = 'page_id';
		$defaults[$var] = '';
		$instance = wp_parse_args((array)$instance, $defaults);
		$var = absint($instance[$var]);
		$arise_redirect_text      = strip_tags($instance['arise_redirect_text']);
		$arise_widget_redirecturl = esc_url($instance['arise_widget_redirecturl']);
		?>
		<p>
				<label for="<?php echo $this->get_field_id(key($defaults));?>">
					<?php _e('Page', 'arise');?>
				:</label>
				<?php wp_dropdown_pages(array('show_option_none' => ' ', 'name' => $this->get_field_name(key($defaults)), 'selected' => $instance[key($defaults)]));?>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('arise_redirect_text');?>">
					<?php _e('Redirect Text:', 'arise');?>
				</label>
				<input class="widefat" id="<?php echo $this->get_field_id('arise_redirect_text');?>" name="<?php echo $this->get_field_name('arise_redirect_text');?>" type="text" value="<?php echo esc_attr($arise_redirect_text);?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('arise_widget_redirecturl');?>">
					<?php _e('Redirect Url:', 'arise');?>
				</label>
				<input class="widefat" id="<?php echo $this->get_field_id('arise_widget_redirecturl');?>" name="<?php echo $this->get_field_name('arise_widget_redirecturl');?>" type="text" value="<?php echo esc_url($arise_widget_redirecturl);?>" />
			</p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$var  = 'page_id';
		$instance['arise_widget_redirecturl'] = esc_url_raw($new_instance['arise_widget_redirecturl']);
		$instance['arise_redirect_text'] = sanitize_text_field($new_instance['arise_redirect_text']);
		$instance['filter'] = isset($new_instance['filter']);
		$instance[$var] = absint($new_instance[$var]);
		return $instance;
	}
	function widget($args, $instance) {
		extract($args);
		extract($instance);
		$page_array = array();
		$var     = 'page_id';
		$page_id = isset($instance[$var])?$instance[$var]:'';
			if (!empty($page_id)) {
				array_push($page_array, $page_id);
			}
		$arise_redirect_text    = apply_filters('arise_redirect_text', empty($instance['arise_redirect_text'])?'':$instance['arise_redirect_text'], $instance);
		$arise_widget_redirecturl = apply_filters('arise_widget_redirecturl', empty($instance['arise_widget_redirecturl'])?'':$instance['arise_widget_redirecturl'], $instance, $this->id_base);
		echo '<!-- Parallax Widget ============================================= -->' .$before_widget; 
		$get_featured_pages = new WP_Query(array(
				'posts_per_page' => -1, 'post_type' => array('page'), 'post__in' => $page_array, 'orderby' => 'post__in'
			));
			while ($get_featured_pages->have_posts()):$get_featured_pages->the_post();
					$arise_parallax_title = get_the_title();
					$parallax_content = get_the_content();
					$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'slider'); ?>
			<div class="parallax_content" <?php if (has_post_thumbnail()) { ?> style="background-image:url('<?php echo esc_url($image_attributes[0]); ?>');" <?php } ?> >
				<div class="container clearfix">
					<?php if(!empty($arise_parallax_title)): ?>
					<h3><?php echo esc_attr($arise_parallax_title); ?></h3>
					<?php endif;
					if(!empty($parallax_content)):?>
						<h2 class="widget-title"><?php echo apply_filters( 'the_title', $parallax_content); ?></h2>
					<?php endif;
					if(!empty($arise_redirect_text)): ?>
						<a class="btn-default light" href="<?php echo esc_url($arise_widget_redirecturl); ?>" title="<?php echo esc_attr($arise_redirect_text); ?>" target="_blank"><?php echo esc_attr($arise_redirect_text); ?></a><!-- end .btn-default -->
					<?php endif; ?>
				</div><!-- end .container -->
			</div><!-- end .parallax_content -->
		<?php
		endwhile;
		echo $after_widget .'<!-- end .widget_parallax -->';
		wp_reset_postdata();
	}
}