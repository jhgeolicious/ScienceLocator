var map_coordinates = function(map, element, text)
{
	map.on('mousemove', function(e){
		var lng = Math.round(L.Util.formatNum(e.latlng.lng, 5) * 100) / 100;
		var lat = Math.round(L.Util.formatNum(e.latlng.lat, 5) * 100) / 100;
		element.html((text ? text + ' ' : '') + 'Lng ' + lng + ' and Lat ' + lat);
	}, this);
}
