jQuery(document).ready(function() {
	
	'use strict';
	
	/* Submenu Parent Style */
	$('.submenu li:first-child a').hover(function(){
		$(this).parent().parent().toggleClass('hover');
	});
	
	/* Sticky Header */
	jQuery(window).scroll(function() {
		if (jQuery(window).scrollTop() > 130) {
			jQuery('.main_header').addClass('sticky');
			jQuery('.main_header').removeClass('non_sticky');
		}
		else {
			jQuery('.main_header').removeClass('sticky');
			jQuery('.main_header').addClass('non_sticky');
		}
	});
	
	// ===================== mobile menu
	jQuery(document).ready(function() {
      $("#mobile_menu").mmenu({
       extensions: ["pageshadow" , "border-full" , "effect-listitems-slide" ],
          offCanvas: {position: "right"}
      }, {
         // configuration
         classNames: {
            fixedElements: {
               fixed: "mob_nav"
            }
         }
      });
    });
	// ==============================

	$(".nav_cover ul li.sub-menu a").on("mouseenter",function(){return $(".main_nav").addClass("blue-back")})
	$(".nav_cover ul li.sub-menu a").on("mouseleave",function(){return $(".main_nav").removeClass("blue-back")})
	
$('input').focus(function(){
  
   $(this).parent().addClass("lable-top");

   })


	/******************************BACK TO TOP*****************/
  
   // browser window scroll (in pixels) after which the "back to top" link is shown
   var offset = 500,
    //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
    offset_opacity = 1200,
    //duration of the top scrolling animation (in ms)
    scroll_top_duration = 700,
    //grab the "back to top" link
    $back_to_top = $('.cd-top');

  //hide or show the "back to top" link
  $(window).scroll(function(){
    ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
    if( $(this).scrollTop() > offset_opacity ) { 
      $back_to_top.addClass('cd-fade-out');
    }
  });

  //smooth scroll to top
  $back_to_top.on('click', function(event){
    event.preventDefault();
    $('body,html').animate({
      scrollTop: 0 ,
      }, scroll_top_duration
    );
  });     
	
	
	
		
});
//  scroll-top header reagain size
  	jQuery(document).ready(function($) {
      var didScroll;
      var lastScrollTop = 0;
      var delta = 5;
      var navbarHeight = $('.main_header').outerHeight();
      $(window).scroll(function(event){
      didScroll = true;
      });

      setInterval(function() {
      if (didScroll) {
      hasScrolled();
      didScroll = false;
      }
      }, 50);


      function hasScrolled() {

      var st = $(this).scrollTop();
      // Make sure they scroll more than delta
      if(Math.abs(lastScrollTop - st) <= delta)
      return;

      // If they scrolled down and are past the navbar, add class .nav-up.
      // This is necessary so you never see what is "behind" the navbar.
      if (st > lastScrollTop && st > navbarHeight){
      // Scroll Down
      $('.main_header').removeClass('nav_down').addClass('nav_up');
      } else {
      // Scroll Up
      if(st + $(window).height() < $(document).height()) {
      $('.main_header').removeClass('nav_up').addClass('nav_down');
      }
      }
      lastScrollTop = st;
  }

});
