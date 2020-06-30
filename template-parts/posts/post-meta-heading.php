<?php
/**
 * Partial: Post meta details/heading - Posts
 *
 * @var int $post_id Post ID
 * @var string $wdc_page_builder Name of current flex content row.
 */
	$categories = get_the_category();
	$list = array();

	foreach($categories as $cat) {
		$list[] = '<a href="'. get_category_link($cat->cat_ID) .'?categoryid='. $cat->cat_ID .'">'. $cat->name .'</a>';
	}

	$list = implode(', ', $list);

	$post = get_post(get_the_ID());

?>

<div class="container">
	<div class="entry-header">
		<h1 class="entry-title"><?php echo $post->post_title; ?></h1>
	</div>
</div>

<div class="entry-image mt-2 mb-2">
<?php
	if( has_post_thumbnail() ) :
		the_post_thumbnail( 'full' );
	else :
		echo '<div class="img_box" style="background-image: url('. get_stylesheet_directory_uri() .'/assets/images/svg/WDC_Logo_Marker.svg)"></div>';
	endif;
?>
</div>

<div class="primary-content text-center">
	<div class="category"><?php echo $list; ?></div>
	<div class="date-author">
	<?php
		echo get_the_date( 'd/m/Y', get_the_ID() ) .' - by '; ?>
		<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ), get_the_author_meta( 'user_nicename', $post->post_author ) ). '?authorid='. get_the_author_meta( 'ID', $post->post_author ); ?>" title="View Author Listing"><?php echo get_the_author_meta( 'display_name', $post->post_author ); ?></a>
	</div>

</div>
