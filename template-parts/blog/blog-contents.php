<?php

  /**
  * Partial: Blog posts
  * was included in the intro-heading with validation to check the blog ID and then display
  * @var int $post_id Post ID
  */
  $blog_ID = 20;
  $cat_ID = 1;
  $posts_per_page = get_field('posts_per_page', $blog_ID);

  global $post;
  global $paged;  // current paginated page
  $args = array(
    'posts_per_page' => $posts_per_page,
    // 'category_name' => 'blog',
    'cat' => $cat_ID,
    // 'paged' => $paged
  );

  /* get posts from Blog category */
  $posts = get_posts( $args );

  $ctr = 1;
?>
<section class="listings">
	<div id="blog-section" class="spacer">
    <div class="container">
      <div id="ajax_posts" class="position-relative">
      <?php
        foreach ( $posts as $post ) : setup_postdata( $post );
          $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');

            if ( $ctr == 1 ) :
              echo '<div class="row w-100 text-center">';
            endif;
      ?>
        <div class=" d-inline-block box-wrapper position-relative<?php echo ( $ctr == 1 ? ' first' : ( $ctr == 2 ? ' middle' : ( $ctr == 3 ? ' last' : '' ) ) ); ?>">
          <div class="box box-shadow text-center">
            <?php if($featured_img_url) : ?>
              <img src="<?php echo $featured_img_url; ?>">
            <?php else: ?>
              <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/svg/WDC Logo_Marker.svg'; ?>" class="img-dummy">
            <?php endif; ?>
            <?php
              $headline = get_the_title();

              $headline = substr($headline, 0, 60);
              // $headline = substr($headline, 0, strrpos($headline, ' '));
            ?>
              <div class="the_title text-white"><?php echo $headline; ?></div>

              <div class="date-author"><?php echo get_the_date( 'd/mY', $post->ID ) .' - by '. get_the_author(); ?></div>


              <?php
              if( !empty(get_the_excerpt($post->ID)) ) :
              echo '<div class="content-excerpt">';
                $excerpt = get_the_excerpt($post->ID);

                $excerpt = substr($excerpt, 0, 150);
                // $result = substr($excerpt, 0, strrpos($excerpt, ' '));
                echo $excerpt;
              echo '</div>';
              endif;
              ?>

              <div class="call_to_action justify-content-center">
                <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="bg-less">
                  <span class="btn_arrow"></span>
                </a>
              </div>
          </div>
        </div>
      <?php
          if ( $ctr == 3 ) :
            echo '</div>';
          endif;

          $ctr++;
          $ctr = ( $ctr > 3 ? 1 : $ctr );
        endforeach;
        wp_reset_postdata(); ?>
      </div>
    </div><!-- container -->
    <div class="container">
      <input type="hidden" id="posts_per_page" data-posts="<?php echo $posts_per_page; ?>">
      <div id="msg_notice" class="text-center"></div>
      <div class="call_to_action d-flex justify-content-center">
        <a href="javascript:;" id="more_posts" data-catid="<?php echo $cat_ID; ?>" class=" btn btn_cta">Load more</a>
      </div>
    </div>
  </div>
</section>
