$(document).ready(function() {
    $(".accordion .accord-header").click(function() {
      if($(this).next("div").is(":visible")){
        $(this).next("div").slideUp("fast");
        $(this).removeClass("active");
      } else {
        $(".accordion .accord-content").slideUp("fast");
        $(this).next("div").slideToggle("fast");
        $(this).addClass("active").siblings().removeClass("active");;
      }
    });
});