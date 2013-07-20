$(document).ready(function() {
  
  function checkBG() {
    $("#bg").css("min-height", $(window).height() + "px"); // Reset height to window height before calculating the document, necessary when switching from portrait to landscape
    $("#bg").css("min-height", $(document).height() + "px");
  };
  
  checkBG();
  
  $(window).on("resize scroll", function() {
    checkBG();
  });
  
});