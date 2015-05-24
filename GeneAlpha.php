<?php

class GeneAlpha
{
	private $alpha;
	
	public function __construct($new_opacity)
	{
		$this->set_opacity($new_opacity);
	}
	
	public function get_opacity()
	{
		return $this->alpha;
	}
	
	public function set_opacity($new_opacity)
	{
		if(is_float($new_opacity))
		{
			$this->alpha = $new_opacity;
		}
	}
	
	public function mutate()
	{
		$new_opacity = (float) mt_rand(0,100)/100;
		$this->set_opacity($new_opacity);
	}
}