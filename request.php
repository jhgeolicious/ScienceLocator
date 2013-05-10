<?php

/*

// enable error reporting for development
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// input from javascript
// $search_string = isset($_POST['name']) ? $_POST['name'] : '';

// database query
$db = pg_connect("host=localhost port=5432 dbname=postgistry user=postgres password=postgres") or die('Connection to database failed.');
$query = pg_query($db, 'SELECT id, name, ST_AsGeoJSON(area) FROM tablename') or die('No query results from database.');

// handle result
$results = array();
while ($row = pg_fetch_array($query))
{
	$results[] = array(
		'id'      => $row[0],
		'title'   => $row[1],
		'polygon' => $row[2],
	);
}

// encode output
$json = json_encode($results) or die('There was an error encoding the results to JSON in the PHP script.');
echo $json;

// close database
pg_free_result($query);
pg_close($db);

*/

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
