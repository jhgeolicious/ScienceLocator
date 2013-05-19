$(document).ready(function(){

	/****************************************************************
	 * initlialization                                              *
	 ****************************************************************/
	
	var map = map_initialize('map');

	map_coordinates(map, $('#debug'), 'Mouse at');

	var drawing = map_draw({
		map:    map,
		button: $('input[name=area]'),
		start:  function(){ remove_messages(); },
	});

	/****************************************************************
	 * post request                                                 *
	 ****************************************************************/

	function request(title, date, link, description, points)
	{
		remove_messages();

		var request = $.ajax({
			url        : 'pages/post/request.php',
			type       : 'POST',
			dataType   : 'text',
			data       : {
							title        : title        || '',
							date         : date         || '',
							link         : link         || '',
							description  : description  || '',
							points       : points       || '',
						 },
			cache      : false,
			beforeSend : function(){ $('#side').append('<div class="message loading"></div>'); },
		}).done(function(text){
			if(text == 'success')
			{
				success_message();
				$('#details input[type=text], #details textarea').val('');
				drawing.reset();
				$('input[name=area]').val('Define Area');
			}
			else fail_message(text);
		}).fail(function(jqxhr){
			fail_message(jqxhr.responseText);
		});
	}

	/****************************************************************
	 * output messages                                              *
	 ****************************************************************/

	function success_message()
	{
		remove_messages();
		$('#side').append('<div class="message"><h3>Thanks, the paper was posted successfully.</h3><p>Feel free to post another paper just now.</p></div>');
	}

	function fail_message(text)
	{
		remove_messages();
		$('#side').append('<div class="message"><h3>Sorry, the post request failed.</h3><p>' + text + '</p></div>');
	}

	function remove_messages()
	{
		$('.message').remove();
	}

	/****************************************************************
	 * get user input                                               *
	 ****************************************************************/

	$('#details input[name=submit]').click(function(){
		request(
			$('#details input[name=title]').val(),
			$('#details input[name=date]').val(),
			$('#details input[name=link]').val(),
			$('#details textarea[name=description]').val(),
			lnglat_to_array(drawing.points)
		);
	});

	/****************************************************************
	 * helpers                                                      *
	 ****************************************************************/

	function lnglat_to_array(lnglat)
	{
		var array = [];
		for (i = 0; i < lnglat.length; ++i)
		{
			array.push([ lnglat[i].lng, lnglat[i].lat ]);
		}
		return array;
	}

});
