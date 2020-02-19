<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if ( has_post_thumbnail() ): ?>

	<?php if ( is_single() ): ?>
		<?php
		echo "<div class='post-formats-wrapper'>";
		$thumb = get_the_post_thumbnail( get_the_ID(), 'full' );
		if ( empty( $thumb ) ) {
			return;
		}
		echo '<a class="post-image" href="' . esc_url( get_permalink() ) . '">'. $thumb . '</a>';
		echo "</div>";
		?>

	<?php else: ?>

		<div class="entry-thumbnail">
			<?php echo feature_images( 270, 250 ); ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>"
			   class="thim-button style3"><?php esc_html_e( 'Read more', 'resca' ); ?></a>
		</div>

	<?php endif; ?>

<?php endif; ?>