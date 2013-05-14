<?php

/*******************************************
 * initialization and database setup       *
 *******************************************/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

$db = pg_connect("host=localhost port=5432 dbname=postgistry user=postgres password=postgres") or die('Connection to database failed.');

/*******************************************
 * fetch input from JavaScript             *
 *******************************************/

$search = array(
	'title'    => isset($_POST['title'])    ? $_POST['title']    : '',
	'fulltext' => isset($_POST['fulltext']) ? $_POST['fulltext'] : '',
);

/*******************************************
 * database query                          *
 *******************************************/

$query = "
SELECT
	id,
	title,
	to_char(date, 'MM/DD/YYYY') As date,
	link,
	description,
	ST_AsGeoJSON(polygon)
FROM tablename
";

$result = pg_query($db, $query) or die('No query results from database.');

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
pg_free_result($result);

$geojson = array('type' => 'FeatureCollection', 'features' => $features);

/*******************************************
 * encode output                           *
 *******************************************/

$output = json_encode($geojson) or die('There was an error encoding the results to JSON in the PHP script.');
echo $output;

/*******************************************
 * free ressources                         *
 *******************************************/

pg_close($db);
