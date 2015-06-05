<?php

require_once('config.php');

$file_test = $GLOBALS['DIR_UPLOADED_IMG']."france.png";
if(isset($_GET['basename']))
{
	/*
	export.php?basename=france
	export.php?basename=mario_pixelise
	export.php?basename=joconde
	*/
	$file_test = $GLOBALS['DIR_UPLOADED_IMG'].$_GET['basename'].".png";
}


// Get all pixels from the image
$pixels_goal = array();
$palette = array();
importPixelsRGBA($file_test, $pixels_goal, $palette);

// Initialize the population
$nb_pixels = count($pixels_goal);
$pixels_genetic = array();
initPopulation($pixels_genetic, $palette, $nb_pixels);

// Evolving
$stats = array();
evolve($pixels_genetic, $pixels_goal, $stats, $palette);

// Export picture
$export_png_path = pixelArrayToPicture($file_test, $pixels_genetic);

// Send email
$to      = 'arthurlambert23@gmail.com, kimsavinfo@gmail.com';
$subject = 'IA - Genetic Algorithme drawing';
$headers = 'From: kimsavinfo@gmail.com' . "\r\n" ;
$headers .= 'Reply-To: kimsavinfo@gmail.com' . "\r\n" ;
$headers .= "Content-Type: text/html; charset=\"utf-8\"";
$headers .= 'X-Mailer: PHP/' . phpversion();
	
$message = $file_test .' -> '.$export_png_path.' : <br/>';
$message .= 'MIN_FITTING_POURCENTAGE :'.var_export($GLOBALS['MIN_FITTING_POURCENTAGE'], true).'<br/>';
$message .=  'CROSSOVER_ACTIVATE_THRESHOLD :'.var_export($GLOBALS['CROSSOVER_ACTIVATE_THRESHOLD'], true).'<br/>';
$message .=  'MUTATION_ACTIVATE_THRESHOLD :'.var_export($GLOBALS['MUTATION_ACTIVATE_THRESHOLD'], true).'<br/>';
$message .=  'MAX_ITERATIONS :'.var_export($GLOBALS['MAX_ITERATIONS'], true).'<br/>';
$message .=  'STATS :'.var_export($stats, true).'<br/>';

mail($to, $subject, $message, $headers);

?>