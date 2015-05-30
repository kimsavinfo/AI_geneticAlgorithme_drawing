<?php

/** ====================================================================================
	FITTING
==================================================================================== **/

// IF Alpha axe THEN fitting * 100
function getFitting($p_axe1, $p_axe2, $p_is_aplha = false)
{
	return $p_is_aplha ? abs($p_axe1 - $p_axe2) * 100 : abs($p_axe1 - $p_axe2);
}

// Max fitting = 255 + 255 + 255 + 100
// The lesser fitting, the better
function getFittingTotal($p_pixel1, $p_pixel2)
{
	return getFitting($p_pixel1[0], $p_pixel2[0])
	+ getFitting($p_pixel1[1], $p_pixel2[1])
	+ getFitting($p_pixel1[2], $p_pixel2[2])
	+ getFitting($p_pixel1[3], $p_pixel2[3], true);
}

/** ====================================================================================
	IINITIALIZATION : FIRST GENERATION
==================================================================================== **/

function initPopulation(&$p_pixels_genetic, $p_palette, $p_nb_pixels)
{
	$nb_colours = count($p_palette) - 1;
	$palette_keys = array_keys($p_palette);
	$iColour = 0;

	for($iPixel = 0; $iPixel < $p_nb_pixels; $iPixel++)
	{
		if($iColour <= $nb_colours)
		{
			// Don't be racist ;) and create at least one pixel for each colour
			$p_pixels_genetic[$iPixel] = $p_palette[$palette_keys[$iPixel]];
			$iColour++;
		}
		else
		{
			$p_pixels_genetic[$iPixel] = $p_palette[$palette_keys[mt_rand(0, $nb_colours)]];
		}
	}
}