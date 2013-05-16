<?php

require('../../system/config.php');

function connect()
{
	global $config;
	$db = pg_connect('host='     . $config['database'][  'host'  ]
	              . ' port='     . $config['database'][  'port'  ]
	              . ' dbname='   . $config['database'][ 'dbname' ]
	              . ' user='     . $config['database'][  'user'  ]
	              . ' password=' . $config['database']['password']) or die('Connection to database failed.');
	return $db;
}

function query($db, $query)
{
	if(func_num_args() == 2)
		return pg_query($db, $query);

	$args = func_get_args();
	$params = array_splice($args, 2);
	return pg_query_params($db, $query, $params);
}
