<?php

function system_head()
{ ?>
	<?php global $config, $system_layout_dir; ?>
	<title><?php echo $config['title']; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="<?=$system_layout_dir?>/pic/favicon.png" type="image/ico">
	<link rel="stylesheet" type="text/css" href="<?=$system_layout_dir?>/style.css">	
<?php }

function system_body_start()
{ ?>
	<?php global $config; ?>
	<div id="header">
		<h1 id="logo"><a href="/"><?=$config['title']?></a></h1>
		<h2 id="slogan">„Find research papers by location!“</h2>
		<ul id="menu">
			<?php system_menu(); ?>
		</ul>
		<br class="clear">
	</div>
	<div id="content">
<?php }

function system_body_end()
{ ?>
	</div>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<?php }
