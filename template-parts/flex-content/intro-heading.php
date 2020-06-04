<?php
/**
 * Partial: Columns
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

 $intro = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_details', true );
 $css_id = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_css_id', true );
 $id = ( !empty($css_id) ? 'id="'. $css_id .'"' : '' );
?>

<section <?php echo $id; ?> class="intro-heading spacer">
  <div class="container position-relative text-center">
  <?php if( $intro ) : ?>
    <div class="intro text-center"><?php echo wp_kses_post( wpautop( $intro ) ); ?></div>
  <?php endif; ?>

    <?php
    /*
    **
    **  Validates if there is a CSS ID being set on the Intro Heading
    **  if there is, and is equal to the WDC blog, then display blog category posts
    */
    if( $css_id == 'wdc_blog' ) {
      include locate_template( 'template-parts/flex-content/blog-contents.php');
    }
  ?>
  </div>
</section>
