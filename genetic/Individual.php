<?php

require_once('GeneAlpha.php');
require_once('GeneRed.php');
require_once('GeneBlue.php');
require_once('GeneGreen.php');


class Individual
{
	private $genome = array();
	private $fitting = 865; // fitting max for init
	
	public function __construct($p_red, $p_green, $p_blue, $p_alpha)
	{
		$this->genome[0] = new GeneRed($p_red);
		$this->genome[1] = new GeneGreen($p_green); 
		$this->genome[2] = new GeneBlue($p_blue); 
		$this->genome[3] = new GeneAlpha($p_alpha);
	}
	
	public function getGenome()
	{
		return $genome;
	}
	
	public function mutate()
	{
		$nbAffetcedGenees = mt_rand(1,4);
		
		$genesIndexes = array(0,1,2,3);
		$nb_genes = $this->getNbGenes();
		for($i=0;$i<$nbAffetcedGenees;$i++)
		{
			$rand_selected_gene = mt_rand(1, $nb_genes);
			$this->genome[--$rand_selected_gene]->mutate();
			
			unset($genesIndexes[$rand_selected_gene]);
			$genesIndexes = array_values($genesIndexes);
		}
	}
	
	public function evaluate($p_individual_goal)
	{
		$this->genome[0]->evaluate($p_individual_goal->getRed()->getColour());
		$this->genome[1]->evaluate($p_individual_goal->getGreen()->getColour());
		$this->genome[2]->evaluate($p_individual_goal->getBlue()->getColour());
		$this->genome[3]->evaluate($p_individual_goal->getAlpha()->getOpacity());
		
		$this->calculateFitting();
	}
	
	private function calculateFitting()
	{
		$this->fitting = $this->getRed()->getFitting()
		+ $this->getGreen()->getFitting()
		+ $this->getBlue()->getFitting()
		+ $this->getAlpha()->getFitting();
	}
	
	/* === GET / SET =================================================== */
	
	public function getRed()
	{
		return $this->genome[0];
	}
	
	public function getGreen()
	{
		return $this->genome[1];
	}
	
	public function getBlue()
	{
		return $this->genome[2];
	}
	
	public function getAlpha()
	{
		return $this->genome[3];
	}
	
	public function getNbGenes()
	{
		return count($this->genome);
	}
	
	public function getFitting()
	{
		return $this->fitting;
	}
	
	public function toString()
	{
		return 'Red : '.$this->getRed()->getColour().
		' Green : '.$this->getGreen()->getColour().
		' Blue : '.$this->getBlue()->getColour().
		' Alpha : '.$this->getAlpha()->getOpacity();
	}
	
	public function getRGBStringCSS()
	{
		return $this->getRed()->getColour().
		",".$this->getGreen()->getColour().
		",".$this->getBlue()->getColour();
	}
	
	public function getRGBSStringRaw()
	{		
		return $this->getRed()->getColour3Digits().
		$this->getGreen()->getColour3Digits().
		$this->getBlue()->getColour3Digits().
		$this->getAlpha()->getOpacity3Digits();
	}
	
	
}