$(document).ready(function(){

	/****************************************************************
	 * initlialization                                              *
	 ****************************************************************/
	
	var map = map_initialize();

	map_coordinates(map, $('#debug'), 'Mouse at');

	var drawing = map_draw({
		map:    map,
		button: $('#area input[type="button"]'),
		start:  function(){ polygons.clearLayers(); },
	});

	/****************************************************************
	 * post request                                                 *
	 ****************************************************************/

	function request(title, date, link, description, points)
	{
		$('.message').remove();

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
			beforeSend : function(){ $('#details').append('<p class="loading"></p>'); },
		}).done(function(text){
			drawing.hide();
			$('#details input[type=text], #details textarea').val(''),
			$('#details').prepend('<h3 class="message">' + text + '</h3>');
		}).fail(function(jqxhr){
			$('#details').html('<h3>The post request failed.</h3>' + '<p>' + jqxhr.responseText + '</p>');
		}).always(function(){
			$('.loading').remove();
		});
	}

	$('#details input[name=submit]').click(function(){
		request(
			$('#details input[name=title]').val(),
			$('#details input[name=date]').val(),
			$('#details input[name=link]').val(),
			$('#details textarea[name=description]').val(),
			lnglat_to_array(drawing.points)
		);
	});

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
