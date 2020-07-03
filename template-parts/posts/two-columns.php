<?php
/**
 * Partial: Intro Heading - Posts
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

 $l_heading = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_left_content_heading', true );
 $l_content = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_left_content_content', true );
 $r_heading = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_right_content_heading', true );
 $r_content = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_right_content_content', true );
?>

<div class="two-column-content">
  <div class="container position-relative mt-1">
    <div class="row">
      <div class="col">
        <h4><?php echo $l_heading; ?></h4>
        <div><?php echo wp_kses_post( wpautop( $l_content ) ); ?></div>
      </div>
      <div class="col">
        <h4><?php echo $r_heading; ?></h4>
        <div><?php echo wp_kses_post( wpautop( $r_content ) ); ?></div>
      </div>
    </div>
  </div>
</div>
