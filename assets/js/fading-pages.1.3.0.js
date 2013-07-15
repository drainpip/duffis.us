$(document).ready(function() {  
  "use strict";
  var mobile, i, url, img;
  var resize = false;
  
  $(window).bind( 'hashchange', function() {
    // Detect any hash change and update accordingly. I'll research alternatives to a hard-coded if statement like this.
    var hash = window.location.hash;
    if (hash === "#Wedding") {
      i = 1;
    } else if (hash === "#LBC") {
      i = 2;
    } else if (hash === "#Registry") {
      i = 3;
		} else if (hash === "#Photos") {
      i = 4;
    } else {
      i = 0;
    }
    resize = false;
    fadingPages();
  });
  $(window).trigger( 'hashchange' ); // Trigger on load in case they come in with a hash.  
  
  function fadingPages() {
    checkDesktop();
    if (resize) {
			if (mobile) {
				$("html, body").animate({
					scrollTop: $("section:nth-child(" + (i + 1) + ")").offset().top
				}, 0);
				$("section").removeAttr("style").css("opacity",1);
				$("section.active").css("z-index","99");
			} else {
				$("section").animate({opacity:0},0);
				$("section.active").animate({opacity:1},0).css("z-index","99");
			}
    } else {
      if (!$(".nav li:nth-child(" + (i) + ")").hasClass("active")) {
        $(".nav li.active").removeClass("active");
        $(".nav li:nth-child(" + (i) + ")").addClass("active");
        if (!mobile) {  
          $("section.active").animate({opacity:0},50).removeClass("active").css("z-index",i);
          $("section:nth-child(" + (i + 1) + ")").animate({opacity:1},400).addClass("active").css("z-index","99");
        } else {
          $("section.active").removeClass("active").css("z-index",i);
          $("section").animate({opacity:1},0);
          $("html, body").animate({
            scrollTop: $("section:nth-child(" + (i + 1) + ")").addClass("active").css("z-index","99").offset().top
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