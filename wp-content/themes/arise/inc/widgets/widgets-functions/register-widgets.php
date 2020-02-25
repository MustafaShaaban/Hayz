<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/**************** ARISE REGISTER WIDGETS ***************************************/
add_action('widgets_init', 'arise_widgets_init');
function arise_widgets_init() {
	register_widget( "arise_contact_widgets" );
	register_widget("arise_parallax_widget");
	register_widget("arise_post_widget");
	register_widget("arise_parallax_video_widget");
	register_widget("arise_widget_testimonial" );
	register_widget("arise_portfolio_widget");

	register_sidebar(array(
			'name' => __('Main Sidebar', 'arise'),
			'id' => 'arise_main_sidebar',
			'description' => __('Shows widgets at Main Sidebar.', 'arise'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('Display Contact Info at Header ', 'arise'),
			'id' => 'arise_header_info',
			'description' => __('Shows widgets on all page.', 'arise'),
			'before_widget' => '<div id="%1$s" class="info clearfix">',
			'after_widget' => '</div>',
		));

	register_sidebar(array(
			'name' => __('Front Page Section', 'arise'),
			'id' => 'arise_corporate_page_sidebar',
			'description' => __('Shows widgets on Front Page. You may use some of this widgets: TF: Featured Recent Work, TF: Testimonial, TF: Slogan', 'arise'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('Contact Page Sidebar', 'arise'),
			'id' => 'arise_contact_page_sidebar',
			'description' => __('Shows widgets on Contact Page Template.', 'arise'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Shortcode For Contact Page', 'arise'),
			'id' => 'arise_form_for_contact_page',
			'description' => __('Add Contact Form 7 Shortcode using text widgets Ex: [contact-form-7 id="137" title="Contact form 1"]', 'arise'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	global $arise_settings;
	$arise_settings = wp_parse_args( get_option( 'arise_theme_options', array() ), arise_get_option_defaults_values() );
	for($i =1; $i<= $arise_settings['arise_footer_column_section']; $i++){
	register_sidebar(array(
			'name' => __('Footer Column ', 'arise') . $i,
			'id' => 'arise_footer_'.$i,
			'description' => __('Shows widgets at Footer Column ', 'arise').$i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}
	register_sidebar(array(
			'name' => __('WooCommerce Sidebar', 'arise'),
			'id' => 'arise_woocommerce_sidebar',
			'description' => __('Add WooCommerce Widgets Only', 'arise'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
}