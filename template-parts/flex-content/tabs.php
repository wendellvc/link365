<?php
/**
* View: Tabs with CTA
*
* @package   WDC\Theme
* @author    Wendell Cabalhin <wendell.cabalhin@intimation.co.uk>
* @copyright Copyright (c) 2018, Intimation Creative Ltd
* @license   MIT
*
* @var array $benefits tabs and contents
*/

$tabs = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_tabs', true );

?>
<section id="benefits" class="tabs-container spacer">

  <div class="container position-relative">

    <div class="benefits-container">
      <div class="tabs d-flex justify-content-center">
      <?php
        $ctr = 1;
        for ( $i = 0; $i < $tabs; $i++ ) {
          $active = ( $ctr == 1 ? 'active' : '' );
          $name = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_tabs_' . $i . '_name', true );
          echo '<a href="javascript:;" id="tab_'.$ctr.'" data-slide="'. $ctr .'" data-tabname="'. strtolower(str_replace(' ', '_', $name)) .'" class="nav_tab '. $active .'">'. strtoupper($name) .'</a>';

          $ctr++;
        } ?>
      </div><!-- tabs closing -->

      <div class="swiper-wrapper">
      <?php
        for ( $i = 0; $i < $tabs; $i++ ) {
          $title = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_tabs_' . $i . '_title', true );
          $details = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_tabs_' . $i . '_details', true );
          $cta_label = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_tabs_' . $i . '_cta_label', true );
          $cta_url = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_tabs_' . $i . '_cta_url', true );
      ?>

        <div class="swiper-slide d-flex justify-content-center">
          <div class="tab-container">
            <div class="tab-content">
              <div class="tab-title text-center"><?php echo wp_kses_post( wpautop( $title ) ); ?></div>
              <div class="text-center"><?php echo wp_kses_post( wpautop( $details ) ); ?></div>
              <div class="call_to_action d-flex justify-content-center"><a href="<?php echo $cta_url; ?>" class="btn btn_cta bg-full"><?php echo $cta_label; ?></a></div>
            </div>
          </div>
        </div>

      <?php
        } ?>
      </div><!-- swiper-wrapper closing -->

      <!-- Add Pagination -->
      <div class="swiper-pagination"></div>
      <!-- Add Arrows -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

    </div>

  </div><!-- container -->

</section>
