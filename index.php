<?php

// set error reporting only during development phase
error_reporting(-1);

// load configuration
include 'config/index.php';

// get page
if(isset($_GET['page']))
	$page = $_GET['page'];
else
	$page = $config['home'];

// load system
include 'layout/index.php';

// securely include page
if(in_array($page, $config['pages']))
{
	$system_dir = 'pages/' . $page . '/';
	include $system_dir . 'index.php';
}
// or deny access
else
{
	header('HTTP/1.0 404 Not Found');
	header('Content-type: text/plain');
	echo 'The requested page does not exist.';
}
