<?php
/**
* View: Tabs with CTA
*
* @package   WDC\Theme
* @author    Wendell Cabalhin <wendell.cabalhin@intimation.co.uk>
* @copyright Copyright (c) 2018, Intimation Creative Ltd
* @license   MIT
*
* @var array $benefits tabs and contents
*/

$heading = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_heading', true );
$headline = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_headline', true );
$gallery = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_images', true );

?>
<section id="gallery-items" class="spacer gallery-items-container">

  <div class="container position-relative">
    <?php if( $heading || $headline ) : ?>
      <div class="intro text-center">
        <h2><?php echo $heading; ?></h2>
        <?php echo wp_kses_post( wpautop( $headline ) ); ?>
    </div>
    <?php endif; ?>
  </div>
  <div class="container position-relative">

    <div class="gallery_items-container">
      <div class="swiper-wrapper">
      <?php
        for ( $i = 0; $i < $gallery; $i++ ) {
          $image = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_images_' . $i . '_image', true );
          $accreditor = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_images_' . $i . '_title', true );
      ?>

        <div class="swiper-slide d-flex justify-content-center">
          <div class="accreditors text-center">
            <?php if( $image ) : ?>
            <img src="<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>">
            <?php else : ?>
            <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/svg/CRED_DEFAULT.svg'; ?>">
            <?php endif; ?>
            <div class="mt-1"><?php echo $accreditor; ?></div>
          </div>
        </div>

      <?php
        } ?>
      </div><!-- swiper-wrapper closing -->

      <!-- Add Pagination -->
      <!-- <div class="swiper-pagination"></div> -->
      <!-- Add Arrows -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

    </div>

  </div><!-- container -->

</section>
