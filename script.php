<?php

$db = pg_connect("host=localhost port=5432 dbname=postgistry user=postgres password=postgres") or die('Connection to database failed.');
$result = pg_query($db, 'SELECT id, name, ST_AsText(area) FROM tablename');

if($result)
{
	while ($row = pg_fetch_array($result))
	{
		$id = $row[0];
		$title = $row[1];

		$description = '';
		$points = polygon_from_text($row[2]);
		foreach($points as $point)
		{
			$description .= '(' . $point[0] . '|' . $point[1] . '), ';
		}

		results_entry($title, 'id ' . $id, $description);
	}
}  

pg_free_result($result);
pg_close($db);

function results_entry($title, $date, $description)
{
	echo '<a><h3>' . $title . '</h3><span>' . $date . '</span><p>' . $description . '</p></a>';
}

function polygon_from_text($input)
{
	if(substr($input, 0, 7) != 'POLYGON') return;

	$string = substr($input, 9, -2);
	$points = explode(',', $string);
	foreach($points as $key => $point)
	{
		$points[$key] = explode(' ', $point);
	}
	return $points;
}
