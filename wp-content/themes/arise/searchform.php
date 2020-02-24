<?php
/**
 * Displays the searchform
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
?>
<form id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<?php
		$arise_settings = arise_get_theme_options();
		$arise_search_form = $arise_settings['arise_search_text'];
		if($arise_search_form !='Search &hellip;'): ?>
	<label class="screen-reader-text"><?php echo esc_html ($arise_search_form); ?></label>
	<input type="search" name="s" class="s" id="s" placeholder="<?php echo esc_attr($arise_search_form); ?>" autocomplete="off">
	<button type="submit" class="search-submit"><i class="search-icon"></i></button>
	<?php else: ?>
	<input type="search" name="s" class="s" id="s" placeholder="<?php esc_attr_e( 'Search ...', 'arise' ); ?>" autocomplete="off">
	<button type="submit" class="search-submit"><i class="search-icon"></i></button>
	<?php endif; ?>
</form> <!-- end .search-form -->