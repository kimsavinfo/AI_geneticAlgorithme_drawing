<?php

require_once('Individual.php');

class ImageGoal
{
	private $individuals = array();
	private $main_colours = array();
	
	public function __construct($p_path, $p_max_main_colour = 1)
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
			}
		}
		
		$this->findMainColours($p_max_main_colour );
	}
	
	private function findMainColours($p_max_main_colour = 1)
	{
		$main_colours = array();
	}
	
	public function getIndividuals()
	{
		return $this->individuals;
	}
}