<?php

function system_menu()
{
	global $config, $page;
	foreach($config['menu'] as $key => $value)
	{
		echo '<li' . ($key == $page ? ' class="selected"' : '') . '>';
		echo '<a href="?page=' . $key . '">' . $value . '</a></li>';
	}
}
