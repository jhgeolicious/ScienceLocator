<!DOCTYPE html>
<html>
<head>
	<?php system_head(); ?>
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.css" />
	<!--[if lte IE 8]>
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?=$system_page_dir?>/style.css">	
</head>
<body>
	<?php system_body_start(); ?>
	<div id="side"><div>
		<h2>First, draw an area on the map</h2>
		<div id="area">
			<p>Welcome to Science Locator! Start a new search by clicking the button below.</p>
			<span><input type="button" class="button" value="Define Area"></span>
			<p>Then click on points on the map to define the corners of a polygon. The search results will be filtered by that area.<p>
		</div>
		<h2>Enter keywords you look for</h2>
		<div id="keywords">
			<form method="post">
				<input type="button" class="button" value="Find Results">
				<span><input type="text" placeholder=" Type here..." value="" /></span>
			</form>
			<p>Examples are <i>lake, tokio, topology</i>. You might leave this blank.</p>
		</div>
		<h2>Results on the map and below</h2>
		<ul id="results">
			<li><br/><br/><br/></li>
		</ul>
	</div></div>
	<div id="middle"><div><div>
		<div id="ads">&nbsp;</div>
		<div id="map"></div>
		<div id="footer">Copyright © 2013 <?=$config['title']?>. Early prototype by Danijar Hafner. <span id="debug"></span></div>
	</div></div></div>
	<br class="clear">
	<?php system_body_end(); ?>
	<script src="<?=$system_page_dir?>/layout.js"           ></script>
	<script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	<script src="<?=$system_shared_dir?>/map_initialize.js" ></script>
	<script src="<?=$system_shared_dir?>/map_draw.js"       ></script>
	<script src="<?=$system_shared_dir?>/map_coordinates.js"></script>
	<script src="<?=$system_page_dir?>/request.js"          ></script>
</body>
</html>
