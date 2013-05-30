<?php

/****************************************************************
 * scripts                                                      *
 ****************************************************************/

$scripts = array();
function system_script($src)
{
	global $scripts;
	if(!in_array($src, $scripts))
		$scripts[] = $src;
}

function system_scripts()
{
	global $scripts;
	foreach($scripts as $script)
		echo '<script src="' . $script . '"></script>';
}

/****************************************************************
 * styles                                                       *
 ****************************************************************/

$styles = array();
function system_style($href)
{
	global $styles;
	if(!in_array($href, $styles))
		$styles[] = $href;
}

function system_styles()
{
	global $styles;
	foreach($styles as $style)
		echo '<link rel="stylesheet" type="text/css" href="' . $style . '">';
}

/****************************************************************
 * menu                                                         *
 ****************************************************************/

function system_menu()
{
	global $config, $page;
	foreach($config['menu'] as $key => $value)
	{
		echo '<li' . ($key == $page ? ' class="selected"' : '') . '>';
		echo '<a href="?page=' . $key . '">' . $value . '</a></li>';
	}
}
