/**
* Theme JavaScript.
*
* @package   WDC\Theme
* @author    Wendell Cabalhin <wendell.cabalhin@intimation.co.uk>
* @copyright Copyright (c) 2019, Intimation Creative
* @copyright MIT
*/

(function ($) {
 	'use strict';

  /********************************************
   * Benefit tabs slides.
   ********************************************/
   var service_swiper = new Swiper('.benefits-container', {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });

  /* when nav-tab is clicked, it should switch on the corresponding pagination dot/bullet */
  $('.nav_tab').on('click', function(e) {
    e.preventDefault();
    var idx = $(this).data('slide');

    /* setting an active nav-tab */
    $('.nav_tab').removeClass('active');
    $(this).addClass('active');

    /* to navigate to the corresponding pagination when a specific nav-tab is clicked */
    var slide = $('.swiper-pagination span:nth-child('+ idx +')');
    slide.click();

  });

  /* when pagination dot/bullet is clicked, it should switch on the corresponding nav-tab */
  $('.approaches-pagination > span').on('click', function(e) {

    var idx = $(this).attr('aria-label').slice(-1);

    /* set to the corresponding nav-tab when a specific pagination is clicked */
    $('.tabs a').removeClass('active');
    $('.tabs a:nth-child('+ idx +')').addClass('active');

  });

})(jQuery);
