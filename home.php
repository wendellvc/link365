<?php
/**
 * Blog Template.
 *
 * @package   Link365\Theme
 * @author    Wendell cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2021
 * @license   MIT
 */

add_action( 'wp_head', 'link365_blog_home_setup' );
/**
 * Build our archive template.
 *
 * @since 1.0.0
 *
 * @return void
 */
function link365_blog_home_setup() {

	// Force full width content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Add body class.
	add_action( 'body_class', 'link365_output_flex_body_class' );

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

	// Output custom page header.
	add_action( 'genesis_before_loop', 'link365_output_flex_content' );
	// Attach custom content.
	add_action( 'genesis_entry_header', 'link365_output_post_meta', 11 );
}

/**
 * Output listing location.
 *
 * @since 1.0.0
 *
 * @return void
 */
function link365_output_post_meta() {

}

/*
** start of the home/frontpage contents
*/
function link365_output_flex_body_class( $classes ) {
	return array_merge( [ 'uses-flex-content', 'blog' ], $classes );
}

function link365_output_flex_content() {
	$post_id = 20; /* Blog page ID */

	$link365_page_builder = get_post_meta( $post_id, 'link365_page_builder', true );

	$post = get_post($post_id);
	// print_r($post);
	foreach ( $link365_page_builder as $count => $layout ) {
		if( $post->post_name == 'blog' ) :
		switch ( $layout ) {
			case 'header_banner':
				include locate_template( 'template-parts/posts/banner.php');
				break;
			case 'intro_content':
				include locate_template( 'template-parts/flex-content/intro-heading.php');
				break;
			case 'blog_heading':
				include locate_template( 'template-parts/posts/intro-heading.php');
				break;
			case 'blog_contents':
				include locate_template( 'template-parts/posts/post-contents.php');
				break;
			case 'flashing_banner':
				include locate_template( 'template-parts/flex-content/flashing-banner.php');
				break;
		}
	endif;

	}

}

genesis();
