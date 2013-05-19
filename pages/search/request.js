$(document).ready(function(){

	/****************************************************************
	 * initlialization                                              *
	 ****************************************************************/
	
	var map = map_initialize('map');

	map_coordinates(map, $('#debug'), 'Mouse at');

	var drawing = map_draw({
		map:    map,
		button: $('input[name=area]'),
		start:  function(){ polygons.clearLayers(); },
	});

	/****************************************************************
	 * search request                                               *
	 ****************************************************************/

	function search_request(title, points)
	{
		var request = $.ajax({
			url        : 'pages/search/request.php',
			type       : 'POST',
			dataType   : 'json',
			data       : {
							title  : title  || '',
							points : points || '',
						 },
			cache      : false,
			beforeSend : function(){ $('#results').addClass('loading'); },
		}).done(function(json){
			$('#results').html('');
			drawing.hide();
			for(var i = 0; i < json.features.length; ++i)
				list_result(json.features[i].properties);
			polygons.addData(json.features);
		}).fail(function(jqxhr){
			$('#results').html('<h3>The search request failed.</h3><p>' + jqxhr.responseText + '</p>');
		}).always(function(){
			$('#results').removeClass('loading');
		});
	}

	$('input[name=submit]').click(function(){
		search_request(
			$('input[name=keywords]').val(),
			lnglat_to_array(drawing.points)
		);
	});

	function lnglat_to_array(lnglat)
	{
		array = [];
		for (i = 0; i < lnglat.length; ++i)
		{
			array.push([lnglat[i].lng, lnglat[i].lat]);
		}
		return array;
	}

	/****************************************************************
	 * display results                                              *
	 ****************************************************************/

	var polygons = L.geoJson(null, {
		onEachFeature: function(feature, layer){
			layer.bindPopup(feature.properties.title);
		},
	}).addTo(map);

	function list_result(properties)
	{
		$('#results').append('<div tag="' + (properties.id          || ''              ) + '">'
		                   + '<h3>'       + (properties.title       || 'Untitled'      ) + '</h3>'
		                   + (properties.link ? '<a href="' + properties.link + '" target="_blank">' + properties.link + '</a>' : '')
		                   + '<span>'     + (properties.date        || 'date unknown'  ) + '</span>'
		                   + (properties.description ? '<p>' + properties.description + '</p>' : '')
		                   + '</div>');
	}
});
