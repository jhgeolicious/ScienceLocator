$(document).ready(function(){

	var map = L.map('map', {
		minZoom   : 0,
		maxZoom   : 11,
		maxBounds : [[180, -250], [-180, 250]],
		//crs       : L.CRS.EPSG4326,
	}).setView([0, 0], 0);

	var terrain  = L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);
	
	var polygons = L.geoJson().addTo(map);

	function request(title, fulltext)
	{
		var request = $.ajax({
			url        : 'request.php',
			type       : 'POST',
			dataType   : 'json',
			data       : {
							title    : title    || '',
							fulltext : fulltext || '',
						 },
			cache      : false,

			beforeSend : function(){
							$('#papers').html('<a><h3>Wait for it...</h3></a>');
						 },

			success    : function(json){
							clear_results();
							display_results(json);
						 },

			error      : function(jqxhr){
							$('#papers').html('<a><h3>The search request failed.</h3>' + '<p>' + jqxhr.responseText + '</p></a>');
						 },
		});
	}
	request('paper title', 'full text search words');

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
