<?php
/**
 * Display all arise functions and definitions
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */

/************************************************************************************************/
if ( ! function_exists( 'arise_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function arise_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
			$content_width=790;
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on arise, use a find and replace
	 * to change 'arise' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'arise', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-thumbnails');

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in three location.
	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'arise' ),
		'topmenu' => __( 'Top Menu', 'arise' ),
		'social-link'  => __( 'Add Social Icons Only', 'arise' ),
	) );
	add_image_size('arise_slider_image', 1920, 1080, true);

	/*
	 * Switch default core markup for comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

		add_theme_support( 'gutenberg', array(
			'colors' => array(
				'#2b9b9b',
			),
		) );
	add_theme_support( 'align-wide' );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'arise_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', '//fonts.googleapis.com/css?family=Roboto:400,300,500,700' ) );

	/**
	* Making the theme Woocommrece compatible
	*/

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
endif; // arise_setup
add_action( 'after_setup_theme', 'arise_setup' );

/***************************************************************************************/
function arise_content_width() {
	if ( is_page_template( 'page-templates/gallery-template.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1170;
	}
}
add_action( 'template_redirect', 'arise_content_width' );

/***************************************************************************************/
if(!function_exists('arise_get_theme_options')):
	function arise_get_theme_options() {
	    return wp_parse_args(  get_option( 'arise_theme_options', array() ),  arise_get_option_defaults_values() );
	}
endif;

if (!is_child_theme()){

	require get_template_directory() . '/inc/welcome-notice.php';

}

/***************************************************************************************/
require get_template_directory() . '/inc/customizer/arise-default-values.php';
require( get_template_directory() . '/inc/settings/arise-functions.php' );
require( get_template_directory() . '/inc/settings/arise-common-functions.php' );
require get_template_directory() . '/inc/jetpack.php';

/************************ Arise Widgets  *****************************/
require get_template_directory() . '/inc/widgets/widgets-functions/contactus-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/parallax-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/post-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/register-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/video-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/testimonials-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/portfolio-widgets.php';

/************************ Arise Customizer  *****************************/
require get_template_directory() . '/inc/customizer/functions/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/functions/register-panel.php';
function arise_customize_register( $wp_customize ) {
if(!class_exists('Arise_Plus_Features')){
	class Arise_Customize_Arise_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
			<a title="<?php esc_attr_e( 'Review Arise', 'arise' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/arise/' ); ?>" target="_blank" id="about_arise">
			<?php _e( 'Review Arise', 'arise' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://themefreesia.com/theme-instruction/arise/' ); ?>" title="<?php esc_attr_e( 'Theme Instructions', 'arise' ); ?>" target="_blank" id="about_arise">
			<?php _e( 'Theme Instructions', 'arise' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://tickets.themefreesia.com/' ); ?>" title="<?php esc_attr_e( 'Support Ticket', 'arise' ); ?>" target="_blank" id="about_arise">
			<?php _e( 'Forum', 'arise' ); ?>
			</a><br/>
			<a href="<?php echo esc_url( 'https://demo.themefreesia.com/arise/' ); ?>" title="<?php esc_attr_e( 'View Demo', 'arise' ); ?>" target="_blank" id="about_arise">
			<?php _e( 'View Demo', 'arise' ); ?>
			</a><br/>
			<a href="<?php echo esc_url(home_url('/')).'wp-admin/theme-install.php?search=author:themefreesia'; ?>" title="<?php esc_attr_e( 'View ThemeFreesia Themes', 'arise' ); ?>" target="_blank" id="about_arise">
                <?php _e( 'View ThemeFreesia Themes', 'arise' ); ?>
            </a><br/>
		<?php
		}
	}
	$wp_customize->add_section('arise_upgrade_links', array(
		'title'					=> __('About Arise', 'arise'),
		'priority'				=> 2,
	));
	$wp_customize->add_setting( 'arise_upgrade_links', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new Arise_Customize_Arise_upgrade(
		$wp_customize,
		'arise_upgrade_links',
			array(
				'section'				=> 'arise_upgrade_links',
				'settings'				=> 'arise_upgrade_links',
			)
		)
	);
}
	require get_template_directory() . '/inc/customizer/functions/design-options.php';
	require get_template_directory() . '/inc/customizer/functions/theme-options.php';
	require get_template_directory() . '/inc/customizer/functions/frontpage-features.php';
	require get_template_directory() . '/inc/customizer/functions/featured-content-customizer.php' ;
}

add_action( 'customize_register', 'arise_customize_register' );
add_action( 'customize_preview_init', 'arise_customize_preview_js' );
if(!class_exists('Arise_Plus_Features')){
	// Add Upgrade to Pro Button.
	require_once( trailingslashit( get_template_directory() ) . 'inc/upgrade-plus/class-customize.php' );
}
/**************************************************************************************/
function arise_hide_previous_custom_css( $wp_customize ) { 
	// Bail if not WP 4.7. 
	if ( ! function_exists( 'wp_get_custom_css_post' ) ) { 
		return; 
	} 
		$wp_customize->remove_control( 'arise_theme_options[arise_custom_css]' ); 
} 
add_action( 'customize_register', 'arise_hide_previous_custom_css'); 
/**************************************************************************************/

// Add Post Class Clearfix
function arise_post_class_clearfix( $classes ) {
	$classes[] = 'clearfix';
	return $classes;
}
add_filter( 'post_class', 'arise_post_class_clearfix' );

/******************* Front Page *************************/
function arise_display_front_page(){
	require get_template_directory() . '/index.php';
}

add_action('arise_show_front_page','arise_display_front_page');

/******************* Arise Header Display *************************/
function arise_header_display(){
	$arise_settings = arise_get_theme_options();
	$header_display = $arise_settings['arise_header_display'];
	$header_logo = $arise_settings['arise-img-upload-header-logo'];
	if ($header_display == 'header_logo' || $header_display == 'header_text' || $header_display == 'show_both')	{
		echo '<div id="site-branding">';
			if($header_display != 'header_text'){ ?>
				<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <img src="<?php echo esc_url($header_logo);?>" id="site-logo" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"></a> 
			<?php }
				if (is_home() || is_front_page()){ ?>
				<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
				<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_html(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
				<?php if(is_home() || is_front_page()){ ?>
				</h1>  <!-- end .site-title -->
				<?php } else { ?> </h2> <!-- end .site-title --> <?php }

				$site_description = get_bloginfo( 'description', 'display' );
				if ($site_description){?>
					<div id="site-description"> <?php bloginfo('description');?> </div> <!-- end #site-description -->
		<?php }
		echo '</div>'; // end #site-branding
	}
}
add_action('arise_site_branding','arise_header_display');