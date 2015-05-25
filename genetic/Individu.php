<?php

require_once('GeneAlpha.php');
require_once('GeneRed.php');
require_once('GeneBlue.php');
require_once('GeneGreen.php');


class Individu
{
	private $genome = array();
	
	public function __construct($red, $green, $blue, $alpha)
	{
		$this->genome[0] = new GeneRed($red);
		$this->genome[1] = new GeneGreen($green); 
		$this->genome[2] = new GeneBlue($blue); 
		$this->genome[3] = new GeneAlpha($alpha);
	}
	
	public function get_genome()
	{
		return $genome;
	}
	
	public function mutate()
	{
		$nbAffetcedGenees = mt_rand(1,4);
		
		$genesIndexes = array(0,1,2,3);
		
		for($i=0;$i<$nbAffetcedGenees;$i++)
		{
			$randSelectedGenee = mt_rand(1,count($genesIndexes));
			$this->genome[--$randSelectedGenee]->mutate();
			
			unset($genesIndexes[$randSelectedGenee]);
			$genesIndexes = array_values($genesIndexes);
		}
	}
	
	public function to_string()
	{
		return 'Red : '.$this->genome[0]->get_colour().
		' Green : '.$this->genome[1]->get_colour().
		' Blue : '.$this->genome[2]->get_colour().
		' Alpha : '.$this->genome[3]->get_opacity();
	}
}