$(document).ready(function(){

	// set map height
	function resize()
	{
		height = $(window).height()
		       + $(document).scrollTop()
		       - $('#map').offset().top - 2
		       - $('#footer').outerHeight(true);
		$('#map').css('height', height);
	}
	$(window).resize(resize);
	resize();

	function scroll()
	{
		if($(document).scrollTop() > 100)
		{
			$('#middle > div').css('top', '0');
			$('#ads').css('display', 'block').animate({'opacity' : '1'}, 350, function(){ $('#ads').css('opacity', '1'); });
			$('#map').css('margin-top', '0px');
		}
		// hide ads
		else
		{
			$('#middle > div').css('top', '12em');
			$('#ads').css('display', 'none').stop().css('opacity', '0');
			$('#map').css('margin-top', '2px');
		}
	}
	$(document).scroll(scroll);
	scroll();

});
