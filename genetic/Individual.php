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
	
	public function toString()
	{
		return 'Red : '.$this->getRed().
		' Green : '.$this->getGreen().
		' Blue : '.$this->getBlue().
		' Alpha : '.$this->getAlpha();
	}
	
	public function getRGBStringCSS()
	{
		return $this->getRed().",".$this->getGreen().",".$this->getBlue();
	}
	
	public function getRGBSStringRaw()
	{
		return $this->getRed().$this->getGreen().$this->getBlue().$this->getAlpha();
	}
	
	public function getRed()
	{
		return $this->genome[0]->getColour();
	}
	
	public function getGreen()
	{
		return $this->genome[1]->getColour();
	}
	
	public function getBlue()
	{
		return $this->genome[2]->getColour();
	}
	
	public function getAlpha()
	{
		return $this->genome[3]->getOpacity();
	}
}