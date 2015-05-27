<?php

require_once('GeneAlpha.php');
require_once('GeneRed.php');
require_once('GeneBlue.php');
require_once('GeneGreen.php');


class Individual
{
	private $genome = array();
	
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
		
		for($i=0;$i<$nbAffetcedGenees;$i++)
		{
			$rand_selected_gene = mt_rand(1,count($genesIndexes));
			$this->genome[--$rand_selected_gene]->mutate();
			
			unset($genesIndexes[$rand_selected_gene]);
			$genesIndexes = array_values($genesIndexes);
		}
	}
	
	public function evaluate($p_individual_goal)
	{
		$this->getRed()->evaluate($p_individual_goal->getRed()->getColour());
		$this->getGreen()->evaluate($p_individual_goal->getGreen()->getColour());
		$this->getBlue()->evaluate($p_individual_goal->getBlue()->getColour());
		$this->getAlpha()->evaluate($p_individual_goal->getAlpha()->getOpacity());
	}
	
	public function getFitting()
	{
		return $this->getRed()->getFitting()
		+ $this->getGreen()->getFitting()
		+ $this->getBlue()->getFitting()
		+ $this->getAlpha()->getFitting();
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
		return $this->genome[0]->getColour3Digits().
		$this->genome[1]->getColour3Digits().
		$this->genome[2]->getColour3Digits().
		$this->genome[3]->getOpacity3Digits();
	}
	
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
}