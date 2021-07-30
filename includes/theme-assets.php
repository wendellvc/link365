<?php
/**
 * Theme scripts and styles.
 *
 * @package   Link365\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2021
 * @copyright MIT
 */

namespace Link365\Theme;

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
	wp_register_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css', false, '5.2.0' );
	wp_register_style( 'bootstrap', asset( '../develop/vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css' ), false, CHILD_THEME_VERSION );
	wp_enqueue_style( 'link365', asset( 'css/style.css' ), [
		'normalize',
		'font-awesome',
		'bootstrap'
	], CHILD_THEME_VERSION );

	wp_enqueue_script( 'bootstrap-js', asset( '../develop/vendor/bootstrap-5.0.2-dist/js/bootstrap.min.js'), ['jquery'], CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'link365', asset( 'js/link365.js' ), ['jquery'], CHILD_THEME_VERSION, true );

	wp_localize_script( 'link365', 'ajax_posts', array(
	  'ajaxurl' => admin_url( 'admin-ajax.php' ),
	  'noposts' => __('No older posts found', 'link365'),
	));

}


add_action('wp_ajax_nopriv_link365_load_filter_status_post_ajax', __NAMESPACE__ . '\\link365_load_filter_status_post_ajax');
add_action('wp_ajax_link365_load_filter_status_post_ajax', __NAMESPACE__ . '\\link365_load_filter_status_post_ajax');

if ( ! function_exists( 'link365_load_filter_status_post_ajax' ) ) {
	function link365_load_filter_status_post_ajax() {

		$post_per_page = ( isset( $_POST['ppp'] ) ? $_POST['ppp'] : 5 );
		$status = ( isset( $_POST['status'] ) ? $_POST['status'] : '' );
		$paged = (isset($_POST['page'])) ? $_POST['page'] : 1;
		$html = '';
		$ctr = 1;

		header("Content-Type: text/html");

		if( $status == 'all' ) {
			$meta_query = '';
		} else {
			$meta_query = array(
				array(
				  'key' => 'status',
				  'value' => $status,
				  'compare' => '='
				)
			);
		}

		$args = array(
			'post_type' => 'invoices',
			'post_status' => 'publish',
			'orderby' => array( 'post_date' => 'ASC'),
			// 'posts_per_page' => $post_per_page,
			'posts_per_page' => -1,
			'paged' => $paged,
			'meta_query' => $meta_query
		);
		
		$invoices = get_posts( $args );

		$html .= '<table class="table table-sm table-responsive">
					<tbody>
					<tr>
						<td class="d-flex flex-wrap align-items-center justify-content-center">
						<div class="form-check custom-control custom-checkbox mb-0">
							<input class="form-check-input mb-0" type="checkbox" value="" id="checkbox_all">
						</div>
						</td>
						<td>
						<div class="d-flex flex-wrap align-items-center">ID</div>
						</td>
						<td>RESTAURANT</td>
						<td>STATUS</td>
						<td>START DATE</td>
						<td>END DATE</td>
						<td>TOTAL</td>
						<td>FEES</td>
						<td>TRANSFER</td>
						<td>ORDERS</td>
						<td></td>
					</tr>';
		
		if ($invoices) :
			foreach ( $invoices as $key => $invoice ) : setup_postdata( $invoice );

				$ID = $invoice->ID;

				// status
                if( strtolower($status) == 'pending' )
                  $class = 'bg-warning';
                if( strtolower($status) == 'ongoing' )
                  $class = 'bg-light text-dark';
                if( strtolower($status) == 'verified' )
                  $class = 'bg-success';
                if( strtolower($status) == 'paid' )
                  $class = 'bg-info';
                
                // start date
                $start = get_post_meta($invoice->ID, 'start_date');
                
                // end date
                $end = get_post_meta($invoice->ID, 'end_date');
                
                // end date
                $total = get_post_meta($invoice->ID, 'total');
                
                // end date
                $fees = get_post_meta($invoice->ID, 'fees');
                
                // end date
                $transfer = get_post_meta($invoice->ID, 'transfer');
                
                // end date
                $orders = get_post_meta($invoice->ID, 'orders');

				$html .= '<tr>
					<td class="d-flex flex-wrap align-items-center justify-content-center">
					<div class="form-check custom-control custom-checkbox mb-0">
						<input class="form-check-input mb-0" type="checkbox" value="" id="checkbox_select">
					</div>
					</td>
					<td class="tbl_text">#'. str_pad($invoice->ID, 5, '0', STR_PAD_LEFT) .'</td>
					<td>
					<div class="d-flex">
						<svg class="bd-placeholder-img rounded d-block" width="20" height="20" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 20x20" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
						<div class="tbl_text">'. $invoice->post_title .'</div>
					</div>
					</td>
					<td class="tbl_text"><span class="badge rounded-pill '. $class .'">'. strtoupper($status) .'</span></td>
					<td class="tbl_text">'. ( !empty($start[0]) ? $start[0] : '' ) .'</td>
					<td class="tbl_text">'. ( !empty($end[0]) ? $end[0] : '' ) .'</td>
					<td class="tbl_text">'. ( !empty($total[0]) ? 'HK$'. $total[0] : '' ) .'</td>
					<td class="tbl_text">'. ( !empty($fees[0]) ? 'HK$'. $fees[0] : '' ) .'</td>
					<td class="tbl_text">'. ( !empty($transfer[0]) ? 'HK$'. $transfer[0] : '' ) .'</td>
					<td class="tbl_text">'. ( !empty($orders[0]) ? $orders[0] : '' ) .'</td>
					<td class="tbl_text">
					'. file_get_contents(get_stylesheet_directory_uri().'/assets/images/svg/cloud-download.svg') .'
					</td>
				</tr>';
					
				endforeach;
			endif;

			$html .= '</tbody>
				</table>';

		wp_reset_postdata();
		wp_die($html);
		ob_clean();
	}
}

add_action('wp_ajax_nopriv_link365_update_posts_status_ajax', __NAMESPACE__ . '\\link365_update_posts_status_ajax');
add_action('wp_ajax_link365_update_posts_status_ajax', __NAMESPACE__ . '\\link365_update_posts_status_ajax');

if ( ! function_exists( 'link365_update_posts_status_ajax' ) ) {
	function link365_update_posts_status_ajax() {

		$strIDs = ( isset( $_POST['IDs'] ) ? $_POST['IDs'] : '' );
		$html  = '';

		$arrayIDs = explode(',', $strIDs);

		header("Content-Type: text/html");

		if( !empty( $arrayIDs ) ) {
			foreach( $arrayIDs as $key => $postid ) {
				update_post_meta($postid, 'status', 'paid'); // We will update the field.
			}

			$html .= '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<i class="far fa-check-circle"></i>
				<strong>Success</strong> The record/s is/are now marked as paid.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
		} else {
			$html .= '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<i class="fas fa-exclamation-triangle"></i>
				<strong>Warning</strong> No record to be updated.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
		}

		wp_reset_postdata();
		wp_die($html);
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