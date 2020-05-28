<?php
/**
 * Partial: Columns
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

  $intro = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_intro_text', true );
  $boxes = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes', true );
  $cta_label = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_label', true );
  $cta_url = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_url', true );

?>

<section id="column_grids" class="spacer position-relative">
  <div class="container">

    <div class="intro text-center"><?php echo wp_kses_post( wpautop( $intro ) ); ?></div>
    
    <div class="d-flex justify-content-center">
    <?php for ( $i = 0; $i < $boxes; $i++ ) {
      $icon = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_image', true );
      $title = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_title', true );
      $subtitle = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_subtext', true );
      ?>
      <div class="img-wrapper text-center">
        <img src="<?php echo wp_get_attachment_image_url( $icon, 'full' ); ?>">
        <div class="title"><?php echo $title; ?></div>
        <div class="subtext"><?php echo wp_kses_post( wpautop( $subtitle ) ); ?></div>
      </div>
    <?php } ?>
    </div>

  <?php if( !empty($cta_label) ): ?>
    <div class="call_to_action justify-content-center position-absolute">
      <a href="<?php echo $cta_url; ?>" class="btn btn_cta bg-full"><?php echo $cta_label; ?></a>
    </div>
  <?php endif; ?>
  </div>
</section>
