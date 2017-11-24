$(function() {

  $( document ).tooltip({
    position: {
      my: "center bottom-20",
      at: "center top",
      using: function( position, feedback ) {
        $( this ).css( position );
        $( "<div>" )
          .addClass( "arrow" )
          .addClass( feedback.vertical )
          .addClass( feedback.horizontal )
          .appendTo( this );
      }
    }
  });

  // var tooltips = $( "[title]" ).tooltip({
  //   position: {
  //     my: "left top",
  //     at: "right+5 top-5",
  //     collision: "none"
  //   }
  // });


  // $( "#dialog-message" ).dialog({
  //   modal: true,
  //   width: 600,
  //   autoOpen: false,
  //   buttons: {
  //     Ok: function() {
  //       $( this ).dialog( "close" );
  //     }
  //   }
  // });
  //
  // $('#test_button').click(function(){
  //   $('#dialog-message').dialog({ autoOpen:open, width:900 })
  // });

  /*==========================*==========================
  ||||||||| FROM jQuery 2.0 Development Cookbook - Ch6 Creating a modal pop up - RECIPE 10 |||||||||
  ============================*============================*/
      modalPosition();
      $(window).resize(function()
      {
          modalPosition();
      });

      $(document).on('click', '.openModal', function()
      {
          var recID, url, hala;
          recID = $(this).attr('id');
          url = $(this).attr('data-href')+'/'+recID;
          // alert(url);
          $.get(url, {recID: recID}, function(data){
            if(data){
              $("div.js_modal_body").html(data);
              $('.js_modal, .js_modal_backdrop').fadeIn('fast');
            }
          });
      });
      $('.close_modal').click(function()
      {
          $('.js_modal, .js_modal_backdrop').fadeOut('fast');
      });

      function modalPosition()
      {
        var width = $('.js_modal').width();
        var pageWidth = $(window).width();
        var x = (pageWidth / 2) - (width / 2);
        $('.js_modal').css({left: x + "px"});
      }

      /*==========================*==========================
      ||||||||| FROM jQuery 2.0 Development Cookbook - Ch7 Creating an animated login form - RECIPE 1 |||||||||
      ============================*============================*/
      $(document).on('click', '.openImageModal', function()
      {
      //	var button = $(event.relatedTarget) // Button that triggered the modal
        var width = $(this).attr('data-width'); // Extract info from data-* attributes
        var height = $(this).attr('data-height');
        var image = $(this).attr('data-image');
        var frame = $('.image-frame');
        var box = $('.image-box');
        // Add some pixels to the width and height:
    		// width = width + 10;
    		// height = height + 1;
        box.css({'width':width, 'height':height, 'z-index': 1000});
        $('.image-box span').html('<img src="'+image+'" >');
        frame.fadeIn(500);
        $('.js_modal_backdrop').fadeIn('fast');
        box.animate({'top' : '50px'}, 500);
      });

      $(document).on('click', '.image-btn', function()
      {
        $('.image-box').animate({'top' : '-365px'}, 500);
        $('.image-frame').fadeOut(500);
        $('.js_modal_backdrop').fadeOut('fast');
        $('.toggle:checked').removeAttr('checked'); //remove all checked marks
      });

});
