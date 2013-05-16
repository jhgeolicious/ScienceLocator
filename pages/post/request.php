<?php

/*******************************************
 * fetch input from javascript             *
 *******************************************/

include 'check.php';

$detail = array();

$detail['title'      ] = check_title      ($_POST['title'      ]);
$detail['date'       ] = check_date       ($_POST['date'       ]);
$detail['link'       ] = check_link       ($_POST['link'       ]);
$detail['description'] = check_description($_POST['description']);
$detail['points'     ] = check_points     ($_POST['points'     ]);

if(!$detail['title'      ]) die('You need to type in a proper title.'      );
if(!$detail['date'       ]) die('You need to type in a proper date.'       );
if(!$detail['link'       ]) die('You need to type in a proper link.'       );
if(!$detail['description']) die('You need to type in a proper description.');
if(!$detail['points'     ]) die('You need to specify a proper area.'       );

/*******************************************
 * database query                          *
 *******************************************/

require('../../shared/database_query.php');
require('../../shared/geojson_conversion.php');

$db = connect();

$result = query($db,
	'INSERT INTO tablename(title, date, link, description, polygon)
	VALUES($1, $2, $3, $4, ST_GeomFromGeoJSON($5))',
	$detail['title'], $detail['date'], $detail['link'], $detail['description'], geojson_from_points($detail['points'])
);

/*******************************************
 * send output                             *
 *******************************************/

if($result)
	echo 'Thanks, the paper was posted successfully.';
else
	echo nl2br('Sorry, there was an error posting the paper.' . '\r\n' . pg_last_error());

/*******************************************
 * free ressources                         *
 *******************************************/

pg_free_result($result);
pg_close($db);
