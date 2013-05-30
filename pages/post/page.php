<!DOCTYPE html>
<html>
<head>
	<?php layout_head(); ?>
</head>
<body>
	<?php layout_body_start(); ?>

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

	<?php layout_body_end(); ?>
</body>
</html>
