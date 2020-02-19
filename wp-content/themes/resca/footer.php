<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package thim
 */
global $theme_options_data;
$border_top = '';
?>
<?php if ( is_active_sidebar( 'main-bottom' ) ) : ?>
	<div class="main-bottom">
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar( 'main-bottom' ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'footer' ) ) : ?>
				<div class="footer">
					<?php $border_top = ' border-copyright' ?>
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			<?php endif; ?>
			<?php
			if ( isset( $theme_options_data['thim_copyright_text'] ) ) {
				echo '<div class="col-sm-12"><p class="text-copyright' . $border_top . '">' . $theme_options_data['thim_copyright_text'] . '</p></div>';
			}
			?>
		</div>
	</div>
</footer><!-- #colophon -->

<?php if ( isset( $theme_options_data['thim_show_to_top'] ) && $theme_options_data['thim_show_to_top'] == 1 ) { ?>
	<a id='back-to-top' class="scrollup show" title="<?php esc_attr_e( 'Go To Top', 'resca' ); ?>"></a>
<?php } ?>
</div><!--end main-content-->
</div></div><!-- .wrapper-container -->

<?php if ( isset( $theme_options_data['thim_show_offcanvas_sidebar'] ) && $theme_options_data['thim_show_offcanvas_sidebar'] == '1' && is_active_sidebar( 'offcanvas_sidebar' ) ) { ?>
	<div class="slider-sidebar">
		<?php dynamic_sidebar( 'offcanvas_sidebar' ); ?>
	</div>  <!--slider_sidebar-->
<?php } ?>
<div class="covers-parallax"></div>
<?php wp_footer(); ?>
</body>
</html>

