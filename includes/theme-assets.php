<?php
/**
 * Theme scripts and styles.
 *
 * @package   WDC\Theme
 * @author    Craig Simpson <craig.simpson@intimation.uk>
 * @copyright Copyright (c) 2019, Intimation Creative
 * @copyright MIT
 */

namespace WDC\Theme;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );
/**
 * Skeleton scripts and styles.
 *
 * @since 0.1.0
 *
 * @return void
 */
function enqueue_scripts() {

	wp_register_style( 'normalize', asset( 'css/normalize.css' ), false, '8.0.0' );
	wp_register_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', false, '5.2.0' );
	wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;700&display=swap', [], CHILD_THEME_VERSION );
	wp_register_style( 'bootstrap', asset( '../develop/vendor/bootstrap/css/bootstrap.min.css' ), false, CHILD_THEME_VERSION );
	wp_enqueue_style( 'wdc', asset( 'css/style.css' ), [
		'normalize',
		'font-awesome',
		'google-fonts',
		'bootstrap'
	], CHILD_THEME_VERSION );

	wp_register_script( 'swiper', asset( '../develop/vendor/swiper/js/swiper.js' ), [ 'jquery' ], CHILD_THEME_VERSION );
	// wp_register_script( 'bootstrap-js', asset( '../develop/vendor/bootstrap/js/bootstrap.min.js' ), [ 'jquery' ], CHILD_THEME_VERSION );

	// Custom home page scripts & styles.
	// wp_register_script( 'home', asset( 'js/home.js' ), [ 'swiper' ], CHILD_THEME_VERSION, true );
	// wp_register_style( 'global', asset( 'css/global.css' ), false, CHILD_THEME_VERSION );

	wp_enqueue_script( 'bootstrap-js', asset( '../develop/vendor/bootstrap/js/bootstrap.min.js'), ['jquery'], CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'wdc', asset( 'js/wdc.js' ), [], CHILD_THEME_VERSION, true );

}

if ( ! function_exists( 'asset' ) ) {
	/**
	 * Return a hashed asset name if it exists.
	 *
	 * @param string $path Relative path to asset.
	 *
	 * @return string
	 */
	function asset( $path ) {
		static $manifest = null;

		if ( null === $manifest ) {
			$manifest_path = get_stylesheet_directory() . '/assets/assets.json';
			$manifest      = file_exists( $manifest_path ) ? json_decode( file_get_contents( $manifest_path ), true ) : [];
		}

		if ( array_key_exists( $path, $manifest ) ) {
			return esc_url( get_stylesheet_directory_uri() . '/assets/' . $manifest[ $path ] );
		}

		return esc_url( get_stylesheet_directory_uri() . '/assets/' . $path );
	}
}
