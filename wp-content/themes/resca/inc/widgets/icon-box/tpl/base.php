<?php

/* setup hover color */
$data_color = $boxes_icon_style = $thim_animation = "";
$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );

if ( $instance['color_group']['icon_hover_color'] <> '' ) {
	$data_color .= ' data-icon="' . $instance['color_group']['icon_hover_color'] . '"';
}
if ( $instance['color_group']['icon_border_color_hover'] <> '' ) {
	$data_color .= ' data-icon-border="' . $instance['color_group']['icon_border_color_hover'] . '"';
}
if ( $instance['color_group']['icon_bg_color_hover'] <> '' ) {
	$data_color .= ' data-icon-bg="' . $instance['color_group']['icon_bg_color_hover'] . '"';
}

if ( $instance['read_more_group']['button_read_more_group']['bg_read_more_text_hover'] <> '' ) {
	$data_color .= ' data-btn-bg="' . $instance['read_more_group']['button_read_more_group']['bg_read_more_text_hover'] . '"';
}
if ( $instance['read_more_group']['button_read_more_group']['read_more_text_color_hover'] <> '' ) {
	$data_color .= ' data-text-readmore="' . $instance['read_more_group']['button_read_more_group']['read_more_text_color_hover'] . '"';
}

// custom font heading
$ct_font_heading = $style_font_heading = '';
$ct_font_heading .= ( $instance['title_group']['color_title'] != '' ) ? 'color: ' . $instance['title_group']['color_title'] . ';' : '';
if ( $instance['title_group']['font_heading'] == 'custom' ) {
	$ct_font_heading .= ( $instance['title_group']['custom_heading']['custom_font_size'] != '' ) ? 'font-size: ' . $instance['title_group']['custom_heading']['custom_font_size'] . 'px; line-height: ' . $instance['title_group']['custom_heading']['custom_font_size'] . 'px;' : '';
	$ct_font_heading .= ( $instance['title_group']['custom_heading']['custom_font_weight'] != '' ) ? 'font-weight: ' . $instance['title_group']['custom_heading']['custom_font_weight'] . ';' : '';
	$ct_font_heading .= ( $instance['title_group']['custom_heading']['custom_mg_bt'] != '' ) ? 'margin-bottom: ' . $instance['title_group']['custom_heading']['custom_mg_bt'] . 'px;' : '';
}
if ( $ct_font_heading ) {
	$style_font_heading = 'style="' . $ct_font_heading . '"';
}
/* end setup hover color */

// icon style
$icon_style = $boxes_icon_style = '';
$icon_style .= ( $instance['color_group']['icon_bg_color'] != '' ) ? 'background-color: ' . $instance['color_group']['icon_bg_color'] . ';' : '';
$icon_style .= ( $instance['color_group']['icon_border_color'] != '' ) ? 'border-color:' . $instance['color_group']['icon_border_color'] . ';' : '';
$icon_style .= ( $instance['width_icon_box'] != '' ) ? 'width: ' . $instance['width_icon_box'] . 'px;height: ' . $instance['width_icon_box'] . 'px;' : '';
if ( $icon_style ) {
	$boxes_icon_style = 'style="' . $icon_style . '"';
}
// end icon style

// read more button css
$read_more = $read_more_style = '';
$read_more .= ( $instance['read_more_group']['button_read_more_group']['border_read_more_text'] != '' ) ? 'border-color: ' . $instance['read_more_group']['button_read_more_group']['border_read_more_text'] . ';' : '';
$read_more .= ( $instance['read_more_group']['button_read_more_group']['bg_read_more_text'] != '' ) ? 'background-color: ' . $instance['read_more_group']['button_read_more_group']['bg_read_more_text'] . ';' : '';
$read_more .= ( $instance['read_more_group']['button_read_more_group']['read_more_text_color'] != '' ) ? 'color: ' . $instance['read_more_group']['button_read_more_group']['read_more_text_color'] . ';' : '';
if ( $read_more ) {
	$read_more_style = ' style="' . $read_more . '"';
}
// end
// video background
$bg_video = $poster = $class_bg_video = $icon_play = '';
if ( $instance['self_poster'] != '' ) {
	$poster = ' poster="' . wp_get_attachment_url( $instance['self_poster'] ) . '"';
}
if ( $instance['widget_background'] == 'bg_video' && $instance['self_video'] != '' ) {
	$src            = wp_get_attachment_url( $instance['self_video'] );
	$bg_video       = '<video loop muted="true" ' . $poster . ' class="full-screen-video">
					  <source src="' . $src . '" type="video/mp4">
  				</video>';
	$class_bg_video = ' background-video';
	$icon_play      = '<span class="bg-video-play"></span>';
}

$prefix = '<div class="wrapper-box-icon' . $class_bg_video . ' ' . $instance['layout_group']['text_align_sc'] . ' ' . $instance['layout_group']['box_icon_style'] . $thim_animation . '" ' . $data_color . '>';
$suffix = '</div>';
//wrapper-box-icon

// Set link to Box
$more_link = $link_prefix = $link_sufix = '';
if ( $instance['read_more_group']['link'] != 'complete_box' ) {
	if ( $instance['read_more_group']['read_more'] == '' ) {
		$prefix .= '<a class="icon-box-link" href="' . $instance['read_more_group']['link'] . '"></a>';
	}
	// Display Read More
	if ( $instance['read_more_group']['read_more'] == 'more' ) {
		$more_link = '<a class="smicon-read sc-btn" href="' . $instance['read_more_group']['link'] . '" ' . $read_more_style . ' >';
		$more_link .= $instance['read_more_group']['button_read_more_group']['read_text'];
		$more_link .= '</a>';
	}
	//Box Title
	if ( $instance['read_more_group']['read_more'] == 'title' ) {
		$link_prefix .= '<a class="smicon-box-link" href="' . $instance['read_more_group']['link'] . '">';
		$link_sufix .= '</a>';
	}
}
// end
$boxes_content_style = $content_style = '';
if ( $instance['layout_group']['pos'] != 'top' ) {
	$boxes_content_style .= ( $instance['width_icon_box'] != '' && $instance['font_awesome_group']['icon'] != 'none' ) ? 'width: calc( 100% - ' . $instance['width_icon_box'] . 'px - 15px);' : '';
}
if ( $boxes_content_style ) {
	$content_style = ' style="' . $boxes_content_style . '"';
}

// translate 
//$instance['desc_group']['content'] 	= apply_filters( 'widget_text', $instance['desc_group']['content'], $instance );
//$instance['sub-title'] 				= apply_filters( 'widget_text', $instance['sub-title'], $instance );
//$instance['title_group']['title'] 	= apply_filters( 'widget_text', $instance['title_group']['title'], $instance );
if( function_exists('wpml_translate_single_string') ) {
	$instance['desc_group']['content'] 	= apply_filters( 'wpml_translate_single_string', $instance['desc_group']['content'], 'Widgets', $this->id.'-content' );
	$instance['sub-title'] 				= apply_filters( 'wpml_translate_single_string', $instance['sub-title'], 'Widgets', $this->id.'-sub-title' );
	$instance['title_group']['title'] 	= apply_filters( 'wpml_translate_single_string', $instance['title_group']['title'], 'Widgets', $this->id.'-title' );
} else {
	$instance['desc_group']['content'] 	= __( $instance['desc_group']['content'] );
	$instance['sub-title'] 				= __( $instance['sub-title'] );
	$instance['title_group']['title'] 	= __( $instance['title_group']['title'] );
}

// show title
$html_title = $border_bottom_title = $border_bottom_title_style = $subtitle = $class_separator = '';
$border_bottom_title_style .= ( $instance['title_group']['color_title'] != '' ) ? 'style="background-color: ' . $instance['title_group']['color_title'] . '""' : '';
if ( $instance['title_group']['line_after_title'] == '1' ) {
	$border_bottom_title = '<span class="line-heading" ' . $border_bottom_title_style . '></span>';
	$class_separator     = ' wrapper-line-heading';
}

if ( isset( $instance['sub-title'] ) && $instance['sub-title'] <> '' ) {
	$subtitle = '<p class="heading__secondary">' . $instance['sub-title'] . '</p>';
}

if ( $instance['title_group']['title'] != '' ) {
	$html_title .= '<div class="sc-heading article_heading">';
	$html_title .= $subtitle;
	$html_title .= '<' . $instance['title_group']['size'] . ' class = "heading__primary' . $class_separator . '" ' . $style_font_heading . '>';
	$html_title .= $link_prefix . $instance['title_group']['title'] . $link_sufix;
	$html_title .= $border_bottom_title . '</' . $instance['title_group']['size'] . '></div>';
}
// end show title

/* show icon or custom icon */
$html_icon = $icon_layout = '';
if ( $instance['layout_group']['box_icon_style'] ) {
	$icon_layout = ' ' . $instance['layout_group']['box_icon_style'];
}
if ( $instance['icon_type'] == 'font-awesome' ) {
	if ( $instance['font_awesome_group']['icon'] == '' ) {
		$instance['font_awesome_group']['icon'] = 'none';
	}
	if ( $instance['font_awesome_group']['icon'] != 'none' ) {
		$html_icon .= '<div class="boxes-icon' . $icon_layout . '" ' . $boxes_icon_style . '><span class="inner-icon"><span class="icon">';
		$class = 'fa fa-' . $instance['font_awesome_group']['icon'];
		$style = '';
		$style .= ( $instance['color_group']['icon_color'] != '' ) ? 'color:' . $instance['color_group']['icon_color'] . ';' : '';
		$style .= ( $instance['font_awesome_group']['icon_size'] != '' ) ? ' font-size:' . $instance['font_awesome_group']['icon_size'] . 'px; line-height:' . $instance['font_awesome_group']['icon_size'] . 'px; vertical-align: middle;' : '';
		$html_icon .= '<i class="' . $class . '" style="' . $style . '"></i>';
		$html_icon .= '</span></span></div>';
	}
} else {
	if ( $instance['icon_type'] == 'font-7-stroke' ) {
		if ( $instance['font_7_stroke_group']['icon'] == '' ) {
			$instance['font_7_stroke_group']['icon'] = 'none';
		}
		if ( $instance['font_7_stroke_group']['icon'] != 'none' ) {
			$html_icon .= '<div class="boxes-icon' . $icon_layout . '" ' . $boxes_icon_style . '><span class="inner-icon"><span class="icon">';
			$class = 'pe-7s-' . $instance['font_7_stroke_group']['icon'];
			$style = '';
			$style .= ( $instance['color_group']['icon_color'] != '' ) ? 'color:' . $instance['color_group']['icon_color'] . ';' : '';
			$style .= ( $instance['font_7_stroke_group']['icon_size'] != '' ) ? ' font-size:' . $instance['font_7_stroke_group']['icon_size'] . 'px; line-height:' . $instance['font_7_stroke_group']['icon_size'] . 'px; vertical-align: middle;' : '';
			$html_icon .= '<i class="' . $class . '" style="' . $style . '"></i>';
			$html_icon .= '</span></span></div>';
		}
	} else {
		$img = wp_get_attachment_image_src( $instance['font_image_group']['icon_img'], 'full' );
		$html_icon .= '<div class="boxes-icon' . $icon_layout . '" ' . $boxes_icon_style . '><span class="inner-icon"><span class="icon icon-images">';
		$img_icon_size = '';
		$img_icon_size = @getimagesize( $img[0] );
		$html_icon .= '<img src="' . $img[0] . '" ' . $img_icon_size[3] . ' alt="" />';
		$html_icon .= '</span></span></div>';
	}
}
/* end show icon or custom icon */

/* show CONTENT*/
$html_content = $color_desc = $line_height = '';
if ( $instance['desc_group']['content'] != '' ) {
	
	if ( $instance['desc_group']['custom_font_size_des'] ) {
		$line_height = (int) $instance['desc_group']['custom_font_size_des'] + 7;
	}
	$color_desc .= ( $instance['desc_group']['color_description'] ) ? 'color: ' . $instance['desc_group']['color_description'] . ';' : '';
	$color_desc .= ( $instance['desc_group']['custom_font_size_des'] ) ? 'font-size: ' . $instance['desc_group']['custom_font_size_des'] . 'px;' : '';
	$color_desc .= ( $instance['desc_group']['custom_font_weight'] ) ? 'font-weight: ' . $instance['desc_group']['custom_font_weight'] . ';' : '';
	$color_desc .= ( $line_height ) ? 'line-height: ' . $line_height . 'px;' : '';
	if ( $color_desc <> '' ) {
		$color_desc = 'style="' . $color_desc . '"';
	}
	$html_content .= '<div class="desc-icon-box">';
	$html_content .= ( $instance['desc_group']['content'] != '' ) ? '<p ' . $color_desc . '>' . $instance['desc_group']['content'] . '</p>' : '';
	
	$html_content .= $more_link;
	$html_content .= "</div>";
}

// html
//start div wrapper-box-icon
$html = $prefix;
$html .= '<div class="smicon-box icon-' . $instance['layout_group']['pos'] . '">';
// show icon
$html .= $html_icon;
// show title
$html .= '<div class="content-inner" ' . $content_style . '>';
$html .= $html_title;

// show content
$html .= $html_content;
$html .= $icon_play;
$html .= '</div>';
$html .= '</div><!--end smicon-box-->';
$html .= $suffix;
$html .= $bg_video;
echo ent2ncr( $html );