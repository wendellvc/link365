<?php
/**
 * Partial: Author Header banner
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

  $imgID = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_image', true );
  $img = wp_get_attachment_image_src($imgID, 'full');

  $authorid = $_GET['authorid'];
  $author = get_user_meta($authorid);

  $photo_url = get_field('photo', "user_{$authorid}");

  if( !empty($img) ) :
?>

<section class="banner">
  <div class="position-relative">

  	<div class="page-banner-content-wrapper position-absolute w-100">
  		<div class="container">
    		<div class="entry-content d-flex justify-content-center align-items-center">
          <h2><?php echo $author['first_name'][$count] .' '. $author['last_name'][$count]; ?></h2>
    		</div>
    	</div>
  	</div>
    <div class="user-photo-wrapper position-absolute w-100 d-flex justify-content-center">
      <div class="user-photo" style="background-image: url('<?php echo $photo_url; ?>');"></div>
    </div>

  	<div class="header-banner-container">
        <div class="header-banner-img" style="background-image: url('<?php echo $img[0]; ?>');"></div>
  	</div>

  </div>
</section>

<?php endif; ?>
