<?php
/**
 * View: Banner.
 *
 * @package   WDC\Theme
 * @author     Cabalhin <wendell.cabalhin@intimation.co.uk>
 * @copyright Copyright (c) 2018, Intimation Creative Ltd
 * @license   MIT
 *
 * @var string $title Page heading.
 * @var string $subtitle Page subtitle.
 * @var array $slides Slide URLs
 */ ?>
<section class="banner">
	<div class="banner-slider-container swiper-container">
		<div class="swiper-wrapper">
			<?php
			$n = 0;
			foreach ( $slides as $slide) {
				$n++;
				?>
				<?php if ( $n == 1 ) { $title = $title_1; $class = 'title_1'; } ?>
				<?php if ( $n == 2 ) { $title = $title_2; $class = 'title_2'; } ?>
				<?php if ( $n == 3 ) { $title = $title_3; $class = 'title_3'; } ?>
				<?php if ( $n == 4 ) { $title = $title_4; $class = 'title_4'; } ?>


				<div data-background="<?php echo esc_url( $slide ); ?>" class="swiper-slide swiper-lazy">

					<div class="wrap">
						<h2 class="<?php echo $class; ?>"><?php echo wp_kses_post( $title ); ?></h2>
					</div>

					<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
				</div>
			<?php  }  ?>
		</div>
		<div class="swiper-pagination"></div>
	</div>
</section>
