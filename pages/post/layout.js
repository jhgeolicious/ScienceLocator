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

});
