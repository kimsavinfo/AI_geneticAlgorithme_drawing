<?php

class GeneAlpha
{
	private $alpha = 0;
	private $fitting = 100; // fitting max for init
	
	public function __construct($p_opacity)
	{
		$this->setOpacity($p_opacity);
	}
	
	public function mutate()
	{
		$p_opacity = (float)mt_rand(0,100)/100;
		$this->setOpacity($p_opacity);
	}
	
	public function calculateFitting($p_opacity)
	{
		return abs($this->alpha - $p_opacity) * 100;
	}
	
	/* === GET / SET =================================================== */
	
	public function getOpacity()
	{
		return $this->alpha;
	}
	
	public function getOpacity3Digits()
	{
		return sprintf("%'.03d\n", ($this->getOpacity() * 100) );
	}
	
	public function setOpacity($p_opacity)
	{
		if(is_float($p_opacity))
		{
			$this->alpha = $p_opacity;
		}
	}
	
	public function getFitting()
	{
		return $this->fitting;
	}
	
	public function evaluate($p_opacity_goal)
	{
		$this->fitting = $this->calculateFitting($p_opacity_goal);
	}
}