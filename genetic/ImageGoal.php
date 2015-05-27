<?php

require_once('Individual.php');

class ImageGoal
{	
	private $width;
	private $height;
	private $individuals = array(); // all colours
	private $unique_colours = array(); // list all different colours but only 1 time
	
	public function __construct($p_path)
	{
		$image = imagecreatefrompng($p_path);
		$size = getimagesize($p_path);
		
		$this->width = $size[0];
		$this->height = $size[1];
		
		for ($iLine=0; $iLine < $size[1]; $iLine++) 
		{
			for ($iColumn=0; $iColumn < $size[0]; $iColumn++) 
			{				
				$rgb = imagecolorat($image, $iColumn, $iLine);
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
			$this->unique_colours[$colour_key] = new Individual(
				$p_individual->getRed()->getColour(), 
				$p_individual->getGreen()->getColour(), 
				$p_individual->getBlue()->getColour(), 
				$p_individual->getalpha()->getOpacity()
			);
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
	
	public function getWidth()
	{
		return $this->width;
	}
	
	public function getHeight()
	{
		return $this->height;
	}
}