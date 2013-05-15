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
	var drawing = map_draw({
		map:    map,
		button: $('#area input[type="button"]')
	});

});
