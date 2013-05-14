<?php
	if(isset($_GET['page']))
	{
		$allowed = array('search', 'post', 'account');
		if(in_array($_GET['page'], $allowed)) $page = $_GET['page'];
		else
		{
			header('HTTP/1.0 404 Not Found');
			header('Content-type: text/plain');
			echo 'The requested page does not exist.';
			die;
		}
	}
	else $page = 'search';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Science Locator</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.css" />
	<!--[if lte IE 8]>
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" />
	<![endif]-->

	<link rel="shortcut icon" href="layout/pic/favicon.png" type="image/ico">
	<link rel="stylesheet" type="text/css" href="layout/style.css">

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="layout/script.js"></script>
</head>
<body>
	<div id="header">
		<h1 id="logo"><a href="/">Science Locator</a></h1>
		<h2 id="slogan">„Find research papers by location!“</h2>
		<ul id="menu">
			<li <?php if($page == 'search')  echo 'class="selected"'; ?> ><a href="?page=search">Search</a></li>
			<li <?php if($page == 'post'  )  echo 'class="selected"'; ?> ><a href="?page=post">Post</a></li>
			<li <?php if($page == 'account') echo 'class="selected"'; ?> ><a href="?page=account">Account</a></li>
		</ul>
		<br class="clear">
	</div>
	<div id="content">
		
		<?php include('pages/' . $page . '/index.php'); ?>
	</div>
</body>
</html>
