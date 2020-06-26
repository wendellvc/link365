<?php
  /**
  * Partial: Author/Category Listing Intro Heading
  *
  * @var int $post_id Post ID
  * @var string $wdc_page_builder Name of current flex content row.
  */

  $id = ( isset($_GET['authorid']) ? $_GET['authorid'] : '' );
  $categoryid = ( isset($_GET['categoryid']) ? $_GET['categoryid'] : '' );

  $intro = get_field('intro', "user_{$authorid}");
  $cat_metas = get_category($categoryid);
  $intro = ( !empty($intro) ? $intro : $cat_metas->name );

  $description = get_field('brief_description', "user_{$authorid}");

  $posts_per_page = get_field('posts_per_page', 20);
  $args = array(
    'posts_per_page' => $posts_per_page,
    // 'post_type' => $post_type,
    'author' => $id,
    'cat' => $categoryid,
    // 'paged' => $paged
  );

  $posts = get_posts( $args );
  $no_of_articles = count($posts);
  $article_label = ( $no_of_articles > 1 ? ' ARCTICLES' : ' ARTICLE' );
  $description = ( !empty($description) ? $description : $no_of_articles .$article_label );

  if( !empty($intro) || !empty($description) ) : ?>

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

<?php endif; ?>
