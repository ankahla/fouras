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
          - Work Gallery Slider
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

--------------------------------------------------------------*/
(function($) {
  "use strict";

  var $window = $( window )
  var datepick = $( '.date-pick' )
  var counter = $( '.counter' )
  var sliderrange = $( '#slider-range' )
  var amount = $( '#amount' )
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

  // Work Gallery Slider
    $("#work-gallery-slider").owlCarousel({
      loop: true,
      items: 4,
      dots: false,
      nav: true,
      autoplayTimeout: 2500,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 30,
      autoplay: true,
      slideSpeed: 300,
      navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
            items: 1,
            nav: false,
            dots: false,
        },
        600: {
            items: 2,
            nav: false,
            dots: false,
        },
        768: {
            items: 3,
            nav: true,
        },
        1100: {
            items: 4,
            nav: true,
        }
      }
    });

  // Testimonials Slider    
    $("#testimonials-slider").owlCarousel({
      loop: true,
      items: 1,
      dots: false,
      nav: true,
      autoplayTimeout: 2500,
      smartSpeed: 2000,
      autoHeight: false,
      touchDrag: true,
      mouseDrag: true,
      margin: 0,
      animateIn: 'fadeIn',
      animateOut: 'fadeOut',
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
            items: 1,
            nav: false,
            dots: false,
        },
        1100: {
            items: 1,
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
          return item.el.attr('title') + '<small>by Weddlist</small>';
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
        format : "dd/mm/yyyy"
      });
    }

// Facts Count 
    if ($(counter).length) {   
      $(function( $ ) {
        $(counter).counterUp({
          delay: 20,
          time: 2000
        });
      });  
    }
  
// Price Slider / Filter
    $( sliderrange ).slider({
        range: true,
        min: 0,
        max: 1500,
        values: [ 200, 800 ],
        slide: function( event, ui ) {
            $( amount ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( amount ).val( "$" + $( sliderrange ).slider( "values", 0 ) +
        " - $" + $( sliderrange ).slider( "values", 1 ) );


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

// Preloader   
  $window.on('load', function()  { 
    $('.status').fadeOut();
    $('.preloader').delay(350).fadeOut('slow'); 
  }); 

})(jQuery);