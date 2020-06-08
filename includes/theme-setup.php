<?php
/**
 * Theme setup.
 *
 * @package   WDC\Theme
 * @author    Craig Simpson <craig.simpson@intimation.uk>
 * @copyright Copyright (c) 2019, Intimation Creative
 * @copyright MIT
 */

namespace WDC\Theme;

add_action( 'genesis_setup', __NAMESPACE__ . '\\theme_setup', 15 );
/**
 * Theme Setup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function theme_setup() {

	$theme_support = [
		'genesis-accessibility'       => [
			'404-page',
			'headings',
			'rems',
			'search-form',
		],
		'genesis-footer-widgets'      => 4,
		'genesis-menus'               => [
			'primary' => __( 'Primary Menu', 'wdc' ),
		],
		'genesis-responsive-viewport' => null,
		'genesis-structural-wraps'    => [
			'header',
			'site-inner',
			'footer-widgets',
			'footer',
		],
		'html5'                       => [
			'caption',
			'gallery',
			'search-form',
		],
		/**
		 * Enable features from Soil when plugin is activated
		 *
		 * @link https://roots.io/plugins/soil/
		 */
		'soil-clean-up'               => null,
		'soil-disable-trackbacks'     => null,
		'soil-jquery-cdn'             => null,
		'soil-nav-walker'             => null,
		'soil-nice-search'            => null,
		'soil-relative-urls'          => null,
	];

	array_map( 'add_theme_support', array_keys( $theme_support ), $theme_support );

}

add_action( 'init', __NAMESPACE__ . '\\add_image_sizes' );
/**
 * Add theme specific image sizes.
 *
 * @since 0.1.0
 *
 * @return void
 */
function add_image_sizes() {

	$image_sizes = [
		'banner-image' => [ 1280, 800, true ],
	];

	array_walk( $image_sizes, function ( $args, $name ) {
		add_image_size( $name, $args[0], $args[1], isset( $args[2] ) ? $args[2] : false );
	} );

}

function wdc_acf_google_map_api( $api ){

	$api['key'] = 'AIzaSyDPTyrj4PIpTT1uS11c_ST6n7n4VUQl57g';

	return $api;

}

add_filter('acf/fields/google_map/api', __NAMESPACE__ . '\\wdc_acf_google_map_api');

function wdc_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyDPTyrj4PIpTT1uS11c_ST6n7n4VUQl57g');
}

add_action('acf/init', __NAMESPACE__ . '\\wdc_acf_init');
