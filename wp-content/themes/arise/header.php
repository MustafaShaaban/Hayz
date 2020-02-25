<?php
/**
 * Displays the header content
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$arise_settings = arise_get_theme_options(); ?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php 
	if ( function_exists( 'wp_body_open' ) ) {

		wp_body_open();

	} ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content','arise');?></a>
<!-- Masthead ============================================= -->
<header id="masthead" class="site-header" role="banner">
	<?php
			$arise_top_bar = $arise_settings['arise_top_bar'];
			if (( has_nav_menu( 'social-link' ) || has_nav_menu( 'topmenu' ) || is_active_sidebar( 'arise_header_info' )) && $arise_top_bar ==0):
				if($header_image = $arise_settings['arise_display_header_image'] == 'top'){
					do_action('arise_header_image');
				}
				echo '<div class="top-info-bar">
						<div class="container clearfix">';
							if(has_nav_menu('topmenu')):
								$args = array(
									'theme_location' => 'topmenu',
									'container'      => '',
									'items_wrap'     => '<ul>%3$s</ul>',
								);
								echo '<nav class="min-nav clearfix" role="navigation" aria-label="'. esc_attr__('Top Menu','arise').'">';
								wp_nav_menu($args);
								echo '</nav>'.'<!-- end .min-nav -->';
							endif;
							if(has_nav_menu('social-link') && $arise_settings['arise_top_social_icons'] == 0):
								echo '<div class="header-social-block">';
									do_action('social_links');
								echo '</div>'.'<!-- end .header-social-block -->';
							endif;
							if( is_active_sidebar( 'arise_header_info' )) {
								dynamic_sidebar( 'arise_header_info' );
							}
					echo '</div> <!-- end .container -->
				</div> <!-- end .top-info-bar -->';
			endif;
			if($header_image = $arise_settings['arise_display_header_image'] == 'below'){
				do_action('arise_header_image');
			} ?>
	<!-- Main Header============================================= -->
	<div id="sticky_header" class="clearfix">
		<div class="container clearfix">
		<?php do_action('arise_site_branding'); ?>
		<div class="menu-toggle">      
			<div class="line-one"></div>
			<div class="line-two"></div>
			<div class="line-three"></div>
		</div>
		<!-- Main Nav ============================================= -->
		<div class="navbar-right">
		<?php
			if (has_nav_menu('primary')) { ?>
        <?php $args = array(
			'theme_location' => 'primary',
			'container'      => '',
			'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>',
			); ?>
		<nav id="site-navigation" class="main-navigation clearfix" role="navigation" aria-label="'.esc_attr__('Main Menu','arise').'">
			<button class="menu-toggle-2" aria-controls="primary-menu" aria-expanded="false"> </button> <!-- end .menu-toggle -->
			<?php wp_nav_menu($args);//extract the content from apperance-> nav menu ?>
		</nav> <!-- end #site-navigation -->
		<?php } else {// extract the content from page menu only ?>
		<nav id="site-navigation" class="main-navigation clearfix" role="navigation" aria-label="'.esc_attr__('Main Menu','arise').'">
		<button class="menu-toggle-2" aria-controls="primary-menu" aria-expanded="false"> </button> <!-- end .menu-toggle -->
			<?php	wp_page_menu(array('menu_class' => 'menu', 'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>')); ?>
		</nav> <!-- end #site-navigation -->
		<?php }
			$search_form = $arise_settings['arise_search_custom_header'];
			if (1 != $search_form) { ?>
			<button id="search-toggle" class="header-search" type="button"></button>
			<div id="search-box" class="clearfix">
				<?php get_search_form();?>
			</div>  <!-- end #search-box -->
		<?php } ?>
		</div> <!-- end .navbar-right -->
		</div> <!-- end .container -->
	</div> <!-- end #sticky_header -->
	<div class="header-line"></div>
	<?php
		$enable_slider = $arise_settings['arise_enable_slider'];
		arise_slider_value();
		if ($enable_slider=='frontpage'|| $enable_slider=='enitresite'){
			if(is_front_page() && ($enable_slider=='frontpage') ) {
				if($arise_settings['arise_slider_type'] == 'default_slider') {
						arise_page_sliders();
				}else{
					if(class_exists('Arise_Plus_Features')):
						arise_image_sliders();
					endif;
				}
			}
			if($enable_slider=='enitresite'){
				if($arise_settings['arise_slider_type'] == 'default_slider') {
						arise_page_sliders();
				}else{
					if(class_exists('Arise_Plus_Features')):
						arise_image_sliders();
					endif;
				}
			}
		}
		if(!is_page_template('page-templates/arise-corporate.php') && !is_page_template('alter-front-page-template.php')) {
			if (('' != arise_header_title()) || function_exists('bcn_display_list')) {
				if(is_home()){ 
					echo '';
				} else { ?>
					<div class="container">
						<div class="page-header clearfix">
							<?php if ( is_front_page()) : ?>
								<h2 class="page-title"><?php echo arise_header_title(); ?></h2>
								<!-- .page-title -->
							<?php else : ?>
								<h1 class="page-title"><?php echo arise_header_title(); ?></h1>
								<!-- .page-title -->
							<?php endif; ?>
							<?php arise_breadcrumb(); ?>
						</div> <!-- .page-header -->
					</div> <!-- .container -->
				<?php }
			}
		} ?>
</header> <!-- end #masthead -->
<!-- Main Page Start ============================================= -->
<div id="content">
<?php if (!is_page_template('page-templates/arise-corporate.php') ){ 
  if(is_page_template('three-column-blog-template.php') || is_page_template('our-team-template.php') || is_page_template('about-us-template.php') || is_page_template('important-works-template.php') ){
	echo '';
	}else{?>
<div class="container clearfix">
<?php }
	}