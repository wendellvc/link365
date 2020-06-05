<?php
  /**
  * Partial: Left Vertical Slides
  *
  * @var int $post_id Post ID
  * @var string $wdc_page_builder Name of current flex content row.
  */

  $heading = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_heading', true );
  $icon = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_icon', true );
  $title = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_title', true );
  $subtitle = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_subtitle', true );
  $subtext = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_subtext', true );

  $slides = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_slides', true );
?>

<section id="left_vertical_slides" class="spacer position-relative">
  <div class="container">

    <?php if( $heading ) : ?>
    <div class="intro text-center"><?php echo wp_kses_post( wpautop( $heading ) ); ?></div>
    <?php endif; ?>


    <div class="left-wrapper d-flex align-items-center position-relative">
      <div class="box-col img-wrap slides-container ml-auto">
        <div class="swiper-wrapper position-relative">
          <?php for ( $i = 0; $i < $slides; $i++ ) {
            $img = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_slides_' . $i . '_image', true );
            ?>
              <div class="swiper-slide img-wrap">
                <img src="<?php echo wp_get_attachment_image_url( $img, 'full' ); ?>">
              </div>
          <?php } ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
      </div>
      <div class="box-col text-wrap mr-auto">
        <?php if($icon) : ?>
        <img src="<?php echo wp_get_attachment_image_url( $icon, 'full' ); ?>">
        <?php endif; ?>
        <div class="title"><?php echo wp_kses_post( wpautop( $title ) ); ?></div>
        <div class="subtitle"><?php echo wp_kses_post( wpautop( $subtitle ) ); ?></div>
        <div class="subtext"><?php echo wp_kses_post( wpautop( $subtext ) ); ?></div>
      </div>
    </div>

  <?php if( !empty($cta_label) ): ?>
    <div class="call_to_action">
      <a href="<?php echo $cta_url; ?>" class="btn bgfull"><?php echo $cta_label; ?></a>
    </div>
  <?php endif; ?>

  </div>
</section>
