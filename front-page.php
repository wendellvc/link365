<?php
/**
 * Front page template.
 *
 * @package   Link365\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2018
 * @license   MIT
 */

add_action( 'wp_head', 'link365_front_page_setup', 5 );
/**
 * Build our custom front page.
 *
 * @return void
 * @since 1.0.0
 *
 */
function link365_front_page_setup() {

	// Load home page scripts and styles.
	wp_enqueue_style( 'home' );
	// JS
	wp_enqueue_script( 'home' );

	// Force full width content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Add body class.
	add_filter( 'body_class', function ( $classes ) {
		return array_merge( $classes, [ 'front-page' ] );
	} );

	// Remove all of the extra markup around <main>.
	add_filter( 'genesis_markup_site-inner', '__return_null' );
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

	// Remove the Genesis post title and default loop.
	// remove_action( 'genesis_post_title', 'genesis_do_post_title' );
	// remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	remove_action( 'genesis_loop', 'genesis_do_loop' );

	// Output custom page header.
	add_action( 'genesis_loop', 'link365_output_invoices_content' );

}

/**
 * Invoices content
 */
function link365_output_invoices_content() {
	include locate_template( 'template-parts/cpt-content/invoices-content.php');
}

/**
 * Pagination function
 * @param	object		$result		returned by the WP_Query
 */
function wpbeginner_numeric_posts_nav($result) {
	
    if( ! is_page('invoices') )
        return;
 
    /** Stop execution if there's only 1 page */
    if( $result->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'page' ) ? absint( get_query_var( 'page' ) ) : 1;
    $max   = intval( $result->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul class="pagination">' . "\n";
 
    /** Previous Post Link */
	$url = 'javascript:;';
	$disabled = 'disabled';
	if( $paged != 1 ) :
        if( $paged > 2 ) {
            $url = esc_url( get_pagenum_link( $paged - 1 ) );
        } else {
            $url = esc_url( get_pagenum_link( 1 ) );
        }
		$disabled = '';
	endif;
	printf( '<li class="page-item '. $disabled .'">%s</li>' . "\n", '<a href="'. $url .'" class="page-link btn-prev"> &lt; </a>' );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? 'active' : '';
		
        printf( '<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li class="page-item"><a class="page-link" href="javascript:;">…</a></li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? 'active' : '';
        printf( '<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
		echo '<li class="page-item"><a class="page-link" href="javascript:;">…</a></li>' . "\n";
 
        $class = $paged == $max ? 'active' : '';
        printf( '<li class="page-item %s"><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
	$url = 'javascript:;';
	$disabled = 'disabled';
	if( $paged != $max ) : 
        if( $link < $max ) {
            $url = esc_url( get_pagenum_link( $link + 1 ) );
        } else {
            $url = esc_url( get_pagenum_link( $link - 1 ) );
        }
		
		$disabled = '';
	endif;
	printf( '<li class="page-item '. $disabled .'">%s</li>' . "\n", '<a href="'. $url .'" class="page-link btn-prev"> &gt; </a>' );
 
    echo '</ul></div>' . "\n";
 
}

genesis();
