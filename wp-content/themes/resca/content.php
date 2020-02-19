<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="share-post">
		<div class="date-meta"><?php echo get_the_date( "d\<\i\>\ M\<\/\i\>\ " ) ?></div>
		<?php do_action( 'social_share');?>
	</div>
	<div class="content-inner">
		<?php
		do_action( 'thim_entry_top', 'full' ); ?>
		<div class="entry-content">
			<?php
			if ( has_post_format( 'link' ) && thim_meta( 'thim_url' ) && thim_meta( 'thim_text' ) ) {
				$url  = thim_meta( 'thim_url' );
				$text = thim_meta( 'thim_text' );
				if ( $url && $text ) { ?>
					<header class="entry-header">
						<h3 class="blog_title">
							<a class="link" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>

							<h3>
					</header>

				<?php
				}
				?>
				<div class="entry-summary">
					<?php
					the_excerpt();
					?>
				</div><!-- .entry-summary -->
			<?php } elseif ( has_post_format( 'quote' ) && thim_meta( 'thim_quote' ) && thim_meta( 'thim_author_url' ) ) {
				$quote      = thim_meta( 'thim_quote' );
				$author     = thim_meta( 'thim_author' );
				$author_url = thim_meta( 'thim_author_url' );
				if ( $author_url ) {
					$author = ' <a href=' . esc_url( $author_url ) . '>' . $author . '</a>';
				}
				if ( $quote && $author ) {
					?>
					<header class="entry-header">
						<div class="box-header box-quote">
							<blockquote><?php echo esc_html( $quote ); ?><cite><?php echo esc_html( $author ); ?></cite>
							</blockquote>
						</div>
					</header>
				<?php
				}
			} elseif ( has_post_format( 'audio' ) ) {
				?>

				<?php the_title( sprintf( '<header class="entry-header"><h2 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2></header>' ); ?>
				<div class="entry-summary">
					<?php
					the_excerpt();
					?>
				</div><!-- .entry-summary -->
			<?php
			} else {
				?>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="blog_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<?php thim_entry_meta(); ?>
				</header>
				<!-- .entry-header -->
				<div class="entry-summary">
					<?php
					the_excerpt();
					?>
				</div><!-- .entry-summary -->
			<?php }; ?>
		</div>
	</div>
</article><!-- #post-## -->