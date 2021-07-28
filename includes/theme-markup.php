<?php
/**
 * Theme markup customizations.
 *
 * @package   Link365\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2021
 * @copyright MIT
 */

namespace Link365\Theme;

add_action( 'genesis_setup', __NAMESPACE__ . '\\theme_markup', 20 );
/**
 * Global page setup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function theme_markup() {

	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
	add_filter( 'genesis_edit_post_link', '__return_false' );

	remove_action( 'genesis_doctype', 'genesis_do_doctype' );
	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

	remove_filter( 'body_class', 'genesis_header_body_classes' );

	// Remove .wrap from menu-primary or other element by omitting them from the array below
 	// add_theme_support( 'genesis-structural-wraps', array( 'header', 'menu-secondary', 'footer-widgets', 'footer' ) );
 	add_theme_support( 'genesis-structural-wraps', array() );
 	add_theme_support( 'custom-header', array(
	    'width'           => 217,
	    'height'          => 71,
	    'header-selector' => '.site-title a',
	    'header-text'     => false,
	    'flex-width'     => true,
	    'flex-height'     => true,
	) );

	// remove custom genesis custom header style
	remove_action( 'wp_head', 'genesis_custom_header_style');
	//* Remove site header markup
	//remove initial header functions
	remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
	remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
	remove_action( 'genesis_header', 'genesis_do_header' );

	//add in the new header markup - prefix the function name - here sm_ is used
	add_action( 'genesis_header', __NAMESPACE__ . '\\custom_genesis_header_markup_open', 5 );
	add_action( 'genesis_header', __NAMESPACE__ . '\\custom_genesis_header_markup_close', 15 );
	// add_action( 'genesis_header', __NAMESPACE__ . '\\sm_genesis_do_header' );

}

add_action( 'genesis_doctype', __NAMESPACE__ . '\\link365_do_doctype' );
/**
 * Add no-js class to html tag, and immediately remove it with JS.
 *
 * @link http://www.paulirish.com/2009/avoiding-the-fouc-v3/
 *
 * @since  0.1.0
 *
 * @return void
 */
function link365_do_doctype() {
	include locate_template( 'template-parts/doctype.php' );
}


add_filter( 'genesis_attr_site-header', __NAMESPACE__ . '\\link365_add_class' );
function link365_add_class( $attributes ) {

 $attributes['class'] = 'site-header position-relative';
 return $attributes;
}


//New Header functions
function custom_genesis_header_markup_open() {

	genesis_markup( array(
		'html5'   => '<header %s>',
		'context' => 'site-header',
	) );
	// Added in content
	// echo '<div class="header-ghost"></div>';

	ob_start();
	do_action( "custom_before_header_wrap" );

	genesis_structural_wrap( 'header' );
}

function custom_genesis_header_markup_close() {

	genesis_structural_wrap( 'header', 'close' );
	// Added in content
	do_action( "custom_after_header_wrap" );
	genesis_markup( array(
		'close'   => '</header>',
		'context' => 'site-header',
	) );
}

add_filter( 'genesis_attr_site-description', __NAMESPACE__ . '\\custom_add_site_description_class' );
/**
* Add class for screen readers to site description.
* This will keep the site description mark up but will not have any visual presence on the page
* This runs if there is a header image set in the Customiser.
*
* @param string $attributes Add screen reader class.
* @author @_AlphaBlossom
* @author @_neilgee
*/
function custom_add_site_description_class( $attributes ) {
	if ( get_header_image() ) :
		$attributes['class'] .= ' screen-reader-text';
		return $attributes;
	endif;
		return $attributes;
}


add_action( 'custom_before_header_wrap', __NAMESPACE__ . '\\custom_output_before_header_wrap' );
/**
 * opening header markup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function custom_output_before_header_wrap() {

	include locate_template( 'template-parts/header-opening.php' );

}


add_action( 'custom_after_header_wrap', __NAMESPACE__ . '\\custom_output_after_header_wrap' );
/**
 * closing header markup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function custom_output_after_header_wrap() {
	include locate_template( 'template-parts/header-closing.php' );
}


/** register and hook the Header Menu to the Main Menu Display location **/
add_action( 'init', __NAMESPACE__ . '\\custom_additional_menu' );
function custom_additional_menu() {
	register_nav_menus( array('main_menu' => __('Main Menu')) );
}


add_filter('nav_menu_css_class', __NAMESPACE__ . '\\add_custom_classes_on_li', 1, 3);
function add_custom_classes_on_li($classes, $item, $args) {
    $classes[] = 'nav-item';
    return $classes;
}


//* Unregister Genesis widgets
add_action( 'widgets_init',  __NAMESPACE__ . '\\unregister_genesis_widgets', 99 );

function unregister_genesis_widgets() {
	unregister_sidebar( 'header-right' );
	unregister_sidebar( 'sidebar' );
	unregister_sidebar( 'sidebar-alt' );
	unregister_sidebar( 'footer-1' );
	unregister_sidebar( 'footer-2' );
	unregister_sidebar( 'footer-3' );
	unregister_sidebar( 'footer-4' );
}


add_action( 'widgets_init',  __NAMESPACE__ . '\\register_custom_widgets', 5 );
/**
 * Create/Register custom sidebar widget areas.
 *
 * @since 0.1.0
 *
 * @return void
 */
function register_custom_widgets() {
	register_sidebar( array(
	   'name'          => __( 'Header Socials' ),
	   'id'            => 'header-links-socials',
	   'description'   => __( 'Widgets in this area will be shown on header area.' ),
	   'before_widget' => '',
	   'after_widget'  => '',
	   'before_title'  => '',
	   'after_title'   => '',
	) );

	register_sidebar( array(
	   'name'          => __( 'Footer Credits' ),
	   'id'            => 'footer-links-socials',
	   'description'   => __( 'Widgets in this area will be shown on footer area.' ),
	   'before_widget' => '',
	   'after_widget'  => '',
	   'before_title'  => '',
	   'after_title'   => '',
	) );

}


add_filter( 'wp_get_attachment_image_attributes', __NAMESPACE__ . '\\link365_lazy_load_images' );
/**
 * Filter in the new loading attribute on images.
 *
 * @param array $attributes Existing image attributes.
 *
 * @return array
 */
function link365_lazy_load_images( $attributes ) {
	return array_merge( $attributes, [
		'loading' => 'lazy'
	] );
}


/** Remove site footer **/
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

/** Customize and apply site footer **/
add_filter( 'genesis_pre_get_option_footer_text', __NAMESPACE__ . '\\custom_footer' );

function custom_footer() {
	include locate_template( 'template-parts/footer-credits.php' );
	return false;
}
