<?php

error_reporting(-1);

// get page
if(isset($_GET['page']))
	$page = $_GET['page'];
else
	$page = $config['home'];

// load system
include 'system/index.php';

// check allowance
if(in_array($page, $config['pages']))
{
	$system_dir = 'pages/' . $page . '/';
	include $system_dir . 'index.php';
}
else
{
	header('HTTP/1.0 404 Not Found');
	header('Content-type: text/plain');
	echo 'The requested page does not exist.';
}
