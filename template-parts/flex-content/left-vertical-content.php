<?php
  /**
  * Partial: Left Vertical Content
  *
  * @var int $post_id Post ID
  * @var string $wdc_page_builder Name of current flex content row.
  */

  $heading = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_heading', true );
  $details = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_details', true );
  $image = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_image', true );
  $title = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_title', true );
  $subtitle = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_subtitle', true );
  $subtext = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_subtext', true );
  $cta_label = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_label', true );
  $cta_url = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_url', true );
?>

<section id="left_content" class="spacer position-relative">
  <div class="container">
    <!-- heading and details -->
    <?php if( $heading || $details ) :  ?>
    <div class="heading-wrapper text-center mb-2">
      <?php if( $heading ) :  ?>
      <div class="heading intro"><h2><?php echo $heading; ?></h2></div>
      <?php endif; ?>
      <?php if( $details ) :  ?>
      <div class="details"><?php echo wp_kses_post( wpautop( $details ) ); ?></div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="left-wrapper d-flex align-items-center position-relative">
      <div class="box-col img-wrap ml-auto">
        <div class="position-relative">
          <div class="img-wrap">
            <img src="<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>">
          </div>
        </div>

      </div>
      <div class="box-col text-wrap mr-auto">
        <div class="title"><?php echo wp_kses_post( wpautop( $title ) ); ?></div>
        <div class="subtitle"><?php echo wp_kses_post( wpautop( $subtitle ) ); ?></div>
        <?php if( $subtext ) :  ?>
        <div class="subtext"><?php echo wp_kses_post( wpautop( $subtext ) ); ?></div>
        <?php endif; ?>
        <?php if( !empty($cta_label) ): ?>
          <div class="call_to_action">
            <a href="<?php echo $cta_url; ?>" class="btn bgfull"><?php echo $cta_label; ?></a>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>
