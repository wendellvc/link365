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

<section id="boxes_with_ctas" class="spacer position-relative">
  <div class="container">

    <div class="intro text-center"><?php echo wp_kses_post( wpautop( $intro ) ); ?></div>

    <div class="d-flex justify-content-center position-relative">

    <?php for ( $i = 0; $i < $boxes; $i++ ) {
      $icon = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_image', true );
      $title = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_title', true );
      $text = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_text', true );
      $subtitle = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_subtext', true );
      $link = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_cata_url', true );
      ?>
      <div class="box-wrapper position-relative">
        <div class="box box-shadow text-center">
          <img src="<?php echo wp_get_attachment_image_url( $icon, 'full' ); ?>">
          <div class="title"><?php echo $title; ?></div>
          <div class="subtitle"><?php echo wp_kses_post( wpautop( $text ) ); ?></div>
          <div class="subtext"><?php echo wp_kses_post( wpautop( $subtitle ) ); ?></div>
          <div class="call_to_action justify-content-center">
            <a href="<?php echo $link; ?>" class="top">
              <span class="btn_arrow"></span>
            </a>
          </div>
        </div>
      </div>
    <?php } ?>

    </div>

  <?php if( !empty($cta_label) ): ?>
    <div class="call_to_action">
      <a href="<?php echo $cta_url; ?>" class="btn"><?php echo $cta_label; ?></a>
    </div>
  <?php endif; ?>

  </div>
</section>
