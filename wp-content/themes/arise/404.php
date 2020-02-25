<?php
/**
 * The template for displaying 404 pages
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
get_header();
$arise_settings = arise_get_theme_options();
global $arise_content_layout;
if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
	$layout = 'default';
}
if( 'default' == $layout ) { //Settings from customizer
	if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')){ ?>

<div id="primary">
	<?php }
}?>
<div class="site-content" role="main">
	<article id="post-0" class="post error404 not-found">
		<?php if ( is_active_sidebar( 'arise_404_page' ) ) :
			dynamic_sidebar( 'arise_404_page' );
		else:?>
		<section class="error-404 not-found">
			<header class="page-header">
				<h2 class="page-title"> <?php _e( 'Oops! That page can&rsquo;t be found.', 'arise' ); ?> </h2>
			</header> <!-- .page-header -->
			<div class="page-content">
				<p> <?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'arise' ); ?> </p>
					<?php get_search_form(); ?>
			</div> <!-- .page-content -->
		</section> <!-- .error-404 -->
	<?php endif; ?>
	</article> <!-- #post-0 .post .error404 .not-found -->
</div> <!-- #content .site-content -->
<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($arise_settings['arise_sidebar_layout_options'] != 'nosidebar') && ($arise_settings['arise_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}
get_sidebar();
get_footer();