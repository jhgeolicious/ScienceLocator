<!DOCTYPE html>
<html>
<head>
	<?php system_head(); ?>
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.css" />
	<!--[if lte IE 8]>
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?=$system_dir?>style.css">	
</head>
<body>
	<?php system_body_start(); ?>
	<div id="side"><div>
	<h2>1. Draw an area on the map</h2>
	<div id="area">
		<p>Welcome to Science Locator! Post a research paper by clicking the button below.</p>
		<span><input type="button" class="button" value="Define Area"></span>
		<p>Then click on points on the map to define the corners of a polygon. The area will be stored along with the paper.<p>
	</div>
	<h2>2. Enter keywords the paper is about</h2>
	<div id="details">
		<form method="post">
			<span><input type="text" placeholder=" Title" value="" /></span><br />
			<span><input type="text" placeholder=" Link" value="" /></span><br />
			<span><input type="text" placeholder=" Description" value="" /></span><br />
			<input type="button" class="button" value="Post Paper">
			<br class="clear" />
		</form>
	</div>
	</div></div>
	<div id="middle"><div><div>
		<div id="map"></div>
		<div id="footer">Copyright © 2013 Science Locator. Early prototype by Danijar Hafner. <span style="color:#aaa;">Debug: <span id="debug"></span></span></div>
	</div></div></div>
	<br class="clear">
	<?php system_body_end(); ?>
	<script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	<script src="<?=$system_dir?>layout.js"></script>
	<script src="<?=$system_dir?>request.js"></script>
</body>
</html>