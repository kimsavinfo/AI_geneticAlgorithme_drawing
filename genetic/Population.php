<?php

require_once('ImageGoal.php');

class Population
{
	private $MAX_ITERATIONS = 10;
	private $imageGoal;
	private $individuals = array();
	private $nb_individuals; // would often get the total number so facto here
	
	/**
	* Initialisation : 
	* Create as many individuals as there are pixels in the image.
	* Pick a random colour from the picture and associate it to the Individual.
	*/
	public function __construct($p_path)
	{
		$this->imageGoal = new ImageGoal($p_path);
		$this->initPopulation();
	}
	
	private function initPopulation()
	{
		$width = $this->imageGoal->getWidth();
		$height = $this->imageGoal->getHeight();
		$unique_colours = $this->imageGoal->getUniqueColours();
		
		for ($iLine=0; $iLine < $height; $iLine++) 
		{
			for ($iColumn=0; $iColumn < $width; $iColumn++) 
			{				
				$random_key = array_rand($unique_colours, 1);
				$this->individuals[] = $unique_colours[$random_key];
			}
		}
		
		$this->nb_individuals = $width * $height;
	}
	
	/* === EVOLVE ============================================== */
	
	/**
	* Try to recreate image with a genetic algorithm 
	*/
	public function evolve()
	{
		$iIteration = 0;
		
		do
		{
			$this->evaluate();
			
			$iIteration++;
		}while($iIteration < $this->MAX_ITERATIONS);
	}
	
	private function evaluate()
	{
		$individuals_goal = $this->imageGoal->getIndividuals();
		
		for($iIndividual = 0; $iIndividual < $this->nb_individuals; $iIndividual++)
		{
			$this->individuals[$iIndividual]->evaluate($individuals_goal[$iIndividual]);
		}
	}
	
	/* === GET / SET =================================================== */
	
	public function getIndividuals()
	{
		return $this->individuals;
	}
	
	public function getImageGoal()
	{
		return $this->imageGoal;
	}
	
}