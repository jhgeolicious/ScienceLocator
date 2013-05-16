$(document).ready(function(){

	/****************************************************************
	 * initlialization                                              *
	 ****************************************************************/
	
	var map = map_initialize();

	map_coordinates(map, $('#debug'), 'Mouse at');

	var polygons = L.geoJson(null, {
		onEachFeature: function(feature, layer){
			layer.bindPopup(feature.properties.title);
		},
	}).addTo(map);

	/****************************************************************
	 * search request                                               *
	 ****************************************************************/

	var request = $.ajax({
		url        : 'pages/all/request.php',
		type       : 'POST',
		dataType   : 'json',
		cache      : false,
		
		beforeSend : function(){
			$('#results').html('<li class="loading"></li>');
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

	/****************************************************************
	 * display results                                              *
	 ****************************************************************/

	function list_result(properties)
	{
		$('#results').append('<li tag="' + (properties.id          || ''              ) + '">'
		                   + '<h3>'      + (properties.title       || 'Untitled'      ) + '</h3>'
		                   + (properties.link ? '<a href="' + properties.link + '" target="_blank">' + properties.link + '</a>' : '')
		                   + '<span>'    + (properties.date        || 'date unknown'  ) + '</span>'
		                   + (properties.description ? '<p>' + properties.description + '</p>' : '')
		                   + '</li>');
	}
});
