<?php

/*******************************************
 * database query                          *
 *******************************************/

require('../../shared/database_query.php');

$db = connect();

$result = query($db, "SELECT id, title, to_char(date, 'MM/DD/YYYY') As date, link, description, ST_AsGeoJSON(polygon) FROM tablename")
	or die('No query results from database.');

/*******************************************
 * create GeoJSON object                   *
 *******************************************/

$features = array();

while ($row = pg_fetch_array($result))
{
	$properties = array(
		'id'          => intval($row[0]),
		'title'       => $row[1],
		'date'        => $row[2],
		'link'        => $row[3],
		'description' => $row[4],
	);

	$features[] = array(
		'type'       => 'Feature',
		'geometry'   => json_decode($row[5], true),
		'properties' => $properties,
	);
}

$geojson = array('type' => 'FeatureCollection', 'features' => $features);

/*******************************************
 * encode output                           *
 *******************************************/

if(count($features) > 0)
	echo json_encode($geojson);
else
	die('No query results from database.');

/*******************************************
 * free ressources                         *
 *******************************************/

pg_free_result($result);
pg_close($db);
