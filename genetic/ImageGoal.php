<?php

require_once('Individual.php');

class ImageGoal
{
	private $individuals = array();
	
	public function __construct($p_path)
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
	}
	
	public function get_individuals()
	{
		return $this->individuals;
	}
}