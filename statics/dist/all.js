$(".codes-fixed span").on('click touch', function (){
	$(".codes-fixed").fadeOut();
});
$(".mob-nav").click(function(){
	$(".header-wrap").slideToggle();
	$(this).toggleClass("active");
})