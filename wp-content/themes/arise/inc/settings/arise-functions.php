<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage arise
 * @since arise 1.0
 */
/********************* Set Default Value if not set ***********************************/
	if ( !get_theme_mod('arise_theme_options') ) {
		set_theme_mod( 'arise_theme_options', arise_get_option_defaults_values() );
	}
/********************* arise RESPONSIVE AND CUSTOM CSS OPTIONS ***********************************/
function arise_resp_and_custom_css() {
	$arise_settings = arise_get_theme_options();
	$header_display = $arise_settings['arise_header_display'];
	if( $arise_settings['arise_responsive'] == 'on' ) { ?>
	<meta name="viewport" content="width=device-width" />
	<?php } else{ ?>
	<meta name="viewport" content="width=1070" />
	<?php  }
	
	if (($arise_settings['arise_slider_header_line'] == 1) || ($header_display == 'header_logo')){
		$arise_internal_css = '<!-- Custom CSS -->'."\n";
		$arise_internal_css .= '<style type="text/css" media="screen">'."\n";
		if($arise_settings['arise_slider_header_line']==1){
			$arise_internal_css .= 
			'.header-line {
				height: 0px;
			}';
		}
		if($header_display=='header_logo'){
			$arise_internal_css .= 
				'#site-branding #site-title, #site-branding #site-description{
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
			}';
		}
		$arise_internal_css .= '</style>'."\n";
	}
	if (isset($arise_internal_css)) {
		echo $arise_internal_css;
	}
}
add_filter( 'wp_head', 'arise_resp_and_custom_css');

/******************************** EXCERPT LENGTH *********************************/
function arise_arise_excerpt_length($length) {
	$arise_settings = arise_get_theme_options();
	$arise_excerpt_length = $arise_settings['arise_excerpt_length'];
	return absint($arise_excerpt_length);// this will return 30 words in the excerpt
}
add_filter('excerpt_length', 'arise_arise_excerpt_length');
/********************* CONTINUE READING LINKS FOR EXCERPT *********************************/
function arise_continue_reading() {
	 return '&hellip; '; 
}
add_filter('excerpt_more', 'arise_continue_reading');

/***************** USED CLASS FOR BODY TAGS ******************************/
function arise_body_class($classes) {
	global $arise_site_layout, $arise_content_layout, $post;
	$arise_settings = arise_get_theme_options();
	if ($post) {
		$layout = get_post_meta($post->ID, 'arise_sidebarlayout', true);
	}
	$arise_site_layout = $arise_settings['arise_design_layout'];
	$arise_blog_layout_temp = $arise_settings['arise_blog_layout_temp'];
	$arise_content_layout = $arise_settings['arise_sidebar_layout_options'];
	if (empty($layout) || is_archive() || is_search() || is_home()) {
		$layout = 'default';
	}
	if(!is_page_template('page-templates/arise-corporate.php')) {
		if ('default' == $layout) {
			$themeoption_layout = $arise_content_layout;
			if ('left' == $themeoption_layout) {
				$classes[] = 'left-sidebar-layout';
			} elseif ('right' == $themeoption_layout) {
				$classes[] = '';
			} elseif ('fullwidth' == $themeoption_layout) {
				$classes[] = 'full-width-layout';
			} elseif ('nosidebar' == $themeoption_layout) {
				$classes[] = 'no-sidebar-layout';
			}
		} elseif ('left-sidebar' == $layout) {
			$classes[] = 'left-sidebar-layout';
		} elseif ('right-sidebar' == $layout) {
			$classes[] = '';//css blank
		} elseif ('full-width' == $layout) {
			$classes[] = 'full-width-layout';
		} elseif ('no-sidebar' == $layout) {
			$classes[] = 'no-sidebar-layout';
		}
		if($arise_blog_layout_temp == 'large_image_display'){
			$classes[] = "blog-large";
		}elseif ($arise_blog_layout_temp == 'medium_image_display'){
			$classes[] = "small_image_blog";
		}
	}
	if (!is_page_template('page-templates/arise-corporate.php') && !is_page_template('alter-front-page-template.php') ){
		$classes[] = '';
	}elseif (is_page_template('page-templates/arise-corporate.php')) {
		$classes[] = 'tf-business-template';
		$classes[] = 'page-template-default';
	}
	if (is_page_template('page-templates/page-template-contact.php')) {
			$classes[] = 'contact';
	}
	if ($arise_site_layout =='boxed-layout') {
		$classes[] = 'boxed-layout';
	}
	if ($arise_site_layout =='small-boxed-layout') {
		$classes[] = 'boxed-layout-small';
	}
	return $classes;
}
add_filter('body_class', 'arise_body_class');

/**************************** SOCIAL MENU *********************************************/
function arise_social_links() {
	if ( has_nav_menu( 'social-link' ) ) : ?>
	<div class="social-links clearfix">
	<?php
		wp_nav_menu( array(
			'container' 	=> '',
			'theme_location' => 'social-link',
			'depth'          => 1,
			'items_wrap'      => '<ul>%3$s</ul>',
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
		) );
	?>
	</div><!-- end .social-links -->
	<?php endif;
}
add_action ('social_links', 'arise_social_links');

/******************* DISPLAY BREADCRUMBS ******************************/
function arise_breadcrumb() {
	if (function_exists('bcn_display')) { ?>
		<div class="breadcrumb home">
			<?php bcn_display(); ?>
		</div> <!-- .breadcrumb -->
	<?php }
}

/*********************** arise PAGE SLIDERS ***********************************/
function arise_page_sliders() {
	$arise_settings = arise_get_theme_options();
	global $post;
	$slider_custom_text = $arise_settings['arise_secondary_text'];
	$slider_custom_url = $arise_settings['arise_secondary_url'];
	global $arise_excerpt_length;
	$arise_page_sliders_display = '';
	$arise_total_page_no 		= 0; 
	$arise_list_page				= array();
	for( $i = 1; $i <= $arise_settings['arise_slider_no']; $i++ ){
		if( isset ( $arise_settings['arise_featured_page_slider_' . $i] ) && $arise_settings['arise_featured_page_slider_' . $i] > 0 ){
			$arise_total_page_no++;
			$arise_list_page	=	array_merge( $arise_list_page, array( esc_attr($arise_settings['arise_featured_page_slider_' . $i] )) );
		}
	}
		if ( !empty( $arise_list_page ) && $arise_total_page_no > 0 ) {
			$arise_page_sliders_display 	.= '<div class="main-slider"> <div class="layer-slider">';
					$get_featured_posts 		= new WP_Query(array( 'posts_per_page'=> $arise_settings['arise_slider_no'], 'post_type' => array('page'), 'post__in' => $arise_list_page, 'orderby' => 'post__in', ));
			$i = 0;
			while ($get_featured_posts->have_posts()):$get_featured_posts->the_post();
			$attachment_id = get_post_thumbnail_id();
			$image_attributes = wp_get_attachment_image_src($attachment_id,'arise_slider_image');
						$i++;
						$title_attribute       	 	 = apply_filters('the_title', get_the_title($post->ID));
						$excerpt               	 	 = get_the_excerpt();
						if (1 == $i) {$classes   	 = "slides show-display";} else { $classes = "slides hide-display";}
				$arise_page_sliders_display    	.= '<div class="'.$classes.'">';
				if ($image_attributes) {
					$arise_page_sliders_display 	.= '<div class="image-slider clearfix" title="'.the_title('', '', false).'"' .' style="background-image:url(' ."'" .esc_url($image_attributes[0])."'" .')">';
				}
				if ($title_attribute != '' || $excerpt != '') {
					$arise_page_sliders_display 	.= '<div class="container">
				<article class="slider-content clearfix">';
				$remove_link = $arise_settings['arise_slider_link'];
					if($remove_link == 0){
						if ($title_attribute != '') {
							$arise_page_sliders_display .= '<h2 class="slider-title"><a href="'.esc_url(get_permalink()).'" title="'.the_title('', '', false).'" rel="bookmark">'.get_the_title().'</a></h2><!-- .slider-title -->';
						}
					}else{
						$arise_page_sliders_display .= '<h2 class="slider-title">'.get_the_title().'</h2><!-- .slider-title -->';
					}
					if ($excerpt != '') {
						$excerpt_text = $arise_settings['arise_tag_text'];
						$arise_page_sliders_display .= '<div class="slider-text">';
						$arise_page_sliders_display .= '<h3 class="featured-content">'.wp_strip_all_tags($excerpt).' </h3></div><!-- end .slider-text -->';
						$arise_page_sliders_display .= '<div class="slider-buttons">';
						if($arise_settings['arise_slider_button'] == 0){
							if($excerpt_text == '' || $excerpt_text == 'Read More') :
								$arise_page_sliders_display 	.= '<a title='.'"'.get_the_title(). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="btn-default vivid">'.__('Read More', 'arise').'</a>';
							else:
							$arise_page_sliders_display 	.= '<a title='.'"'.get_the_title(). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="btn-default vivid">'.$arise_settings[ 'arise_tag_text' ].'</a>';
							endif;
								}
							if(!empty($slider_custom_text)){
							$arise_page_sliders_display 	.= '<a title="'.esc_attr($slider_custom_text).'"' .' href="'.esc_url($slider_custom_url). '"'. ' class="btn-default light" target="_blank">'.esc_attr($slider_custom_text). '</a>';
						}
						$arise_page_sliders_display 	.='</div>';
						}
						$arise_page_sliders_display 	.='</article><!-- end .slider-content --> </div><!-- end .container -->';
				}
				if ($image_attributes) {
					$arise_page_sliders_display 	.='</div><!-- end .image-slider -->';
				}
				$arise_page_sliders_display 	.='</div><!-- end .slides -->';
			endwhile;
			wp_reset_postdata();
			$arise_page_sliders_display .= '</div>	  <!-- end .layer-slider -->
					<a class="slider-prev" id="prev2" href="#"></a> <a class="slider-next" id="next2" href="#"></a>
  <nav class="slider-button" role="navigation" aria-label="'.esc_attr__('Slider Nav','arise').'"> </nav>
  <!-- end .slider-button -->
</div>
<!-- end .main-slider -->';
		}
				echo $arise_page_sliders_display;
}

/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
function arise_scripts() {
	$arise_settings = arise_get_theme_options();
	wp_enqueue_style( 'arise-style', get_stylesheet_uri() );
	wp_enqueue_script('jquery_cycle_all', get_template_directory_uri().'/js/jquery.cycle.all.js', array('jquery'), '3.0.3', true);
	
	wp_register_style( 'arise_google_fonts', '//fonts.googleapis.com/css?family=Roboto:400,300,500,700' ); 

	$enable_slider = $arise_settings['arise_enable_slider'];
	$arise_stick_menu = $arise_settings['arise_stick_menu'];
		wp_enqueue_script('arise_slider', get_template_directory_uri().'/js/arise-slider-setting.js', array('jquery_cycle_all'), false, true);
	wp_enqueue_script('arise-main', get_template_directory_uri().'/js/arise-main.js', array('jquery'));
	if($arise_stick_menu != 1):
	wp_enqueue_script('sticky-scroll', get_template_directory_uri().'/js/arise-sticky-scroll.js', array('jquery'));
	endif;
	wp_enqueue_script('arise-navigation', get_template_directory_uri().'/js/navigation.js', array('jquery'), false, true);
	wp_enqueue_script('arise-quote-slider', get_template_directory_uri().'/js/arise-quote-slider.js', array('jquery'),'4.2.2', true);
	wp_enqueue_script('arise-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array('jquery'), false, true);
	wp_enqueue_style( 'arise_google_fonts' );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	if( $arise_settings['arise_responsive'] == 'on' ) {
		wp_enqueue_style('arise-responsive', get_template_directory_uri().'/css/responsive.css');
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'arise_scripts' );

/*************************** Importing Custom CSS to the core option added in WordPress 4.7. ****************************************/
function arise_custom_css_migrate(){
$ver = get_theme_mod( 'custom_css_version', false );
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$arise_settings = arise_get_theme_options();
		if ( $arise_settings['arise_custom_css'] != '' ) {
			$arise_core_css = wp_get_custom_css(); // Preserve css which is added from core
			$return   = wp_update_custom_css_post( $arise_core_css . $arise_settings['arise_custom_css'] );
			if ( ! is_wp_error( $return ) ) {
				unset( $arise_settings['arise_custom_css'] );
				set_theme_mod( 'arise_theme_options', $arise_settings );
				set_theme_mod( 'custom_css_version', '4.7' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'arise_custom_css_migrate' );