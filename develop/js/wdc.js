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

  /********************************************
   * Vertical slides.
   ********************************************/
  var slides_swiper = new Swiper('.slides-container', {
      direction: 'vertical',
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

  /* Fadeout Flash Notice */
  $('.close').on('click', function() {
    setTimeout(function() {
      $('.alert').fadeOut('slow');}, 100
    );
  });

  var backToTop = $('#back_to_top');
  backToTop.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  });


  var docElem = document.documentElement,
      header = document.querySelector( '.site-header' ),
      didScroll = false,
      changeHeaderOn = 100;

  function init() {
      window.addEventListener( 'scroll', function( event ) {
          if( !didScroll ) {
              didScroll = true;
              setTimeout( scrollPage, 250 );
          }
      }, false );
  }

  function scrollPage() {
      var sy = scrollY();
      if ( sy >= changeHeaderOn ) {
          classie.add( header, 'shrink' );
      }
      else {
          classie.remove( header, 'shrink' );
      }
      didScroll = false;
  }

  function scrollY() {
      return window.pageYOffset || docElem.scrollTop;
  }

  init();

})(jQuery);
