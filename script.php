<?php

$db = pg_connect("host=localhost port=5432 dbname=postgistry user=postgres password=postgres") or die('<b>Connection to database failed.</b>');
$result = pg_query($db, 'SELECT id, name FROM tablename');

if($result)
{
	echo 'There are ';
	$first = true;
	while ($row = pg_fetch_array($result)) {
		if($first) $first = false;
		else echo ', ';
		echo 'a ' . $row[1];
	}
	echo ' in my pocket.';
}  

pg_free_result($result);
pg_close($db);
