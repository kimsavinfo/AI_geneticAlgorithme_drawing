<?php

class GeneGreen
{
	private $green;
	
	public function __construct($new_colour)
	{
		$this->set_colour($new_colour);
	}
	
	public function get_colour()
	{
		return $this->green;
	}
	
	public function set_colour($new_colour)
	{
		if(is_int($new_colour))
		{
			$this->green = $new_colour;
		}
	}
	
	public function mutate()
	{
		$this->set_colour(mt_rand(0,255));
	}
}