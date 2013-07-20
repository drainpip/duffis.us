$(document).ready(function() {  
  "use strict";
  var mobile, i, url, img;
  var resize = false;
	
  var hash = window.location.hash;  
	if (hash !== '') {
		$('.intro').fadeOut(0);
		$('.main').fadeIn(0);
		if ($('#bg').is(':hidden')) {
			$("#bg").fadeIn("slow");
		}
	}
  $(window).bind( 'hashchange', function() {
		var hash = window.location.hash;
    // Detect any hash change and update accordingly. I'll research alternatives to a hard-coded if statement like this.
    if (hash === "#Wedding") {
      i = 1;
    } else if (hash === "#LBC") {
      i = 2;
    } else if (hash === "#Registry") {
      i = 3;
    } else if (hash === "#Photos") {
      i = 4;
    } else {
      i = 1;
    }
    resize = false;
    fadingPages();
  });
  $(window).trigger( 'hashchange' ); // Trigger on load in case they come in with a hash. 
	
	$('#continue').click(function() {
    $('.intro').fadeOut(500,function() {
      $('#bg').fadeIn(1000,function() {
        $('.main').fadeIn();
      });
    });
  });
  
  function fadingPages() {
    checkDesktop();
    if (resize) {
      if (mobile) {
        $("html, body").animate({
          scrollTop: $("section:nth-child(" + (i + 1) + ")").offset().top
        }, 0);
        $("section").removeAttr("style");
      } else {
        $("section.active").fadeIn(0);
      }
    } else {
      if (!$(".nav li:nth-child(" + (i) + ")").hasClass("active")) {
        $(".nav li.active").removeClass("active");
        $(".nav li:nth-child(" + (i) + ")").addClass("active");
        if (!mobile) {  
          $("section.active").fadeOut(50).removeClass("active");
          $("section:nth-child(" + (i + 1) + ")").fadeIn().addClass("active");
        } else {
          $("section.active").removeClass("active");
          $("section").fadeIn(0);
          $("html, body").animate({
            scrollTop: $("section:nth-child(" + (i + 1) + ")").addClass("active").offset().top
          }, 400);    
        }
      }    
    }
  };  
  function checkDesktop() { //Test window size, sets mobile bit + adjusts animations on mobile to desktop transitions
    if (($(window).width()) < 768) {
      mobile = true;
    } else {
      mobile = false;
    }
  };
  function mainNav() {
    if ($("#main-heading").outerWidth() > 767) {
      var menuTop = $("#main-heading").width() * .23;
      $(".main-nav").css("top", menuTop + "px");
    } else {
      $(".main-nav").css("top", "0px");
      $(".main-nav").removeAttr("style");
    }
  };
	
  // Run on DOM ready + if window is resized
  checkDesktop();
  mainNav();

  $(window).on("resize", function() {
    resize = true;
    fadingPages();
  });            
  $(window).on("resize scroll", function() {
    mainNav();
  });  
});