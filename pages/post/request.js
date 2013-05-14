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
	
});
