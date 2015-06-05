<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit','10000M');

$GLOBALS['DIR_UPLOADED_IMG'] = "uploaded/";
$GLOBALS['DIR_IMG_MAP'] = "img_map/";
$GLOBALS['DIR_RESULTS'] = "_results/";

require_once('genetic/image_manager.php');
require_once('genetic/css_manager.php');
require_once('genetic/time_manager.php');
require_once('genetic/genetic.php');

// Configuration for genetic

// Percentage, will calculate MIN_FITTING accepted
$GLOBALS['MIN_FITTING_POURCENTAGE'] = 100;
if(isset($_POST['MIN_FITTING_POURCENTAGE']))
{
	$GLOBALS['MIN_FITTING_POURCENTAGE'] = $_POST['MIN_FITTING_POURCENTAGE'];
}

// Percentage, the odds to happen
$GLOBALS['CROSSOVER_ACTIVATE_THRESHOLD'] = 05;
if(isset($_POST['CROSSOVER_ACTIVATE_THRESHOLD']))
{
	$GLOBALS['CROSSOVER_ACTIVATE_THRESHOLD'] = $_POST['CROSSOVER_ACTIVATE_THRESHOLD'];
}

// Percentage, the odds to happen
$GLOBALS['MUTATION_ACTIVATE_THRESHOLD'] = 20;
if(isset($_POST['MUTATION_ACTIVATE_THRESHOLD']))
{
	$GLOBALS['MUTATION_ACTIVATE_THRESHOLD'] = $_POST['MUTATION_ACTIVATE_THRESHOLD'];
}

// IF the algorithm did not succeed in reaching the MIN_FITTING
// THEN it will stop to reproduce at the MAX_ITERATIONS generation
$GLOBALS['MAX_ITERATIONS'] = 10;
if(isset($_POST['MAX_ITERATIONS']))
{
	$GLOBALS['MAX_ITERATIONS'] = $_POST['MAX_ITERATIONS'];
}