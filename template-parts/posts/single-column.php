<?php
/**
 * Partial: Single Content Column - Posts
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

 $single_content = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_content', true );

if( $single_content ) : ?>

<div class="single-content">
  <div class="container position-relative">
    <div class="intro"><?php echo wp_kses_post( wpautop( $single_content ) ); ?></div>
  </div>
</div>

<?php
endif;
?>
