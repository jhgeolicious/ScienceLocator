<!DOCTYPE html>
<html>
<head>
	<?php layout_head(); ?>	
</head>
<body>
	<?php layout_body_start(); ?>

	<div class="left"><div id="map"></div></div>
	<div class="left"><div id="footer">Copyright © <?=date('Y').' '.$config['title']?>. Early prototype by Danijar Hafner. <span id="debug"></span></div></div>
	<div class="left"><div id="ads"></div></div>

	<div class="right areas" id="side">
		<h2>First, draw an area on the map</h2>
		<div>
			<p>Welcome to Science Locator! Start a new search by clicking the button below.</p>
			<center><input type="button" name="area" value="Define Area"></center>
			<p>Then click on points on the map to define the corners of a polygon. The search results will be filtered by that area.<p>
		</div>
		<h2>Enter keywords you look for</h2>
		<div>
			<input type="text" name="keywords" placeholder=" Type here..." value="" />
			<p>Examples are <i>lake, tokio, topology</i>. You might leave this blank.</p>
			<input type="button" name="submit" value="Find Results">
			<br class="clear"/>
		</div>
		<h2>Results on the map and below</h2>
		<div id="results"></div>
	</div>

	<?php layout_body_end(); ?>
</body>
</html>
