$(document).ready(function(){

	$('#ads').hide();
	function scroll()
	{
		// show ads
		if($(document).scrollTop() > 100)
		{
			$('#ads').fadeIn(200); // why doesn't stop() work?
		}
		// hide ads
		else
		{
			$('#ads').fadeOut(25);
		}
	}
	$(document).scroll(scroll);
	scroll();

});
