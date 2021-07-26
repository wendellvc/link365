/**
* Theme JavaScript.
*
* @package   Link365\Theme
* @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
* @copyright Copyright (c) 2021
* @copyright MIT
*/

(function ($) {
 	'use strict'; 

  var ppp = $('#posts_per_page').data('posts'); // Post per page
  var cat = $('#catid').data('catid');
  var pageNumber = 1;

  function load_posts(filter_by, values, load_more) {
      var categories = values.join('_');
      cat = ( filter_by == 'All' ? '' : categories );
      pageNumber = ( load_more == true ? pageNumber++ : 0 );

      pageNumber++;

      var str = 'cat=' + cat + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=link365_load_more_post_ajax';

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
    var str = 'post_type=' + post_type + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=link365_load_more_post_ajax';

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
