<?php

/*******************************************
 * connect to database                     *
 *******************************************/

include '../../system/config.php';

$db = pg_connect('host='     . $config['database'][  'host'  ]
	          . ' port='     . $config['database'][  'port'  ]
	          . ' dbname='   . $config['database'][ 'dbname' ]
	          . ' user='     . $config['database'][  'user'  ]
	          . ' password=' . $config['database']['password']) or die('Connection to database failed.');

/*******************************************
 * fetch input from JavaScript             *
 *******************************************/

$search = array();

if(isset($_POST['points'])) {
	foreach($_POST['points'] as $point)
		$search['points'][] = array(floatval($point[0]), floatval($point[1]));
	// add starting point at the end
	$search['points'][] = $search['points'][0];
}
else die('You need to define a polygon area to post a paper.');

if(isset($_POST['title']))
	$search['title'] = $_POST['title'];
else die('You need to speficy the title of the paper.');

if(isset($_POST['date']))
	$search['date'] = $_POST['date'];
else die('You need to speficy the date of publication.');

if(isset($_POST['link']))
	$search['link'] = $_POST['link'];
else die('You need to speficy the link where the paper can be found online.');

if(isset($_POST['description']))
	$search['description'] = $_POST['description'];

/*******************************************
 * create geo json geometry                *
 *******************************************/

$geometry = array(
	'type'        => 'Polygon',
	'coordinates' => array($search['points']),
	'crs'         => array('type' => 'name', 'properties' => array('name' => 'EPSG:3857')),
);

// die(json_encode($geometry));

/*******************************************
 * database query                          *
 *******************************************/

$query = "
INSERT INTO tablename (title, date, link, description, polygon)
VALUES
(
	'" . $search['title'      ] . "',
	'" . $search['date'       ] . "',
	'" . $search['link'       ] . "',
	'" . $search['description'] . "',
	ST_GeomFromGeoJSON('" . json_encode($geometry) . "')
)
";

$result = pg_query($db, $query);

/*******************************************
 * send output                             *
 *******************************************/

if($result)
	echo 'Thanks, the paper was posted successfully.';
else
	echo nl2br('Sorry, there was an error posting the paper.\n' . pg_last_error());

/*******************************************
 * free ressources                         *
 *******************************************/

pg_free_result($result);
pg_close($db);
