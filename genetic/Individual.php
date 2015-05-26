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
	
	public function get_red()
	{
		return $this->genome[0]->get_colour();
	}
	
	public function get_green()
	{
		return $this->genome[1]->get_colour();
	}
	
	public function get_blue()
	{
		return $this->genome[2]->get_colour();
	}
	
	public function get_alpha()
	{
		return $this->genome[3]->get_opacity();
	}
}