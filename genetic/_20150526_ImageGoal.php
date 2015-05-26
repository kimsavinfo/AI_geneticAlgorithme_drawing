<?php

/**
Archived because :
Using K-means to find the main colours does not seem to be a so good idea...
In fact, it would perhaps orient the results too much
and we would not explore all paths.
*/

require_once('Individual.php');

class ImageGoal
{
	// Maximum colour centers
	private $MAX_MAIN_COLOURS = 1;
	private $MAX_MAIN_COLOURS_ITERATIONS = 1000;
	// Minimum distance for the main colour : when do we stop looking for ?
	private $MIN_ACCEPTED_DIST = 100;
	
	private $individuals = array(); // all colours
	private $unique_colours = array(); // list all different colours but only 1 time
	private $main_colours = array(); // main image's colours
	
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
				$this->addUniqueColour($individual);
			}
		}
		
		$this->findMainColours($p_max_main_colours);
	}
	
	/* === DIFFERENT COLOURS : all colours but 1 time only ============= */
	private function addUniqueColour($p_individual)
	{
		$colour_key = $p_individual->getRGBSStringRaw();
		if(!isset($this->unique_colours[$colour_key]))
		{
			$this->unique_colours[$colour_key] = $p_individual;
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
			
			$this->sortColoursInMainColours();
			
			
			
			$iIteration++;
		}while($biggest_center_distance > $this->MIN_ACCEPTED_DIST
				&& $iIteration < $this->MAX_MAIN_COLOURS_ITERATIONS);
	}
	
	private function sortColoursInMainColours()
	{
		
	}
	
	/**
	* Pick MAX_MAIN_COLOURS random colours in unique_colours list
	* and set them as the colour references, as the center
	**/
	private function initMainColours()
	{
		$this->main_colours = array();
		$list_keys = array_keys($this->unique_colours);
		
		while(count($this->main_colours) < $this->MAX_MAIN_COLOURS) 
		{
			$random_key = array_rand($list_keys, 1);
			$this->main_colours[] = $this->unique_colours[$list_keys[$random_key]];
			
			unset($list_keys[$random_key]);
			$list_keys = array_values($list_keys);
		}
	}
	
	private function checkNbMaxMainColours($p_max_main_colours = 1)
	{
		$nb_max = count($this->unique_colours);
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