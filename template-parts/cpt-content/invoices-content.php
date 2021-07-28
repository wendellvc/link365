<?php
/**
 * Partial: Invoices Content
 */

// get the title of the custom post type - Invoices
$title = get_the_title();

$post_per_page = -1;

$args = array(
  'post_type' => 'invoices',
  'post_status' => 'publish',
  'orderby' => array( 'post_date' => 'ASC'),
  'posts_per_page' => $post_per_page
);

$invoices = get_posts( $args );
// print_r($invoices);
?>

<section class="page-content <?php echo strtolower($title); ?>">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 entry-title">
        <h1 class="page-title"><?php echo $title; ?></h1>
      </div>
    </div>
    
    <div class="row">
      <div class="container-fluid filter-container d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <div class="me-lg-auto">
          <a class="btn btn-default active" href="#" role="button">ALL</a>
          <a class="btn btn-default" href="#" role="button">ONGOING</a>
          <a class="btn btn-default" href="#" role="button">VERFIFIED</a>
          <a class="btn btn-default" href="#" role="button">PENDING</a>
          <a class="btn btn-default" href="#" role="button">PAID</a>
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
          <a class="btn btn-warning" href="#" role="button">Mark as paid</a>
        </div>
      </div>
    </div>
    

    <div class="row">
      <div class="col-sm-12 invoices">
        <div class="table-wrapper rounded">
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
              foreach( $invoices as $key => $invoice ) :
            ?>
              <tr>
                <td class="d-flex flex-wrap align-items-center justify-content-center">
                  <div class="form-check custom-control custom-checkbox mb-0">
                    <input class="form-check-input mb-0" type="checkbox" value="" id="checkbox_all">
                  </div>
                </td>
                <td class="tbl_text">#<?php echo str_pad($invoice->ID, 5, '0', STR_PAD_LEFT); ?></td>
                <td>
                  <div class="d-flex">
                    <svg class="bd-placeholder-img rounded d-block" width="20" height="20" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 20x20" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
                    <div class="tbl_text"><?php echo $invoice->post_title; ?></div>
                  </div>
                </td>
                <td class="tbl_text"><span class="badge rounded-pill bg-success"><?php echo strtoupper('VERIFIED'); ?></span></td>
                <td class="tbl_text">16/08/2018</td>
                <td class="tbl_text">16/08/2018</td>
                <td class="tbl_text">HK$2.99</td>
                <td class="tbl_text">HK$2.99</td>
                <td class="tbl_text">HK$2.99</td>
                <td class="tbl_text">20</td>
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
        </div>
      </div>
    </div>
    
  </div>
</section>
