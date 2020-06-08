<?php
/**
 * Partial: Boxes Dynamically with Toggle and Slider
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

  $id_attr = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_id_attribute', true );
  $cl_attr = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_class_attribute', true );
  $heading = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_heading', true );
  $details = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_details', true );
  $boxes = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes', true );
  $cta_label = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_label', true );
  $cta_url = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_url', true );
  $ctr = 1;
?>

<!-- <section id="<?php echo $id_attr; ?>" class="position-relative <?php echo ( $boxes > 3 ? 'products_list' : 'spacer ' ); ?>"> -->
<section id="<?php echo ( $id_attr ? $id_attr : 'column_grids' ); ?>" class="<?php echo ( $cl_attr ? $cl_attr.' spacer position-relative' : ( $id_attr == 'boxes_with_ctas' ? 'position-relative products_list' : 'spacer position-relative'  ) ); ?>">
  <div class="container position-relative">

    <!-- heading and details -->
    <?php if( $heading ) :  ?>
    <div class="heading-wrapper text-center">
      <div class="heading intro"><h2><?php echo $heading; ?></h2></div>
      <div class="details"><?php echo wp_kses_post( wpautop( $details ) ); ?></div>
    </div>
    <?php endif; ?>

    <!-- Dynamic Boxes -->
    <!-- <div class="dynamic-boxes d-flex justify-content-center"> -->
    <div class="people-container dynamic-boxes">
      <div class="swiper-wrapper">

        <?php
        $engineer = '';
        $examiner = '';
        $ctr = 1;
        for ( $i = 0; $i < $boxes; $i++ ) :
          /* check if classification is profile then use toggler */
          $profile = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_profile', true );
          $image = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_image', true );
          $title = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_title', true );
          $subtitle = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_subtitle', true );
          $subtext = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_subtext', true );
          $profile_label = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_cta_label', true );
          $profile_link = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_cta_link', true );

          $img = wp_get_attachment_image_url( $image, 'full' );
          // if ( $ctr == 1 ) :
          //   echo '<div class="row">';
          // endif;
          /* user the default boxes display */ ?>
          <div class="swiper-slide default-boxes <?php echo ( $ctr == 1 ? 'first' : ( $ctr == 2 ? 'middle' : ( $ctr == 3 ? 'last' : '' ) ) ); ?>">
            <div class="box box-shadow text-center <?php echo $cl_attr; ?>">
              <?php $img = ( $img ? $img : get_stylesheet_directory_uri() .'/assets/images/svg/WDC_AVATAR.svg' ); ?>
              <img src="<?php echo $img; ?>" class="img-responsive">
              <div class="main-title"><?php echo $title; ?></div>
              <div class="subtitle"><?php echo $subtitle; ?></div>
              <div class="subtext"><?php echo wp_kses_post( wpautop( $subtext ) ); ?></div>

              <?php if( $profile_label ) : ?>
                <div class="call_to_action justify-content-center">
                  <a href="<?php echo $profile_link; ?>" class="bg-less"><?php echo $profile_label; ?><span class="btn_arrow d-block"></span></a>
                </div>
              <?php endif; ?>

            </div>
          </div>

        <?php
        // if ( $ctr == 3 ) :
        //   echo '</div>';
        // endif;
        $ctr++;
        $ctr = ( $ctr > 3 ? 1 : $ctr );
        endfor; ?>
      </div>

      <!-- Add Arrows -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

    </div>

  </div>
</section>
