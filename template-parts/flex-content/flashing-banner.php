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
<section id="flashing-banner" class="alert alert-dismissible fade show mb-0 rounded-0" role="alert">

    <div class="container position-relative d-flex flex-column align-items-center">
      <?php echo wp_kses_post( wpautop( $details ) ); ?>

      <button type="button" class="close p-0" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
</section>

<?php endif; ?>
