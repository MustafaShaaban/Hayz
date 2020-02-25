<?php
/**
 * This template to displays woocommerce page
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
		<?php woocommerce_content(); ?>
	</main> <!-- #main -->
	<?php 
	if( 'default' == $layout ) { //Settings from customizer
		if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}?>
<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')){ ?>
<aside id="secondary" role="complementary">
	<?php }
} 
	if( 'default' == $layout ) { //Settings from customizer
		if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')): ?>
		<?php dynamic_sidebar( 'arise_woocommerce_sidebar' ); ?>
</aside> <!-- #secondary -->
<?php endif;
	}
get_footer(); ?>
