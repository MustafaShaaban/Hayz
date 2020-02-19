<?php
$class_fillter = $class_fillter_ct = '';
if (!empty($instance['id'])) {
    $post_id = $instance['id'];
} else {
    return;
}
$list_id = explode(',', $post_id);
?>
<div class="wrapper-filter-controls">
    <div class="filter-controls">
        <div class="filter active" data-filter="*"><?php echo esc_html__( 'All', 'resca' ); ?></div>
        <?php
        for ($j = 0; $j < count($list_id); $j++) {
            $post_id_ct = $list_id[$j];
            if (get_post_type($post_id_ct) != 'erm_menu') {
                return;
            }
            $class_fillter_ct = 'menu-item-' . $post_id_ct;
            $menu_post_ct = get_post($post_id_ct);
            echo '<div class="filter" data-filter=".' . $class_fillter_ct . '">' . $menu_post_ct->post_title . '</div>';
        }
        ?>
    </div>
</div>
<!-- Container -->
<div class="grid layout-default erm_menu_content row" itemscope itemtype="http://schema.org/ItemList">
    <?php
    for ($i = 0; $i < count($list_id); $i++) {
        $post_id = $list_id[$i];
        if (get_post_type($post_id) != 'erm_menu') {
            return;
        }
        $class_fillter = ' menu-item-' . $post_id;

        $menu_post = get_post($post_id);
        // Menu items
        $menu_items = get_post_meta($post_id, '_erm_menu_items', true);
        if (!empty($menu_items)) {
            $menu_items = preg_split('/,/', $menu_items);

            foreach ($menu_items as $item_id) {
                $visible = get_post_meta($item_id, '_erm_visible', true);
                if ($visible != 1) {
                    continue;
                }
                $post = get_post($item_id);
                $type = get_post_meta($item_id, '_erm_type', true);
                if ($type == 'section') {
                    echo '<div class="col-sm-6  col-xs-12 element-item erm_section' . $class_fillter . '">';
                    echo '<div class="item-erm-section">';
                    echo '<h2 class="erm_section_title">' . $post->post_title . '</h2>';
                    echo '<div class="erm_section_desc">' . $post->post_content . '</div>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    $has_thumbnail = has_post_thumbnail($item_id);
                    $prices = get_post_meta($item_id, '_erm_prices', true);
                    $class = '';
                    if ( !empty( $prices ) && $prices[0]['name'] != '' ) {
                        $class = ' erm_product_active';
                    }
                    echo '<div class="col-sm-6 col-xs-12 element-item' . $class_fillter . ' erm_product' . ($has_thumbnail ? ' with_image' : ' no_image') . '">';
                    echo '<div class="item-erm-section'. $class .'">';
                    echo '<div class="item-left">';
                    if ($has_thumbnail) {
                        $image_id = get_post_thumbnail_id($item_id);
                        $src_thumb = erm_get_image_src($image_id, 'thumbnail');
                        $src_full = erm_get_image_src($image_id, 'full');
                        $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        $post_image = get_post($image_id);
                        $caption = $post_image->post_excerpt;
                        $desc = $post_image->post_content;
                        echo '<a class="image-popup" target="_blank" href="' . $src_full . '" data-caption="' . esc_attr($caption) . '" data-desc="' . esc_attr($desc) . '"><img class="erm_product_image" alt="' . esc_attr($alt) . '" src="' . $src_thumb . '"></a>';
                    }
                    echo '<h3 class="erm_product_title"><span>' . $post->post_title . '</span></h3>';
                    echo '<div class="erm_product_desc">' . $post->post_content . '</div>';
                    echo '</div>';
                    if (!empty($prices)) {
                        echo '<div class="erm_product_price">';
                        echo '<ul>';
                        foreach ($prices as $price) {
                            echo '<li>';
                            echo '<span class="name">' . esc_html__('Price', 'resca') . '</span>';
                            if ($price['value']) {
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
                    echo '</div>';
                    echo '</div>';
                }

            }
        }
    }
    wp_reset_postdata();
    ?>
</div>
