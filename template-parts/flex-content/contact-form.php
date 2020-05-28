<?php
/**
 * Partial: Contact Form
 *
 * @var int $post_id Post ID
 * @var string $custom_page_builder Name of current flex content row.
 */

 $details = get_post_meta( $post_id, 'wdc_page_builder_' . $count . '_details', true );

?>
<section id="contact" class="flex-content flex-content--contact-form contact-form spacer">
	<div class="container">
  	<div class="intro text-center">
    	<?php echo wp_kses_post( wpautop( $details ) ); ?>
    </div>

    <div class="form-contact ml-auto mr-auto">
    	<?php gravity_form( 1, false, false, false, '', true ); ?>
    </div>
  </div>
</section>
