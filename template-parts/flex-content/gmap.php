<?php
/**
 * Partial: Google Map
 *
 * @var int $post_id Post ID
 * @var string $custom_page_builder Name of current flex content row.
 */

 $map = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_gmap', true );

?>
<section id="gmap" class="flex-content flex-content--contact-form contact-form">
	<?php echo $map; ?>
</section>
