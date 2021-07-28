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

		// Attach custom content.
		add_action( 'genesis_loop', __NAMESPACE__ . '\\link365_output_flex_content' );
		add_action( 'body_class', __NAMESPACE__ . '\\link365_output_flex_body_class' );
		add_action( 'genesis_entry_content', __NAMESPACE__ . '\\link365_output_flex_content' );

	}

}

/*
** start of the home/frontpage contents
*/
function link365_output_flex_body_class( $classes ) {
	return array_merge( [ 'uses-flex-content' ], $classes );
}

function link365_output_flex_content() {
	$post_id = get_the_ID();
	$link365_page_builder = get_post_meta( $post_id, 'link365_page_builder', true );

	/* get the post metas */
	$post = get_post($post_id);

	foreach ( $link365_page_builder as $count => $layout ) {

		if( $post->post_type == 'invoices' ) :
			switch ( $layout ) {
				case 'content_header':
					include locate_template( 'template-parts/flex-content/content-header.php');
					break;
			}
		endif;

	}
}
