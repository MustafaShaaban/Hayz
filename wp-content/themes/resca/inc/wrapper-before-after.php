<?php
if ( !function_exists( 'thim_wrapper_layout' ) ) :
	function thim_wrapper_layout() {
		global $theme_options_data, $wp_query;
		$using_custom_layout = $wrapper_layout = $cat_ID = '';
		$wrapper_class_col   = 'col-sm-9 alignright';
		if ( get_post_type() == "product" ) {
			$prefix = 'thim_woo';
		} elseif( get_post_type() == 'tp_event'  ) {
			$prefix = 'thim_event';
		} else {
			if ( is_front_page() || is_home() ) {
				$prefix = 'thim_front_page';
			} else {
				$prefix = 'thim_archive';
			}
		}

		// get id category
		$cat_obj = $wp_query->get_queried_object();
		if ( isset( $cat_obj->term_id ) ) {
			$cat_ID = $cat_obj->term_id;
		}
		// get layout
        if( is_home() ) {
            $postid = get_option( 'page_for_posts' );
            $using_custom_layout = get_post_meta( $postid, 'thim_mtb_custom_layout', true );
            if ( $using_custom_layout ) {
                $wrapper_layout = get_post_meta( $postid, 'thim_mtb_layout', true );
            } else {
                $wrapper_layout = $theme_options_data[$prefix . '_cate_layout'];
            }
        } elseif ( is_page() || is_single() ) {
			$postid = get_the_ID();
			if ( isset( $theme_options_data[$prefix . '_single_layout'] ) ) {
				$wrapper_layout = $theme_options_data[$prefix . '_single_layout'];
			}

	        if ( isset( $theme_options_data[$prefix . '_layout'] ) ) {
		        $wrapper_layout = $theme_options_data[$prefix . '_layout'];
	        }
			/***********custom layout*************/
			$using_custom_layout = get_post_meta( $postid, 'thim_mtb_custom_layout', true );
			if ( $using_custom_layout ) {
				$wrapper_layout = get_post_meta( $postid, 'thim_mtb_layout', true );
			}


		} else {
			if ( isset( $theme_options_data[$prefix . '_cate_layout'] ) ) {
				$wrapper_layout = $theme_options_data[$prefix . '_cate_layout'];
			}

	        if ( isset( $theme_options_data[$prefix . '_layout'] ) ) {
		        $wrapper_layout = $theme_options_data[$prefix . '_layout'];
	        }
			/***********custom layout*************/
			$using_custom_layout = get_tax_meta( $cat_ID, 'thim_layout', true );
			if ( $using_custom_layout <> '' ) {
				$wrapper_layout = get_tax_meta( $cat_ID, 'thim_layout', true );
			}
		}

		if ( $wrapper_layout == 'full-content' ) {
			$wrapper_class_col = "col-sm-12 full-width";
		}
		if ( $wrapper_layout == 'sidebar-right' ) {
			$wrapper_class_col = "col-sm-9 alignleft";
		}
		if ( $wrapper_layout == 'sidebar-left' ) {
			$wrapper_class_col = 'col-sm-9 alignright';
		}
 		return $wrapper_class_col;
	}
endif;
//
add_action( 'thim_wrapper_loop_start', 'thim_wrapper_loop_start' );
if ( !function_exists( 'thim_wrapper_loop_start' ) ) :
	function thim_wrapper_loop_start() {
		$class_no_padding = '';
		if ( is_page() || is_single() ) {
			$mtb_no_padding = get_post_meta( get_the_ID(), 'thim_mtb_no_padding', true );
			if ( $mtb_no_padding ) {
				$class_no_padding = ' no-padding-top';
			}
		}
		$wrapper_class_col = thim_wrapper_layout();
		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
		}
		echo '<div class="container site-content' . $class_no_padding . '"><div class="row"><main id="main" class="site-main ' . $wrapper_class_col . '" role="main">';
	}
endif;

//
add_action( 'thim_wrapper_loop_end', 'thim_wrapper_loop_end' );

if ( !function_exists( 'thim_wrapper_loop_end' ) ) :
	function thim_wrapper_loop_end() {
		$wrapper_class_col = thim_wrapper_layout();
		if ( is_404() ) {
			$wrapper_class_col = 'col-sm-12 full-width';
		}
		echo '</main>';
		if ( $wrapper_class_col != 'col-sm-12 full-width' ) {
			if ( get_post_type() == "product" ) {
				do_action( 'woocommerce_sidebar' );
			} else {
				get_sidebar();
			}
		}
		echo '</div></div>';
	}
endif;