<?php
/**
 * Partial: Intro Heading - Posts
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

 $css_id = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_css_id', true );
 $css_class = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_css_class', true );
 $heading = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_heading', true );
 $headline = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_headline', true );
 $id = ( !empty($css_id) ? 'id="'. $css_id .'"' : '' );
?>

<section <?php echo $id; ?> class="<?php echo $css_class; ?> intro-heading spacer">
  <div class="container position-relative text-center">
  <?php if( $heading ) : ?>
    <h2><?php echo $heading; ?></h2>
  <?php endif; ?>
  <?php if( $headline ) : ?>
    <div class="intro text-center"><?php echo wp_kses_post( wpautop( $headline ) ); ?></div>
  <?php endif; ?>
  </div>
</section>
