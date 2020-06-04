<?php
/**
 * Theme page builder
 *
 * @package   WDC\Theme
 * @author    Wendell Cabalhin <wendell.cabalhin@intimation.co.uk>
 * @copyright Copyright (c) 2020, Intimation Creative
 * @copyright MIT
 */

namespace WDC\Theme;

add_action( 'genesis_meta', __NAMESPACE__ . '\\wdc_maybe_remove_loop' );
/**
 * Decide if we should remove the loop.
 *
 * @return void
 * @since 0.1.0
 */
function wdc_maybe_remove_loop() {

	$post_id = get_the_ID();

	/**
	 * If we're not on a page with an actual ID then this won't work.
	 */
	if ( false === $post_id ) {
		return;
	}

	if ( is_array( get_post_meta( $post_id, 'wdc_page_builder', true ) ) ) {
		// Remove all of the extra markup around <main>.
		add_filter( 'genesis_markup_site-inner', '__return_null' );
		add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Attach custom content.
		add_action( 'genesis_loop', __NAMESPACE__ . '\\wdc_output_flex_content' );
		add_action( 'body_class', __NAMESPACE__ . '\\wdc_output_flex_body_class' );
		add_action( 'genesis_entry_content', __NAMESPACE__ . '\\wdc_output_flex_content' );

	}

}

/*
** start of the home/frontpage contents
*/
function wdc_output_flex_body_class( $classes ) {
	return array_merge( [ 'uses-flex-content' ], $classes );
}

function wdc_output_flex_content() {
	$post_id = get_the_ID();
	$wdc_page_builder = get_post_meta( $post_id, 'wdc_page_builder', true );

	foreach ( $wdc_page_builder as $count => $layout ) {

		switch ( $layout ) {
			case 'header_banner':
				include locate_template( 'template-parts/flex-content/header-banner.php');
				break;
			case 'flashing_banner':
				include locate_template( 'template-parts/flex-content/flashing-banner.php');
				break;
			case 'contact_form':
				include locate_template( 'template-parts/flex-content/contact-form.php');
				break;
			case 'intro_content':
				include locate_template( 'template-parts/flex-content/intro-heading.php');
				break;
			case 'column_grids':
				include locate_template( 'template-parts/flex-content/column-grids.php');
				break;
			case 'boxes_with_ctas':
				include locate_template( 'template-parts/flex-content/boxes-ctas.php');
				break;
			case 'tabs_with_ctas':
				include locate_template( 'template-parts/flex-content/tabs.php');
				break;
			case 'left_vertical_slides':
				include locate_template( 'template-parts/flex-content/left-vertical-slides.php');
				break;
			case 'right_vertical_slides':
				include locate_template( 'template-parts/flex-content/right-vertical-slides.php');
				break;
			case 'divider':
				include locate_template( 'template-parts/flex-content/divider.php');
				break;
			case 'divider_thin':
				include locate_template( 'template-parts/flex-content/divider-thin.php');
				break;
			case 'left_content':
				include locate_template( 'template-parts/flex-content/left-vertical-content.php');
				break;
			case 'right_content':
				include locate_template( 'template-parts/flex-content/right-vertical-content.php');
				break;
			case 'dynamic_boxes':
				include locate_template( 'template-parts/flex-content/boxes-dynamic.php');
				break;
			case 'gallery':
				include locate_template( 'template-parts/flex-content/gallery.php');
				break;
		}

	}
}
