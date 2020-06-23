<?php
/**
* Single post/ event template.
*
* @package   WDC\Theme
* @author    Wendell cabalhin <wendell.cabalhin@intimation.co.uk>
* @copyright Copyright (c) 2019, Intimation Creative
* @license   MIT
**/

add_action( 'wp_head', 'wdc_blog_single_setup' );
/**
 * Build our archive template.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wdc_blog_single_setup() {

	// Force full width content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Add body class.
	add_action( 'body_class', 'wdc_output_flex_body_class' );

	// Remove all of the extra markup around <main>.
	add_filter( 'genesis_markup_site-inner', '__return_null' );
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

	// Don't include .wrap for site-inner.
	add_theme_support( 'genesis-structural-wraps', [] );


	/* remove post content, header and footer markups */
	//* Remove the entry header markup (requires HTML5 theme support)
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
	add_action( 'genesis_before_loop', 'wdc_output_posts_wrapper_open' );

}

/*
** start of the home/frontpage contents
*/
function wdc_output_flex_body_class( $classes ) {
	return array_merge( [ 'uses-flex-content', 'blog' ], $classes );
}

/**
 * Output single-post wrapper open.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wdc_output_posts_wrapper_open() {
	include locate_template( 'template-parts/posts/listings-wrapper-open.php' );
}

add_action( 'genesis_entry_header', 'wdc_article_wrapper_open', 5 );
/**
 * Output article wrapper open.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wdc_article_wrapper_open() {
	echo '<div class="container">
					<div class="entry-header">';/* <!-- closing div is found before wdc_output_excerpt -->*/
}

add_action( 'genesis_entry_header', 'genesis_do_post_title', 5 );
add_action( 'genesis_entry_header', 'genesis_do_post_title', 5 );

add_action( 'genesis_before_entry_content', 'wdc_output_excerpt', 5);
/**
 * Output the excerpt.
 *
 * @return void
 * @since 0.1.0
 */
function wdc_output_excerpt() {
	?>
	<!-- opening div is found after .container - wdc_article_wrapper_open -->
	</div><!-- closing .entry-header -->

	<div class="entry-excerpt">
		<p><?php echo get_the_excerpt(); ?></p>
	</div>
	<?php
}

add_action( 'genesis_before_entry_content', 'wdc_output_featured_image', 5 );
/**
 * Output the featured image.
 *
 * @return void
 * @since 0.1.0
 */
function wdc_output_featured_image() {
	?>
	<div class="entry-image">
	<?php
		if( has_post_thumbnail() ) :
			the_post_thumbnail( 'full' );
		else :
			echo '<div class="img_box" style="background-image: url('. get_stylesheet_directory_uri() .'/assets/images/svg/WDC_Logo_Marker.svg)"></div>';
		endif;
	?>
	</div>
	<?php
}

add_action( 'genesis_entry_content', 'wdc_output_blog_content' );
/**
 * Output the featured image.
 *
 * @return void
 * @since 0.1.0
 */
function wdc_output_blog_content() {

	$categories = get_the_category();
	$list = array();
	foreach($categories as $cat) {
		$list[] = $cat->name;
	}
	$list = implode(', ', $list);
	?>
	<div class="primary-content mt-1">
		<div class="category"><?php echo $list; ?></div>
		<div class="date-author"><?php echo get_the_date( 'd/mY' ) .' - by '. get_the_author(); ?></div>
		<div class="mt-1"><?php echo the_content(); ?></div>

		<!-- SHARE BUTTON -->
		<?php
			if( is_active_sidebar('btn-share') ) {
				echo '<div class="shareit-buttons mt-2 mb-2">';
				dynamic_sidebar('btn-share');
				echo '</div>';
			}
		?>

	</div>
	<?php
}

add_action( 'genesis_after_entry_content', 'wdc_article_wrapper_close', 15 );
/**
 * Output article wrapper open.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wdc_article_wrapper_close() {
	echo '</div>';
}


add_action( 'genesis_after_loop', 'wdc_output_posts_wrapper_close' );
/**
 * Output single-post wrapper close.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wdc_output_posts_wrapper_close() {
	include locate_template( 'template-parts/posts/listings-wrapper-close.php' );
}

/* display the previous and nect post */
add_action( 'genesis_entry_footer', 'genesis_prev_next_post_nav', 12 );

genesis();
