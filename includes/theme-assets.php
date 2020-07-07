<?php
/**
 * Theme scripts and styles.
 *
 * @package   WDC\Theme
 * @author    Wendell Cabalhin <wendell.cabalhin@intimation.co.uk>
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
	// wp_register_style( 'bootstrap', asset( '../develop/vendor/bootstrap/css/bootstrap.min.css' ), false, CHILD_THEME_VERSION );
	wp_enqueue_style( 'wdc', asset( 'css/style.css' ), [
		'normalize',
		'font-awesome',
		'google-fonts',
		// 'bootstrap'
	], CHILD_THEME_VERSION );

	wp_register_script( 'swiper', asset( '../develop/vendor/swiper/js/swiper.js' ), [ 'jquery' ], CHILD_THEME_VERSION );
	wp_register_script( 'classie', asset( '../develop/vendor/classie.js' ), [ 'jquery' ], CHILD_THEME_VERSION );
	wp_register_script( 'collapse', asset( '../develop/vendor/collapse.js' ), [ 'jquery' ], CHILD_THEME_VERSION );
	wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDPTyrj4PIpTT1uS11c_ST6n7n4VUQl57g', [ 'jquery' ], CHILD_THEME_VERSION );

	// Custom home page scripts & styles.
	// wp_register_script( 'home', asset( 'js/home.js' ), [ 'swiper' ], CHILD_THEME_VERSION, true );
	// wp_register_style( 'global', asset( 'css/global.css' ), false, CHILD_THEME_VERSION );

	// wp_enqueue_script( 'bootstrap-js', asset( '../develop/vendor/bootstrap/js/bootstrap.min.js'), ['jquery'], CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'wdc', asset( 'js/wdc.js' ), ['jquery', 'swiper', 'classie', 'collapse', 'google-map'], CHILD_THEME_VERSION, true );

	wp_localize_script( 'wdc', 'ajax_posts', array(
	  'ajaxurl' => admin_url( 'admin-ajax.php' ),
	  'noposts' => __('No older posts found', 'wdc'),
	));

}

add_action('wp_ajax_nopriv_wdc_load_more_post_ajax', __NAMESPACE__ . '\\wdc_load_more_post_ajax');
add_action('wp_ajax_wdc_load_more_post_ajax', __NAMESPACE__ . '\\wdc_load_more_post_ajax');

if ( ! function_exists( 'wdc_ajax_load_more_post' ) ) {
	function wdc_load_more_post_ajax() {
		$out = '';
		$ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
		$page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
		$categories = ( isset($_POST['cat']) ? explode('_', $_POST['cat']) : '' );
		$post_type = (isset($_POST['post_type'])) ? $_POST['post_type'] : '';
		$ctr = 1;

		header("Content-Type: text/html");

		if( !empty($post_type) ) :
			$args = array( 'posts_per_page' => $ppp, 'post_type' => $post_type, 'paged' => $page );
		else :
			$args = array( 'posts_per_page' => $ppp, 'cat' => $categories, 'paged' => $page );
		endif;

		$posts = get_posts( $args );

		if ($posts) :
			foreach ( $posts as $post ) : setup_postdata( $post );
				$ID = $post->ID;

				/*
				** FOR TESTIMONIALS
				*/
				if( $post_type == 'testimonials' ) {
						$out .= '<section id="divider_thin">
						  <div class="container">
						    <div class="img_quote m-auto"><img src="'. get_stylesheet_directory_uri() .'/assets/images/svg/WDC_Quote_ORANGE.svg"></div>
						    <div class="divider-thin m-auto"></div>
						  </div>
						</section>';
						$out .= '<div class="row w-100 text-center testimonial">';
						$out .= '<div class="t_details">'. wp_kses_post( wpautop( $post->post_content ) ) .'</div>';
						$out .= '<div class="t_logo"><img src="'. get_the_post_thumbnail_url($ID, 'full') .'"></div>';
						$out .= '</div>';


				/*
				** FOR CAREERS
				*/
				} elseif ( $post_type == 'careers' ) {


				/*
				** FOR BLOG POSTS, AND CASE STUDIES
				*/
				} else {

					$featured_img_url = get_the_post_thumbnail_url($ID, 'full');

					if ( $ctr == 1 ) :
						$out .= '<div class="row w-100 text-center">';
					endif;

					$out .= '<div class=" d-inline-block box-wrapper position-relative '. ( $ctr == 1 ? 'first' : ( $ctr == 2 ? 'middle' : ( $ctr == 3 ? 'last' : '' ) ) ) .'">
						<div class="box box-shadow text-center">';
						if($featured_img_url) :
							// $out .='<img src="'. $featured_img_url .'">';
							$out .='<div class="img_box" style="background-image: url('. $featured_img_url .');"></div>';
						else :
							// $out .= '<img src="'. get_stylesheet_directory_uri() .'/assets/images/svg/WDC_Logo_Marker.svg'. '" class="img-dummy">';
							$out .= '<div class="img_box" style="background-image: url('. get_stylesheet_directory_uri() .'/assets/images/svg/WDC_Logo_Marker.svg);"></div>';
						endif;

							$headline = get_the_title($ID);
							if( strlen($headline) > 40 )
								$headline = substr($headline, 0, 40).'...';

							$out .= '<div class="'. ( $post_type == 'case-studies' ? 'title' : 'the_title text-white' ) .'">'. $headline .'</div>';
							$out .= '<div class="date-author">'. get_the_date( 'd/m/Y', $post->ID ) .' - by <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ). '?authorid='. $post->post_author .'" title="View Author Listing">'. the_author() .'</a></div>';

							if( !empty(get_the_excerpt($ID)) ) :
								$out .= '<div class="content-excerpt">';
								$excerpt = get_the_excerpt($ID);
								if( strlen($excerpt) > 150 )
                  $excerpt = substr($excerpt, 0, 150).'...';
								$out .= $excerpt;
								$out .= '</div>';
							endif;

							$out .= '<div class="call_to_action justify-content-center">
								<a href="'. esc_url( get_the_permalink($ID) ) .'" class="bg-less">
									<span class="btn_arrow"></span>
								</a>
							</div>
						</div>
					</div>';

					if ( $ctr == 3 ) :
						$out .= '</div>';
					endif;

					$ctr++;
					$ctr = ( $ctr > 3 ? 1 : $ctr );

				}

			endforeach;
		endif;

		wp_reset_postdata();
		wp_die($out);
		ob_clean();
	}
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
