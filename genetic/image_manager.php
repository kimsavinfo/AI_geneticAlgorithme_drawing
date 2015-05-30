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