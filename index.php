<!DOCTYPE html>
<html>
<head>
	<title>Science Locator</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="shortcut icon" href="pic/favicon.png" type="image/ico">

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.css" />
	<!--[if lte IE 8]>
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<table class="extent"><tbody>
		<tr id="nav" class="variable split">
			<td id="title"><h1><a href=""><img src="pic/logo.png">Science Locator</a></h1></td>
			<td id="login"><table><tbody>
				<tr><td><label for="name">Email</label></td><td><label for="pass">Password</label></td><td></td></tr>
				<tr><td><input type="text" id="name"></td><td><input type="password" id="pass"></td><td><input type="button" value="Login"></td></tr>
				<tr><td><input type="checkbox" id="stay"><label for="stay">Keep me logged in</label></td><td><a href="">Forgot your password?</a></td><td></td></tr>
			</tbody></table></td>
		</tr>
		<tr id="content" class="fill"><td colspan="2">
			<table class="extent"><tbody>
				<tr class="variable split">
					<td id="search"><span><input type="text" placeholder="search topic..."></span></td>
					<td id="results"><h2>Search Results</h2></td>
				</tr>
				<tr class="fill">
					<td><div id="map"></div></td>
					<td id="sidebar">
						<div id="papers">
							<!--a><h3>Title of the paper</h3><span>01/01/2000</span><p>Description</p></a-->
						</div>
					</td>
				</tr>
			</tbody></table>
		</td></tr>
		<tr id="footer" class="variable"><td colspan="2">This is an early prototype lacking final functionality of http://sciencelocator.com created by Danijar Hafner.</td></tr>
	</tbody></table>

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	<script src="script.js"></script>
</body>
</html>
