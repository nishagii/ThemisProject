<?php 

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

function esc($str)
{
	return htmlspecialchars($str);
}


function redirect($path)
{
	if (preg_match('/^https?:\/\//', $path)) {
		// External URL like Google's auth link
		header("Location: " . $path);
	} else {
		// Internal route
		header("Location: " . ROOT . "/" . ltrim($path, '/'));
	}
	die;
}