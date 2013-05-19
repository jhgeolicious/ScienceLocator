var map_initialize = function(id)
{
	var map = L.map(id || 'map', {
		minZoom   : 0,
		maxZoom   : 11,
		maxBounds : [[-75, -180], [75, 180]],
		crs       : L.CRS.EPSG3857,
	}).fitWorld();

	var terrain  = L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);

	return map;
}
