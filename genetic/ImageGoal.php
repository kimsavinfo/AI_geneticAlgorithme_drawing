<?php

require_once('Individual.php');

class ImageGoal
{	
	private $individuals = array(); // all colours
	private $unique_colours = array(); // list all different colours but only 1 time
	
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
		ksort($this->unique_colours);
	}
	
	/* === UNIQUE COLOURS ============================================== */
	
	private function addUniqueColour($p_individual)
	{
		$colour_key = $p_individual->getRGBSStringRaw();
		if(!isset($this->unique_colours[$colour_key]))
		{
			$this->unique_colours[$colour_key] = $p_individual;
		}
	}
	
	/* === GET / SET =================================================== */
	
	public function getIndividuals()
	{
		return $this->individuals;
	}
	
	public function getUniqueColours()
	{
		return $this->unique_colours;
	}
}