<div class="container text-center">
	<div class="logo-address-wrapper">
		<?php
			$start = ( !empty($start) ? $start : '2020' );
			$year = ( $start == date('Y') ? $start : "{$start}-".date('Y') );

			if( is_active_sidebar('footer-links-socials') ) {
				dynamic_sidebar('footer-links-socials');
			}
		?>
		<div class="textwidget custom-html-widget">
			<div class="address"><?php echo get_field('address_1', 'option'); ?>, <span class="d-inline-block"><?php echo get_field('address_2', 'option'); ?></span><br>
				<span class="d-inline-block"><span class="contact_label">T</span><span><a id="tel" href="tel:<?php echo get_field('phone', 'option'); ?>"><?php echo get_field('phone', 'option'); ?></a></span></span>
				<span class="separator">|</span>
				<span class="contact_label">E</span><a href="mailto:<?php echo get_field('email_address', 'option'); ?>"><span><?php echo get_field('email_address', 'option'); ?></span></a>
			</div>
		</div>
	</div>

	<div class="copyright-tm-company-registration-wrapper">
		<div class="copyright-trademark">&copy; Copyright <?php echo $year .' '. get_bloginfo( 'description' ); ?> Ltd&trade;</div>
		<?php
			if( is_active_sidebar('company-registration') ) {
				dynamic_sidebar('company-registration');
			}
		?>
	</div>

	<div class="footer-socials-wrapper">
		<div class="textwidget custom-html-widget">
			<a href="<?php echo get_field('instagram', 'option'); ?>"><i class="icons instagram"></i></a>
			<a href="<?php echo get_field('facebook', 'option'); ?>"><i class="icons facebook"></i></a>
			<a href="<?php echo get_field('linkedin', 'option'); ?>"><i class="icons linkedin"></i></a>
		</div>

		<?php
			if( is_active_sidebar('footer-socials') ) {
				dynamic_sidebar('footer-socials');
			}
		?>
	</div>
</div>

<div class="back-to-top">
	<div class="d-flex justify-content-center"><a id="back_to_top" href="#">BACK TO TOP</a></div>
</div>
