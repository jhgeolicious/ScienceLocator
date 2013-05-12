<?php

// enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

// input from javascript
// $search_string = isset($_POST['name']) ? $_POST['name'] : '';

$db = pg_connect("host=localhost port=5432 dbname=postgistry user=postgres password=postgres") or die('Connection to database failed.');

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
	$json = json_decode($row[5], true);

	$properties = array(
		'id'          => intval($row[0]),
		'title'       => $row[1],
		'date'        => $row[2],
		'link'        => $row[3],
		'description' => $row[4],
	);

	$geometry = array(
		'type'        => $json['type'],
		'coordinates' => $json['coordinates'],
		'properties'  => $properties,
	);

	$features[] = array('type' => 'Feature', 'geometry' => $geometry);
}
pg_free_result($result);

$geojson = array('type' => 'FeatureCollection', 'features' => $features);

/*******************************************
 * encode output                           *
 *******************************************/

$output = json_encode($geojson) or die('There was an error encoding the results to JSON in the PHP script.');
echo $output;

pg_close($db);

/*
$db = pg_connect("host=localhost port=5432 dbname=postgistry user=postgres password=postgres") or die('Connection to database failed.');

$result = pg_query($db,
	"SELECT row_to_json(collection)
	FROM (
		SELECT 'FeatureCollection'               As type,
		       array_to_json(array_agg(feature)) As features
		FROM (
			SELECT 'Feature'                                                                         As type,
			       ST_AsGeoJSON(tablename.polygon)::json                                             As geometry,
			       row_to_json((SELECT row FROM (SELECT id,
			                                            title,
			                                            to_char(date, 'MM/DD/YYYY') As date,
			                                            link,
			                                            description
			                                    ) As row))                                           As properties
			FROM tablename
		) As feature
	) As collection;"
) or die('Querying results from database faild.');

echo pg_fetch_row($result)[0];
pg_free_result($result);
pg_close($db);
*/
