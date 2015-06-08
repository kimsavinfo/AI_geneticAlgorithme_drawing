<?php

function lib_getListImages($p_directory)
{
	$list_imgs = array();

	// add trailing slash if missing
	if(substr($p_directory, -1) != "/") $p_directory .= "/";

	// full server path to directory
	$full_path = $p_directory;
	$opened_directory = @dir($full_path) or die("lib_getListImages: Failed opening directory $p_directory for reading");
	
	$images_types = array("image/jpeg", "image/gif", "image/png");
	while(false !== ($img_file = $opened_directory->read())) 
	{
		if($img_file != "." && $img_file != "..")
		{
			$list_imgs[] = $img_file;
		}
	}
	$opened_directory->close();

	return $list_imgs;
}