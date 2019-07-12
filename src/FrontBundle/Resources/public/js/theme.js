/**
 * Wedding
 *
 * This file contains all template JS functions
 *
 * @package Weddlist
--------------------------------------------------------------
                   Contents
--------------------------------------------------------------

 * 01 - Owl Carousel
          - Home Slider    
          - New Listing Gallery Slider
          - Testimonials Slider    
          - Gallery Slider    
 * 02 - Video Play
 * 03 - Smooth Scroll
 * 04 - Mailchimp Form
 * 05 - Popup Dialog
 * 06 - Navigation 
 * 07 - Datepicker
 * 08 - Facts Count 
 * 09 - Price Slider / Filter
 * 10 - Search
 * 11 - Dropdown Select
 * 12 - Preloader
 * 13 - PrettySelect

--------------------------------------------------------------*/
(function($) {
  "use strict";   

  var $window = $( window )
  var datepick = $( '.date-pick' )
  var counter = $( '.counter' )
  var search = $( '.search' )  
  
// Owl Carousel 

    // Home Slider    
      $("#home-slider").owlCarousel({
      loop: true,
      items: 1,
      dots: true,
      nav: false,
      autoplayTimeout: 2500,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 0,
      autoplay: true,
      slideSpeed: 600,
      navText: ['', ''],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 1,
            nav: false,
            dots: false,
        },
        768: {
            items: 1,
            nav: false,
            dots: false,
        },
        1100: {
            items: 1,
            nav: false,
            dots: true,
        }
      }
    });

    // New Listing Gallery Slider
    $("#new-lsiting-gallery-slider").owlCarousel({
      loop: true,
      items: 6,
      dots: false,
      nav: false,
      autoplayTimeout: 2500,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 0,
      autoplay: true,
      slideSpeed: 300,
      navText: [''],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 1,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: true,
        },
        1100: {
            items: 6,
            nav: false,
        }
      }
    });

    // Testimonials Slider    
    $("#testimonials-slider").owlCarousel({
      loop: true,
      items: 2,
      dots: false,
      nav: true,
      autoplayTimeout: 10000,
      smartSpeed: 5000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 0,
      autoplay: true,
      slideSpeed: 1000,
      navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 1,
            nav: false,
            dots: false,
        },
        768: {
            items: 1,
            nav: false,
            dots: false,
        },
        1100: {
            items: 2,
            nav: true,
            dots: false,
        }
      }
    });
    
    // Gallery Slider    
    $("#gallery-slider").owlCarousel({
      loop: true,
      items: 5,
      dots: false,
      nav: false,
      autoplayTimeout: 2000,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 0,
      autoplay: true,
      slideSpeed: 600,
      navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 1,
            nav: false,
            dots: false,
        },
        768: {
            items: 2,
            nav: false,
            dots: false,
        },
        1100: {
            items: 5,
            nav: false,
            dots: false,
        }
      }
    });

// Video Play     
    $('.btn-video-play').on('click',function() {
      $('.video-item .video-preview').append(video_url);
      $(this).hide();
    });     

// Smooth Scroll
    smoothScroll.init();
    
// Mailchimp Form
    $('#subscribe-form').ajaxChimp({
        url: 'http://blahblah.us1.list-manage.com/subscribe/post?u=5afsdhfuhdsiufdba6f8802&id=4djhfdsh9'
    });

// Popup Dialog    
    $('.gallery-block').magnificPopup({
      delegate: 'a',
      type: 'image',    
      tLoading: 'Loading image #%curr%...',
      mainClass: 'mfp-img-mobile',    
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
      },
      image: {
        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
        titleSrc: function(item) {
          return item.el.attr('title');
        }
      }
    });
    
// Navigation 
    // Navigation / Menu
    $("#cssmenu").menumaker({
      title: "Menu",
      format: "multitoggle"
    });

// Datepicker
    if ($(datepick).length) {
      $(datepick).datepicker({
        format : "yyyy-mm-dd"
      });
    }

// Facts Count 
    if ($(counter).length) {         
      $(counter).counterUp({
        delay: 20,
        time: 2000
      });       
    }
  
// Search
  $('.search-icon').on('click', function (e) {
    e.preventDefault();
    $(search).addClass('active');
  });

  $('.search-close').on('click', function (e) {
    e.preventDefault();
    $(search).removeClass('active');
  });
  
// Dropdown Select
  $( document.body ).on( 'click', '.dropdown-menu li', function( event ) {
      var $target = $( event.currentTarget );
      $target.closest( '.dropdown' )
         .find( '[data-bind="label"]' ).text( $target.text() )
            .end()
         .children( '.dropdown-toggle' ).dropdown( 'toggle' );
      return false;
   });

$( "form" ).submit(function(event ) {
    $('.status').fadeIn();
    $('.preloader').show();
})

// Preloader   
  $window.on('load', function()  { 
    $('.status').fadeOut();
    $('.preloader').delay(350).fadeOut('slow'); 
  });
// enabling bootstrap dropdown in form submit
jQuery.fn.prettySelect = function(defaultLabel)
{
  return this.each(function()
  {
      var d = new Date();
      var id = d.getTime();
      var selectElement = $(this);
      if (selectElement.data('pretty-select-rendred')) {
        // rerender
        selectElement.next('.dropdown').remove();
        selectElement.data('pretty-select-rendred', false);
      }
      
      if (!defaultLabel) {
        defaultLabel = selectElement.attr('place-holder') ? selectElement.attr('place-holder') : '';
      }

      var selectedOption = selectElement.find('option:selected');
      if (selectedOption.size()) {
        defaultLabel = selectedOption.text();
      }

      var mainObject = $('<div class="dropdown"><div>');
      var placeHolder = $('<button class="btn dropdown-toggle" type="button" id="dropdownMenu-'+id+'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="drp-name" data-bind="label">'+defaultLabel+'</span><span><i class="fa fa-angle-down" aria-hidden="true"></i></span></button>')
      placeHolder.appendTo(mainObject);
      var selectList = $('<ul class="dropdown-menu" aria-labelledby="dropdownMenu-'+id+'">');

      selectElement.find('option').each(function(key, optionElement){
        var selectListLink = $('<a href="#"></a>');
        selectListLink.data('value', $(optionElement).attr('value'));
        selectListLink.text($(optionElement).text());
        selectListLink.click(function(e){
          e.preventDefault();
          selectElement.val($(e.target).data('value'));
        });

        var liElement = $('<li></li>');
        selectListLink.appendTo(liElement);
        liElement.appendTo(selectList);

      });

      selectList.appendTo(mainObject);
      selectElement.data('pretty-select-rendred', true).hide().after(mainObject);
  });

};

})(jQuery);

jQuery(document).ready(function(){
  jQuery('select:visible').prettySelect();
});