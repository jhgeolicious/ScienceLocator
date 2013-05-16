<?php

function geojson_from_points($points)
{
	$geometry = array(
		'type'        => 'Polygon',
		'coordinates' => array($points),
		'crs'         => array('type' => 'name', 'properties' => array('name' => 'EPSG:3857')),
	);

	return json_encode($geometry);
}
