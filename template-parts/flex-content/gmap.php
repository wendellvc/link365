<?php
/**
 * Partial: Google Map
 *
 * @var int $post_id Post ID
 * @var string $custom_page_builder Name of current flex content row.
 */

 $map = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_google_map', true );
 $styles = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_styles', true );

?>
<section id="gmap" class="flex-content flex-content--contact-form contact-form">
  <div class="acf-map" data-zoom="16" data-styles="<?php echo $styles; ?>">
      <div class="marker" data-lat="<?php echo esc_attr($map['lat']); ?>" data-lng="<?php echo esc_attr($map['lng']); ?>"></div>
  </div>
</section>
