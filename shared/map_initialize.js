var map_initialize = function(id)
{
	// initialize map
	var map = L.map(id || 'map', {
		minZoom   : 0,
		maxZoom   : 11,
		maxBounds : [[-85, -180],[85, 180]],
		crs       : L.CRS.EPSG3857,
	}).fitWorld();

	// add a tile layer
	var terrain  = L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);

	return map;
}
