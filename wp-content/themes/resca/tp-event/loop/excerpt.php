<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="entry-content">
	<?php the_excerpt(); ?>
</div>

<div class="entry-meta">
	<div class="date">
		<div class="day"><?php echo tp_event_get_time('d'); ?></div>
		<div class="month"><?php echo tp_event_get_time('M'); ?></div>
	</div>
	<div class="metas">
		<div class="time"><i class="fa fa-clock-o"></i> <?php echo tp_event_start('H:i'); ?> - <?php echo tp_event_end('H:i'); ?></div>
		<div class="location"><i class="fa fa-map-marker"></i> <?php echo tp_event_location(); ?></div>
	</div>
</div>