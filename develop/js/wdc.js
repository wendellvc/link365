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

  $('.collapse').collapse('hide');

  var prevHeight = $('.site-header').height();
  $('.navbar-toggler').on('click', function(){
    if( $('.site-header').hasClass('addedNavbar') ) {
      $('.site-header').removeClass('addedNavbar');
    } else {
      $('.site-header').addClass('addedNavbar');
    }
  });


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
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });

  var gallery_swiper = new Swiper('.gallery-container', {
    slidesPerView: 1,
    spaceBetween: 0,
    // loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    // pagination: {
    //   el: '.swiper-pagination',
    //   clickable: true,
    // },
  });

  var gallery_items_swiper = new Swiper('.gallery_items-container', {
    slidesPerView: 3,
    spaceBetween: 0,
    // loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    // pagination: {
    //   el: '.swiper-pagination',
    //   clickable: true,
    // },
  });

  var people_swiper = new Swiper('.people-container', {
    slidesPerView: 3,
    spaceBetween: 0,
    // loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    // pagination: {
    //   el: '.swiper-pagination',
    //   clickable: true,
    // },
  });

  // Breakpoints
  $(window).on('resize', function(){
      var width = $(window).width();
      if(width >= 992) {
          gallery_items_swiper.params.slidesPerView = 3;
          people_swiper.params.slidesPerView = 3;
      } else if(width >= 768) {
          gallery_items_swiper.params.slidesPerView = 2;
          people_swiper.params.slidesPerView = 2;
      } else {
          gallery_items_swiper.params.slidesPerView = 1;
          people_swiper.params.slidesPerView = 1;
      }
      // people_swiper.reInit();
  }).resize();

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

  /**
  * initMap
  *
  * Renders a Google Map onto the selected jQuery element
  *
  * @param   jQuery $el The jQuery element.
  * @return  object The map instance.
  */

  function initMap( $el ) {

      // Find marker elements within map.
      var $markers = $el.find('.marker');

      // Create gerenic map.
      var mapArgs = {
          zoom        : $el.data('zoom') || 16,
          mapTypeId   : google.maps.MapTypeId.ROADMAP,
          styles      : [
            {
              "featureType": "all",
              "elementType": "labels.text.fill",
              "stylers": [
                {
                  "saturation": 36
                },
                {
                  "color": "#333333"
                },
                {
                  "lightness": 40
                }
              ]
            },
            {
              "featureType": "all",
              "elementType": "labels.text.stroke",
              "stylers": [
                {
                  "visibility": "on"
                },
                {
                  "color": "#ffffff"
                },
                {
                  "lightness": 16
                }
              ]
            },
            {
              "featureType": "all",
              "elementType": "labels.icon",
              "stylers": [
                {
                  "visibility": "off"
                }
              ]
            },
            {
              "featureType": "administrative",
              "elementType": "geometry.fill",
              "stylers": [
                {
                  "color": "#fefefe"
                },
                {
                  "lightness": 20
                }
              ]
            },
            {
              "featureType": "administrative",
              "elementType": "geometry.stroke",
              "stylers": [
                {
                  "color": "#fefefe"
                },
                {
                  "lightness": 17
                },
                {
                  "weight": 1.2
                }
              ]
            },
            {
              "featureType": "landscape",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#f5f5f5"
                },
                {
                  "lightness": 20
                }
              ]
            },
            {
              "featureType": "landscape",
              "elementType": "geometry.fill",
              "stylers": [
                {
                  "weight": "1.45"
                },
                {
                  "gamma": "2.47"
                },
                {
                  "hue": "#1f00ff"
                }
              ]
            },
            {
              "featureType": "poi",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#f5f5f5"
                },
                {
                  "lightness": 21
                }
              ]
            },
            {
              "featureType": "poi",
              "elementType": "labels.icon",
              "stylers": [
                {
                  "visibility": "on"
                }
              ]
            },
            {
              "featureType": "poi.park",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#dedede"
                },
                {
                  "lightness": 21
                }
              ]
            },
            {
              "featureType": "road.highway",
              "elementType": "geometry.fill",
              "stylers": [
                {
                  "color": "#ffffff"
                },
                {
                  "lightness": 17
                }
              ]
            },
            {
              "featureType": "road.highway",
              "elementType": "geometry.stroke",
              "stylers": [
                {
                  "color": "#ffffff"
                },
                {
                  "lightness": 29
                },
                {
                  "weight": 0.2
                }
              ]
            },
            {
              "featureType": "road.arterial",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#ffffff"
                },
                {
                  "lightness": 18
                }
              ]
            },
            {
              "featureType": "road.local",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#ffffff"
                },
                {
                  "lightness": 16
                }
              ]
            },
            {
              "featureType": "transit",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#f2f2f2"
                },
                {
                  "lightness": 19
                }
              ]
            },
            {
              "featureType": "water",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#e9e9e9"
                },
                {
                  "lightness": 17
                }
              ]
            }
          ]
      };
      var map = new google.maps.Map( $el[0], mapArgs );

      // Add markers.
      map.markers = [];
      $markers.each(function(){
          initMarker( $(this), map );
      });

      // Center map based on markers.
      centerMap( map );

      // Return map instance.
      return map;
  }

  /**
   * initMarker
   *
   * Creates a marker for the given jQuery element and map.
   *
   * @param   jQuery $el The jQuery element.
   * @param   object The map instance.
   * @return  object The marker instance.
   */
  function initMarker( $marker, map ) {

      // Get position from marker.
      var lat = $marker.data('lat');
      var lng = $marker.data('lng');
      var latLng = {
          lat: parseFloat( lat ),
          lng: parseFloat( lng )
      };

      // Create marker instance.
      var marker = new google.maps.Marker({
          position : latLng,
          map: map
      });

      // Append to reference for later use.
      map.markers.push( marker );

      // If marker contains HTML, add it to an infoWindow.
      if( $marker.html() ){

          // Create info window.
          var infowindow = new google.maps.InfoWindow({
              content: $marker.html()
          });

          // Show info window when marker is clicked.
          google.maps.event.addListener(marker, 'click', function() {
              infowindow.open( map, marker );
          });
      }
  }

  /**
   * centerMap
   *
   * Centers the map showing all markers in view.
   *
   *
   * @param   object The map instance.
   * @return  void
   */
  function centerMap( map ) {

      // Create map boundaries from all map markers.
      var bounds = new google.maps.LatLngBounds();
      map.markers.forEach(function( marker ){
          bounds.extend({
              lat: marker.position.lat(),
              lng: marker.position.lng()
          });
      });

      // Case: Single marker.
      if( map.markers.length == 1 ){
          map.setCenter( bounds.getCenter() );

      // Case: Multiple markers.
      } else{
          map.fitBounds( bounds );
      }
  }

  $('.acf-map').each(function(){
      var map = initMap( $(this) );
  });

  var ppp = $('#posts_per_page').data('posts'); // Post per page
  var cat = $('#catid').data('catid');
  var pageNumber = 1;

  function load_posts(filter_by) {

      cat = ( filter_by != '' ? ( filter_by == 'All' ? '' : filter_by ) : cat );
      pageNumber = ( filter_by != '' ? 0 : pageNumber++ );

      pageNumber++;

      var str = 'cat=' + cat + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=wdc_load_more_post_ajax';

      $.ajax({
          type: "POST",
          dataType: "html",
          url: ajax_posts.ajaxurl,
          data: str,
          success: function(data) {

              var $data = $(data);
              if($data.length) {
                if( pageNumber == 1 ) {
                  $("#ajax_posts").html($data);
                } else {
                  $("#ajax_posts").append($data);
                }

                  $("#more_posts").attr("disabled", false);
              } else{
                  $("#more_posts").attr("disabled", 'disabled');
                  $("#msg_notice").html('<div class="alert">No older posts found.</adiv>');
              }
          },
          error : function(jqXHR, textStatus, errorThrown) {
              console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
          }

      });
  }

  /*
  ** Generally for blog posts
  */
  $("#more_posts").on("click", function(e) { // When btn is pressed.
      e.preventDefault();
      $("#more_posts").attr("disabled", 'disabled'); // Disable the button, temp.
      load_posts('');
  });

  $('.opt_toggle').on('click', function(e) {
    /* setting an active/selected */
    // e.preventDefault();
    // $('.opt_toggle').removeClass('active');
    // $(this).addClass('active');
    var catid = $(this).find('input').val();
    var category = $.trim($(this).text());
    $('#catid').attr("data-catid", catid);
    catid = ( category == 'All' ? category : catid );
    load_posts(catid);
    $("#msg_notice").html('');
  });

  /*
  ** Case Studies and testimonials
  */
  var post_type = $('#post_type').val();
  $("#more_custom_posts").on("click", function(e) { // When btn is pressed.
      e.preventDefault();
      $(this).attr("disabled", 'disabled'); // Disable the button, temp.
      // post_type = $('#post_type').val();
      load_custom_posts('');
  });

  $('.opt_posts_toggle').on('click', function(e) {
    /* setting an active/selected */
    e.preventDefault();
    $('.opt_posts_toggle').removeClass('active');
    $(this).addClass('active');
    post_type = $(this).find('input').val();
    $('#post_type').val(post_type);
    load_custom_posts(post_type);
    $("#msg_notice").html('');
  });

  function load_custom_posts(type) {
    pageNumber = ( type != '' ? 0 : pageNumber++ );
    pageNumber++;
    post_type = ( type == '' ? $('#post_type').val() : type );
    var str = 'post_type=' + post_type + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=wdc_load_more_post_ajax';

    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function(data) {

            var $data = $(data);
            if($data.length) {
              if( pageNumber == 1 ) {
                $("#ajax_posts").html($data);
              } else {
                $("#ajax_posts").append($data);
              }

                $("#more_custom_posts").attr("disabled", false);
            } else {
              $("#more_custom_posts").attr("disabled", 'disabled');
              $("#msg_notice").html('<div class="alert">No older posts found.</adiv>');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
  }

})(jQuery);
