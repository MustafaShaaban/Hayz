<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/****************** ARISE POST WIDGETS **************************************/
  class arise_post_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array('classname' => 'widget_latest_blog clearfix', 'description' => __('Displays Blog Widgets on FrontPage', 'arise'));
		$control_ops = array('width'     => 200, 'height'     => 250);
		parent::__construct(false, $name = __('TF: FP Blog Widget', 'arise'), $widget_ops, $control_ops);
	}
	function form($instance) {
		$instance = wp_parse_args(( array ) $instance, array('title' => '','description' => '','number' => '3','post_type'=> 'latest','category' => '', 'checkbox' => ''));
		$checkbox = esc_attr($instance['checkbox']); 
		$title    = esc_attr($instance['title']);
		$description    = esc_attr($instance['description']);
		$number = absint( $instance[ 'number' ] );
		$post_type = $instance[ 'post_type' ];
		$category = $instance[ 'category' ];
		?>
				<p>
			<input id="<?php echo $this->get_field_id('checkbox'); ?>" name="<?php echo $this->get_field_name('checkbox'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?>/>
			<label for="<?php echo $this->get_field_id('checkbox'); ?>"><?php _e('Check to hide entry format','arise'); ?></label>
		</p>
				<p>
				<label for="<?php echo $this->get_field_id('title');?>">
		<?php _e('Title:', 'arise');?>
				</label>
				<input id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo esc_attr($title);?>" />
				</p>
				<p>
			<label for="<?php echo $this->get_field_id('description');?>">
				<?php _e('Description:', 'arise');?>
			</label>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('description');?>" name="<?php echo $this->get_field_name('description');?>"><?php echo esc_attr($description);
	?></textarea></p>
				<p>
				<label for="<?php echo $this->get_field_id('number'); ?>">
				<?php _e( 'Number of Post:', 'arise' ); ?>
				</label>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
				</p>
				<p><input type="radio" <?php checked($post_type, 'latest') ?> id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'arise' );?><br />  
		 <input type="radio" <?php checked($post_type,'category') ?> id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'arise' );?><br /></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'arise' ); ?>:</label>
			<?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
		</p>
		<?php
	}
	function update($new_instance, $old_instance) {

		$instance  = $old_instance;
		$instance['description'] = sanitize_textarea_field($new_instance['description']);
		$instance['checkbox'] = sanitize_text_field($new_instance['checkbox']);
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance[ 'number' ] = absint( $new_instance[ 'number' ] );
		$instance[ 'post_type' ] = sanitize_text_field($new_instance[ 'post_type' ]);
		$instance[ 'category' ] = sanitize_text_field($new_instance[ 'category' ]);
		return $instance;
	}
	function widget($args, $instance) {
		global $arise_settings;
		extract($args);
		extract($instance);
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$description = isset( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
		$number = empty( $instance[ 'number' ] ) ? 3 : $instance[ 'number' ];
		$post_type = isset( $instance[ 'post_type' ] ) ? $instance[ 'post_type' ] : 'latest' ;
		$category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

		if( $post_type == 'latest' ) {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' 			=> absint($number),
				'post_type'					=> 'post',
				'ignore_sticky_posts' 	=> true
			) );
		}
		else {
			$get_featured_posts = new WP_Query( array(
				'posts_per_page' 			=> absint($number),
				'post_type'					=> 'post',
				'category__in'				=> esc_attr($category)
			) );
		}
		echo '<!-- Latest Blog Widget ============================================= -->' .$before_widget;
		?>
		<?php
			if ( !empty( $title ) || !empty( $description ) ) {
				echo '<div class="latest_blog_title">';
				echo '<h2>' . esc_html( $title ) . '</h2>'; ?>
				<p><?php echo esc_textarea( $description ); ?></p>
				<?php echo '</div><!-- end .latest_blog_title -->';
				} ?>
				<div class="container clearfix">
					<div class="column clearfix">
			<?php
 			$i=1;
 			while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post(); ?>
				<div class="three-column">
						<?php
							$format = get_post_format();
							if($format != ''){ ?>
							<article class="format-<?php echo $format; ?>">
							<?php
							}
								if( has_post_thumbnail() ) { ?>
								<a class="blog-img" href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>">
								<?php the_post_thumbnail(); ?>
								<div class="blog-overlay"> &#187; </div></a>
								<?php }
								?>
								<header class="entry-header">
									<h3 class="entry-title"><a rel="bookmark" href="<?php the_permalink();?>"><?php the_title(); ?> </a></h3>
								</header>
								<?php if ( $instance['checkbox'] != true ) { ?>
								<div class="entry-meta clearfix">
								<?php if ( current_theme_supports( 'post-formats', $format ) ) {
									printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
										sprintf(''),
										esc_url( get_post_format_link( $format ) ),
										get_post_format_string( $format ) );
									} ?> 
								<span class="author vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a></span>

									<span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
									<?php if ( comments_open() ) { ?>
									<span class="comments"><?php comments_popup_link( __( 'No Comments', 'arise' ), __( '1 Comment', 'arise' ), __( '% Comments', 'arise' ), '', __( 'Comments Off', 'arise' ) ); ?></span>
									<?php } ?>	
								</div>  <!-- end .entry-meta -->
								<?php } ?>
						<div class="entry-content"><?php the_excerpt(); ?> 
						<?php $arise_tag_text = $arise_settings['arise_tag_text'];
						$excerpt = get_the_excerpt();
						$content = get_the_content();
						if(strlen($excerpt) < strlen($content)){ ?>
							<p><a class="more-link" title="<?php the_title_attribute();?>" href="<?php the_permalink();?>">
								<?php
								if($arise_tag_text == 'Read More' || $arise_tag_text == ''):
									_e('Read More', 'arise');
								else:
									echo esc_attr($arise_tag_text);
								endif;?>
							</a></p>
							<?php } ?>
							</div> <!-- end .entry-content -->
							<?php if($format != ''){ ?>
						</article>
						<?php } ?>
					</div> <!-- end .three-column -->
				<?php $i++;
			endwhile;
			// Reset Post Data
			wp_reset_postdata(); 
			echo '</div> <!-- end .column -->';
			echo '</div> <!-- end .container -->';?>
		<?php echo $after_widget .'<!-- end .widget_latest_blog -->';
	}
}