<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/******************** ARISE PARALLAX VIDEO WIDGETS **********************************/
class arise_parallax_video_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array('classname' => 'widget_parallax_video', 'description' => __('Display Parallax Youtube/ Vimeo video for Front Page', 'arise'));
		$control_ops = array('width'     => 200, 'height'     => 250);
		parent::__construct(false, $name = __('TF: FP Video Widget', 'arise'), $widget_ops, $control_ops);
	}
	function form($instance) {
		$instance           = wp_parse_args((array) $instance, array('arise_video_content' => '', 'page_id' => '', 'arise_video_redirect_text' => '', 'arise_video_redirecturl' => '','parallax_video_bg_img'=>'','arise_video_title'=>'','video_links'=>''));
		$var            = 'page_id';
		$defaults[$var] = '';
		$instance = wp_parse_args((array)$instance, $defaults);
		$var = absint($instance[$var]);
		$arise_video_content   = stripslashes( wp_filter_post_kses( addslashes ($instance['arise_video_content'])));
		$arise_video_redirect_text      = strip_tags($instance['arise_video_redirect_text']);
		$arise_video_redirecturl = esc_url($instance['arise_video_redirecturl']);
		?>	
			<p>
				<label for="<?php _e('Description','arise')?>">
					<?php _e('Add all iframe code at page editor to display youtube/ Vimeo video. Do not add iframe code at video content. Your iframe code will be displayed from page editor', 'arise');?>
				:</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id(key($defaults));?>">
					<?php _e('Page', 'arise');?>
				:</label>
				<?php wp_dropdown_pages(array('show_option_none' => ' ', 'name' => $this->get_field_name(key($defaults)), 'selected' => $instance[key($defaults)]));?>
			</p>

			<p>
					<?php _e('Video Content:', 'arise');?>
				<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('arise_video_content');?>" name="<?php echo $this->get_field_name('arise_video_content');?>"><?php echo stripslashes( wp_filter_post_kses( addslashes ($arise_video_content)));
		?></textarea>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('arise_video_redirect_text');?>">
					<?php _e('Redirect Text:', 'arise');?>
				</label>
				<input class="widefat" id="<?php echo $this->get_field_id('arise_video_redirect_text');?>" name="<?php echo $this->get_field_name('arise_video_redirect_text');?>" type="text" value="<?php echo esc_attr($arise_video_redirect_text);?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('arise_video_redirecturl');?>">
					<?php _e('Redirect Url:', 'arise');?>
				</label>
				<input class="widefat" id="<?php echo $this->get_field_id('arise_video_redirecturl');?>" name="<?php echo $this->get_field_name('arise_video_redirecturl');?>" type="text" value="<?php echo $arise_video_redirecturl;?>" />
			</p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance                       = $old_instance;
		$var            = 'page_id';
		$instance['arise_video_content']   = sanitize_textarea_field($new_instance['arise_video_content']);
		$instance['arise_video_redirecturl'] = esc_url_raw($new_instance['arise_video_redirecturl']);
		$instance['arise_video_redirect_text']      = sanitize_text_field($new_instance['arise_video_redirect_text']);
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
		$arise_video_content = apply_filters('arise_video_content', empty($instance['arise_video_content'])?'':$instance['arise_video_content'], $instance, $this->id_base);
		$arise_video_redirect_text    = apply_filters('arise_video_redirect_text', empty($instance['arise_video_redirect_text'])?'':$instance['arise_video_redirect_text'], $instance);
		$arise_video_redirecturl = apply_filters('arise_video_redirecturl', empty($instance['arise_video_redirecturl'])?'':$instance['arise_video_redirecturl'], $instance, $this->id_base);
		echo '<!-- Parallax Video Widget ============================================= -->' .$before_widget; ?>
		<?php $get_featured_pages = new WP_Query(array(
				'posts_per_page' => -1,
				'post_type'      => array('page'),
				'post__in'       => $page_array,
				'orderby'        => 'post__in'
			));
		while ($get_featured_pages->have_posts()):$get_featured_pages->the_post();
					$arise_video_title = get_the_title();
					$video_links = get_the_content();
					$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'slider'); ?>
			<div class="parallax_video_content" <?php if (has_post_thumbnail()) { ?> style="background-image:url('<?php echo esc_url($image_attributes[0]); ?>');" <?php } ?> >
				<div class="container clearfix">
					<div class="column">
						<div class="two-column">
							<?php if(!empty($video_links)): ?>
							<div class="video-wrapper"><?php echo apply_filters( 'the_title', $video_links); ?></div><!-- end .video-wrapper -->
							<?php endif; ?>
						</div><!-- end .two-column -->
						<?php if(!empty($arise_video_title) || !empty($arise_video_content) || !empty($arise_video_redirect_text)): ?>
						<div class="two-column">
							<div class="parallax_video_text">
							<?php if (!empty($arise_video_title)): ?>
							<h3 class="widget-title"><?php echo esc_attr($arise_video_title); ?></h3>
							<?php endif;
							if(!empty($arise_video_content)): ?>
							<h3><?php echo esc_attr($arise_video_content); ?></h3>
							<?php endif;
							if(!empty($arise_video_redirect_text)): ?>
							<a class="btn-default light" href="<?php echo esc_url($arise_video_redirecturl); ?>" title="<?php echo esc_attr($arise_video_redirect_text); ?>" target="_blank"><?php echo esc_attr($arise_video_redirect_text); ?></a><!-- end .btn-default -->
						<?php endif; ?>
							</div>
						</div> <!-- end .two-column -->
					</div> <!-- end .column -->
				</div> <!-- end .container -->
			</div> <!-- end .parallax_content -->
			<?php endif;
			endwhile;
		echo $after_widget .'<!-- end .widget_parallax_video -->';
		wp_reset_postdata();
	}
}