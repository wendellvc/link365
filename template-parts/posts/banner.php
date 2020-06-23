<?php
/**
 * Partial: Blog Header banner
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */

 $imgID = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_image', true );
 $img = wp_get_attachment_image_src($imgID, 'full');

 if( !empty($img) ) :
?>

<section class="banner">
  <div class="position-relative">

  	<div class="page-banner-content-wrapper position-absolute w-100">
  		<div class="container">
    		<div class="entry-content d-flex align-items-center">
    		<?php
          $post = get_post($post_id);
          $content = apply_filters('the_content', $post->post_content);
          echo (!empty($content) ? $content : '<h2>'. get_the_title($post_id) .'</h2>' );
        ?>
    		</div>
    	</div>
  	</div>

  	<div class="header-banner-container">
        <div class="header-banner-img" style="background-image: url('<?php echo $img[0]; ?>');"></div>
  	</div>

  </div>
</section>

<?php endif; ?>
