<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $theme_options_data, $wp_query;

// color theme options
$cat_obj = $wp_query->get_queried_object();

if ( isset( $cat_obj->term_id ) ) {
	$cat_ID = $cat_obj->term_id;
} else {
	$cat_ID = "";
}
$thim_custom_column = get_tax_meta( $cat_ID, 'thim_custom_column', true );

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( !$product || !$product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop'] ++;
$column_product = 4;

if ( $thim_custom_column <> '' ) {
	$column_product = 12 / $thim_custom_column;
} else {
	if ( isset( $theme_options_data['thim_woo_product_column'] ) && $theme_options_data['thim_woo_product_column'] <> '' ) {
		$thim_custom_column = $theme_options_data['thim_woo_product_column'];
		$column_product     = 12 / $theme_options_data['thim_woo_product_column'];
	}
}
if ( $column_product == '2.4' ) {
	$column_product = "col-5";
}
// Extra post classes
$classes   = array();
$classes[] = 'col-md-' . $column_product . ' col-sm-6 col-xs-6';
?>
<li <?php post_class( $classes ); ?>>
	<div class="content__product">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="product_thumb">
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<?php
			if ( isset( $theme_options_data['thim_woo_set_show_qv'] ) && $theme_options_data['thim_woo_set_show_qv'] == '1' ) {
				echo '<div class="quick-view" data-prod="' . esc_attr( get_the_ID() ) . '"><a href="javascript:;"><i class="fa fa-search"></i></a></div>';
			}
			?>
			<a href="<?php the_permalink(); ?>" class="link-images-product"></a>
		</div>


		<div class="product__title">
			<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
			<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			<?php

			/**
			 * woocommerce_after_shop_loop_item hook
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );

			?>
		</div>
	</div>
</li>
