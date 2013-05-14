$(document).ready(function(){

	var map = L.map('map', {
		minZoom   : 0,
		maxZoom   : 11,
		maxBounds : [[-75, -180], [75, 180]],
		crs       : L.CRS.EPSG3857,
	}).setView([20, -20], 0);

	var terrain  = L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);
	
	var polygons = L.geoJson(null, {
		onEachFeature: function(feature, layer){
			debug = feature.geometry.coordinates;
			layer.bindPopup(feature.properties.title + '<br><span style="color:#aaa;">' + 'Debug: ' + debug + "</span>");
		},
	}).addTo(map);

	map.on('mousemove', function(e){
		var lng = L.Util.formatNum(e.latlng.lng, 5);
		var lat = L.Util.formatNum(e.latlng.lat, 5);
		$('#debug').html('Lng ' + lng + ' Lat ' + lat);
	}, this);

	function search_request(title)
	{
		var request = $.ajax({
			url        : 'pages/search/request.php',
			type       : 'POST',
			dataType   : 'json',
			data       : {
							title : title || '',
						 },
			cache      : false,
			beforeSend : function(){
				$('#results').html('<li><h3>Wait for it...</h3></li>');
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

	function list_result(properties)
	{
		$('#results').append('<li tag="' + (properties.id          || ''              ) + '">'
		                   + '<h3>'      + (properties.title       || 'Untitled'      ) + '</h3>'
		                   + (properties.link ? '<a href="' + properties.link + '">' + properties.link + '</a>' : '')
		                   + '<span>'    + (properties.date        || 'date unknown'  ) + '</span>'
		                   + '<p>'       + (properties.description || 'no description') + '</p>'
		                   + '</li>');
	}

	$('#keywords input[type="button"]').click(function(){
		search_request($('#keywords input[type="text"]').val());
	});
});
