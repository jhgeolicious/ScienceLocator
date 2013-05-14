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

	/****************************************************************
	 * debug print                                                  *
	 ****************************************************************/
	map.on('mousemove', function(e){
		var lng = L.Util.formatNum(e.latlng.lng, 5);
		var lat = L.Util.formatNum(e.latlng.lat, 5);
		$('#debug').html('Lng ' + lng + ' Lat ' + lat);
	}, this);

	/****************************************************************
	 * polygon drawing                                              *
	 ****************************************************************/
	var drawing = false, polygon = L.polygon([]).addTo(map), points = [];

	
	$('#area input[type="button"]').click(function(){
		drawing_state();
	});

	// start and stop setting points
	map.on('click', function(e){
		if(drawing)
		{
			points.push(e.latlng);
			update_polygon(points);
		}
	});
	
	$(document).keyup(function(e) {
		if(e.keyCode == 27)
			drawing_state(false);
	});

	// preview next point
	map.on('mousemove', function(e){
		if(drawing)
			update_polygon(points.concat(e.latlng));
	}, this);

	// helper functions
	var area_button_label = $('#area input[type="button"]').val();
	function drawing_state(state)
	{
		if(typeof state === 'undefined')
			state = !drawing;

		if(state)
		{
			polygons.clearLayers();
			points = [];
			$('#area input[type="button"]').val('I am ready');
		}
		else
		{
			update_polygon(points);
			$('#area input[type="button"]').val(area_button_label);
		}

		drawing = state;
	}

	function update_polygon(points)
	{
		map.removeLayer(polygon);
		polygon = L.polygon(points, {
			color:      '#f60',
			opacity:     0.8,
			weight:      7,
			fillColor:  '#f60',
			fillOpacity: 0.3,
		});
		polygon.addTo(map);
	}

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
				$('#results').html('<li><h3>Wait for it...</h3></li>');
				map.removeLayer(polygon);
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
		search_request($('#keywords input[type="text"]').val());
	});

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
