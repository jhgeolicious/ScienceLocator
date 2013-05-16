$(document).ready(function(){

	/****************************************************************
	 * map initlialization                                          *
	 ****************************************************************/
	var map = L.map('map', {
		minZoom   : 0,
		maxZoom   : 11,
		maxBounds : [[-75, -180], [75, 180]],
		crs       : L.CRS.EPSG3857,
	}).setView([20, -20], 0);

	var terrain  = L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);

	map_coordinates(map, $('#debug'));

	/****************************************************************
	 * polygon drawing                                              *
	 ****************************************************************/
	var drawing = map_draw({
		map:    map,
		button: $('#area input[type="button"]'),
	});

	/****************************************************************
	 * post request                                                 *
	 ****************************************************************/

	function request(title, date, link, description, points)
	{
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

			beforeSend : function(){
				drawing.hide();
				$('#details input[type=text]').val(''),
				$('#details').html('<p class="loading"></p>');
			},
			success : function(text){
				$('#details').html('<h3>' + text + '</h3>');
			},

			error : function(jqxhr){
				$('#details').html('<h3>The post request failed.</h3>' + '<p>' + jqxhr.responseText + '</p>');
			},
		});
	}

	$('#details input[name=submit]').click(function(){
		request(
			$('#details input[name=title]').val(),
			$('#details input[name=date]').val(),
			$('#details input[name=link]').val(),
			$('#details input[name=description]').val(),
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
