<?php
/**
 * Author Template.
 *
 * @package   WDC\Theme
 * @author    Wendell cabalhin <wendell.cabalhin@intimation.co.uk>
 * @copyright Copyright (c) 2018, Intimation Creative Ltd
 * @license   MIT
 */

add_action( 'wp_head', 'wdc_author_setup' );
/**
 * Build our archive template.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wdc_author_setup() {

	// Force full width content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Add body class.
	add_action( 'body_class', 'wdc_output_flex_body_class' );

	// Remove all of the extra markup around <main>.
	add_filter( 'genesis_markup_site-inner', '__return_null' );
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

	// Don't include .wrap for site-inner.
	add_theme_support( 'genesis-structural-wraps', [] );

	// Remove the archive description and post info, and hide the content as screen reader text.
	remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	add_action( 'genesis_entry_header', 'genesis_do_post_image', 9 );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	add_filter( 'genesis_attr_entry-content', 'genesis_attributes_screen_reader_class' );
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );

	// Output custom page header.
	add_action( 'genesis_before_loop', 'wdc_output_flex_content' );
	// Attach custom content.
	add_action( 'genesis_entry_header', 'wdc_output_post_meta', 11 );
}

/**
 * Output listing location.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wdc_output_post_meta() {

}

/*
** start of the home/frontpage contents
*/
function wdc_output_flex_body_class( $classes ) {
	return array_merge( [ 'uses-flex-content', 'author' ], $classes );
}

function wdc_output_flex_content() {


	$post_id = 735; /* Author page ID */

	$wdc_page_builder = get_post_meta( $post_id, 'wdc_page_builder', true );

	foreach ( $wdc_page_builder as $count => $layout ) {

		switch ( $layout ) {
			case 'header_banner':
				include locate_template( 'template-parts/posts/author-banner.php');
				break;
			case 'blog_heading':
				include locate_template( 'template-parts/posts/author-heading.php');
				break;
			case 'blog_contents':
				include locate_template( 'template-parts/posts/author-contents.php');
				break;
			case 'flashing_banner':
				include locate_template( 'template-parts/flex-content/flashing-banner.php');
				break;
		}

	}

}

genesis();
