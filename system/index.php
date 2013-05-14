<?php

include 'config.php';

function system_head()
{ ?>
	<title><?php echo $config['title']; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="system/pic/favicon.png" type="image/ico">
	<link rel="stylesheet" type="text/css" href="system/style/style.css">	
<?php }

function system_body_start()
{ ?>
	<?php global $config, $page; ?>
	<div id="header">
		<h1 id="logo"><a href="/"><?=$config['title']?></a></h1>
		<h2 id="slogan">„Find research papers by location!“</h2>
		<ul id="menu">
			<?php foreach($config['menu'] as $key => $value)
			{
				echo '<li' . ($key == $page ? ' class="selected"' : '') . '>';
				echo '<a href="?page=' . $key . '">' . $value . '</a></li>';
			} ?>
		</ul>
		<br class="clear">
	</div>
	<div id="content">
<?php }

function system_body_end()
{ ?>
	</div>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="system/script/script.js"></script>
<?php }
