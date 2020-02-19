<?php
$number_posts = 2;
if ( $instance['number_posts'] <> '' ) {
	$number_posts = $instance['number_posts'];
}
$query_args = array(
	'posts_per_page' => $number_posts,
	'order'          => $instance['order'] == 'asc' ? 'asc' : 'desc',
);
switch ( $instance['orderby'] ) {
	case 'recent' :
		$query_args['orderby'] = 'post_date';
		break;
	case 'title' :
		$query_args['orderby'] = 'post_title';
		break;
	case 'popular' :
		$query_args['orderby'] = 'comment_count';
		break;
	default : //random
		$query_args['orderby'] = 'rand';
}

$posts_display = new WP_Query( $query_args );
if ( $posts_display->have_posts() ) {
	if ( $instance['title'] ) {
		echo ent2ncr( $args['before_title'] . $instance['title'] . $args['after_title'] );
	}
	echo '<div class="thim-list-posts">';
	while ( $posts_display->have_posts() ) {
		$posts_display->the_post();
		$class = 'item-post';
		?>
	<div <?php post_class( $class ); ?>>
		<?php do_action( 'thim_entry_top', 'medium' );
		echo '<div class="article-title-wrapper">';
		echo '<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" class="article-title">' . esc_attr( get_the_title() ) . '</a>';
		echo '<div class="article-date"><span class="day">' . get_the_date( 'd' ) . '</span><span class="month">' . get_the_date( 'M' ) . '</span></div>';
		echo '</div><div class="article-author">' . __( 'Post by', 'resca' ) . ' <span>' . get_the_author() . '</span></div>';
		echo '</div>';
	}
	echo '</div>';
	wp_reset_postdata();
}
?>