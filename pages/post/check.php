<?php

$blacklist = array();

function check_title($title)
{
	if(empty($title)) return false;

	// trim
	$title = trim($title, ' \t\'".');

	// check against blacklist
	global $blacklist;
	if(count(array_intersect(explode(' ', $title), $blacklist)) > 0) return false;

	return $title;
}

function check_date($date)
{
	if(empty($date)) return false;

	// trim
	$date = trim($date, ' \t\'".');

	// validate
	$time = strtotime($date);
	if($time === false) return false;
	$date = date('d.m.Y', $time);

	return $date;
}

function check_link($link)
{
	if(empty($link)) return false;

	$schemes = array('http', 'https', 'ftp');

	// trim
	$link = trim($link);

	// complete scheme
	$omitted = true;
	foreach($schemes as $scheme)
		if($scheme . '://' == substr($link, 0, count($scheme) + 3))
			$omitted = false;
	if($omitted) $link = 'http://' . $link;

	// is an url
	$parts = parse_url($link);
	if(!in_array($parts['scheme'], $schemes)) return false;

	// is reachable
    if(!$fp = curl_init($link)) return false;

    return $link;
}

function check_description($description)
{
	if(empty($description)) return false;

	// trim
	$description = trim($description, ' \t\'"');

	// check against blacklist
	global $blacklist;
	if(count(array_intersect(explode(' ', $description), $blacklist)) > 0) return false;

	return $description;
}

function check_points($points)
{
	if(empty($points)) return false;

	// add all points
	foreach($points as $point)
		$output[] = array(floatval($point[0]), floatval($point[1]));

	// close ring
	$output[] = $output[0];

	return $output;
}
