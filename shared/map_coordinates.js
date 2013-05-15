var map_coordinates = function(map, element)
{
	map.on('mousemove', function(e){
		var lng = L.Util.formatNum(e.latlng.lng, 5);
		var lat = L.Util.formatNum(e.latlng.lat, 5);
		element.html('Lng ' + lng + ' Lat ' + lat);
	}, this);
}
