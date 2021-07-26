<?php
/**
 * Theme setup.
 *
 * @package   Link365\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2021
 * @copyright MIT
 */

namespace Link365\Theme;

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
			'primary' => __( 'Primary Menu', 'link365' ),
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