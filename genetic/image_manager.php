<?php

function exportPixelsRGBA($p_path, &$p_pixels, &$p_palette)
{
	// Get the basename to configure the exports file :
	// basename_pixels.txt for all the pixels' image
	// basename_palette.txt for the image's colours palette
	$basename = basename($p_path, ".png");
	$export_file_pixels = $GLOBALS['DIR_IMG_MAP'].$basename."_pixels.txt";
	$export_file_palette = $GLOBALS['DIR_IMG_MAP'].$basename."_palette.txt";

	if(!file_exists($export_file_pixels) || !file_exists($export_file_palette))
	{
		$image = imagecreatefrompng($p_path);
		$size = getimagesize($p_path);

		for ($iLine=0; $iLine < $size[1]; $iLine++) 
		{
			for ($iColumn=0; $iColumn < $size[0]; $iColumn++) 
			{				
				$rgb = imagecolorat($image, $iColumn, $iLine);
				$colours = imagecolorsforindex($image, $rgb);
				
				$p_pixels[] =  array(
					$colours["red"], $colours["green"],
					$colours["blue"], $colours["alpha"]
				);

				$palette_key = $colours["red"].$colours["green"].$colours["blue"].$colours["alpha"];
				$p_palette[$palette_key] = array(
					$colours["red"], $colours["green"],
					$colours["blue"], $colours["alpha"]
				);
			}
		}

		file_put_contents($export_file_pixels, var_export($p_pixels, true));
		file_put_contents($export_file_palette, var_export($p_palette, true));
	}
}

function importPixelsRGBA($p_path, &$p_pixels, &$p_palette)
{
	$basename = basename($p_path, ".png");
	$import_file_pixels = $GLOBALS['DIR_IMG_MAP'].$basename."_pixels.txt";
	$import_file_palette = $GLOBALS['DIR_IMG_MAP'].$basename."_palette.txt";

	if(!file_exists($import_file_pixels) || !file_exists($import_file_palette))
	{
		exportPixelsRGBA($p_path, $p_pixels, $p_palette);
	}
	else
	{
		$pixels_content = file_get_contents($import_file_pixels, "r");
		$palette_content = file_get_contents($import_file_palette, "r");

		eval('$p_pixels = '.$pixels_content.';');
		eval('$p_palette = '.$palette_content.';');
	}
}

function pixelArrayToPicture($p_path, $p_pixels_tab)
{
	$size = getimagesize($p_path);
	$new_pic = imagecreatetruecolor($size[0], $size[1]);

	$nb_of_pixels = $size[0]*$size[1];
	$current_pixel = 0;
	$new_image_j=0;

	for ($i=0; $i < $nb_of_pixels; $i++)
	{ 
		$new_color = imagecolorallocatealpha($new_pic, 
			$p_pixels_tab[$i][0], 
			$p_pixels_tab[$i][1],
			$p_pixels_tab[$i][2], 
			$p_pixels_tab[$i][3]);
			
		$new_image_i = $current_pixel% $size[0];
		$new_image_j = $new_image_i==0 && $i!=0 ? ($new_image_j+1) : $new_image_j;
		$current_pixel++;
		
		imagesetpixel($new_pic, $new_image_i, $new_image_j, $new_color);
	}

	$basename = basename($p_path, ".png");
	$export_png = $GLOBALS['DIR_RESULTS'].$basename."_pixels_".microtime(true).".png";
	
	header('Content-Type: image/png');
	imagepng($new_pic, $export_png);
	
	return $export_png;
}