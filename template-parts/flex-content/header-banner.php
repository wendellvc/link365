<?php
/**
 * Partial: Header banner
 *
 * @var int $post_id Post ID
 * @var string $link365_page_builder Name of current flex content row.
 */

 $imgID = get_post_meta( $post_id, 'link365_page_builder_' . $count . '_image', true );
 // echo $imgID;
 $img = wp_get_attachment_image_src($imgID, 'full');
 // $img = genesis_get_image( array($imgID, 'html', 'full') );
// print_r($img);
 if( !empty($img) ) :
?>

<section class="banner">
  <div class="position-relative">

  	<div class="page-banner-content-wrapper position-absolute w-100">
  		<div class="container">
      <?php //if( is_front_page() ) : ?>
    		<div class="entry-content <?php echo ( !is_front_page() ? 'd-flex align-items-center' : '' ); ?>">
    		<?php
          $post = get_post();
          $content = apply_filters('the_content', $post->post_content);
          echo (!empty($content) ? $content : '<h2>'. get_the_title() .'</h2>' );
        ?>
    		</div>
      <?php //else : ?>
        <!-- <h1><?php //echo the_title(); ?></h1> -->
      <?php //endif; ?>
    	</div>
  	</div>

  	<div class="header-banner-container">
        <div class="header-banner-img" style="background-image: url('<?php echo $img[0]; ?>');"></div>
  	</div>

  </div>
</section>

<?php endif; ?>
