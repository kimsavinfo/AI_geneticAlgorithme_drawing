<?php

require_once('libs/Chrono.php');
require_once("libs/file_manager.php");
require_once('genetic/Population.php');

ini_set('max_execution_time', 0);
ini_set('memory_limit','10000M');

//$file_test = "uploaded/france.png";
//$file_test = "uploaded/mario_pixelise.png";
//$file_test = "uploaded/joconde.png";
//$file_test = "uploaded/landscape.png";
$file_test = "uploaded/mario.png";

// $a = file_get_contents("img_map/mario.txt", "r");

$chrono = new Chrono();
$before = memory_get_usage();

$individuals = array();
$image = imagecreatefrompng($file_test);
$size = getimagesize($file_test);

for ($iLine=0; $iLine < $size[1]; $iLine++) 
{
	for ($iColumn=0; $iColumn < $size[0]; $iColumn++) 
	{				
		$rgb = imagecolorat($image, $iColumn, $iLine);
		$colours = imagecolorsforindex($image, $rgb);
		
		$individuals[] =  array(
			$colours["red"], $colours["green"],
			$colours["blue"], $colours["alpha"]
		);
	}
}

file_put_contents("img_map/mario.txt", var_export($individuals, true));

// eval('$b = ' . var_export($a, true) . ';');

$after = memory_get_usage();
$chrono->end();




echo ($after - $before)." octets || ".$chrono->getDurationHis();

// Joconde : 1 181 306 504 octets
// Mario : 138,7 Mo


// lib_exportPNGPixelsToTXT();
