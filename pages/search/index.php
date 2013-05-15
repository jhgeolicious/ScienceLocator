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
			<p>Welcome to Science Locator! Start a new search by clicking the button below.</p>
			<span><input type="button" class="button" value="Define Area"></span>
			<p>Then click on points on the map to define the corners of a polygon. The search results will be filtered by that area.<p>
		</div>
		<h2>2. Enter keywords you look for</h2>
		<div id="keywords">
			<form method="post">
				<input type="button" class="button" value="Find Results">
				<span><input type="text" placeholder=" Type here..." value="" /></span>
			</form>
			<p>Examples are <i>lake, tokio, topology</i>. You might leave this blank.</p>
		</div>
		<h2>3. Results on the map and below</h2>
		<ul id="results">
			<li><h3>Title of the paper</h3><a href="http://www.example.com/paper.pdf">www.example.com/paper.pdf</a><span>01/01/2000</span><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p></li>
			<li><h3>Title of the paper</h3><a href="http://www.example.com/paper.pdf">www.example.com/paper.pdf</a><span>01/01/2000</span><p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></li>
			<li><h3>Title of the paper</h3><a href="http://www.example.com/paper.pdf">www.example.com/paper.pdf</a><span>01/01/2000</span><p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p></li>
			<li><h3>Title of the paper</h3><a href="http://www.example.com/paper.pdf">www.example.com/paper.pdf</a><span>01/01/2000</span><p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p></li>
			<li><h3>Title of the paper</h3><a href="http://www.example.com/paper.pdf">www.example.com/paper.pdf</a><span>01/01/2000</span><p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p></li>
		</ul>
	</div></div>
	<div id="middle"><div><div>
		<div id="ads">&nbsp;</div>
		<div id="map"></div>
		<div id="footer">Copyright © 2013 <?=$config['title']?>. Early prototype by Danijar Hafner. <span style="color:#aaa;">Debug: <span id="debug"></span></span></div>
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
