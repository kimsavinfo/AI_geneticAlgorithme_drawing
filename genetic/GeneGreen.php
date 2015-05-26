<?php

class GeneGreen
{
	private $green;
	
	public function __construct($new_colour)
	{
		$this->setColour($new_colour);
	}
	
	public function getColour()
	{
		return $this->green;
	}
	
	public function setColour($new_colour)
	{
		if(is_int($new_colour))
		{
			$this->green = $new_colour;
		}
	}
	
	public function mutate()
	{
		$this->setColour(mt_rand(0,255));
	}
}