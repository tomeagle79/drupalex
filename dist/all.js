$(".codes-fixed span").click(function(){
	$(".codes-fixed").fadeOut();
});
$(".mob-nav").click(function(){
	$(".header-wrap").slideToggle();
	$(this).toggleClass("active");
})