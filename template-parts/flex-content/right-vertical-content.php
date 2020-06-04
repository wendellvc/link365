<?php
/**
 * Partial: Right Vertical Content
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
?>

<section id="right_content" class="spacer position-relative">
  <div class="container">

    <div class="right-wrapper d-flex align-items-center position-relative">
      <div class="box-col text-wrap ml-auto">
        <div class="title"><?php echo wp_kses_post( wpautop( $title ) ); ?></div>
        <div class="subtitle"><?php echo wp_kses_post( wpautop( $subtitle ) ); ?></div>
        <div class="subtext"><?php echo wp_kses_post( wpautop( $subtext ) ); ?></div>
      </div>
      <div class="box-col img-wrap mr-auto">
        <div class="position-relative">
          <div class="img-wrap">
            <img src="<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>">
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
