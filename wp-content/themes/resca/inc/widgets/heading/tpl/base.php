<?php
$thim_animation = $des = $html = $css = $subtitle = $line_heading = $class = '';
$thim_animation .= thim_getCSSAnimation( $instance['css_animation'] );
if ( $instance['textcolor'] ) {
	$css .= 'color:' . $instance['textcolor'] . ';';
}

if ( $instance['font_heading'] == 'custom' ) {
	if ( $instance['custom_font_heading']['custom_font_size'] <> '' ) {
		$css .= 'font-size:' . $instance['custom_font_heading']['custom_font_size'] . 'px;';
	}
	if ( $instance['custom_font_heading']['custom_font_weight'] <> '' ) {
		$css .= 'font-weight:' . $instance['custom_font_heading']['custom_font_weight'] . ';';
	}
	if ( $instance['custom_font_heading']['custom_font_style'] <> '' ) {
		$css .= 'font-style:' . $instance['custom_font_heading']['custom_font_style'] . ';';
	}
}

if ( $css ) {
	$css = ' style="' . $css . '"';
}

if ( $instance['sub-title'] ) {
	$subtitle = '<p class="heading__secondary">' . $instance['sub-title'] . '</p>';
}
if ( $instance['line'] ) {
	$line_heading = '<span class="line-heading"></span>';
	$class        = ' wrapper-line-heading';
}
echo '<div class="sc-heading article_heading' . $thim_animation . '">';
echo ent2ncr($subtitle);
echo '<' . $instance['size'] . $css . ' class="heading__primary' . $class . '">' . $instance['title'] . $line_heading . '</' . $instance['size'] . '>';

echo '</div>';

