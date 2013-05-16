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
	<h2>1. Draw an area on the map</h2>
	<div id="area">
		<p>Welcome to Science Locator! Post a research paper by clicking the button below.</p>
		<span><input type="button" class="button" value="Define Area"></span>
		<p>Then click on points on the map to define the corners of a polygon. The area will be stored along with the paper.<p>
	</div>
	<h2>2. Enter keywords the paper is about</h2>
	<div id="details">
		<form method="post">
			<span><input type="text"   name="title"       placeholder=" Title"       value="German Territory" /></span><br />
			<span><input type="text"   name="date"        placeholder=" Date"        value="16.05.2013" /></span><br />
			<span><input type="text"   name="link"        placeholder=" Link"        value="https://en.wikipedia.org/wiki/Germany" /></span><br />
			<span><input type="text"   name="description" placeholder=" Description" value="Germany is in Western and Central Europe, with Denmark bordering to the north, Poland and the Czech Republic to the east, Austria and Switzerland to the south, France and Luxembourg to the southwest, and Belgium and the Netherlands to the northwest." /></span><br />
			<input       type="button" name="submit"      class="button"             value="Post Paper">
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
	<script src="<?=$system_page_dir?>/layout.js"></script>
	<script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	<script src="<?=$system_shared_dir?>/map_draw.js"></script>
	<script src="<?=$system_shared_dir?>/map_coordinates.js"></script>
	<script src="<?=$system_page_dir?>/request.js"></script>
</body>
</html>
