<?php
/**
* Single post/ event template.
*
* @package   Link365\Theme
* @author    Wendell cabalhin <cabalhinwendell@gmail.com>
* @copyright Copyright (c) 2021
* @license   MIT
**/

add_action( 'wp_head', 'link365_case_studies_single_setup' );
/**
 * Build our archive template.
 *
 * @since 1.0.0
 *
 * @return void
 */
function link365_case_studies_single_setup() {

	// Force full width content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Add body class.
	add_action( 'body_class', 'link365_output_flex_body_class' );

	// Remove all of the extra markup around <main>.
	add_filter( 'genesis_markup_site-inner', '__return_null' );
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

	// Don't include .wrap for site-inner.
	add_theme_support( 'genesis-structural-wraps', [] );


	/* remove post content, header and footer markups */
	// Remove the entry header markup (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

	remove_action( 'genesis_entry_header', 'genesis_post_meta', 12 );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12);

	remove_action( 'genesis_entry_content', 'genesis_do_post_content');

	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

	// Attach custom content.

	add_action( 'genesis_loop', 'link365_output_flex_content' );

}

/*
** start of the home/frontpage contents
*/
function link365_output_flex_body_class( $classes ) {
	return array_merge( [ 'uses-flex-content', 'case-studies' ], $classes );
}

add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2);
function current_type_nav_class($css_class, $item)
{
	if( get_post_type() === 'invoices' ) {
		$current_value = 'current_page_parent';
		$css_class = array_filter($css_class, function ($element) use ($current_value) {
		  return ($element != $current_value);
		});

		if( strtolower($item->title) == 'invoices' ) :
			array_push($css_class, 'current_page_parent');
		endif;
	}

	return $css_class;
}

function link365_output_flex_content() {
	$post_id = get_the_ID(); /* post ID */

	$link365_page_builder = get_post_meta( $post_id, 'link365_page_builder', true );

	$post = get_post($post_id);
	// print_r($post);

	if( $link365_page_builder ) :
		foreach ( $link365_page_builder as $count => $layout ) {
			// if( $post->post_type == 'post' ) :
			switch ( $layout ) {
				case 'single_column':
					include locate_template( 'template-parts/posts/single-column.php');
					break;
				case 'two_columns':
					include locate_template( 'template-parts/posts/two-columns.php');
					break;
			}
			// endif;
		}
	endif;

}

genesis();
