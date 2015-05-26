<?php

require_once('Individual.php');

class ImageGoal
{
	// Maximum colour centers
	private $MAX_MAIN_COLOURS = 1;
	private $MAX_MAIN_COLOURS_ITERATIONS = 1000;
	// Minimum distance for the main colour : when do we stop looking for ?
	private $MIN_ACCEPTED_DIST = 100;
	
	private $individuals = array(); // all colours
	private $different_colours = array(); // list all different colours 1 time only
	private $main_colours = array();
	
	public function __construct($p_path, $p_max_main_colours = 1)
	{
		$image = imagecreatefrompng($p_path);
		$size = getimagesize($p_path);
		
		for ($iLine=0; $iLine < $size[0]; $iLine++) 
		{
			for ($iColumn=0; $iColumn < $size[1]; $iColumn++) 
			{
				$rgb = imagecolorat($image, $iLine, $iColumn);
				$colours = imagecolorsforindex($image, $rgb);
				
				$individual = new Individual(
					$colours["red"], $colours["green"],
					$colours["blue"], $colours["alpha"]
				);
				
				$this->individuals[] = $individual;
				$this->addDifferentColour($individual);
			}
		}
		
		$this->findMainColours($p_max_main_colours);
	}
	
	/* === DIFFERENT COLOURS : all colours but 1 time only ============= */
	private function addDifferentColour($p_individual)
	{
		$colour_key = $p_individual->getRGBSStringRaw();
		if(!isset($this->different_colours[$colour_key]))
		{
			$this->different_colours[$colour_key] = $p_individual;
		}
	}
	
	
	/* === K-MEANS : find main colours - BEGIN ========================= */
	
	/**
	* A center is a colour reference, which will become a main colour
	**/
	private function findMainColours($p_max_main_colours = 1)
	{
		$this->checkNbMaxMainColours($p_max_main_colours);
		$this->initMainColours();
		$iIteration = 0;
		
		do
		{
			$biggest_center_distance = 0;
			
			
			$iIteration++;
		}while($biggest_center_distance > $this->MIN_ACCEPTED_DIST
				&& $iIteration < $this->MAX_MAIN_COLOURS_ITERATIONS);
	}
	
	/**
	* Pick MAX_MAIN_COLOURS random colours in different_colours list
	* and set them as the colour references, as the center
	**/
	private function initMainColours()
	{
		$this->main_colours = array();
		$list_keys = array_keys($this->different_colours);
		
		while(count($this->main_colours) < $this->MAX_MAIN_COLOURS) 
		{
			$random_key = array_rand($list_keys, 1);
			$this->main_colours[] = $this->different_colours[$list_keys[$random_key]];
			
			unset($list_keys[$random_key]);
			$list_keys = array_values($list_keys);
		}
	}
	
	private function checkNbMaxMainColours($p_max_main_colours = 1)
	{
		$nb_max = count($this->different_colours);
		$this->MAX_MAIN_COLOURS = $p_max_main_colours < $nb_max ? $p_max_main_colours : $nb_max;
	}
	
	/* === GET / SET =================================================== */
	
	public function getIndividuals()
	{
		return $this->individuals;
	}
	
	public function getMainColours()
	{
		return $this->main_colours;
	}
}