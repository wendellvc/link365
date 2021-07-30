<?php
/**
 * Theme page builder
 *
 * @package   Link365\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2020, Intimation Creative
 * @copyright MIT
 */

namespace Link365\Theme;

add_action( 'genesis_meta', __NAMESPACE__ . '\\link365_maybe_remove_loop' );
/**
 * Decide if we should remove the loop.
 *
 * @return void
 * @since 0.1.0
 */
function link365_maybe_remove_loop() {

	$post_id = get_the_ID();

	/**
	 * If we're not on a page with an actual ID then this won't work.
	 */
	if ( false === $post_id ) {
		return;
	}

	if ( is_array( get_post_meta( $post_id, 'link365_page_builder', true ) ) ) {
		// Remove all of the extra markup around <main>.
		add_filter( 'genesis_markup_site-inner', '__return_null' );
		add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );
		remove_action( 'genesis_loop', 'genesis_do_loop' );

	}

}
