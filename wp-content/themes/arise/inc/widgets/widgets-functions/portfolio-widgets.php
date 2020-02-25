<?php
/***************************** Portfolio Widget ***********************************/
class arise_portfolio_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array('classname' => 'widget_portfolio clearfix', 'description' => __('Portfolio Widget (Front Page)', 'arise'));
		$control_ops = array('width'     => 200, 'height'     => 250);
		parent::__construct(false, $name = __('TF: FP Portfolio Widget', 'arise'), $widget_ops, $control_ops);
	}
	function form($instance) {
		$instance           = wp_parse_args((array) $instance, array('number' => '6', 'title' => '', 'text' => '', 'page_id0'=>'','page_id1'=>'','page_id2'=>'','page_id3'=>'','page_id4'=>'','page_id5'=>'','page_id6'=>'','page_id7'=>''));
		$number = absint( $instance[ 'number' ] );
		$title = esc_attr($instance['title']);
		$text = esc_attr($instance['text']);
		for ($i = 0; $i < $number; $i++) {
			$var            = 'page_id'.$i;
			$defaults[$var] = '';
		}
		$instance = wp_parse_args((array)$instance, $defaults);
		for ($i = 0; $i < $number; $i++) {
			$var = 'page_id'.$i;
			$var = absint($instance[$var]);
		} ?>
<p>
  <label for="<?php echo $this->get_field_id('number'); ?>">
  <?php _e( 'Number of Works:', 'arise' ); ?>
  </label>
  <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('title');?>">
  <?php _e('Title:', 'arise');?>
  </label>
  <input id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo esc_attr($title);?>" />
</p>
<?php _e('Description', 'arise');?>
<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('text');?>" name="<?php echo $this->get_field_name('text');?>"><?php echo esc_attr($text);
		?></textarea>
<?php
		for ($i = 0; $i < $number; $i++) {
			?>
<p>
  <label for="<?php echo $this->get_field_id(key($defaults));?>">
  <?php _e('Page', 'arise');?>
  :</label>
  <?php wp_dropdown_pages(array('show_option_none' => ' ', 'name' => $this->get_field_name(key($defaults)), 'selected' => $instance[key($defaults)]));?>
</p>
<?php
			next($defaults);// forwards the key of $defaults array
		}
	}
	function update($new_instance, $old_instance) {
		$instance                        = $old_instance;
		$instance['number'] = absint( $new_instance['number'] );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['text'] = sanitize_textarea_field( $new_instance['text'] );
		for ($i = 0; $i < $instance['number']; $i++) {
			$var            = 'page_id'.$i;
			$instance[$var] = absint($new_instance[$var]);
		}
		return $instance;
	}

	function widget($args, $instance) {
		global $post;
		$arise_settings = arise_get_theme_options();
		extract($args);
		extract($instance);
		$number = empty( $instance['number'] ) ? 7 : $instance['number'];
		$page_array = array();
		$title               = isset($instance['title'])?$instance['title']:'';
		$text                = apply_filters('widget_text', empty($instance['text'])?'':$instance['text'], $instance);
		$page_array         = array();
		for ($i = 0; $i < $number; $i++) {
			$var     = 'page_id'.$i;
			$page_id = isset($instance[$var])?$instance[$var]:'';
			if (!empty($page_id)) {
				array_push($page_array, $page_id);
			}
			// Push the page id in the array
		}
		$get_featured_pages = new WP_Query(array(
				'posts_per_page' => -1,
				'post_type'      => array('page'),
				'post__in'       => $page_array,
				'orderby'        => 'post__in'
			));
		echo '<!-- Recent Work Widget ============================================= -->' .$before_widget;
		echo '<div class="container clearfix">';
		if (!empty($title)) { echo $before_title . esc_attr($title) . $after_title; }
		if(!empty($text)){ ?>
<p class="widget-sub-title"><?php echo esc_attr($text); ?></p>
<?php }
		while ($get_featured_pages->have_posts()):$get_featured_pages->the_post();
		$page_title = get_the_title();
		?>
<div class="three-column-full-width">
  <?php
				if (has_post_thumbnail()) { ?>
  <?php echo get_the_post_thumbnail($post->ID, 'post-thumbnails');
				} ?>
  <div class="portfolio-content slide-caption" title="<?php echo esc_attr($page_title); ?>">
    <h3><a href="<?php the_permalink();?>" title="<?php echo esc_attr($page_title); ?>"><?php echo esc_attr($page_title); ?></a></h3>
    <?php if(get_the_excerpt() != ''): ?>
    <p>
      <?php 
					if(strlen(get_the_excerpt()) >130){
						$excerpt_length = substr(get_the_excerpt(), 0 , 130);
						echo wp_strip_all_tags($excerpt_length) .'&hellip;';
					}else{
						echo wp_strip_all_tags(get_the_excerpt());
					}?>
    </p>
    <?php endif; ?>
    <?php $arise_tag_text = $arise_settings['arise_tag_text'];
					$excerpt = get_the_excerpt();
					$content = get_the_content();
					if(strlen($excerpt) < strlen($content) || strlen($excerpt) > 130){ ?>
    <p><a class="more-link" title="<?php the_title_attribute();?>" href="<?php the_permalink();?>">
      <?php
							if($arise_tag_text == 'Read More' || $arise_tag_text == ''):
								_e('Read More', 'arise');
							else:
								echo esc_attr($arise_tag_text);
							endif;?>
      </a></p>
    <?php } ?>
  </div>
  <!-- end .recent_work-content -->
</div>
<!-- end .three-column-full-width -->
<?php endwhile;
		// Reset Post Data
		wp_reset_query();
		echo '</div> <!-- end .container -->';
		echo $after_widget .'<!-- end .widget_portfolio -->';
	}
}