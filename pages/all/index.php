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

	<div class="left"><div id="map"></div></div>
	<div class="left"><div id="footer">Copyright © <?=date('Y').' '.$config['title']?>. Early prototype by Danijar Hafner. <span id="debug"></span></div></div>
	<div class="left"><div id="ads"></div></div>

	<div class="right areas" id="side">
		<h2>All papers from Science Locator</h2>
		<div id="results"></div>
	</div>

	<?php system_body_end(); ?>
	<script src="<?=$system_page_dir?>/layout.js"           ></script>
	<script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	<script src="<?=$system_shared_dir?>/map_initialize.js" ></script>
	<script src="<?=$system_shared_dir?>/map_draw.js"       ></script>
	<script src="<?=$system_shared_dir?>/map_coordinates.js"></script>
	<script src="<?=$system_page_dir?>/request.js"          ></script>
</body>
</html>
