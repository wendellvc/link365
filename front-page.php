<?php
/**
 * Front page template.
 *
 * @package   Link365\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2018
 * @license   MIT
 */

add_action( 'wp_head', 'link365_front_page_setup', 5 );
/**
 * Build our custom front page.
 *
 * @return void
 * @since 1.0.0
 *
 */
function link365_front_page_setup() {

	// Load home page scripts and styles.
	wp_enqueue_style( 'home' );
	// JS
	wp_enqueue_script( 'home' );

	// Force full width content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Add body class.
	add_filter( 'body_class', function ( $classes ) {
		return array_merge( $classes, [ 'front-page' ] );
	} );

	// Remove all of the extra markup around <main>.
	add_filter( 'genesis_markup_site-inner', '__return_null' );
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

	// Remove the Genesis post title and default loop.
	remove_action( 'genesis_post_title', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

}

genesis();
