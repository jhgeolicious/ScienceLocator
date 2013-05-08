
var map = L.map('map').setView([23.0, 364.0], 2);

L.tileLayer('http://oatile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg').addTo(map);

var points = [
	[ 10.0, 370.0],
	[ 20.0, 380.0],
	[ 30.0, 410.0],
	[-10.0, 395.0],
];

var polygon = L.polygon(points, {
	color:      '#f60',
	opacity:     0.8,
	weight:      7,
	fillColor:  '#f60',
	fillOpacity: 0.3,
});

polygon.addTo(map);
