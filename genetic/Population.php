<?php

require_once('ImageGoal.php');

/**
* Fitting : the bigger the farther from the goal image (individual colours).
**/

class Population
{
	private $MIN_FITTING_POURCENTAGE = 90; // will calculate MIN_FITTING accepted
	private $MIN_FITTING; // total fitting accepted
	private $CROSSOVER_ACTIVATE_THRESHOLD = 40; // percentage, the odds to happen
	private $MUTATION_ACTIVATE_THRESHOLD = 90; // percentage, the odds to happen
	 // IF the algorithm did not succeed in reaching the MIN_FITTING
	 // THEN it will stop to reproduce at the MAX_ITERATIONS generation
	private $MAX_ITERATIONS = 10000;
	
	private $imageGoal;
	private $individuals = array();
	// Optimisation : would often get the total numbers
	private $nb_individuals; 
	private $nb_genes;
	// Stats
	private $nb_generations = 0;
	
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
				$this->individuals[] = new Individual(
					$unique_colours[$random_key]->getRed()->getColour(), 
					$unique_colours[$random_key]->getGreen()->getColour(), 
					$unique_colours[$random_key]->getBlue()->getColour(), 
					$unique_colours[$random_key]->getalpha()->getOpacity()
				);
			}
		}
		
		$this->nb_individuals = $width * $height;
		$this->nb_genes = $this->individuals[0]->getNbGenes();
		$this->MIN_FITTING = $this->MIN_FITTING_POURCENTAGE * $this->nb_genes / 100;
		
		$this->evaluate($this->individuals);
	}
	
	/* === FITTING ============================================== */
	
	private function evaluate(&$p_individuals)
	{
		$individuals_goal = $this->imageGoal->getIndividuals();
		
		for($iIndividual = 0; $iIndividual < $this->nb_individuals; $iIndividual++)
		{
			$p_individuals[$iIndividual]->evaluate($individuals_goal[$iIndividual]);
		}
	}
	
	/* === EVOLVE ============================================== */
	
	/**
	* Try to recreate image with a genetic algorithm 
	*/
	public function evolve()
	{
		$this->nb_generations = 0;
		$fitting = $this->getFitting();
		
		while($this->nb_generations < $this->MAX_ITERATIONS && $fitting > $this->MIN_FITTING)
		{
			// Selection and Reproduction
			$new_individuals = $this->reproduce();
			$this->evaluate($new_individuals);
			
			// Who will survive ?
			$this->survive($new_individuals, $fitting);
			
			$this->nb_generations++;
		}
	}
	
	private function reproduce()
	{
		$new_individuals = array();
		
		for($iIndividual = 0; $iIndividual < $this->nb_individuals; $iIndividual++)
		{
			// Create a new individual
			$random_crossover = mt_rand(0,100);
			if($random_crossover < $this->CROSSOVER_ACTIVATE_THRESHOLD)
			{
				$new_indidvidual = $this->reproduce2Parents($iIndividual);
			}
			else
			{
				$new_indidvidual = $this->reproduce1Parent($iIndividual);
			}
			
			// Mutation phase
			$random_mutation = mt_rand(0,100);
			if($random_mutation < $this->MUTATION_ACTIVATE_THRESHOLD)
			{
				$new_indidvidual->mutate();
			}
			
			$new_individuals[] = $new_indidvidual;
		}
		
		return $new_individuals;
	}
	
	private function reproduce1Parent($p_iIndividual)
	{
		return new Individual(
			$this->individuals[$p_iIndividual]->getRed()->getColour(), 
			$this->individuals[$p_iIndividual]->getGreen()->getColour(), 
			$this->individuals[$p_iIndividual]->getBlue()->getColour(), 
			$this->individuals[$p_iIndividual]->getalpha()->getOpacity()
		);
	}
	
	private function reproduce2Parents($p_iIndividual)
	{
		$mother = $this->select1ParentForReproduction();
		$father = $this->select1ParentForReproduction();
		return $this->crossover($mother, $father);
	}
	
	private function crossover($p_mother, $p_father)
	{
		$red = mt_rand(0,1) ? $p_mother->getRed()->getColour() : $p_father->getRed()->getColour();
		$blue = mt_rand(0,1) ? $p_mother->getBlue()->getColour() : $p_father->getBlue()->getColour();
		$green = mt_rand(0,1) ? $p_mother->getGreen()->getColour() : $p_father->getGreen()->getColour();
		$alpha = mt_rand(0,1) ? $p_mother->getalpha()->getOpacity() : $p_father->getalpha()->getOpacity();
		
		return new Individual($red, $blue, $green, $alpha);
	}
	
	private function select1ParentForReproduction()
	{
		return $this->individuals[mt_rand(0, ($this->nb_individuals-1))];
	}
	
	// Calculate the fitting while keeping the elite
	// Tournament : better fitting (younger if truce) surviving
	private function survive($p_new_individuals , &$p_fitting)
	{
		$p_fitting = 0;
		
		for($iIndividual = 0; $iIndividual < $this->nb_individuals; $iIndividual++)
		{
			$actual_fitting = $this->individuals[$iIndividual]->getFitting();
			$new_fitting = $p_new_individuals[$iIndividual]->getFitting();
			
			if($new_fitting <= $actual_fitting )
			{
				$this->individuals[$iIndividual] = $p_new_individuals[$iIndividual];
			}
			
			$p_fitting += $this->individuals[$iIndividual]->getFitting();
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
	
	public function getFitting()
	{
		$fitting = 0;
		for($iIndividual = 0; $iIndividual < $this->nb_individuals; $iIndividual++)
		{
			$fitting += $this->individuals[$iIndividual]->getFitting();
		}
		return $fitting;
	}
	
	public function getNbGenerations()
	{
		return $this->nb_generations;
	}

	public function getRGBAStringPicture()
	{
		$string = "";
		for($iIndividual = 0; $iIndividual < $this->nb_individuals; $iIndividual++)
		{
			$string .= $this->individuals[$iIndividual]->getRGBAStringPicture();
			$string .= $iIndividual < ($this->nb_individuals - 1) ? "," : "";
		}
		return $string;
	}

	public function getParameters()
	{
		return array(
			array("legend" => "Minimal differences accepted (all RGBA axes)", "value" => $this->MIN_FITTING, "unity" => "fitting" ), 
			array("legend" => "Minimal picture's percentage difference accepted", "value" => $this->MIN_FITTING_POURCENTAGE, "unity" => "%" ), 
			array("legend" => "Percentage odd a CROSSOVER happens", "value" => $this->CROSSOVER_ACTIVATE_THRESHOLD, "unity" => "%" ), 
			array("legend" => "Percentage odd a MUTATION happens", "value" => $this->MUTATION_ACTIVATE_THRESHOLD, "unity" => "%" ), 
			array("legend" => "Maximum iterations", "value" => $this->MAX_ITERATIONS, "unity" => "generations" )
		);
	}
}