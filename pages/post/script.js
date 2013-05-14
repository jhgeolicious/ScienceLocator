$(document).ready(function(){

	var map = L.map('map', {
		minZoom   : 0,
		maxZoom   : 11,
		maxBounds : [[90, -180], [-90, 180]],
		crs       : L.CRS.EPSG3857,
	}).setView([0, 0], 0);

	var terrain  = L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);

	map.on('mousemove', function(e){
		var lng = L.Util.formatNum(e.latlng.lng, 5);
		var lat = L.Util.formatNum(e.latlng.lat, 5);
		$('#debug').html('Lng ' + lng + ' Lat ' + lat);
	}, this);
});
