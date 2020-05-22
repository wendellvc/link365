<?php
/**
 * Partial: Contact Form
 *
 * @var int $post_id Post ID
 * @var string $custom_page_builder Name of current flex content row.
 */

 $details = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_details', true );

?>
<section id="contact" class="flex-content flex-content--contact-form contact-form">
	<div class="container">
  	<?php echo wp_kses_post( wpautop( $details ) ); ?>
  	<?php // echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="true"]' ); ?>
  	<?php gravity_form( 1, false, false, false, '', true ); ?>
  </div>
</section>
