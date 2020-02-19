<article id="tp_event-<?php the_ID(); ?>" <?php post_class('tp_single_event'); ?>>
	<div class="content-inner">
		<div class="summary entry-summary">
		<?php
			/**
			 * tp_event_before_loop_room_summary hook
			 *
			 * @hooked tp_event_show_room_sale_flash - 10
			 * @hooked tp_event_show_room_images - 20
			 */
			do_action( 'tp_event_before_single_event' );
		
			/**
			 * tp_event_single_event_thumbnail hook
			 */
			do_action( 'tp_event_single_event_thumbnail' );
			/**
			 * tp_event_loop_event_countdown
			 */
			do_action( 'tp_event_loop_event_countdown' );
		?>
		</div>


	<div class="entry-content">

		<?php
			/**
			 * tp_event_single_event_title hook
			 */
			do_action( 'tp_event_single_event_title' );

		?>

	</div><!-- .summary -->

	<?php

		/**
		 * tp_event_single_event_content hook
		 */
		do_action( 'tp_event_single_event_content' );

	?>	

	<?php
		/**
		 * tp_event_after_loop_room hook
		 *
		 * @hooked tp_event_output_room_data_tabs - 10
		 * @hooked tp_event_upsell_display - 15
		 * @hooked tp_event_output_related_products - 20
		 */
		do_action( 'tp_event_after_single_event' );
	?>
	</div>
</article><!-- #product-<?php the_ID(); ?> -->
<div class="share_wrapper">
	<?php do_action( 'thim_social_share' ); ?>
</div>