<?php
/**
 * Template Name: Corporate Template
 *
 * Displays Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0.5
 */
get_header();
$arise_settings = arise_get_theme_options();
	echo '<main id="main" role="main">';
	if($arise_settings['arise_disable_features'] != 1){
		echo '<!-- Front Page Features ============================================= -->';
		$arise_features = '';
		$arise_total_page_no = 0; 
		$arise_list_page	= array();
		for( $i = 1; $i <= $arise_settings['arise_total_features']; $i++ ){
			if( isset ( $arise_settings['arise_frontpage_features_' . $i] ) && $arise_settings['arise_frontpage_features_' . $i] > 0 ){
				$arise_total_page_no++;

				$arise_list_page	=	array_merge( $arise_list_page, array( $arise_settings['arise_frontpage_features_' . $i] ) );
			}

		}
		if (( !empty( $arise_list_page ) || !empty($arise_settings['arise_features_title']) || !empty($arise_settings['arise_features_description']) )  && $arise_total_page_no > 0 ) {
				$arise_features 	.= '<section class="our_feature">
						<div class="container clearfix">';
						$get_featured_posts 		= new WP_Query(array(
						'posts_per_page'      	=> absint($arise_settings['arise_total_features']),
						'post_type'           	=> array('page'),
						'post__in'            	=> $arise_list_page,
						'orderby'             	=> 'post__in',
					));
				if($arise_settings['arise_features_title'] != ''){
					$arise_features .= '<h2>'. esc_attr($arise_settings['arise_features_title']).'</h2>';
				}
				if($arise_settings['arise_features_description'] != ''){
					$arise_features .= '<p class="feature-sub-title">'. esc_attr($arise_settings['arise_features_description']).'</p>';
				}
					$arise_features .= '<div class="column clearfix">';
				while ($get_featured_posts->have_posts()):$get_featured_posts->the_post();
				$attachment_id = get_post_thumbnail_id();
				$image_attributes = wp_get_attachment_image_src($attachment_id,'full');
							$title_attribute       	 	 = apply_filters('the_title', get_the_title($post->ID));
							$excerpt               	 	 = get_the_excerpt();
					$arise_features .= '<div class="three-column">';
					if ($image_attributes) {
						$arise_features 	.= '<a class="feature-icon" href="'.esc_url(get_permalink()).'" title="'.the_title('', '', false).'"' .' alt="'.esc_url(get_permalink()).'">'.get_the_post_thumbnail($post->ID, 'thumbnail').'</a>';
					}
					$arise_features 	.= '<article>';
					if ($title_attribute != '') {
								$arise_features .= '<h3 class="feature-title"><a href="'.esc_url(get_permalink()).'" title="'.the_title('', '', false).'" rel="bookmark">'.get_the_title().'</a></h3>';
					}
					if ($excerpt != '') {
						$excerpt_text = $arise_settings['arise_tag_text'];
						$arise_features .= '<p>'.wp_strip_all_tags($excerpt).' </p>';
					}
					$arise_features 	.= '</article>';
					$content = get_the_content();
					$excerpt = get_the_excerpt();
					if(strlen($excerpt) < strlen($content)){
						$excerpt_text = $arise_settings['arise_tag_text'];
						if($excerpt_text == '' || $excerpt_text == 'Read More') :
							$arise_features 	.= '<a title='.'"'.get_the_title(). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="more-link">'.__('Read More', 'arise').'</a>';
						else:
						$arise_features 	.= '<a title='.'"'.get_the_title(). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="more-link">'.esc_attr($arise_settings[ 'arise_tag_text' ]).'</a>';
						endif;
					}
					$arise_features 	.='</div><!-- .column -->';
					endwhile;
					$arise_features 	.='</div><!-- .end column clearfix -->';
					$arise_features 	.='</div><!-- .container clearfix -->
					</section><!-- end .arise_frontpage_features -->';
				}
		echo $arise_features;
	}
		wp_reset_postdata();
   if( is_active_sidebar( 'arise_corporate_page_sidebar' ) ) {
			dynamic_sidebar( 'arise_corporate_page_sidebar' );
	} ?>
</main>
<!-- end #main -->
<?php get_footer();