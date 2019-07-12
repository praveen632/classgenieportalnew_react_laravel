 (function($) { "use strict";

      var
      mn =   $(".main-nav"),
      mns = "main-nav-scrolled",
      hdr =  $('head').height(),
      owl1 = $('#owl1'),
      owl2 = $('#owl2'),
      owl3 = $('#owl3'),
      $htmlbody = $('html, body'),
      $window = $(window);


/* STICKY NAV */

        $window.scroll(function() {
          if( $(this).scrollTop() > hdr ) {
            mn.addClass(mns);
          } else {
            mn.removeClass(mns);
          }
        });

/* STICKY NAV */


/* Start Of Spinner */

      $window.on('load', function () {
                 $('.spinner-wrapper').delay(2000).fadeOut('slow');
             });

/* End Of Spinner */

/* CONTACT INPUT COLOR */

$("input,textarea").on('focusin', function(){
  $(this).addClass('borderco');
}).on('focusout', function(){
  $(this).removeClass('borderco');
});

/* CONTACT INPUT COLOR */



/* OWL CAROUSEL */

    owl1.owlCarousel({
      loop:true,
      margin:20,
      dots:false,
      nav:true,
      navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:3
          }
      }
  })

        owl2.owlCarousel({
            center: true,
            margin:20,
            nav:true,
            dots:false,
            loop:true,
            navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            responsive:{
              0:{
                  items:1,
              },
              800:{
                items:3,
                margin:30
              },
              1000:
              {
                items:3,
                margin:140
              },
              1200:{
                  items:5,
                  margin:10
              }
            }
        });

        owl3.owlCarousel({
            items:4,
            margin:40,
            loop:true,
            nav:true,
            navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            responsive:{
              0:{
                  items:2
              },
              600:{
                  items:3
              },
              1000:{
                  items:4
              }
            }
        });

/* OWL CAROUSEL */

/* SCROLL TO */

        $("#js--aboutsection").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--about-section').offset().top},1000)
        });
        $("#js--featuressection").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--features-section').offset().top},1000)
        });
        $("#js--testmonialsection").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--testmonial-section').offset().top},2000)
        });
        $("#js--clientssection").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--clients-section').offset().top},2000)
        });
        $("#js--shotssection").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--shots-section').offset().top},2000)
        });
        $("#js--pricesplan").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--prices-plan').offset().top},2000)
        });
        $("#js--price-plan").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--prices-plan').offset().top},2000)
        });
        $("#js--contactsection").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--contact-section').offset().top},2000)
        });
       $("#js--homesection").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--home-section').offset().top},2000)
        });
        $("#js--download-now").on('click', function(){
          $htmlbody.animate({scrollTop:$('#js--downloadnow').offset().top},2500)
        });

/* SCROLL TO */


$('.counter').counterUp({
    delay: 10,
    time: 2500
});
})(jQuery);
