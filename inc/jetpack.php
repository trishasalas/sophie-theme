<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Sophie Theme
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function sophie_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'sophie_jetpack_setup' );
