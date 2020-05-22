<div class="container text-center">
	<div class="logo-address-wrapper">
		<?php
			$start = ( !empty($start) ? $start : '2020' );
			$year = ( $start == date('Y') ? $start : "{$start}-".date('Y') );

			if( is_active_sidebar('footer-links-socials') ) {
				dynamic_sidebar('footer-links-socials');
			}
		?>
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
