<?php

system_style($system_page_dir . '/style.css');
system_script($system_page_dir . '/layout.js');

// system_plugin('leaflet');
system_plugin('leaflet-dev'); // use development version to control animations
system_script($config['dirs']['shared'] . '/map_initialize.js');
system_script($config['dirs']['shared'] . '/map_coordinates.js');
system_script($config['dirs']['shared'] . '/map_draw.js');

system_script($system_page_dir . '/request.js');

include('page.php');
