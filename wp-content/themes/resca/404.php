<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package thim
 */
?>
<section class="error-404 not-found">
	<div class="page-content">
		<div class="tablebox">
			<div class="tablebox__item">
				<h1 class="page-title"><?php _e( 'Page Not Found!', 'resca' ); ?></h1>
				<p> <?php _e( 'Sorry, We couldn\'t find the page you\'re looking for. <br/> Try returning to the ', 'resca' ); ?>
					<a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html__( 'homepage', 'resca' ); ?></a>
				</p>
			</div>
			<div class="tablebox__item">
				<img src="<?php echo get_template_directory_uri() . '/images/404.png' ?>" alt=""/>
			</div>
		</div>
	</div>
	<!-- .page-content -->
</section>