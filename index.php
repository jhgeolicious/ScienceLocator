<?php

// load configuration
require_once('system/config.php');

// load system
require_once('system/index.php');

// get page
if(isset($_GET['page']))
	$page = $_GET['page'];
else
	$page = $config['home'];

// set variables
$system_layout_dir = 'layout/' . $config['layout'];
$system_page_dir = 'pages/' . $page;
$system_shared_dir = 'shared';

// load layout
require_once($system_layout_dir . '/index.php');

// securely include page
if(in_array($page, $config['pages']))
{
	include $system_page_dir . '/index.php';
}
// or deny access
else
{
	header('HTTP/1.0 404 Not Found');
	header('Content-type: text/plain');
	echo 'The requested page does not exist.';
}
