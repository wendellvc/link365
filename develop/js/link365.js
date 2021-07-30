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

  var ppp = $('#posts_per_page').data('ppp'); // Post per page
  var pageNumber = 1;

  /**
   * Filter status
   */
  $( ".btn-status-filter" ).on( 'click', function( e ) { // When btn is pressed.
    e.preventDefault();

    var status = $(this).data('status'); // get the filter status value

    $(".btn-status-filter, .btn-status-filter-all").removeClass('active'); // remove the current active class to the status buttons
    $(this).addClass('active'); // add active class to the button being clicked
    
    var str = 'ppp=' + ppp + '&status=' + status + '&action=link365_load_filter_status_post_ajax';

    $.ajax({
      type: "POST",
      dataType: "html",
      url: ajax_posts.ajaxurl,
      data: str,
      success: function(data) {

        var $data = $(data);
        $("#tbl_ajax").html($data);
        
      },
      error : function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
      }

    } );

  });

  /**
   * Select/Deselect all checkboxes
   */
  $( "#checkbox_all" ).on( 'click', function( e ) { // When btn is pressed.
    // e.preventDefault();
    if( $( this ).is( ':checked' ) ) {
      $('.checkbox_select').attr('checked', 'checked');
    } else {
      $('.checkbox_select').removeAttr('checked');
    }
  } );

  
  $( '#mark_as_paid' ).on( 'click', function( e ) { 
    var arrayIDs = [];
    $.each( $( "input.checkbox_select:checked" ), function (key, data) {   
      var dValue =  $( this ).data( 'checkboxid' );
      arrayIDs.push(dValue);
    });

    var str = 'IDs=' + arrayIDs + '&action=link365_update_posts_status_ajax';

    $.ajax({
      type: "POST",
      dataType: "html",
      url: ajax_posts.ajaxurl,
      data: str,
      success: function(data) {
        
        var $data = $(data);
        console.log($data);
        $("#notification").html($data);

        $.each( $( "input.checkbox_select:checked" ), function (key, data) {   
          var dValue =  $( this ).data( 'checkboxid' );
          $( '#status_update_' + dValue ).removeAttr('class').addClass('badge rounded-pill bg-info').text('PAID');
        });
      },
      error : function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
      }

    } );
  } );

})(jQuery);
