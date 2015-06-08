<?php

class Chrono
{
	private $start;
	private $end;
	private $duration;

	public function __construct()
	{
		$this->start();
	}
	
	public function start()
	{
		$this->start = microtime(true);
	}

	public function end()
	{
		$this->end = microtime(true);
		$this->duration = $this->end - $this->start;
	}

	public function getStartHis()
	{
		return date("H:i:s", $this->start);
	}

	public function getEndHis()
	{
		return date("H:i:s", $this->end);
	}

	public function getDurationHis()
	{
		return gmdate("H:i:s", $this->duration);
	}
}