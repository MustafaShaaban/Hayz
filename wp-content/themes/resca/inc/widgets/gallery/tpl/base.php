<?php
$cats_id = $instance['cat'];
query_posts( 'cat=' . $cats_id );
if ( have_posts() ) :
	?>
	<div class="wrapper-filter-controls">
		<div class="filter-controls">
			<div class="filter active" data-rel="*"><?php echo esc_html__('All', 'resca'); ?></div>
			<?php
			while ( have_posts() ) : the_post();
 				echo '<div class="filter" data-filter=".filter-gallery-' . get_the_ID() . '">' . get_the_title( get_the_ID() ) . '</div>';
			endwhile;
			?>
		</div>
	</div>
	<div class="wrapper-gallery-filter row grid" itemscope itemtype="http://schema.org/ItemList">
		<?php
		while ( have_posts() ) : the_post();
			$images = thim_meta( 'thim_gallery', "type=image&single=false&size=full" );
			if ( empty( $images ) ) {
				break;
			}
			foreach ( $images as $image ) {
				$data        = @getimagesize( $image['url'] );
				$width_data  = $data[0];
				$height_data = $data[1];
				if ( !( $width_data > 380 ) && !( $height_data > 310 ) ) {
					echo '<a class="col-sm-4 fancybox filter-gallery-' . get_the_ID() . '" data-fancybox-group="gallery" href="' . $image['url'] . '"><img src="' . $image['url'] . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" /></a>';
				} else {
					$crop       = ( $height_data < 310 ) ? false : true;
					$image_crop = aq_resize( $image['url'], 380, 310, $crop );
					echo '<a class="col-sm-4 fancybox filter-gallery-' . get_the_ID() . '" data-fancybox-group="gallery" href="' . $image['url'] . '"><img src="' . $image_crop . '" alt= "' . get_the_title() . '" title = "' . get_the_title() . '" /></a>';
				}
			}
		endwhile;
		?>
	</div>
<?php
endif;
wp_reset_query();