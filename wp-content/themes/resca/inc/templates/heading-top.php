<?php
$debugmode = (isset($_GET['debugmode']) && $_GET['debugmode']==1);
global $theme_options_data, $wp_query;
/***********custom Top Images*************/
$text_color = $custom_title = $subtitle = $bg_color = $bg_header = $class_full = $text_color_header =
$bg_image = $thim_custom_heading = $cate_top_image_src = $front_title = '';

$hide_breadcrumbs = $hide_title = 0;
// color theme options
$cat_obj = $wp_query->get_queried_object();

if ( isset( $cat_obj->term_id ) ) {
	$cat_ID = $cat_obj->term_id;
} else {
	$cat_ID = "";
}

if ( get_post_type() == "product" ) {
	$prefix = 'thim_woo';
} else {
	$prefix = 'thim_archive';
}
$text_color = $bg_color = $cate_top_image_src = '';

// single and archive
if ( is_page() || is_single() ) {
	$prefix_inner = '_single_';

} else {
	if ( is_front_page() || is_home() ) {
		$prefix       = 'thim';
		$prefix_inner = '_front_page_';
		if ( isset( $theme_options_data[$prefix . $prefix_inner . 'custom_title'] ) && $theme_options_data[$prefix . $prefix_inner . 'custom_title'] <> '' ) {
			$front_title = $theme_options_data[$prefix . $prefix_inner . 'custom_title'];
		}
		$postid               = get_the_ID();
		if( is_home() ) {
			$postid = get_option( 'page_for_posts' );
		}
	} else {
		$prefix_inner = '_cate_';
	}
}
if ( get_post_type() == "tp_event" ) {
	$prefix       = 'thim';
	$prefix_inner = '_event_';
}

// get data for theme customizer
if ( isset( $theme_options_data[$prefix . $prefix_inner . 'heading_text_color'] ) && $theme_options_data[$prefix . $prefix_inner . 'heading_text_color'] <> '' ) {
	$text_color = $theme_options_data[$prefix . $prefix_inner . 'heading_text_color'];
}

if ( isset( $theme_options_data[$prefix . $prefix_inner . 'heading_bg_color'] ) && $theme_options_data[$prefix . $prefix_inner . 'heading_bg_color'] <> '' ) {
	$bg_color = $theme_options_data[$prefix . $prefix_inner . 'heading_bg_color'];
}
if ( isset( $theme_options_data[$prefix . $prefix_inner . 'custom_title'] ) && $theme_options_data[$prefix . $prefix_inner . 'custom_title'] <> '' ) {
	$custom_title = $theme_options_data[$prefix . $prefix_inner . 'custom_title'];
}
if ( isset( $theme_options_data[$prefix . $prefix_inner . 'sub_title'] ) && $theme_options_data[$prefix . $prefix_inner . 'sub_title'] <> '' ) {
	$subtitle = $theme_options_data[$prefix . $prefix_inner . 'sub_title'];
}

if ( isset( $theme_options_data[$prefix . $prefix_inner . 'top_image'] ) && $theme_options_data[$prefix . $prefix_inner . 'top_image'] <> '' ) {
	$cate_top_image     = $theme_options_data[$prefix . $prefix_inner . 'top_image'];
	$cate_top_image_src = $cate_top_image;

	if ( is_numeric( $cate_top_image ) ) {
		$cate_top_attachment = wp_get_attachment_image_src( $cate_top_image, 'full' );
		$cate_top_image_src  = $cate_top_attachment[0];
	}
}
if ( isset( $theme_options_data[$prefix . $prefix_inner . 'hide_title'] ) ) {
	$hide_title = $theme_options_data[$prefix . $prefix_inner . 'hide_title'];
}

//if ( isset( $theme_options_data[$prefix . $prefix_inner . 'hide_breadcrumbs'] ) ) {
//	$hide_breadcrumbs = $theme_options_data[$prefix . $prefix_inner . 'hide_breadcrumbs'];
//}
if( $debugmode ) {
	var_dump( is_page() || is_single() || is_home() );
	echo '<hr/>';
	var_dump(get_option( 'page_for_posts' ));
	echo '<hr/>';
	$postid = get_the_ID();
	var_dump( $postid );
	echo '<hr/>';
	$using_custom_heading = get_post_meta( $postid, 'thim_mtb_using_custom_heading', true );
	var_dump( $using_custom_heading );
	echo '<hr/>';
	wp_get_nav_menu_items();
	echo '<h1>'.__LINE__.'</h1>';
}
if ( is_page() || is_single() || is_home() ) {
	$postid               = get_the_ID();
	if( is_home() ) {
		$postid = get_option( 'page_for_posts' );
	}
	$using_custom_heading = get_post_meta( $postid, 'thim_mtb_using_custom_heading', true );
	if ( $using_custom_heading ) {
		$hide_title       = get_post_meta( $postid, 'thim_mtb_hide_title_and_subtitle', true );
//		$hide_breadcrumbs = get_post_meta( $postid, 'thim_mtb_hide_breadcrumbs', true );
		$custom_title     = get_post_meta( $postid, 'thim_mtb_custom_title', true );
		$subtitle         = get_post_meta( $postid, 'thim_subtitle', true );
		$text_color_1     = get_post_meta( $postid, 'thim_mtb_text_color', true );
		if ( $text_color_1 <> '' ) {
			$text_color = $text_color_1;
		}
		$bg_color_1 = get_post_meta( $postid, 'thim_mtb_bg_color', true );
		if ( $bg_color_1 <> '' ) {
			$bg_color = $bg_color_1;
		}

		$cate_top_image = get_post_meta( $postid, 'thim_mtb_top_image', true );
		if ( $cate_top_image ) {
			$post_page_top_attachment = wp_get_attachment_image_src( $cate_top_image, 'full' );
			$cate_top_image_src       = $post_page_top_attachment[0];
		}
	}
} else {
	$thim_custom_heading = get_tax_meta( $cat_ID, 'thim_custom_heading', true );
	if ( $thim_custom_heading == 'custom' ) {
		$text_color_1 = get_tax_meta( $cat_ID, $prefix . '_cate_heading_text_color', true );
		$bg_color_1   = get_tax_meta( $cat_ID, $prefix . '_cate_heading_bg_color', true );
		if ( $text_color_1 != '#' ) {
			$text_color = $text_color_1;
		}
		if ( $bg_color_1 != '#' ) {
			$bg_color = $bg_color_1;
		}
//		$hide_breadcrumbs = get_tax_meta( $cat_ID, $prefix . '_cate_hide_breadcrumbs', true );
		$hide_title       = get_tax_meta( $cat_ID, $prefix . '_cate_hide_title', true );
		$cate_top_image   = get_tax_meta( $cat_ID, $prefix . '_top_image', true );
		if ( $cate_top_image ) {
			$cate_top_image_src = $cate_top_image['src'];
		}
	}
}

$hide_title       = ( $hide_title == 'on' ) ? '1' : $hide_title;
 // css
$c_css_style = $css_line = '';
$c_css_style .= ( $text_color != '' ) ? 'color: ' . $text_color . ';' : '';
$c_css_style .= ( $bg_color != '' ) ? 'background-color: ' . $bg_color . ';' : '';
$css_line .= ( $text_color != '' ) ? 'background-color: ' . $text_color . ';' : '';

//css background and color
$c_css = ( $c_css_style != '' ) ? 'style="' . $c_css_style . '"' : '';

$c_css_1 = ( $bg_color != '' ) ? 'style="background-color:' . $bg_color . '"' : '';
// css inline line
$c_css_line = ( $css_line != '' ) ? 'style="' . $css_line . '"' : '';


$top_images = ( $cate_top_image_src != '' ) ? '<img alt="" src="' . $cate_top_image_src . '" /><span class="overlay-top-header" ' . $c_css . '></span>' : '';
// show title and category

?>

	<div class="top_site_main<?php if ( $top_images == '' ) {
		echo ' top-site-no-image';
	}else{echo ' images_parallax';} ?>" <?php echo ent2ncr( $c_css ); ?>  data-parallax_images="scroll" data-image-src="<?php echo esc_url($cate_top_image_src); ?>">
		<?php echo ent2ncr( $top_images ); ?>
		<div class="page-title-wrapper">
			<div class="banner-wrapper container article_heading">
				<?php
				if( $hide_title != '1' ) {
					if ( is_single() ) {
						$typography = 'h2';
					} else {
						$typography = 'h1';
					}
					if ( ( is_page() || is_single() ) && get_post_type() != 'product' ) {
						if ( is_single() ) {
							if ( get_post_type() == "portfolio" ) {
								echo '<' . $typography . ' class="heading__secondary">' . __( 'Portfolio', 'resca' ) . '</' . $typography . '>';
							} else {
								$single_title = get_the_title( get_the_ID() );

								// Get post category info
								$category = get_the_category();
								if ( ! empty( $category ) ) {
									// Get last category post is in
									$last_category = end( ( array_values( $category ) ) );
									$single_title  = $last_category->cat_name;
								}

								switch ( get_post_type() ) {

									case 'tp_event':
										$single_title = esc_html__( 'Event', 'resca' );
										break;
									default:
										# code...
										break;

								}
								echo ' <' . $typography . ' class="heading__secondary">' . $single_title;
								echo '</' . $typography . '>';
							}
						} else {
							echo '<' . $typography . ' class="heading__secondary">';
							$postid = get_the_ID();
							if ( is_home() ) {
								$postid = get_option( 'page_for_posts' );
							}
							echo ( $custom_title != '' ) ? $custom_title : get_the_title( get_the_ID() );
							echo '</' . $typography . '>';
							echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__primary ">' . $subtitle . '</p></div>' : '';
						}
					} elseif ( get_post_type() == 'product' ) {
						echo '<' . $typography . ' class="heading__secondary">';
						woocommerce_page_title();
						echo '</' . $typography . '>';
						echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__primary ">' . $subtitle . '</p></div>' : '';
					} elseif ( get_post_type() == 'tp_event' ) {
						echo '<' . $typography . ' class="heading__secondary">';
						echo ( $custom_title != '' ) ? $custom_title : esc_html__( 'Event', 'resca' );
						echo '</' . $typography . '>';
						echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__primary ">' . $subtitle . '</p></div>' : '';
					} elseif ( is_front_page() || is_home() ) {
						echo '<' . $typography . ' class="heading__secondary">';
						if ( is_home() ) {
							echo ( $custom_title != '' ) ? $custom_title : 'Blog';
						} else {
							echo ( $front_title != '' ) ? $front_title : 'Blog';
						}
						echo '</' . $typography . '>';
						echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__primary ">' . $subtitle . '</p></div>' : '';
					} else {
						echo '<' . $typography . ' class="heading__secondary">';
						thim_the_archive_title();
						echo '</' . $typography . '>';
						echo ( $subtitle != '' ) ? '<div class="banner-description"><p class="heading__primary ">' . $subtitle . '</p></div>' : '';
					}
				}
				?>
			</div>
		</div>
	</div>


<?php if ( $hide_title == '1' && $theme_options_data['thim_header_position'] == 'header_overlay' && $c_css_1 != '' ) { ?>
	<div class="top_site_main<?php if ( $top_images == '' ) {
		echo ' top-site-no-image-custom';
	} ?>" <?php echo ent2ncr( $c_css_1 ); ?>>
		<?php echo ent2ncr( $top_images ); ?>
	</div>
<?php } ?>
