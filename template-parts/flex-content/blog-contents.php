<?php

  /**
  * Partial: Blog posts
  * was included in the intro-heading with validation to check the blog ID and then display
  * @var int $post_id Post ID
  */

  global $post;
  $args = array( 'posts_per_page' => 3, 'category_name' => 'blog' );

  /* get posts from Blog category */
  $posts = get_posts( $args );
  $ctr = 1;
?>

<div id="blog-section" class="">
  <div class="container position-relative">
    <div class="d-flex justify-content-center position-relative">
    <?php
      foreach ( $posts as $post ) : setup_postdata( $post );
        $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
    ?>
      <div class="box-wrapper position-relative<?php echo ( $ctr == 1 ? ' first' : ( $ctr == 2 ? ' middle' : ( $ctr == 3 ? ' last' : '' ) ) ); ?>">
        <div class="box box-shadow text-center">
            <img src="<?php echo $featured_img_url; ?>">
            <div class="the_title text-white"><?php echo get_the_title(); ?></div>

            <div class="date-author"><?php echo get_the_date( 'd/mY', $post->ID ) .' - by '. get_the_author(); ?></div>
            <?php
            if( !empty(get_the_excerpt($post->ID)) ) :
            echo '<div class="content-excerpt">';
              $excerpt = get_the_excerpt($post->ID);

              $excerpt = substr($excerpt, 0, 260);
              $result = substr($excerpt, 0, strrpos($excerpt, ' '));
              echo $result;
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
        $ctr++;
        $ctr = ( $ctr > 3 ? 1 : $ctr );
      endforeach;
      wp_reset_postdata(); ?>
    </div>

    <div class="call_to_action d-flex justify-content-center">
      <a href="blog" class="btn bgfull">VIEW ALL NEWS</a>
    </div>
  </div>
</section>
