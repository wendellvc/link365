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
  $download_label = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_download', true );
  $download_url = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_download_url', true );

  $ctr = 1;
?>

<section id="boxes_with_ctas" class="position-relative <?php echo ( $boxes > 3 ? 'products_list' : 'spacer ' ); ?>">
  <div class="container">

    <div class="intro text-center"><?php echo wp_kses_post( wpautop( $intro ) ); ?></div>

    <div class="<?php echo ( $boxes > 3 ? 'text-center products' : 'd-flex justify-content-center' ); ?> position-relative">

    <?php for ( $i = 0; $i < $boxes; $i++ ) {
      $icon = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_image', true );
      $title = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_title', true );
      $text = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_text', true );
      $subtitle = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_subtext', true );
      $link = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_cta_url', true );

      $img = wp_get_attachment_image_url( $icon, 'full' );
      ?>
      <div class="box-wrapper position-relative <?php echo ( $boxes > 3 ? 'float-left' : '' ) . ( $ctr == 1 ? ' first' : ( $ctr == 2 ? ' middle' : ( $ctr == 3 ? ' last' : '' ) ) ); ?>">
        <div class="box box-shadow text-center <?php echo ( $img ? '' : ' bgorange' ); ?>">
        <?php
          if( $img ) : ?>

          <img src="<?php echo $img; ?>">

          <?php if( $link ) : ?>
          <div class="title"><?php echo $title; ?></div>
          <?php else : ?>
          <div class="product_title"><?php echo $title; ?></div>
          <?php endif; ?>

          <div class="subtext"><?php echo wp_kses_post( wpautop( $subtitle ) ); ?></div>
          <?php if( $link ) : ?>
          <div class="call_to_action justify-content-center">
            <a href="<?php echo $link; ?>" class="btn-half-circle position-relative">
              <span class="btn_arrow"></span>
            </a>
          </div>
        <?php
            endif;
          else:
        ?>
          <div class="subtitle"><?php echo wp_kses_post( wpautop( $text ) ); ?></div>
        <?php
          endif;
        ?>
        </div>
      </div>
    <?php
      $ctr++;
      $ctr = ( $ctr > 3 ? 1 : $ctr );
    } ?>

    </div>

  <?php if( !empty($cta_label) ): ?>
    <div class="call_to_action">
      <a href="<?php echo $cta_url; ?>" class="btn bgfull"><?php echo $cta_label; ?></a>
    </div>
  <?php endif; ?>

  <?php if( !empty($download_label) ): ?>
    <div class="spacer d-flex justify-content-center clear">
    <div class="call_to_action">
      <a href="<?php echo $download_url; ?>" class="btn btn_cta"><?php echo $download_label; ?></a>
    </div>
    </div>
  <?php endif; ?>

  </div>
</section>
