<?php
/**
 * Careers Template.
 *
 * @package   WDC\Theme
 * @author    Wendell cabalhin <wendell.cabalhin@intimation.co.uk>
 * @copyright Copyright (c) 2018, Intimation Creative Ltd
 * @license   MIT
 */

add_action( 'wp_head', 'wdc_careers_setup' );
/**
 * Build our archive template.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wdc_careers_setup() {

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
	return array_merge( [ 'uses-flex-content', 'careers' ], $classes );
}

add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2);
function current_type_nav_class($css_class, $item)
{
	if( get_post_type() === 'careers' ) {
		$current_value = 'current_page_parent';
		$css_class = array_filter($css_class, function ($element) use ($current_value) {
			return ($element != $current_value);
		});

		if( strtolower($item->title) == 'careers' ) :
			array_push($css_class, 'current_page_parent');
		endif;
	}

    return $css_class;
}

function wdc_output_flex_content() {
	$post_id = 18; /* Careers page ID */

	$wdc_page_builder = get_post_meta( $post_id, 'wdc_page_builder', true );

	foreach ( $wdc_page_builder as $count => $layout ) {

		switch ( $layout ) {
			case 'header_banner':
				include locate_template( 'template-parts/posts/banner.php');
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

	}

}

genesis();
