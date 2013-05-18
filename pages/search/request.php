<?php

/*******************************************
 * fetch input from JavaScript             *
 *******************************************/

$search = array();

if(isset($_POST['keywords']))
	$search['keywords'] = trim($_POST['keywords']);

if(isset($_POST['points'])) {
	foreach($_POST['points'] as $point)
		$search['points'][] = array(floatval($point[0]), floatval($point[1]));
	$search['points'][] = $search['points'][0];
} else die('You need to specify a search area.');

/*******************************************
 * database query                          *
 *******************************************/

require('../../shared/database_query.php');
require('../../shared/geojson_conversion.php');

$db = connect();

$result = query($db,
	"SELECT id, title, to_char(date, 'MM/DD/YYYY') As date, link, description, ST_AsGeoJSON(polygon)
	FROM tablename
	WHERE ST_Intersects(ST_GeomFromGeoJSON($1), polygon) = 't'
	AND   ST_Within    (ST_GeomFromGeoJSON($1), polygon) = 'f';",
	geojson_from_points($search['points'])
);

if(!$result) die('The database query failed.');

/*******************************************
 * create geojson object                   *
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
