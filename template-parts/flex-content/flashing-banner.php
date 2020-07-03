<?php
/**
 * Partial: Flashing banner
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

 $class = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_css_class', true );
 $show = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_show', true );
 $details = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_details', true );
 $dismissable = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_dismissable', true );
 $cta_label = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_label', true );
 $cta_url = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_cta_url', true );

 if( $show ) :
?>
<section id="flashing-banner" class="alert alert-dismissible fade show mb-0 rounded-0 <?php echo ( !empty($class) ? $class : '' ); ?>" role="alert">
  <div <?php echo ( $dismissable ? 'id="flashing-banner-shadow"' : 'id="flashing-banner-no-shadow"' ); ?>>
      <div class="container position-relative d-flex flex-column align-items-center text-center">
      <?php if( $class ) : ?>
        <p><?php echo $details; ?>
      <?php else : ?>
        <?php echo wp_kses_post( wpautop( $details ) ); ?>
      <?php endif; ?>
      
      <?php if( $cta_url ) : ?>
        <a href="<?php echo $cta_url; ?>" class="ml-1 bgcolor"><?php echo $cta_label; ?><span class="btn_arrow tail"></span></a>
      <?php endif; ?>

      <?php if( $class ) : ?>
        </p>
      <?php endif; ?>

        <?php if( $dismissable ) : ?>
        <button type="button" class="close p-0" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/svg/close.svg" alt="Close"></span>
        </button>
        <?php endif; ?>
    </div>
  </div>
</section>

<?php endif; ?>
