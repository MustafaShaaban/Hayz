<?php

$number  = $instance['number'];
$link    = $instance['open_link'];
$date    = current_time( 'mysql' );
$current = time();

if ( isset( $instance['post_type'] ) && $instance['post_type'] == 'normal_post' ) {
	$args_event = array(
		'post_type'      => 'post',
		'posts_per_page' => $number,
		'order'          => $instance['order'] == 'asc' ? 'asc' : 'desc',
		'meta_query'     => array(
			'relation' => 'AND',
			array(
				'key'   => 'thim_use_event',
				'value' => '1',
			),
			array(
				'key'     => 'thim_start_date',
				'value'   => $current,
				'compare' => '>'
			)
		)
	);
} else {
	$args_event = array(
		'post_type'      => array( 'tp_event' ),
		'posts_per_page' => $number,
		'order'          => $instance['order'] == 'asc' ? 'asc' : 'desc',
		'post_status'    => array( 'tp-event-upcoming', 'tp-event-happenning'),
	);
}

if ( $instance['orderby'] == 'time' && $instance['post_type'] == 'normal_post' ) {
	$args_event['orderby']  = 'meta_value';
	$args_event['meta_key'] = 'thim_start_date';
} elseif ( $instance['orderby'] == 'time' && $instance['post_type'] == 'event' ) {
	$args_event['orderby']  = 'meta_value';
	$args_event['meta_key'] = 'tp_event_date_start';
} else {
	switch ( $instance['orderby'] ) {
		case 'recent' :
			$args_event['orderby'] = 'post_date';
			break;
		case 'title' :
			$args_event['orderby'] = 'post_title';
			break;
		case 'popular' :
			$args_event['orderby'] = 'comment_count';
			break;
		default : //random
			$args_event['orderby'] = 'rand';
	}
}

$the_query                   = new WP_Query( $args_event );

if ( $the_query->have_posts() ): ?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
		<?php if ( $instance['post_type'] == 'event' ) : ?>
			<div class="item-event">
				<?php
				if ( has_post_thumbnail() ) {
					echo '<div class="event-thumbnail">' . feature_images( 600, 300 ) . '</div>';
				} ?>
				<div class="content-item">
					<?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
					<?php $post_data = get_post(get_the_ID());
					echo $post_data->post_excerpt; ?>
					<?php echo '<p><strong>';
						if ( class_exists( 'WPEMS' ) ) {
							echo esc_attr(wpems_event_start( 'h:i A l - d F Y' ));
						} elseif ( class_exists( 'TP_Event' ) ) {
							echo esc_attr(tp_event_start( 'h:i A l - d F Y' ));
						}
					  echo '</strong></p>';
					?>
					<?php if ( $link == 'new_tab' ) : ?>
						<a class="view-detail"
						   href="<?php echo esc_url( get_permalink() ) ?>"
						   target="_blank"><?php esc_html_e( 'view detail', 'resca' ) ?></a>
					<?php elseif ( $link == 'current_tab' ) : ?>
						<a class="view-detail"
						   href="<?php echo esc_url( get_permalink() ) ?>"><?php esc_html_e( 'view detail', 'resca' ) ?></a>
					<?php else : ?>
						<a class="view-detail"
						   href="<?php echo get_post_type_archive_link( array( 'tp_event' ) ) ?>"><?php esc_html_e( 'view detail', 'resca' ) ?></a>
					<?php endif; ?>
				</div>
				<div class="content-right">
					<div id="coming-soon-counter-<?php echo get_the_ID(); ?>" class="tp_event_counter_widget"
					     data-time="<?php if ( class_exists( 'WPEMS' ) ) {
						     echo esc_attr(wpems_get_time( 'M j, Y H:i:s O', null, false ));
					     } elseif ( class_exists( 'TP_Event' ) ) {
						     echo esc_attr(tp_event_get_time( 'M j, Y H:i:s O', null, false ));
					     } ?>"
					     data-current-time="<?php echo esc_attr( $date ); ?>">

					</div>
				</div>

			</div>
		<?php else :
			$thim_desc = get_post_meta( get_the_ID(), 'thim_desc', true );
			$thim_start_date = get_post_meta( get_the_ID(), 'thim_end_date', true );
			?>
			<div class="item-event">
				<?php
				if ( has_post_thumbnail() ) {
					echo '<div class="event-thumbnail">' . feature_images( 600, 300 ) . '</div>';
				} ?>
				<div class="content-item">
					<?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
					<?php $post_data = get_post(get_the_ID());
					echo $post_data->post_excerpt; ?>
					<?php if ( $thim_desc ) {
						echo '<p><strong>' . $thim_desc . '</strong></p>';
					} ?>
					<?php if ( $link == 'new_tab' ) : ?>
						<a class="view-detail"
						   href="<?php echo esc_url( get_permalink() ) ?>"
						   target="_blank"><?php esc_html_e( 'view detail', 'resca' ) ?></a>
					<?php elseif ( $link == 'current_tab' ) : ?>
						<a class="view-detail"
						   href="<?php echo esc_url( get_permalink() ) ?>"><?php esc_html_e( 'view detail', 'resca' ) ?></a>
					<?php else : ?>
						<a class="view-detail"
						   href="<?php echo get_post_type_archive_link( 'post' ) ?>"><?php esc_html_e( 'view detail', 'resca' ) ?></a>
					<?php endif; ?>
				</div>
				<div class="content-right">
					<div id="coming-soon-counter-<?php echo get_the_ID(); ?>"></div>
					<script type="text/javascript">
						<?php echo 'jQuery(function($) {
									$("#coming-soon-counter-' . get_the_ID() . '").mbComingsoon({
										localization: {
											days: "' . esc_attr( __( 'days', 'resca' ) ) . '",           //Localize labels of counter
											hours: "' . esc_attr( __( 'hours', 'resca' ) ) . '",
											minutes: "' . esc_attr( __( 'minutes', 'resca' ) ) . '",
											seconds: "' . esc_attr( __( 'seconds', 'resca' ) ) . '"
										}
										, expiryDate:  new Date(' . date( "Y", $thim_start_date ) . ', ' . ( date( "m", $thim_start_date ) - 1 ) . ', ' . date( "d", $thim_start_date ) . ', ' . date( "G", $thim_start_date ) . ',' . date( "i", $thim_start_date ) . ', ' . date( "s", $thim_start_date ) . ')
										, speed:100 });
									setTimeout(function () {
										$(window).resize();
									}, 200);
								});
							 '
						?>
					</script>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile;
	?>
<?php endif;
	wp_reset_postdata();
// Restore global post data stomped by the_post(). ?>