<?php
/**
 * The template for displaying search results.
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
get_header();
	$arise_settings = arise_get_theme_options();
	global $arise_content_layout;
	if( $post ) {
		$layout = get_post_meta( $post->ID, 'arise_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}
	if( 'default' == $layout ) { //Settings from customizer
		if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')){ ?>

<div id="primary">
	<?php }
	}?>
	<main id="main" role="main">
	<?php
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
	get_template_part( 'content', get_post_format() );
		}
	}
	else { ?>
	<h2 class="entry-title">
		<?php get_search_form(); ?>
		<p>&nbsp; </p>
		<?php _e( 'No Posts Found.', 'arise' ); ?>
	</h2>
	<?php
	} ?>
	</main> <!-- #main -->
	<?php get_template_part( 'navigation', 'none' );
if( 'default' == $layout ) { //Settings from customizer
	if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}
get_sidebar();
get_footer();