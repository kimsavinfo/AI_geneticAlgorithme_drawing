<?php

class GeneBlue
{
	private $blue;
	
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
		return $this->blue;
	}
	
	public function getColour3Digits()
	{
		return sprintf("%'.03d\n", $this->getColour());
	}
	
	public function setColour($new_colour)
	{
		if(is_int($new_colour))
		{
			$this->blue = $new_colour;
		}
	}
}