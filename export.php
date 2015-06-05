<?php

require_once('config.php');

$file_test = $GLOBALS['DIR_UPLOADED_IMG']."france.png";

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




function PixelArrayToPicture($p_width, $p_height, $p_pixels_tab)
{

	$new_pic = imagecreatetruecolor($p_width, $p_height);

	$nb_of_pixels = $p_width*$p_height;
	$current_pixel = 0;
	$new_image_j=0;

	for ($i=0; $i < $nb_of_pixels; $i+=4) { 
		$new_color = imagecolorallocatealpha($new_pic, 
			$p_pixels_tab[$i][0], 
			$p_pixels_tab[$i][1],
			$p_pixels_tab[$i][2], 
			$p_pixels_tab[$i][3]);

		$new_image_i = $current_pixel%$p_width;
		$new_image_j = $new_image_i==0 && $i!=0 ? ($new_image_j+1) : $new_image_j;
		$current_pixel++;
		
		imagesetpixel($new_pic, $new_image_i, $new_image_j, $new_color);
	}

	return $new_pic;
}

$size = getimagesize($file_test);
header('Content-Type: image/png');
imagepng(PixelArrayToPicture($size[0], $size[1], $pixels_genetic));








// Sending email
$to      = 'arthurlambert23@gmail.com, kimsavinfo@gmail.com';
$subject = 'IA - Genetic Algorithme drawing';
$headers = 'From: kimsavinfo@gmail.com' . "\r\n" ;
$headers .= 'Reply-To: kimsavinfo@gmail.com' . "\r\n" ;
$headers .= "Content-Type: text/html; charset=\"utf-8\"";
$headers .= 'X-Mailer: PHP/' . phpversion();
	
$message = $file_test .' : <br/>';
$message .= 'MIN_FITTING_POURCENTAGE :'.var_export($GLOBALS['MIN_FITTING_POURCENTAGE'], true).'<br/>';
$message .=  'CROSSOVER_ACTIVATE_THRESHOLD :'.var_export($GLOBALS['CROSSOVER_ACTIVATE_THRESHOLD'], true).'<br/>';
$message .=  'MUTATION_ACTIVATE_THRESHOLD :'.var_export($GLOBALS['MUTATION_ACTIVATE_THRESHOLD'], true).'<br/>';
$message .=  'MAX_ITERATIONS :'.var_export($GLOBALS['MAX_ITERATIONS'], true).'<br/>';
$message .=  'STATS :'.var_export($stats, true).'<br/>';

// mail($to, $subject, $message, $headers);






?>