<?php

system_script('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
system_style($system_layout_dir . '/style.css');

function layout_head()
{ ?>
	<?php global $config, $system_layout_dir; ?>
	<title><?php echo $config['title']; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="<?=$system_layout_dir?>/pic/favicon.png" type="image/ico">
	<script src="https://raw.github.com/LeaVerou/prefixfree/gh-pages/prefixfree.min.js"></script>
	<?php system_styles(); ?>
<?php }

function layout_body_start()
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
	<div id="edge"></div>
	<div id="borderleft"></div>
	<div id="borderright"></div>
<?php }

function layout_body_end()
{ ?>
	<?php system_scripts(); ?>
<?php }
