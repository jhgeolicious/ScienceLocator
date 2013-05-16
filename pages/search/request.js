$(document).ready(function(){

	/****************************************************************
	 * initlialization                                              *
	 ****************************************************************/
	
	var map = map_initialize();

	map_coordinates(map, $('#debug'));

	var drawing = map_draw({
		map:    map,
		button: $('#area input[type="button"]'),
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
			beforeSend : function(){
				$('#results').html('<li class="loading"></li>');
				drawing.hide();
				polygons.clearLayers();
			},
			success : function(json){
				$('#results').html('');
				for(var i = 0; i < json.features.length; ++i)
					list_result(json.features[i].properties);
				polygons.addData(json.features);
			},
			error : function(jqxhr){
				$('#results').html('<li><h3>The search request failed.</h3>' + '<p>' + jqxhr.responseText + '</p></li>');
			},
		});
	}

	$('#keywords input[type="button"]').click(function(){
		search_request(
			$('#keywords input[type="text"]').val(),
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
			debug = feature.geometry.coordinates;
			layer.bindPopup(feature.properties.title + '<br><span style="color:#aaa;">' + 'Debug: ' + debug + "</span>");
		},
	}).addTo(map);

	function list_result(properties)
	{
		$('#results').append('<li tag="' + (properties.id          || ''              ) + '">'
		                   + '<h3>'      + (properties.title       || 'Untitled'      ) + '</h3>'
		                   + (properties.link ? '<a href="' + properties.link + '">' + properties.link + '</a>' : '')
		                   + '<span>'    + (properties.date        || 'date unknown'  ) + '</span>'
		                   + '<p>'       + (properties.description || 'no description') + '</p>'
		                   + '</li>');
	}
});
