<?php

system_style($system_page_dir . '/style.css');

include($system_shared_dir . '/leaflet.php');
system_script($system_shared_dir . '/map_initialize.js');
system_script($system_shared_dir . '/map_coordinates.js');
system_script($system_shared_dir . '/map_draw.js');

system_script($system_page_dir . '/request.js');

include('page.php');
