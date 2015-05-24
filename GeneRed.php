<?php

class GeneRed
{
	private $red;
	
	public function __construct($new_colour)
	{
		$this->set_color($new_colour);
	}
	
	public function get_colour()
	{
		return $this->red;
	}
	
	public function set_color($new_colour)
	{
		if(is_int($new_colour))
		{
			$this->red = $new_colour;
		}
	}
	
	public function mutate()
	{
		$this->set_color(mt_rand(0,255));
	}
}