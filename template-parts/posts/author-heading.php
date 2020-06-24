<?php
/**
 * Partial: Author Intro Heading
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

 $intro = get_field('intro', "user_{$authorid}");
 $description = get_field('brief_description', "user_{$authorid}");
?>

<section class="intro-heading spacer">
  <div class="container position-relative text-center">
  <?php if( $intro ) : ?>
    <h2><?php echo $intro; ?></h2>
  <?php endif; ?>
  <?php if( $description ) : ?>
    <div class="intro text-center"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
  <?php endif; ?>
  </div>
</section>
