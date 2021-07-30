<?php
/**
 * Partial: Invoices Content
 */

// get the title of the custom post type - Invoices
$title = get_the_title();

$post_per_page = 5;
$paged = ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

$args = array(
  'post_type' => 'invoices',
  'post_status' => 'publish',
  'orderby' => array( 'post_date' => 'ASC'),
  'posts_per_page' => $post_per_page,
  'paged' => $paged 
);

$invoices = new WP_Query( $args );

$total_pages = $invoices->max_num_pages;

?>

<section class="page-content <?php echo strtolower($title); ?>">

  <span id="posts_per_page" data-ppp="<?php echo $post_per_page; ?>"></span>

  <div class="container">
    <div class="row">
      <div class="col-sm-12 entry-title">
        <h1 class="page-title"><?php echo $title; ?></h1>
      </div>
    </div>

    <div id="notification"></div>
    
    <!-- start of status filter section -->
    <div class="row">
      <div class="container-fluid filter-container d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <div class="me-lg-auto">
          <a class="btn-status-filter-all btn btn-default active" href="<?php echo esc_url( home_url( '/' ) ); ?>" role="button" data-status="all">ALL</a>
          <a class="btn-status-filter btn btn-default" href="javascript:;" role="button" data-status="ongoing">ONGOING</a>
          <a class="btn-status-filter btn btn-default" href="javascript:;" role="button" data-status="verified">VERIFIED</a>
          <a class="btn-status-filter btn btn-default" href="javascript:;" role="button" data-status="pending">PENDING</a>
          <a class="btn-status-filter btn btn-default" href="javascript:;" role="button" data-status="paid">PAID</a>
        </div>
        <div id="filter_wrapper" class="col-12 col-lg-auto mb-lg-0 me-lg-3">
          <form class="">
            <div class="input-group">
              <span class="input-group-text" id="addon-filter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> From</span>
              <input type="text" class="form-control form-control-dark" placeholder="24/05/2018 &rarr; 31/05/2018" aria-label="Search" aria-describedby="addon-filter">
            </div>
          </form>
        </div>
        <div id="search_wrapper" class="col-12 col-lg-auto mb-lg-0 me-lg-3">
          <form class="">
            <div class="input-group">
              <span class="input-group-text" id="addon-search"><i class="fas fa-search"></i></span>
              <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search" aria-describedby="addon-search">
            </div>
          </form>
        </div>
        <div class="text-end">
          <a id="mark_as_paid" class="btn btn-warning" href="javascript:;" role="button">Mark as paid</a>
        </div>
      </div>
    </div>
    <!-- end of status section -->
    
    <!-- start of table section -->
    <div class="row">
      <div class="col-sm-12 invoices mb-3">
        <div id="tbl_ajax" class="table-wrapper rounded">

          <table class="table table-sm table-responsive">
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
              </tr>
            <?php
            if( $invoices ) :
              foreach( $invoices->posts as $key => $invoice ) : 

                // status
                $status = get_post_meta($invoice->ID, 'status');
                $status = ( !empty( $status[0] ) ? $status[0] : '' ) ;
                $class = '';
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
            ?>
              <tr>
                <td class="d-flex flex-wrap align-items-center justify-content-center">
                  <div class="form-check custom-control custom-checkbox mb-0">
                    <input class="form-check-input mb-0 checkbox_select" name="invoice_id[]" type="checkbox" value="" data-checkboxid="<?php echo $invoice->ID; ?>" id="checkbox_select_<?php echo $invoice->ID; ?>">
                  </div>
                </td>
                <td class="tbl_text">#<?php echo str_pad($invoice->ID, 5, '0', STR_PAD_LEFT); ?></td>
                <td>
                  <div class="d-flex">
                    <svg class="bd-placeholder-img rounded d-block" width="20" height="20" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 20x20" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
                    <div class="tbl_text"><?php echo $invoice->post_title; ?></div>
                  </div>
                </td>
                <td class="tbl_text"><span id="status_update_<?php echo $invoice->ID; ?>" class="badge rounded-pill <?php echo $class; ?>"><?php echo strtoupper($status); ?></span></td>
                <td class="tbl_text"><?php echo ( !empty($start[0]) ? $start[0] : '' ); ?></td>
                <td class="tbl_text"><?php echo ( !empty($end[0]) ? $end[0] : '' ); ?></td>
                <td class="tbl_text"><?php echo ( !empty($total[0]) ? 'HK$'. $total[0] : '' ); ?></td>
                <td class="tbl_text"><?php echo ( !empty($fees[0]) ? 'HK$'. $fees[0] : '' ); ?></td>
                <td class="tbl_text"><?php echo ( !empty($transfer[0]) ? 'HK$'. $transfer[0] : '' ); ?></td>
                <td class="tbl_text"><?php echo ( !empty($orders[0]) ? $orders[0] : '' ); ?></td>
                <td class="tbl_text">
                <?php echo file_get_contents(get_stylesheet_directory_uri().'/assets/images/svg/cloud-download.svg'); ?>
                </td>
              </tr>
            <?php
              endforeach;
            endif;
            ?>
            </tbody>
          </table>

          <!-- start of pagination -->
          <diV class="pagination_wrapper">
            <div class="col-sm-12 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start ps-md-3 pe-md-3">
              <div class="me-lg-auto">PAGE <span><?php echo $paged; ?></span> OF <?php echo $total_pages; ?></div>
              <div class="col-12 col-lg-auto mb-lg-0">
                <?php wpbeginner_numeric_posts_nav( $invoices ); ?>
              </div>
            </div>
          </diV><!-- end of pagination -->
          
        </div>
      </div>
    </div><!-- end of table section -->
    
  </div>
</section>

<?php wp_reset_postdata(); ?>
