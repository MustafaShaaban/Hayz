<?php
if ( isset( $instance['id'] ) ) {
	$post_id = $instance['id'];
}
if ( get_post_type( $post_id ) != 'erm_menu' ) {
	return;
}
$css = $size = $class_column = '';
if (  !empty( $instance['size'] ) ) {
	$size = $instance['size'];
}
if (  !empty( $instance['bg_image'] ) ) {
	$images_url = wp_get_attachment_image_src( $instance['bg_image'], 'full' );
	$css .= 'background-image: url(' . $images_url['0'] . ');';
}
if ( !empty( $instance['color'] ) ) {
	$css .= 'color:' . $instance['color'] . '';
}
if ( $css ) {
	$css = ' style="' . $css . '"';
}
// Title & description Menu
$menu_post = get_post( $post_id );
echo '<div class="restaurant-menu">';
if (  $instance['title'] ) {
	echo '<div class="erm_menu-title"' . $css . '><' . $size . ' class="erm_title">' . $instance['title'] . '</' . $size . '></div>';
}

// Menu items
$menu_items = get_post_meta( $post_id, '_erm_menu_items', true );
if ( empty( $menu_items ) ) {
	return;
}

$menu_items = preg_split( '/,/', $menu_items );
if ( isset( $instance['columns'] ) && $instance['columns'] == '2' ) {
	$class_column = ' menu_content_two_column';
}
echo '<ul class="erm_menu_content layout-dotted' . $class_column . '">';

foreach ( $menu_items as $item_id ) {
	$visible = get_post_meta( $item_id, '_erm_visible', true );
	if ( $visible != 1 ) {
		continue;
	}

	$post = get_post( $item_id );
	$type = get_post_meta( $item_id, '_erm_type', true );

	if ( $type == 'section' ) {
		echo '<li class="erm_section">';
		echo '<h2 class="erm_section_title">' . $post->post_title . '</h2>';
		echo '<div class="erm_section_desc">' . $post->post_content . '</div>';
		echo '</li>';
	} else {
		if ( $type == 'product' ) {
			$class         = '';
			$has_thumbnail = has_post_thumbnail( $item_id );
			$prices        = get_post_meta( $item_id, '_erm_prices', true );
			if ( !empty( $prices ) && $prices[0]['name'] != '' ) {
				$title             = str_replace( '@', '', $prices[0]['name'] );
				$prices[0]['name'] = $title;
				$class             = ' erm_product_active';
			}
			echo '<li class="erm_product' . $class .'">';
			echo '<h3 class="erm_product_title"><span>' . $post->post_title . '</span>';
			if ( isset( $instance['type'] ) && $instance['type'] == 'dotted' ) {
				echo '<span class="dotted"></span>';
			}
			echo '</h3>';
			echo '<div class="erm_product_desc">' . $post->post_content . '</div>';
			if ( !empty( $prices ) ) {
				echo '<div class="erm_product_price">';
				echo '<ul>';
				foreach ( $prices as $price ) {
					echo '<li>';
					if ( $price['value'] ) {
						echo '<span class="price">' . apply_filters('erm_filter_price', $price['value']) . '</span>';
					}
					echo '</li>';
 				}
				echo '</ul>';
				echo '</div>';

			}
			echo '<div class="clear"></div>';
			if ( !empty( $prices ) ) {
				foreach ( $prices as $price ) {
					echo '<span class="price-name">' . $price['name'] . '</span>';
				}
			}
			echo '</li>';
		}
	}
}

echo '</ul>';
echo '</div>';
wp_reset_postdata();