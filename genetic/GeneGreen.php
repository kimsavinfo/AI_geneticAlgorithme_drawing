<?php

class GeneGreen
{
	private $green;
	
	public function __construct($new_colour)
	{
		$this->setColour($new_colour);
	}
	
	public function mutate()
	{
		$this->setColour(mt_rand(0,255));
	}
	
	public function getColour()
	{
		return $this->green;
	}
	
	public function getColour3Digits()
	{
		return sprintf("%'.03d\n", $this->getColour());
	}
	
	public function setColour($new_colour)
	{
		if(is_int($new_colour))
		{
			$this->green = $new_colour;
		}
	}
}