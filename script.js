$(document).ready(function(){

	var map = L.map('map', {
		minZoom   : 0,
		maxZoom   : 11,
		maxBounds : [[180, -250], [-180, 250]],
		//crs       : L.CRS.EPSG4326,
	}).setView([0, 0], 0);

	var terrain  = L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);
	
	var polygons = setup_geojson_layer().addTo(map);

	function setup_geojson_layer()
	{
		return L.geoJson(null, {
			onEachFeature: function(feature, layer){
				layer.bindPopup(feature.properties.title);
			},
		});
	}

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
			success : function(json){
				clear_results();
				display_results(json.features);
			},
			error : function(jqxhr){
				$('#papers').html('<a><h3>The search request failed.</h3>' + '<p>' + jqxhr.responseText + '</p></a>');
			},
		});
	}
	request('paper title', 'full text search words');

	function display_results(features)
	{
		polygons.addData(features);

		for(var i = 0; i < features.length; ++i)
			list_result(features[i].properties);
	}

	function list_result(properties)
	{
		$('#papers').append('<a tag="' + (properties.id          || ''              ) + '">'
		                  + '<h3>'     + (properties.title       || 'Untitled'      ) + '</h3>'
		                  + '<span>'   + (properties.date        || 'date unknown'  ) + '</span>'
		                  + '<p>'      + (properties.description || 'no description') + '</p>'
		                  + '</a>');
	}

	function clear_results()
	{
		$('#papers').html('');

		map.removeLayer(polygons);
		polygons = setup_geojson_layer().addTo(map);
	}
});
