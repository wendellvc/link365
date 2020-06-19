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

$gallery = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_images', true );

?>
<section id="gallery" class="spacer">

  <div class="container position-relative">

    <div class="gallery-container">
      <div class="swiper-wrapper">
      <?php
        for ( $i = 0; $i < $gallery; $i++ ) {
          $image = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_images_' . $i . '_image', true );
      ?>

        <div class="swiper-slide d-flex justify-content-center">
          <img src="<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>">
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
