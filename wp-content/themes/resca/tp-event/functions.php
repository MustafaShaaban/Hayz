<?php

/**
 * Event custom functions
 */



// Add tab to archive page
if (!function_exists('thim_event_tabs')) {
	add_action('tp_event_before_event_loop', 'thim_event_tabs');
	function thim_event_tabs(){
		$count = (array) wp_count_posts('tp_event');
		$tab_data = '';
		if ($count['tp-event-happenning'] != 0) {
			$tab_data = 'happening';
		} else {
			if ($count['tp-event-upcoming'] != 0) {
				$tab_data = 'upcoming';
			} else {
				$tab_data = 'expired';
			}
		}
		$tab = isset($_GET['tab']) ? $_GET['tab'] : $tab_data;
		$happening_active = $upcoming_active = $expired_active = '';
		switch ($tab) {
			case 'upcoming':
				$upcoming_active = 'active';
				break;
			case 'expired':
				$expired_active = 'active';
				break;
			default:
				$happening_active = 'active';
				break;
		}
		?>
		<div class="thim-event-tabs">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">

				<?php if ($count['tp-event-happenning'] != 0): ?>
				<li class="tab happening <?php echo esc_attr($happening_active); ?>" data-tab="happening">
					<a href="#happening" aria-controls="happening" data-toggle="tab"><i class="fa fa-bookmark"></i><?php esc_html_e('Happening', 'resca'); ?></a>
				</li>
				<?php endif; ?>
				
				<?php if ($count['tp-event-upcoming'] != 0): ?>
				<li class="tab upcoming <?php echo esc_attr($upcoming_active); ?>" data-tab="upcoming">
					<a href="#upcoming" aria-controls="upcoming" data-toggle="tab"><i class="fa fa-cube"></i><?php esc_html_e('Upcoming', 'resca'); ?></a>
				</li>
				<?php endif; ?>

				<?php if ($count['tp-event-expired'] != 0): ?>
				<li class="tab expired <?php echo esc_attr($expired_active); ?>" data-tab="expired">
					<a href="#expired" aria-controls="expired" data-toggle="tab"><i class="fa fa-user"></i><?php esc_html_e('Expired', 'resca'); ?></a>
				</li>
				<?php endif; ?>

			</ul>
			<!-- End: Nav tabs -->
		</div>
		<?php
	}
}



// Set posts_per_page for Event archive
function thim_set_event_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'tp_event' ) ) {
    	$theme_options_data = get_theme_mods();
    	$posts_per_page = $theme_options_data['thim_event_per_page'];
        $query->set( 'posts_per_page', $posts_per_page );
        return;
    }
}
add_action( 'pre_get_posts', 'thim_set_event_per_page', 1 );



if ( !function_exists( 'thim_event_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function thim_event_paging_nav($wp_query,$tab) {
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$get_tab = isset($_GET['tab']) ? $_GET['tab'] : 'happening';
		$paged  		= (get_query_var( 'paged' ) && $get_tab === $tab ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link 	= html_entity_decode( get_pagenum_link() );

		$query_args = array();
		$url_parts  = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = esc_url( remove_query_arg( array_keys( $query_args ), $pagenum_link ) );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Prev', 'resca' ),
			'next_text' => esc_html__( 'Next', 'resca' ),
			'type'      => 'list'
		) );
		$links = str_replace($get_tab, $tab, $links);
		if ( $links ) :
			?>
			<div class="pagination loop-pagination event">
				<?php echo ent2ncr( $links ); ?>
			</div>
			<!-- .pagination -->
		<?php
		endif;
	}
endif;


 /**
 * Change layout donate
 */
add_action( 'wp_ajax_thim_session_event_tab_active', 'thim_session_event_tab_active' );
add_action( 'wp_ajax_nopriv_thim_session_event_tab_active', 'thim_session_event_tab_active');
function thim_session_event_tab_active() {
    $tab = $_POST['tab'];
    $_SESSION['thim_session_event_tab_active'] = $tab;
    $output['tab'] = $_SESSION['thim_session_event_tab_active'];
    die(json_encode($output));
}

/*Fix Events order date start*/
add_filter( 'posts_fields', 'thim_event_posts_fields', 10, 2 );
add_filter( 'posts_join_paged', 'thim_event_posts_join_paged', 10, 2 );
add_filter( 'posts_where_paged', 'thim_event_posts_where_paged', 10, 2 );
add_filter( 'posts_orderby', 'thim_event_posts_orderby', 10, 2 );

function thim_is_events_archive() {
	global $pagenow, $post_type;
	if ( !is_post_type_archive( 'tp_event' ) || !is_main_query() ) {
		return false;
	}

	return true;
}

function thim_event_posts_fields( $fields, $q ) {
	if ( !thim_is_events_archive() ) {
		return $fields;
	}
	if ( $q->get( 'post_status' ) == 'tp-event-expired' ) {
		$alias = 'end_date_time';
	} else {
		$alias = 'start_date_time';
	}
	$fields = " DISTINCT " . $fields;
	$fields .= ', concat( str_to_date( pm1.meta_value, \'%m/%d/%Y\' ), \' \', str_to_date(pm2.meta_value, \'%h:%i %p\' ) ) as ' . $alias;

	return $fields;
}

function thim_event_posts_join_paged( $join, $q ) {
	if ( !thim_is_events_archive() ) {
		return $join;
	}

	global $wpdb;
	if ( $q->get( 'post_status' ) == 'tp-event-expired' ) {
		$join .= " LEFT JOIN {$wpdb->postmeta} pm1 ON pm1.post_id = {$wpdb->posts}.ID AND pm1.meta_key = 'tp_event_date_end'";
		$join .= " LEFT JOIN {$wpdb->postmeta} pm2 ON pm2.post_id = {$wpdb->posts}.ID AND pm2.meta_key = 'tp_event_time_end'";
	} else {
		$join .= " LEFT JOIN {$wpdb->postmeta} pm1 ON pm1.post_id = {$wpdb->posts}.ID AND pm1.meta_key = 'tp_event_date_start'";
		$join .= " LEFT JOIN {$wpdb->postmeta} pm2 ON pm2.post_id = {$wpdb->posts}.ID AND pm2.meta_key = 'tp_event_time_start'";
	}

	return $join;
}

function thim_event_posts_where_paged( $where, $q ) {
	if ( !thim_is_events_archive() ) {
		return $where;
	}

	return $where;
}

function thim_event_posts_orderby( $order_by_statement, $q ) {
	global $wp_query;
	if ( !thim_is_events_archive() ) {
		return $order_by_statement;
	}
	if ( $q->get( 'post_status' ) == 'tp-event-expired' ) {
		$order_by_statement = "end_date_time DESC";
	} else {
		$order_by_statement = "start_date_time ASC";
	}

	return $order_by_statement;
}