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
		<h2>All papers from Science Locator</h2>
		<div id="results"></div>
	</div>

	<?php layout_body_end(); ?>
</body>
</html>
