<!-- <div class="main-menu"> -->
<div class="container">
	<div class="row">
		<div class="navigation col-sm-12">
			<div class="tm-table">
 				<?php
				if ( is_active_sidebar( 'menu_left' ) ) {
					echo '<ul class="width-navigation-left table-cell table-left">';
					dynamic_sidebar( 'menu_left' );
					echo '</ul>';
				}
				?>
				<div class="width-logo table-cell sm-logo">
					<?php
					do_action( 'thim_logo' );
					do_action( 'thim_sticky_logo' );
					?>
				</div>
				<nav class="width-navigation-right table-cell table-right">
					<?php get_template_part( 'inc/header/main-menu-header-2' ); ?>
				</nav>
			</div>
			<!--end .row-->
		</div>
	</div>
</div>