<?php

class GeneBlue
{
	private $blue;
	
	public function __construct($new_colour)
	{
		$this->set_colour($new_colour);
	}
	
	public function get_colour()
	{
		return $this->blue;
	}
	
	public function set_colour($new_colour)
	{
		if(is_int($new_colour))
		{
			$this->blue = $new_colour;
		}
	}
	
	public function mutate()
	{
		$this->set_colour(mt_rand(0,255));
	}
}