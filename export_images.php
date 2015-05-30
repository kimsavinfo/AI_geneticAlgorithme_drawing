<?php

require_once("libs/file_manager.php");
require_once('genetic/Population.php');

ini_set('max_execution_time', 0);

$file_test = "uploaded/france.png";
//include('img_map/mario_pixelise.php');
//include('img_map/joconde.php');
//include('img_map/landscape.php');
//include('img_map/mario.php');


$before = memory_get_usage();
$population = new Population($file_test);
$after = memory_get_usage();
echo ($after - $before)." octets";

// ancienne version : 113720 octets


lib_exportPNGPixelsToTXT();
