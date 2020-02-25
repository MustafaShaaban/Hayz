<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Theme Freesia
 * @subpackage Arise
 * @since Arise 1.0
 */
/*********** ARISE ADD THEME SUPPORT FOR INFINITE SCROLL **************************/
function arise_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'arise_jetpack_setup' );