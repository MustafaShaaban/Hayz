<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package thim
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

if (
	have_comments() &&
	!( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) )
) {
	$class_has_comments = " has-comments";
} else {
	$class_has_comments = "";
}
?>

<div id="comments" class="comments-area<?php echo esc_attr( $class_has_comments ); ?>">
	<?php // You can start editing here -- including this comment!  ?>
	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through  ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_attr_e( 'Comment navigation', 'resca' ); ?></h1>

				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'resca' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'resca' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation  ?>


		<div class="comment-list-inner">
			<h2 class="comments-title">
				<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'resca' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h2>
			<ol class="comment-list">
				<?php wp_list_comments( 'style=li&&type=comment&avatar_size=90&callback=thim_comment' ); ?>
			</ol>
			<!-- .comment-list -->
			<?php
			//				wp_list_comments( array(
			//					'style'      => 'ol',
			//					'short_ping' => true,
			//				) );
			?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through  ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_attr_e( 'Comment navigation', 'resca' ); ?></h1>

				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'resca' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'resca' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation  ?>
	<?php endif; // have_comments() ?>
	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<!-- <p class="no-comments" style="background: #fff;padding: 30px;"><?php esc_attr_e( 'Comments are closed.', 'resca' ); ?></p> -->
	<?php endif; ?>
	<div class="comment-respond-area">
		<?php comment_form( array( 'title_reply' => __('Post a comment', 'resca'), 'label_submit' => __('SUBMIT', 'resca') ) ); ?>
	</div>
	<div class="clear"></div>

</div><!-- #comments -->
