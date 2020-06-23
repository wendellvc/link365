<?php
/**
 * View: Listings wrapper open.
 *
 * @package   WDC\Theme
 * @author    Wendell Cabalhin <wendell.cabalhin@intimation.co.uk>
 * @copyright Copyright (c) 2018, Intimation Creative Ltd
 * @license   MIT
 */

	$post_type = get_post_type( get_the_ID() );

?>
<section id="single-post-section" class="blog-single-post spacer pb-0">

	<div class="breadcrumbs">
		<div class="container d-flex justify-content-center">
				<div class="call_to_action back-to-overview">
					<a href="<?php echo ( $post_type == 'case-studies' ? '/work' : ( $post_type == 'careers' ? '/careers' : '/blog' ) ); ?>" class="btn btn_cta">BACK TO OVERVIEW</a>
				</div>
		</div>
	</div>

	<!-- <div class="container"> -->
