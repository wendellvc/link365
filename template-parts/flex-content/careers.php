<?php
/**
 * Partial: Careers page
 *
 */

 $posts_per_page = get_field('posts_per_page', $post_id);

  global $post;
  global $paged;  // current paginated page
  $args = array(
   'posts_per_page' => $posts_per_page,
   'post_type' => 'careers'
  );

  /* get Careers posts */
  $posts = get_posts( $args );
  $posts_count = count($posts);
  $ctr = 1;
?>

<section id="careers" class="listings">
  <div id="blog-section" class="spacer">
    <div class="container">
    <?php if( $posts ) : ?>
      <div id="ajax_posts" class="position-relative">
      <?php
        foreach ( $posts as $post ) : setup_postdata( $post );
          $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full'); ?>
        <div class="row w-100 text-center">
          <div class=" d-inline-block box-wrapper box-careers position-relative">
            <div class="box career box-shadow text-left">
              <?php
                $headline = get_the_title();
                $headline = substr($headline, 0, 60);
                $location = get_field('location', $post->ID);
                $salary = get_field('salary', $post->ID);
                $summary = get_field('summary', $post->ID);
              ?>
                <div class="the_title text-white"><?php echo $headline; ?></div>
                <div class="loc_salary"><?php echo $location .' / '. $salary; ?></div>
                <?php
                if( !empty($summary) ) :
                echo '<div class="content-excerpt">'. $summary .'</div>';
                endif;
                ?>

                <div class="call_to_action">
                  <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="btn bgfull">FIND OUT MORE</a>
                </div>
            </div>
          </div>
        </div>
      <?php
        endforeach;
        wp_reset_postdata(); ?>

      </div><!-- ajax_posts -->

    <?php else: ?>
      <div class="alert alert-primary text-center" role="alert">There are no vacancies at present.</div>
    <?php endif; ?>

    </div><!-- container -->

    <?php if( $posts_count > $posts_per_page ) : ?>
    <!-- LOAD MORE POSTS -->
    <div class="container">
      <input type="hidden" id="posts_per_page" data-posts="<?php echo $posts_per_page; ?>">
      <div id="msg_notice" class="text-center"></div>
      <div class="call_to_action d-flex justify-content-center">
        <input type="hidden" id="post_type" value="careers">
        <a href="javascript:;" id="more_custom_posts" class="btn btn_cta">Load more</a>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>
