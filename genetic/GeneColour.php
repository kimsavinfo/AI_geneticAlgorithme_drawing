<?php

class GeneColour
{
	protected $colour = 0;
	protected $fitting = 255; // fitting max for init
	
	public function __construct($p_colour)
	{
		$this->setColour($p_colour);
	}
	
	public function mutate()
	{
		$this->setColour(mt_rand(0,255));
	}
	
	public function getColour()
	{
		return $this->colour;
	}
	
	public function getColour3Digits()
	{
		return sprintf("%'.03d\n", $this->getColour());
	}
	
	public function setColour($p_colour)
	{
		if(is_int($p_colour))
		{
			$this->colour = $p_colour;
		}
	}
	
	public function getFitting()
	{
		return $this->fitting;
	}
	
	public function evaluate($p_colour_goal)
	{
		$this->fitting = abs($this->colour - $p_colour_goal);
	}
}