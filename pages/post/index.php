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

	<div class="right areas" id="side">
		<h2>Draw an area on the map</h2>
		<div>
			<p>Welcome to Science Locator! Post a research paper by clicking the button below.</p>
			<center><input type="button" name="area" value="Define Area"></center>
			<p>Then click on points on the map to define the corners of a polygon. The area will be stored along with the paper.</p>
		</div>
		<h2>Enter details about the paper</h2>
		<div id="details">
			<input type="text"   name="title"       placeholder=" Title"/>                  <br />
			<input type="text"   name="date"        placeholder=" Date" />                  <br />
			<input type="text"   name="link"        placeholder=" Link" />                  <br />
			<textarea            name="description" placeholder=" Description" /></textarea><br />
			<input type="button" name="submit"      value      ="Post Paper">
			<br class="clear"/>
		</div>
	</div>

	<?php system_body_end(); ?>
	<script src="<?=$system_page_dir?>/layout.js"                  ></script>
	<script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	<script src="<?=$system_shared_dir?>/map_initialize.js"        ></script>
	<script src="<?=$system_shared_dir?>/map_draw.js"              ></script>
	<script src="<?=$system_shared_dir?>/map_coordinates.js"       ></script>
	<script src="<?=$system_page_dir?>/request.js"                 ></script>
</body>
</html>
