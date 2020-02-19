<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation

	return $enqueue_styles;
}

// remove woocommerce_breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0 );

add_filter( 'loop_shop_per_page', 'thim_loop_shop_per_page' );
function thim_loop_shop_per_page() {
	global $theme_options_data;
	parse_str( $_SERVER['QUERY_STRING'], $params );
	if ( isset( $theme_options_data['thim_woo_product_per_page'] ) && $theme_options_data['thim_woo_product_per_page'] ) {
		$per_page = $theme_options_data['thim_woo_product_per_page'];
	} else {
		$per_page = 12;
	}
	$pc = ! empty( $params['product_count'] ) ? $params['product_count'] : $per_page;

	return $pc;
}

/*****************quick view*****************/
//remove_action( 'woocommerce_single_product_summary_quick', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_rating', 15 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_loop_add_to_cart_quick_view', 20 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_excerpt', 30 );

//remove_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 7 );

add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_sharing', 50 );

//overwrite content product.
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title_rating', 'woocommerce_template_loop_rating', 5 );


if ( ! function_exists( 'woocommerce_template_loop_add_to_cart_quick_view' ) ) {
	function woocommerce_template_loop_add_to_cart_quick_view() {
		global $product;
		do_action( 'woocommerce_' . $product->product_type . '_add_to_cart' );
	}
}

/* PRODUCT QUICK VIEW */
add_action( 'wp_head', 'lazy_ajax', 0, 0 );
function lazy_ajax() {
	?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var ajaxurl = "<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>";
        /* ]]> */
    </script>
	<?php
}

add_action( 'wp_ajax_jck_quickview', 'jck_quickview' );
add_action( 'wp_ajax_nopriv_jck_quickview', 'jck_quickview' );
/** The Quickview Ajax Output **/
function jck_quickview() {
	global $post, $product;
	$prod_id = $_POST["product"];
	$post    = get_post( $prod_id );
	$product = wc_get_product( $prod_id );
	// Get category permalink
	ob_start();
	?>
	<?php wc_get_template( 'content-single-product-lightbox.php' ); ?>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	echo ent2ncr( $output );
	die();
}

/* End PRODUCT QUICK VIEW */

/* custom WC_Widget_Cart */
//function thim_get_current_cart_info() {
//	global $woocommerce;
//	$items = count( $woocommerce->cart->get_cart() );
//
//	return array(
//		$items,
//		get_woocommerce_currency_symbol()
//	);
//}

/* Share Product */
add_action( 'woocommerce_share', 'wooshare' );
function wooshare() {
	global $theme_options_data;
	$html = '';
	if ( $theme_options_data['thim_woo_sharing_facebook'] == 1 ||
	     $theme_options_data['thim_woo_sharing_twitter'] == 1 ||
	     $theme_options_data['thim_woo_sharing_pinterest'] == 1 ||
	     $theme_options_data['thim_woo_sharing_google'] == 1
	) {
		$html .= '<div class="woo-share">';
		$html .= __( 'Share item', 'resca' );
		$html .= '<ul class="share_show">';
		if ( $theme_options_data['thim_woo_sharing_facebook'] == 1 ) {
			$html .= '<li><a target="_blank" class="facebook" href="https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '&amp;p[title]=' . get_the_title() . '&amp;p[url]=' . urlencode( get_permalink() ) . '&amp;p[images][0]=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" title="' . __( 'Facebook', 'resca' ) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( $theme_options_data['thim_woo_sharing_twitter'] == 1 ) {
			$html .= '<li><a target="_blank" class="twitter" href="https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . esc_attr( get_the_title() ) . '" title="' . __( 'Twitter', 'resca' ) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( $theme_options_data['thim_woo_sharing_pinterest'] == 1 ) {
			$html .= '<li><a target="_blank" class="pinterest" href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . get_the_excerpt() . '&media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" onclick="window.open(this.href); return false;" title="' . __( 'Pinterest', 'resca' ) . '"><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( $theme_options_data['thim_woo_sharing_google'] == 1 ) {
			$html .= '<li><a target="_blank" class="googleplus" href="https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '&amp;title=' . esc_attr( get_the_title() ) . '" title="' . __( 'Google Plus', 'resca' ) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa fa-google"></i></a></li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
	}
	echo ent2ncr( $html );
}

/* custom WC_Widget_Cart */
function thim_get_current_cart_info() {
	global $woocommerce;
	$items = count( $woocommerce->cart->get_cart() );

	return array(
		$items,
		get_woocommerce_currency_symbol()
	);
}

add_filter( 'add_to_cart_fragments', 'thim_add_to_cart_success_ajax' );
function thim_add_to_cart_success_ajax( $count_cat_product ) {
	list( $cart_items ) = thim_get_current_cart_info();
	if ( $cart_items < 0 ) {
		$cart_items = '0';
	} else {
		$cart_items = $cart_items;
	}
	$count_cat_product['#header-mini-cart .cart-items-number .items-number'] = '<span class="items-number">' . $cart_items . '</span>';

	return $count_cat_product;
}

// Override WooCommerce Widgets
add_action( 'widgets_init', 'override_woocommerce_widgets', 15 );
function override_woocommerce_widgets() {
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		unregister_widget( 'WC_Widget_Cart' );
		include_once( 'widgets/class-wc-widget-cart.php' );
		register_widget( 'Custom_WC_Widget_Cart' );
	}
}
