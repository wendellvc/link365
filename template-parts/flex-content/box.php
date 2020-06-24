<?php
/**
 * Partial: Box
 */
?>

<div class="box box-shadow text-center <?php echo $cl_attr; ?>">
  <?php $img = ( $img ? $img : get_stylesheet_directory_uri() .'/assets/images/svg/WDC_DEFAULT_TEAM.svg' ); ?>
  <div class="img_box" style="background-image: url('<?php echo $img; ?>');"></div>
  <!-- <img src="<?php echo $img; ?>" class="img-responsive"> -->
  <div class="main-title"><?php echo $title; ?></div>
  <div class="subtitle"><?php echo $subtitle; ?></div>
  <div class="subtext"><?php echo wp_kses_post( wpautop( $subtext ) ); ?></div>

  <?php if( $profile_label ) : ?>
    <div class="call_to_action justify-content-center">
      <a href="<?php echo $profile_link; ?>" class="bg-less"><?php echo $profile_label; ?></a>
    </div>
  <?php endif; ?>

</div>
