$(document).ready(function(){

	var map = L.map('map', {
		minZoom   : 0,
		maxZoom   : 11,
		maxBounds : [[180, -250], [-180, 250]],
		//crs       : L.CRS.EPSG4326,
	}).setView([0, 0], 0);
	var terrain  = L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);
	var polygons = L.geoJson().addTo(map);

	function request(name)
	{
		var request = $.ajax({
			type     : 'POST',
			url      : 'request.php',
			dataType : 'json',
			data     : { 'name' : name, },
			cache    : false,
		})

		request.success(function(json){
			clear_results();
			display_results(json);
		});

		request.fail(function(jqXHR, message){
			alert( "The search request failed. " + message);
		});
	}
	request('search string');

	function display_results(json)
	{
		polygons.addData(json);

		for(var i = 0; i < json.features.length; ++i)
			list_result(json.features[i].geometry.properties);
	}

	function list_result(json)
	{
		$('#papers').append('<a tag="' + (json['id']          || ''              ) + '">'
		                  + '<h3>'     + (json['title']       || 'Untitled'      ) + '</h3>'
		                  + '<span>'   + (json['date']        || 'date unknown'  ) + '</span>'
		                  + '<p>'      + (json['description'] || 'no description') + '</p>'
		                  + '</a>');
	}

	function clear_results()
	{
		$('#papers').html('');

		map.removeLayer(polygons);
		polygons = L.geoJson().addTo(map);
	}
});
