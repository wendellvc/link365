<?php
/**
 * Partial: Columns
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

  $id_attr = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_id_attribute', true );
  $cl_attr = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_class_attribute', true );
  $intro = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_intro_text', true );
  $boxes = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes', true );
  $file = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_downloadable_file', true );
  $cta_label = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_label', true );
  $cta_url = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_url', true );

  $ctr = 1;
?>

<section <?php echo ( $id_attr ? 'id="'.$id_attr.'"' : 'id="column_grids"' ) . ( $cl_attr ? 'class="'.$cl_attr.' spacer position-relative"' : 'class="spacer position-relative"' ); ?>>
  <div class="container">

    <div class="intro text-center"><?php echo wp_kses_post( wpautop( $intro ) ); ?></div>

    <div class="<?php echo ( $boxes > 3 ? 'col' : 'd-flex justify-content-center' ) ?>">
    <?php
    for ( $i = 0; $i < $boxes; $i++ ) {

      $icon = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_image', true );
      $title = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_title', true );
      $subtitle = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_boxes_' . $i . '_subtext', true );

      // if( $id_attr ) :
        // if ( $boxes >= 3 ) :
          if ( $ctr == 1 ) :
            echo '<div class="row w-100 text-center">';
          endif;
        // endif;
      // endif; ?>
      <div class="img-wrapper text-center <?php echo ( $ctr == 1 ? 'first' : ( $ctr == 2 ? 'middle' : ( $ctr == 3 ? 'last' : '' ) ) ); ?>">
        <img src="<?php echo wp_get_attachment_image_url( $icon, 'full' ); ?>">
        <div class="title"><?php echo wp_kses_post( wpautop( $title ) ); ?></div>
        <div class="subtext"><?php echo wp_kses_post( wpautop( $subtitle ) ); ?></div>
      </div>
    <?php
      // if( $id_attr ) :
        // if ( $boxes >= 3 ) :
          if ( $ctr == 3 ) :
            echo '</div>';
          endif;
        // endif;
      // endif;
      $ctr++;
      $ctr = ( $ctr > 3 ? 1 : $ctr );
    } ?>
    </div>

  <?php if( !empty($file) ): ?>
    <div class="call_to_action justify-content-center position-absolute">
      <a href="<?php echo $file; ?>" class="btn bgfull">Download Price List</a>
    </div>
  <?php endif; ?>
  <?php if( !empty($cta_label) ): ?>
    <div class="call_to_action justify-content-center position-absolute">
      <a href="<?php echo $cta_url; ?>" class="btn bgfull"><?php echo $cta_label; ?></a>
    </div>
  <?php endif; ?>
  </div>
</section>
