<?php
$title= $content = $image = $icon = $read_more_link= $read_more_text = $align = $ct_font_heading = $style_font_heading ='' ;
$title = $instance['title_group']['title'];
$content = $instance['desc_group']['content'];
$align = $instance['text_align_sc'];
// custom font heading
$ct_font_heading .= ( $instance['title_group']['color_title'] != '' ) ? 'color: ' . $instance['title_group']['color_title'] . ';' : '';
if ( $instance['title_group']['font_heading'] == 'custom' ) {
    $ct_font_heading .= ( $instance['title_group']['custom_heading']['custom_font_size'] != '' ) ? 'font-size: ' . $instance['title_group']['custom_heading']['custom_font_size'] . 'px;' : '';
    $ct_font_heading .= ( $instance['title_group']['custom_heading']['custom_font_weight'] != '' ) ? 'font-weight: ' . $instance['title_group']['custom_heading']['custom_font_weight'] . ';' : '';
    $ct_font_heading .= ( $instance['title_group']['custom_heading']['custom_text_transform'] != '' ) ? 'text-transform: ' . $instance['title_group']['custom_heading']['custom_text_transform'] . ';' : '';
    $ct_font_heading .= ( $instance['title_group']['custom_heading']['custom_mg_bt'] != '' ) ? 'margin-bottom: ' . $instance['title_group']['custom_heading']['custom_mg_bt'] . 'px;' : '';
}
if ( $ct_font_heading ) {
    $style_font_heading = 'style="' . $ct_font_heading . '"';
}
//Description
if ( $instance['desc_group']['content'] != '' ) {
    $color_desc .= ( $instance['desc_group']['color_description'] ) ? 'color: ' . $instance['desc_group']['color_description'] . ';' : '';
    $color_desc .= ( $instance['desc_group']['custom_font_size_des'] ) ? 'font-size: ' . $instance['desc_group']['custom_font_size_des'] . 'px;':'';
    $color_desc .= ( $instance['desc_group']['custom_font_weight'] ) ? 'font-weight: ' . $instance['desc_group']['custom_font_weight'] . ';' : '';
    $color_desc .= ( $instance['desc_group']['margin_bottom'] != '' ) ? 'margin-bottom: ' . $instance['desc_group']['margin_bottom'] . 'px;' : '';
    if ( $color_desc <> '' ) {
        $style_color_desc = 'style="' . $color_desc . '"';
    }
}

//image
$image = wp_get_attachment_image_src( $instance['image'], 'full' );
$img_icon_size = @getimagesize( $image[0] );


echo '<div class="menu-details ' . $align . '">';
   echo ' <div class="content-image">';
       echo '<img  src="' . $image[0] . '" ' . $img_icon_size[3] . ' alt="" />';
        if ( $instance['show_icon'] ) {
            $images_url = wp_get_attachment_image_src( $instance['icon_image'], 'full' );
            $icon       = '<img src="' . $images_url['0'] . '">';
            echo ' <div class="box">'.$icon.'</div>';
        }
   echo ' </div>';
   echo ' <div class="content-des">';
        echo '<' . $instance['title_group']['size'] . ' class="title" ' . $style_font_heading . '>'. $title .'</' . $instance['title_group']['size'] . '>';
        echo '<p class="description" ' . $style_color_desc . '>'.$content.'</p>';
    // Display Read More
    $read_more  = $read_more_style = '';
    $read_more_link  = $instance['read_more_group']['link'];
    $read_more_text = $instance['read_more_group']['read_text'];
    $color_fill = '#fff';
    $color_fill = ( $instance['read_more_group']['read_more_text_color'] != '' ) ? $instance['read_more_group']['read_more_text_color'] . '' : '#fff';
    $read_more .= ( $instance['read_more_group']['bg_read_more_text'] != '' ) ? 'background-color: ' . $instance['read_more_group']['bg_read_more_text'] . ';' : '';
    $read_more .= ( $instance['read_more_group']['read_more_text_color'] != '' ) ? 'color: ' . $instance['read_more_group']['read_more_text_color'] . ';' : '';
    $read_more .= ( $instance['read_more_group']['border_read_more_color'] != '' ) ? 'border-color: ' . $instance['read_more_group']['border_read_more_color'] . ';' : '';
    $read_more .= ( $instance['read_more_group']['read_more_font_size'] != '' ) ? 'font-size: ' . $instance['read_more_group']['read_more_font_size'] . 'px; line-height: ' . $instance['read_more_group']['read_more_font_size'] . 'px;' : '';
    $read_more .= ( $instance['read_more_group']['read_more_font_weight'] != '' ) ? 'font-weight: ' . $instance['read_more_group']['read_more_font_weight'] . ';' : '';
    if ( $read_more ) {
        $read_more_style = ' style="' . $read_more . '"';
    }

    if ( $read_more_link ) {
        echo '<a class="read-more menu-btn" href="' . $instance['read_more_group']['link']. '" ' . $read_more_style . ' ' . $data_color . '>'.$read_more_text.'</a>';
    }
    echo '</div>';
echo '</div>';