$(function(){
  $(window).scroll(function(){
	var aTop = 540;
	if($(this).scrollTop()>=aTop){
		$('.cusm').css('background','#FF8734');
	}
	else{
		$('.cusm').css('background','rgba(255, 135, 52, 0.40)');
	}
  });
});
$(document).ready(function() {
  var owl = $("#adlist");
  owl.owlCarousel({
   itemsCustom : [
	  [0, 2],
	  [450, 2],
	  [600, 3],
	  [700, 4],
	  [1000, 5],
	  [1200, 6],
	  [1400, 6],
	  [1600, 6]
	],
	navigation : true,
	autoPlay : 5000
  });
});
$(document).ready(function() {
  var owl = $("#slist");
  owl.owlCarousel({
   itemsCustom : [
	  [0, 2],
	  [450, 3],
	  [600, 3],
	  [700, 3],
	  [1000, 3],
	  [1200, 3],
	  [1400, 3],
	  [1600, 3]
	],
	navigation : true
  });
});