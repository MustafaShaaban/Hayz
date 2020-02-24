<?php
/**
 * Template Name: Contact Template
 *
 * Displays the contact page template.
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
get_header();
	global $arise_settings;
	$arise_settings = wp_parse_args(  get_option( 'arise_theme_options', array() ),  arise_get_option_defaults_values() );
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
	}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<div id="primary">
	<?php }
	}?>
	<main id="main" role="main">
	<?php
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
			if('' != get_the_content()) : ?>
	<div class="googlemaps_widget">
		<div class="maps-container">
			<?php the_content(); ?>
		</div>
	</div> <!-- end .googlemaps_widget -->
	<?php endif;
	if ( is_active_sidebar( 'arise_form_for_contact_page' ) ) :
		dynamic_sidebar( 'arise_form_for_contact_page' );
	endif; 
	comments_template();
		}
	}
	else { ?>
	<h2 class="entry-title"> <?php _e( 'No Posts Found.', 'arise' ); ?> </h2>
	<?php
	} ?>
	</main> <!-- end #main -->
	<?php  if( 'default' == $layout ) { //Settings from customizer
	if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}else{ // for page/post
	if(($layout != 'no-sidebar') && ($layout != 'full-width')){
		echo '</div><!-- #primary -->';
	} 
}?>
<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')){ ?>
<aside id="secondary" role="complementary">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<aside id="secondary" role="complementary">
	<?php }
	}
	if ( is_active_sidebar( 'arise_contact_page_sidebar' ) ) :
		dynamic_sidebar( 'arise_contact_page_sidebar' );
	endif;?>
	<?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')): ?>
</aside> <!-- #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			echo '</aside><!-- #secondary -->';
		} 
	}
?>
<?php get_footer();