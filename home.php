<?php
/**
 * Blog Template.
 *
 * @package   MoraySpeyside\Theme
 * @author    Craig Simpson <craig.simpson@intimation.uk>
 * @copyright Copyright (c) 2018, Intimation Creative Ltd
 * @license   MIT
 */

add_action( 'wp_head', 'ms_blog_home_setup' );
/**
 * Build our archive template.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ms_blog_home_setup() {

	// Force full width content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Add body class.
	add_filter( 'body_class', function ( $classes ) {
		return array_merge( $classes, [ 'listings-archive', 'events-archive' ] );
	} );

	// Remove all of the extra markup around <main>.
	add_filter( 'genesis_markup_site-inner', '__return_null' );
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

	// Don't include .wrap for site-inner.
	add_theme_support( 'genesis-structural-wraps', [
		'utility',
		'header',
		'footer-widgets',
		'footer',
	] );

	// Remove the archive description and post info, and hide the content as screen reader text.
	remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	add_action( 'genesis_entry_header', 'genesis_do_post_image', 9 );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	add_filter( 'genesis_attr_entry-content', 'genesis_attributes_screen_reader_class' );

	// Output custom page header.
	add_action( 'genesis_before_loop', 'ms_output_custom_page_header' );
	add_action( 'ms_listings_archive_page_header', function() {
		echo '<h1>' . __( 'Blog', 'morayspeyside' ) . '</h1>';
	} );

	// Attach custom content.
	add_action( 'genesis_before_loop', 'ms_output_posts_wrapper_open' );
	add_action( 'genesis_entry_header', 'ms_output_post_meta', 11 );
	add_action( 'genesis_after_loop', 'ms_output_posts_wrapper_close' );
}

/**
 * Output listings wrapper open.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ms_output_posts_wrapper_open() {
	include locate_template( 'partials/events/listings-wrapper-open.php' );
}

/**
 * Output listing location.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ms_output_post_meta() {

}

/**
 * Output listings wrapper close.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ms_output_posts_wrapper_close() {
	include locate_template( 'partials/events/listings-wrapper-close.php' );
}

genesis();
