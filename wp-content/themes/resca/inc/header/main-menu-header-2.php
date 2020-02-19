<?php
global $theme_options_data;
?>

<?php
if ( is_active_sidebar( 'menu_right' ) || ( isset( $theme_options_data['thim_show_offcanvas_sidebar'] ) && $theme_options_data['thim_show_offcanvas_sidebar'] == '1' && is_active_sidebar( 'offcanvas_sidebar' ) ) ) {
	echo '<ul class="menu-right">';
	if ( is_active_sidebar( 'menu_right' ) ) {
		dynamic_sidebar( 'menu_right' );
	}
	if ( isset( $theme_options_data['thim_show_offcanvas_sidebar'] ) && $theme_options_data['thim_show_offcanvas_sidebar'] == '1' && is_active_sidebar( 'offcanvas_sidebar' ) ) {
		?>
		<li class="sliderbar-menu-controller">
			<?php
			$icon = '';
			if ( isset( $theme_options_data['thim_icon_offcanvas_sidebar'] ) ) {
				$icon = 'fa ' . $theme_options_data['thim_icon_offcanvas_sidebar'];
			}
			?>
			<span>
				<i class="<?php echo esc_attr($icon); ?>"></i>
			</span>
		</li>
	<?php
	}
	echo '</ul>';
}
?>
<div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
	<?php echo '<div>' . __( 'Menu', 'resca' ) . '</div>'; ?>
	<div>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</div>
</div>
<ul class="nav navbar-nav menu-main-menu">
	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s'
		) );
	} else {
		wp_nav_menu( array(
			'theme_location' => '',
			'container'      => false,
			'items_wrap'     => '%3$s'
		) );
	}
	//sidebar menu_right
	?>
</ul>
<!--</div>-->