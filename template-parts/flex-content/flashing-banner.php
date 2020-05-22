<?php
/**
 * Partial: Flashing banner
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

 $show = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_show', true );
 $details = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_details', true );

 if( $show ) :
?>

<section id="flashing-banner" class="flex-content flex-content--flashing-banner flash-banner">
	<div class="container">
    <?php echo wp_kses_post( wpautop( $details ) ); ?>
  </div>
</section>

<?php endif; ?>
