<?php

class GeneAlpha
{
	private $alpha;
	
	public function __construct($new_opacity)
	{
		$this->setOpacity($new_opacity);
	}
	
	public function mutate()
	{
		$new_opacity = (float) mt_rand(0,100)/100;
		$this->setOpacity($new_opacity);
	}
	
	public function getOpacity()
	{
		return $this->alpha;
	}
	
	public function getOpacity3Digits()
	{
		return sprintf("%'.03d\n", ($this->getOpacity() * 100) );
	}
	
	public function setOpacity($new_opacity)
	{
		if(is_float($new_opacity))
		{
			$this->alpha = $new_opacity;
		}
	}
}