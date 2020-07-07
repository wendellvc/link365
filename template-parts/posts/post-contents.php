<?php

  /**
  * Partial: Posts and Custom Post Types
  * was included in the intro-heading with validation to check the blog ID and then display
  * @var int $post_id Post ID
  */

  $id = get_the_ID();

  $post = get_post($post_id);
  $slug = $post->post_name;
  if( $slug == 'careers' ) {
    include locate_template( 'template-parts/flex-content/careers.php');

  // } elseif( $slug == 'author' ) {
  } elseif( $slug == 'home' ) {
    include locate_template( 'template-parts/posts/home-blog-contents.php');
  } else {

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
  $all_posts = get_posts( array('post_type' => $post_type) );
  $posts_count = count($all_posts);
  $cat_count = count($categories);
  $ctr = 1;
?>
<section id="<?php echo $posts_for; ?>" class="listings">
	<div id="blog-section" class="spacer">

  <?php if( $posts_for == '' ) : ?>
    <div class="container mb-2">
        <!-- APPLIES TO BLOG POSTS -->
        <div class="filter-by-category text-center mb-1">
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/svg/SMALL_ICON_FILTER.svg'; ?>" class="filter_by_icon">
          </a>
          <p class="mt-1">FILTER RESULTS</p>
        </div>
        <div class="collapse" id="collapseExample">
          <div class="card card-body d-flex justify-content-center">
            <?php
            foreach( $categories as $category ) :  ?>
              <label class="btn opt_toggle btn-secondary">
                <input type="checkbox" name="categoryid[]" class="opt_category" value="<?php echo $category->term_id; ?>"> <?php echo trim($category->name); ?>
              </label>
            <?php endforeach; ?>
          </div>
        </div>
    </div>
  <?php endif; ?>

    <?php if( $posts_for == 'case_studies' ) : ?>
    <!-- FILTER BY CATEGORIES -->
    <div class="container">

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
        <?php /*else : ?>
          <label class="btn opt_toggle btn-secondary active">
            <input type="radio" name="categoryid" value="" class="opt_category" checked> All
          </label>

        <?php
        foreach( $categories as $category ) :  ?>
          <label class="btn opt_toggle btn-secondary">
            <input type="radio" name="categoryid" class="opt_category" value="<?php echo $category->term_id; ?>"> <?php echo trim($category->name); ?>
          </label>
        <?php endforeach;*/ ?>
      <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <div class="container">
    <?php if( $posts ) : ?>
      <div id="ajax_posts" class="position-relative">
      <?php
        $i = 0;
        foreach ( $posts as $post ) : setup_postdata( $post );
          // echo '<pre>'; print_r($post); echo '</pre>';
          $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');

          $categories = get_the_category();
        	$list = array();
        	foreach($categories as $cat) {
            // echo '<pre>'; print_r($cat);
        		$list[] = '<a href="'. get_category_link($cat->cat_ID) .'?categoryid='. $cat->cat_ID .'">'. $cat->name .'</a>';
        	}
        	$list = implode(', ', $list);

            if ( $ctr == 1 ) :
              echo '<div class="row w-100 text-center">';
            endif;
      ?>
        <div class=" d-inline-block box-wrapper position-relative<?php echo ( $ctr == 1 ? ' first' : ( $ctr == 2 ? ' middle' : ( $ctr == 3 ? ' last' : '' ) ) ); ?>">
          <div class="box box-shadow text-center">
            <?php if($featured_img_url) : ?>
              <div class="img_box" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>
            <?php else: ?>
              <div class="img_box" style="background-image: url('<?php echo get_stylesheet_directory_uri().'/assets/images/svg/WDC_DEFAULT_CONTENT_ONWHITE_TRANSPARENT.svg'; ?>');"></div>
            <?php endif; ?>
            <?php
              $headline = get_the_title();
              if( strlen($headline) > 40 )
								$headline = substr($headline, 0, 40).'...';
              // $headline = substr($headline, 0, strrpos($headline, ' '));
            ?>
              <div class="<?php echo ( $posts_for == 'case_studies' ? 'title' : 'the_title text-white' ) ?> d-flex align-items-center"><?php echo $headline; ?></div>
              <div class="category"><?php echo $list; ?></div>
              <div class="date-author">
              <?php
                echo get_the_date( 'd/m/Y', $post->ID ) .' - by '; ?>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ). '?authorid='. $post->post_author; ?>" title="View Author Listing"><?php the_author(); ?></a>
              </div>

              <?php
              if( !empty(get_the_excerpt($post->ID)) ) :
              echo '<div class="content-excerpt">';
                $excerpt = get_the_excerpt($post->ID);
                if( strlen($excerpt) > 150 )
                  $excerpt = substr($excerpt, 0, 150).'...';
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

          $i++;
          $ctr++;
          $ctr = ( $ctr > 3 ? 1 : $ctr );
        endforeach;
        wp_reset_postdata();  ?>

      </div><!-- ajax_posts -->
    <?php else: ?>
      <div class="alert alert-primary text-center" role="alert"><strong>Notice</strong> There are no vacancies at present.</div>
    <?php endif; ?>

      <input type="hidden" id="posts_per_page" data-posts="<?php echo $posts_per_page; ?>">
      <input type="hidden" id="categories_count" value="<?php echo $cat_count; ?>">
    </div><!-- container -->

    <?php if( $posts_count > $posts_per_page ) : ?>
    <!-- LOAD MORE POSTS -->
    <div class="container">

      <div id="msg_notice" class="text-center"></div>
      <div class="call_to_action d-flex justify-content-center mt-2 mb-0">
      <?php if( $posts_for == 'case_studies' ) : ?>
        <input type="hidden" id="post_type" value="<?php echo $post_type; ?>">
      <?php else : ?>
        <input type="hidden" id="catid">
      <?php endif; ?>
        <a href="javascript:;" id="<?php echo ( $posts_for == 'case_studies' ? 'more_custom_posts' : 'more_posts' ); ?>" class="btn btn_cta">Load more</a>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php } ?>
