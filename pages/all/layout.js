$(document).ready(function(){

	// adapt map size
	var max = $('.left').first().offset().top,
	    min = 20;

	function scroll()
	{
		var offset = max - $(document).scrollTop();
		if(offset < min) offset = min;

		$('.left').first().css('top', offset);
	}
	$(document).scroll(scroll);
	scroll();

});
