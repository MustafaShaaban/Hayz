<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package thim
 */
?><!DOCTYPE html>
<?php
global $theme_options_data;
?>
<html <?php language_attributes(); ?> <?php
if ( isset( $theme_options_data['thim_rtl_support'] ) && $theme_options_data['thim_rtl_support'] == '1' ) {
	echo "dir=\"rtl\"";
} ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
	<?php
	$custom_sticky = $class_header = '';
	if ( isset( $theme_options_data['thim_config_att_sticky'] ) && $theme_options_data['thim_config_att_sticky'] == 'sticky_custom' ) {
		$custom_sticky .= ' bg-custom-sticky';
	}
	if ( isset( $theme_options_data['thim_header_sticky'] ) && $theme_options_data['thim_header_sticky'] == 1 ) {
		$custom_sticky .= ' sticky-header';
	}
	if ( isset( $theme_options_data['thim_header_position'] ) ) {
		$custom_sticky .= ' ' . $theme_options_data['thim_header_position'];
		$class_header .= ' wrapper-' . $theme_options_data['thim_header_position'];
	}
	if ( isset( $theme_options_data['thim_header_style'] ) ) {
		$custom_sticky .= ' ' . $theme_options_data['thim_header_style'];
		$class_header .= ' wrapper-' . $theme_options_data['thim_header_style'];
	}
	// favicon
	if ( isset( $theme_options_data['thim_favicon'] ) && $theme_options_data['thim_favicon'] ) {
		$thim_favicon     = $theme_options_data['thim_favicon'];
		$thim_favicon_src = $thim_favicon; // For the default value
		if ( is_numeric( $thim_favicon ) ) {
			$favicon_attachment = wp_get_attachment_image_src( $thim_favicon, 'full' );
			$thim_favicon_src   = $favicon_attachment[0];
		}
	} else {
		$thim_favicon_src = get_template_directory_uri() . "/images/favicon.png";
	}
	?>
	<link rel="shortcut icon" href=" <?php echo esc_url( $thim_favicon_src ); ?>" type="image/x-icon" />
	<?php
	wp_head();
	?>
</head>
<?php flush(); ?>
<body <?php body_class( $class_header ); ?>>
<?php 
$class_loader = '';
if ( isset( $theme_options_data['thim_preload'] ) && $theme_options_data['thim_preload'] == '1' ) { 
	$class_loader = '';
} else {
	$class_loader = 'display: none';
} ?>
<div id="ip-container" class="ip-container" style="<?php echo esc_attr($class_loader); ?>">
	<div class="ip-header">
		<h1 class="ip-logo">
			<?php if ( isset( $theme_options_data['thim_custom_preload_image'] ) && $theme_options_data['thim_custom_preload_image'] <> '' ) {
				$preload_image = wp_get_attachment_image_src( $theme_options_data['thim_custom_preload_image'], 'full' );
				echo '<img src="' . esc_url( $preload_image[0] ) . '" alt="Resca"/>';
			} else {
				echo '<img src="http://resca.thimpress.com/wp-content/uploads/2015/07/resca.png" alt="Resca"/>';
			}
			?>
			<?php if ( isset( $theme_options_data['thim_custom_preload_title'] ) && $theme_options_data['thim_custom_preload_title'] <> '' ) {
				$preload_title = $theme_options_data['thim_custom_preload_title'];
				echo '<span>' . esc_html( $preload_title ) . '</span>';
			} else {
				echo '<span><?php esc_html__( "Restaurant & Cafe", "resca" ); ?></span>';
			} ?>
		</h1>
		<div class="ip-loader">
			<svg class="ip-inner" width="60px" height="60px" viewBox="0 0 80 80">
				<path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z" />
				<path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z" />
			</svg>
		</div>
	</div>
</div>
<div id="wrapper-container" class="wrapper-container">
	<nav class="visible-xs mobile-menu-container mobile-effect" role="navigation">
		<?php get_template_part( 'inc/header/mobile-menu' ); ?>
	</nav>
	<div class="content-pusher <?php thim_site_layout() ?>">
		<header id="masthead" class="site-header affix-top<?php echo esc_attr( $custom_sticky ); ?>">
			<?php
			// Drawer
			if ( isset( $theme_options_data['thim_show_drawer'] ) && $theme_options_data['thim_show_drawer'] == '1' && is_active_sidebar( 'drawer_top' ) ) {
				get_template_part( 'inc/header/drawer' );
			}
			if ( isset( $theme_options_data['thim_header_style'] ) && $theme_options_data['thim_header_style'] ) {
				get_template_part( 'inc/header/' . $theme_options_data['thim_header_style'] );
			} else {
				get_template_part( 'inc/header/header_v1' );
			}
			?>
		</header>
		<div id="main-content">

