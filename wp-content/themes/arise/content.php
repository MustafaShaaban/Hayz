<?php
/**
 * The template for displaying content.
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
$arise_settings = arise_get_theme_options(); ?>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$format = get_post_format(); ?>
	<article class="post-format format-<?php echo $format; ?>">
	<?php
		$arise_blog_post_image = $arise_settings['arise_blog_post_image'];
				if( has_post_thumbnail() && $arise_blog_post_image == 'on') { ?>
					<figure class="post-featured-image">
						<a href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>">
						<?php the_post_thumbnail(); ?>
						</a>
					</figure><!-- end.post-featured-image  -->
				<?php } ?>
		<header class="entry-header">
			<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"> <?php the_title();?> </a> </h2> <!-- end.entry-title -->
		<?php 
			$entry_format_meta_blog = $arise_settings['arise_entry_meta_blog'];
			if($entry_format_meta_blog == 'show-meta' ){?>
			<div class="entry-meta clearfix">
			<?php	
				$format = get_post_format();
				if ( current_theme_supports( 'post-formats', $format ) ) {
					printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
						sprintf( ''),
						esc_url( get_post_format_link( $format ) ),
						get_post_format_string( $format )
					);
				} ?>
			<span class="author vcard"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author(); ?>">
			<?php the_author(); ?> </a></span> <span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>">
			<?php the_time( get_option( 'date_format' ) ); ?> </a></span>
			<?php if ( comments_open() ) { ?>
			<span class="comments">
			<?php comments_popup_link( __( 'No Comments', 'arise' ), __( '1 Comment', 'arise' ), __( '% Comments', 'arise' ), '', __( 'Comments Off', 'arise' ) ); ?> </span>
			<?php } ?>
			</div> <!-- end .entry-meta -->
		<?php } ?>
		</header> <!-- end .entry-header -->
		<div class="entry-content clearfix">
			<?php $content_display = $arise_settings['arise_blog_content_layout'];
				if($content_display == 'fullcontent_display'):
					the_content();
				else:
					the_excerpt();
				endif; ?>
		</div> <!-- end .entry-content -->
		<?php 
			$excerpt = get_the_excerpt();
			$content = get_the_content();
			$disable_entry_format = $arise_settings['arise_entry_format_blog'];
			if($disable_entry_format =='show' || $disable_entry_format =='show-button' || $disable_entry_format =='hide-button'){ ?>
		<footer class="entry-meta clearfix">
			<?php if($disable_entry_format !='show-button'){ ?>
			<span class="cat-links">
			<?php _e('Category : ','arise');  the_category(', '); ?>
			</span> <!-- end .cat-links -->
			<?php $tag_list = get_the_tag_list( '', __( ', ', 'arise' ) );
				if(!empty($tag_list)){ ?>
				<span class="tag-links">
				<?php   echo $tag_list; ?>
				</span> <!-- end .tag-links -->
				<?php } 
			}
			$arise_tag_text = $arise_settings['arise_tag_text'];
			if(strlen($excerpt) < strlen($content) && $disable_entry_format !='hide-button'){ ?>
			<a class="readmore" title="<?php the_title_attribute('echo=0');?>" href="<?php the_permalink();?>">
			<?php
				if($arise_tag_text == 'Read More' || $arise_tag_text == ''):
					_e('Read More', 'arise');
				else:
					echo esc_attr($arise_tag_text);
				endif;?>
			<span></span> </a>
			<?php } ?>
		</footer> <!-- .entry-meta -->
		<?php
		} ?>
		</article>
	</section> <!-- end .post -->