<?php

// set error reporting only during development phase
error_reporting(-1);

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
 * fetch input from javascript             *
 *******************************************/

include 'check.php';

$detail = array(
	'title'       => check_title      ($_POST['title'      ]),
	'date'        => check_date       ($_POST['date'       ]),
	'link'        => check_link       ($_POST['link'       ]),
	'description' => check_description($_POST['description']),
);

if(!$detail['title'      ]) die('You need to type in a proper title.'      );
if(!$detail['date'       ]) die('You need to type in a proper date.'       );
if(!$detail['link'       ]) die('You need to type in a proper link.'       );
if(!$detail['description']) die('You need to type in a proper description.');

if(isset($_POST['points'])) {
	foreach($_POST['points'] as $point)
		$detail['points'][] = array(floatval($point[0]), floatval($point[1]));
	$detail['points'][] = $detail['points'][0];
} else die('You need to specify a proper area.');

/*******************************************
 * create geo json geometry                *
 *******************************************/

$geometry = array(
	'type'        => 'Polygon',
	'coordinates' => array($detail['points']),
	'crs'         => array('type' => 'name', 'properties' => array('name' => 'EPSG:3857')),
);

/*******************************************
 * database query                          *
 *******************************************/

$query = "
INSERT INTO tablename (title, date, link, description, polygon)
VALUES
(
	'" . $detail['title'      ] . "',
	'" . $detail['date'       ] . "',
	'" . $detail['link'       ] . "',
	'" . $detail['description'] . "',
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
