<?php
/**
* Single post/ event template.
*
* @package   Link365\Theme
* @author    Wendell cabalhin <cabalhinwendell@gmail.com>
* @copyright Copyright (c) 2021
* @license   MIT
**/

add_action( 'wp_head', 'link365_blog_single_setup' );
/**
 * Build our archive template.
 *
 * @since 1.0.0
 *
 * @return void
 */
function link365_blog_single_setup() {

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
	add_action( 'genesis_before_loop', 'link365_output_posts_wrapper_open' );

	/* post title, featured image, date, author */
	add_action( 'genesis_before_loop', 'link365_output_posts_heading_metas' );

	add_action( 'genesis_loop', 'link365_output_flex_content' );

	/* display the previous and nect post */
	add_action( 'genesis_after_loop', 'link365_output_share_buttons' );

	add_action( 'genesis_after_loop', 'custom_prev_next_post_nav' );

	add_action( 'genesis_after_loop', 'link365_output_posts_wrapper_close' );

}

/*
** start of the home/frontpage contents
*/
function link365_output_flex_body_class( $classes ) {
	return array_merge( [ 'uses-flex-content', 'blog' ], $classes );
}

/**
 * Output single-post wrapper open.
 *
 * @since 1.0.0
 *
 * @return void
 */
function link365_output_posts_wrapper_open() {
	include locate_template( 'template-parts/posts/listings-wrapper-open.php' );
}

/**
 * Output single-post meta-details.
 *
 * @since 1.0.0
 *
 * @return void
 */
function link365_output_posts_heading_metas() {
	include locate_template( 'template-parts/posts/post-meta-heading.php' );
}

function link365_output_flex_content() {
	$post_id = get_the_ID(); /* post ID */

	$link365_page_builder = get_post_meta( $post_id, 'link365_page_builder', true );

	$post = get_post($post_id);
	// print_r($post);
	if( $link365_page_builder ) :
		foreach ( $link365_page_builder as $count => $layout ) {
			if( $post->post_type == 'post' ) :
			switch ( $layout ) {
				case 'single_column':
					include locate_template( 'template-parts/posts/single-column.php');
					break;
				case 'two_columns':
					include locate_template( 'template-parts/posts/two-columns.php');
					break;
			}
			endif;
		}
	endif;

}


/**
 * Output single-post wrapper close.
 *
 * @since 1.0.0
 *
 * @return void
 */
function link365_output_share_buttons() {

	/* SHARE BUTTON */
	if( is_active_sidebar('btn-share') ) {
		echo '<div class="container">';
			echo '<div class="d-flex justify-content-center">';
				echo '<div class="shareit-buttons mt-2 mb-2">';
				dynamic_sidebar('btn-share');
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
}

/**
 * Output single-post wrapper close.
 *
 * @since 1.0.0
 *
 * @return void
 */
function link365_output_posts_wrapper_close() {
	include locate_template( 'template-parts/posts/listings-wrapper-close.php' );
}

function custom_prev_next_post_nav() {
	// echo get_previous_posts_link();
	// if( get_previous_posts_link() || get_next_post_link() ) :
		echo '<div class="adjacent-entry-pagination pagination">';
		previous_post_link( '<div class="pagination-previous alignleft d-flex align-items-center justify-content-center"> %link</div>', '<span class="adjacent-post-link">&laquo; %title</span>' );
		next_post_link( '<div class="pagination-next alignright d-flex align-items-center justify-content-center"> %link</div>', '<span>%title &raquo;</span>' );
		echo '</div><!-- .prev-next-navigation -->';
	// endif;
}


genesis();
