<?php

  /**
  * Partial: Posts and Custom Post Types
  * was included in the intro-heading with validation to check the blog ID and then display
  * @var int $post_id Post ID
  */

  $id = get_the_ID();
  /*
  ** 14 is the Work Page
  ** 20 is the Blog Page
  ** if page ID is not equal to the Blog page ID, then set to the current page ID, else set to Blog Page ID
  */
  $post_ID = ( $id == 14 ? $id : 20 );
  $cat_ID = 1;
  $posts_for = str_replace(' ', '_', strtolower(get_field('posts_for', $post_ID)));
  $posts_per_page = get_field('posts_per_page', $post_ID);
  $post_type = ( $posts_for == 'case_studies' ? 'case-studies' : '' );

  global $post;
  global $paged;  // current paginated page
  $args = array(
    'posts_per_page' => $posts_per_page,
    'post_type' => $post_type,
    // 'category_name' => 'blog',
    // 'cat' => $cat_ID,
    // 'paged' => $paged
  );

  $categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
    )
  );

  /* get posts from Blog category */
  $posts = get_posts( $args );

  $ctr = 1;
?>
<section id="<?php echo $posts_for; ?>" class="listings">
	<div id="blog-section" class="spacer">

    <!-- FILTER BY CATEGORIES -->
    <div class="container">
      <div class="filter-by-category text-center mb-1">
        <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/svg/SMALL_ICON_FILTER.svg'; ?>" class="filter_by_icon">
      </div>
      <div class="categories-list text-center mb-2">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <?php if( $posts_for == 'case_studies' ) : ?>
          <label class="btn opt_posts_toggle btn-secondary active">
            <input type="radio" name="post_type" value="case-studies" class="opt_post_type"> Case Studies
            <!-- <a href="work">Case Studies</a> -->
          </label>
          <label class="btn opt_posts_toggle btn-secondary">
            <input type="radio" name="post_type" value="testimonials" class="opt_post_type"> Testimonials
            <!-- <a href="/work/testimonials/">Testimonials</a> -->
          </label>
        <?php else : ?>
          <label class="btn opt_toggle btn-secondary active">
            <input type="radio" name="categoryid" value="" class="opt_category" checked> All
          </label>

        <?php
        foreach( $categories as $category ) :  ?>
          <label class="btn opt_toggle btn-secondary">
            <input type="radio" name="categoryid" class="opt_category" value="<?php echo $category->term_id; ?>"> <?php echo trim($category->name); ?>
          </label>
        <?php endforeach; ?>
      <?php endif; ?>
        </div>
      </div>
    </div>

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
              <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/svg/WDC_Logo_Marker.svg'; ?>" class="img-dummy">
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

      </div><!-- ajax_posts -->

    </div><!-- container -->

    <!-- LOAD MORE POSTS -->
    <div class="container">
      <input type="hidden" id="posts_per_page" data-posts="<?php echo $posts_per_page; ?>">
      <div id="msg_notice" class="text-center"></div>
      <div class="call_to_action d-flex justify-content-center">
      <?php if( $posts_for == 'case_studies' ) : ?>
        <input type="hidden" id="post_type" value="<?php echo $post_type; ?>">
      <?php else : ?>
        <input type="hidden" id="catid">
      <?php endif; ?>
        <a href="javascript:;" id="<?php echo ( $posts_for == 'case_studies' ? 'more_custom_posts' : 'more_posts' ); ?>" class="btn btn_cta">Load more</a>
      </div>
    </div>
  </div>
</section>