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
}

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

$output = json_encode($geojson) or die('There was an error encoding the results to JSON in the PHP script.');
echo $output;

/*******************************************
 * free ressources                         *
 *******************************************/

pg_free_result($result);
pg_close($db);
