<?php

system_style($system_page_dir . '/style.css');

system_plugin('leaflet-dev');
system_script($config['dirs']['shared'] . '/map_initialize.js');
system_script($config['dirs']['shared'] . '/map_coordinates.js');
system_script($config['dirs']['shared'] . '/map_draw.js');

system_script($system_page_dir . '/request.js');

include('page.php');
