<?php

  /**
  * Partial: Home Blog posts
  * @var int $post_id Post ID
  */

  $id = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_css_id', true );
  $class = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_css_class', true );

  $ctr = 1;
  $args = array(
    'posts_per_page' => 3,
    'post_type' => ''
  );

  /* get posts from POSTS type */
  $posts = get_posts( $args );
?>
<section id="<?php echo $id; ?>" class="listings <?php echo $class; ?>">
	<div id="blog-section" class="spacer pt-0">
    <div class="container">

    <?php if( $posts ) : ?>
      <div id="ajax_posts" class="position-relative">
      <?php
        $i = 0;
        foreach ( $posts as $post ) : setup_postdata( $post );
          // echo '<pre>'; print_r($post); echo '</pre>';
          $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');

          $categories = get_the_category($post->ID);
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
              $headline = get_the_title($post->ID);
              if( strlen($headline) > 40 )
								$headline = substr($headline, 0, 40).'...';
              // $headline = substr($headline, 0, strrpos($headline, ' '));
            ?>
              <div class="the_title text-white d-flex align-items-center"><?php echo $headline; ?></div>
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
    </div><!-- container -->


    <!-- VIEW MORE POSTS -->
    <div class="container">
      <div class="call_to_action d-flex justify-content-center mt-2 mb-0">
        <a href="/blog" class="btn btn_cta">VIEW ALL NEWS</a>
      </div>
    </div>

  </div>
</section>
