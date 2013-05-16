<?php

$config = array(
	'title'    => 'Science Locator',
	'slogan'   => '„Find research papers by location!“',
	'layout'   => 'default',
	'pages'    => array('search', 'post', 'account', 'all'),
	'home'     => 'search',
	'menu'     => array('search' => 'Search', 'post' => 'Post', 'account' => 'Account'),
	'database' => array('host' => 'localhost', 'port' => '5432', 'dbname' => 'postgistry', 'user' => 'postgres', 'password' => 'postgres'),
);
