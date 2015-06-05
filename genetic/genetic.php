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
function getFittingPixel($p_pixel1, $p_pixel2)
{
	return getFitting($p_pixel1[0], $p_pixel2[0])
	+ getFitting($p_pixel1[1], $p_pixel2[1])
	+ getFitting($p_pixel1[2], $p_pixel2[2])
	+ getFitting($p_pixel1[3], $p_pixel2[3], true);
}

function getFittingTotal($p_pixels_genetic, $p_pixels_goal, $p_nb_pixels)
{
	$fitting = 0;
	for($iPixel = 0; $iPixel < $p_nb_pixels; $iPixel++)
	{
		$fitting += getFittingPixel($p_pixels_genetic[$iPixel], $p_pixels_goal[$iPixel]);
	}
	return $fitting;
}

/** ====================================================================================
	INITIALIZATION : FIRST GENERATION
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

/** ====================================================================================
	EVOLVE : LIFE CIRCLE
	Configuration for genetic : please read config.php and form
==================================================================================== **/

function evolve(&$p_pixels_genetic, $p_pixels_goal, &$p_stats, $p_palette)
{
	$nb_pixels = count($p_pixels_goal);
	$p_stats['nb_generations'] = 0;
	$p_stats['min_fitting'] =  0;	
	if($GLOBALS['MIN_FITTING_POURCENTAGE']  < 100)
	{
		$p_stats['min_fitting'] = $nb_pixels * $GLOBALS['MIN_FITTING_POURCENTAGE']  / 100;
	}
	$p_stats['fitting_total'] = getFittingTotal($p_pixels_genetic, $p_pixels_goal, $nb_pixels);

	$p_stats['microtime_start'] = microtime(true);

	while($p_stats['nb_generations'] < $GLOBALS['MAX_ITERATIONS'] 
		&& $p_stats['fitting_total'] > $p_stats['min_fitting'])
	{
		// Selection and Reproduction
		$new_generation = array();
		reproduce($new_generation, $p_pixels_genetic, $p_pixels_goal, $nb_pixels, $p_palette);

		// Who will survive ?
		// Calculate fitting at the same time for optimization
		survive($p_pixels_genetic, $new_generation, $p_pixels_goal, $nb_pixels, $p_stats);

		$p_stats['nb_generations']++;
	}

	$p_stats['microtime_end'] = microtime(true);
}

/** ====================================================================================
	REPRODUCE
==================================================================================== **/

function reproduce(&$p_new_generation, $p_pixels_genetic, $p_pixels_goal, $p_nb_pixels, $p_palette)
{
	$nb_colours = count($p_palette) - 1;
	$palette_keys = array_keys($p_palette);
	
	for($iPixel = 0; $iPixel < $p_nb_pixels; $iPixel++)
	{
		// Reproduction phase : create a new individual
		$random_crossover = mt_rand(0,100);
		if($random_crossover < $GLOBALS['CROSSOVER_ACTIVATE_THRESHOLD'])
		{
			$p_new_generation[$iPixel] = reproduce2Parents($p_pixels_genetic, $p_pixels_goal[$iPixel], $p_nb_pixels);
		}
		else
		{
			$p_new_generation[$iPixel] = reproduce1Parent($p_pixels_genetic, $p_pixels_goal[$iPixel], $p_nb_pixels);
		}

		// Mutation phase
		$random_mutation = mt_rand(0,100);
		if($random_mutation < $GLOBALS['MUTATION_ACTIVATE_THRESHOLD'])
		{
			mutate($p_new_generation[$iPixel], $p_palette, $palette_keys, $nb_colours);
		}
	}
}

function reproduce1Parent($p_pixels_genetic, $p_pixel_goal, $p_nb_pixels)
{
	$iParent = selectBestParent($p_pixels_genetic, $p_pixel_goal, $p_nb_pixels);
	return $p_pixels_genetic[$iParent];
}

function reproduce2Parents($p_pixels_genetic, $p_pixel_goal, $p_nb_pixels)
{
	$iMother = selectBestParent($p_pixels_genetic, $p_pixel_goal, $p_nb_pixels);
	$iFather = mt_rand(0,($p_nb_pixels-1));
	
	$mother = $p_pixels_genetic[$iMother];
	$father = $p_pixels_genetic[$iFather];
	
	return crossover($mother, $father, $p_pixel_goal);
}

/**
* Elitist : select the best mother for the new kid
* $p_iIndividual : the individual to replace
**/
function selectBestParent($p_pixels_genetic, $p_pixel_goal, $p_nb_pixels)
{
	$iBest = 0;
	$best_fitting = 9999;
	$iPixelTest = 0;
	$is_0_fitting_found = false;
	
	do
	{
		// Calculate hypothetical fitting
		$test_fitting = getFittingPixel($p_pixels_genetic[$iPixelTest], $p_pixel_goal);
		
		// Is the fitting better than the best found for the moment ?
		if($test_fitting < $best_fitting)
		{
			$iBest = $iPixelTest;
			$best_fitting = $test_fitting;
		}
		
		// Did we find the absolute fitting ?
		if($best_fitting == 0)
		{
			$is_0_fitting_found = true;
		}
		
		$iPixelTest++;
	}while($iPixelTest < $p_nb_pixels && !$is_0_fitting_found);
	
	return $iBest;
}

function crossover($p_mother, $p_father, $p_pixel_goal)
{
	$child = array();

	for ($iGene=0; $iGene < 4; $iGene++) 
	{ 
		$is_alpha = $iGene == 3 ? true : false;
		$fitting_mother = getFitting($p_mother[$iGene], $p_pixel_goal[$iGene], $is_alpha);
		$fitting_father = getFitting($p_father[$iGene], $p_pixel_goal[$iGene], $is_alpha);

		if($fitting_mother > $fitting_father)
		{
			$child[$iGene] = $p_mother[$iGene];
		}
		else
		{
			$child[$iGene] = $p_father[$iGene];
		}
	}

	return $child;
}

function mutate(&$p_pixel, $p_palette, $p_palette_keys, $p_nb_colours)
{
	$p_pixel = $p_palette[$p_palette_keys[mt_rand(0, $p_nb_colours)]];
}

/** ====================================================================================
	SURVIVING
	Tournament : better fitting (younger if truce) surviving
==================================================================================== **/

function survive(&$p_pixels_genetic, $p_new_generation, $p_pixels_goal, $p_nb_pixels, &$p_stats)
{
	$p_stats['fitting_total'] = 0;
	$p_stats['nb_error'] = 0;

	for($iPixel = 0; $iPixel < $p_nb_pixels; $iPixel++)
	{
		$actual_fitting = getFittingPixel($p_pixels_genetic[$iPixel], $p_pixels_goal[$iPixel]);
		$new_fitting = getFittingPixel($p_new_generation[$iPixel], $p_pixels_goal[$iPixel]);
		
		if($new_fitting <= $actual_fitting )
		{
			$p_pixels_genetic[$iPixel] = $p_new_generation[$iPixel];
			$p_stats['fitting_total'] += $new_fitting;
		}
		else
		{
			$p_stats['fitting_total'] += $actual_fitting;
		}
		
		if($new_fitting > 0 &&  $actual_fitting > 0)
		{
			$p_stats['nb_error']++;
		}
	}
	
	$p_stats['percentage_error'] = $p_stats['nb_error'] / $p_nb_pixels;
}
