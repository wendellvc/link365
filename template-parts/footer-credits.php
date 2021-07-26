<?php
	$start = ( !empty($start) ? $start : '2021' );
	$year = ( $start == date('Y') ? $start : "{$start}-".date('Y') );

?>
<div class="container text-center">
	
	<div class="copyright-tm-company-registration-wrapper">
		<div class="copyright-trademark">&copy; Copyright <?php echo $year .' - '. get_bloginfo( 'description' ); ?></div>
	</div>

</div>