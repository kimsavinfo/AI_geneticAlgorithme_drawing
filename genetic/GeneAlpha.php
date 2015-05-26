<?php

class GeneAlpha
{
	private $alpha;
	
	public function __construct($new_opacity)
	{
		$this->setOpacity($new_opacity);
	}
	
	public function getOpacity()
	{
		return $this->alpha;
	}
	
	public function setOpacity($new_opacity)
	{
		if(is_float($new_opacity))
		{
			$this->alpha = $new_opacity;
		}
	}
	
	public function mutate()
	{
		$new_opacity = (float) mt_rand(0,100)/100;
		$this->setOpacity($new_opacity);
	}
}