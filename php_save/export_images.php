<?php
header('Content-Type: image/png');

ini_set('max_execution_time', 0);


	
function pictureToPixels($p_name, $p_width, $p_height){
	$original_pic = imagecreatefrompng($p_name);

	$pixels = array();
	$var_name = substr($p_name, 9,-4);
	echo '$'.$var_name.'_individuals = array(';

	for ($i=0; $i < $p_height; $i++) {

		echo '<br/>';

		for ($j=0; $j < $p_width; $j++) {
			
			$rgb = imagecolorat($original_pic, $j, $i);
			$colors = imagecolorsforindex($original_pic, $rgb);
			if($i!=$p_height-1)
			{
				if ($j%100==0)
				{
					echo '<br/>';
				}
				echo $colors['red'].','.$colors['green'].','.$colors['blue'].','.$colors['alpha'].',';
			}
			else
			{
				if ($j%100==0)
				{
					echo '<br/>';
					echo $colors['red'].','.$colors['green'].','.$colors['blue'].','.$colors['alpha'].',';
				}
				elseif($j==$p_width-1)
				{
					echo $colors['red'].','.$colors['green'].','.$colors['blue'].','.$colors['alpha'];
				}
				else
				{
					echo $colors['red'].','.$colors['green'].','.$colors['blue'].','.$colors['alpha'].',';
				}
				
			}
		}
	}
	echo ');';

	return $pixels;
}

//$file_test = "uploaded/france.png";
//$file_test = "uploaded/mario-pixelise.png";
//$file_test = "uploaded/joconde.png";
//$file_test = "uploaded/landscape.png";
//$file_test = "uploaded/mario.png";

//$size = getimagesize($file_test);
//$pixels = pictureToPixels($file_test, $size[0], $size[1]);



//****************************************************************************************
//				On calcule les valeurs uniques de chaque tableausx de pixels
//*****************************************************************************************


function PixelsToUniquePixels($p_pix_array, $new_var_name){
	
	$p_pix_array_length = count($p_pix_array);
	$unique_pix_string = "";

	echo '$'.$new_var_name.' = array(';

	for ($i=0; $i < $p_pix_array_length; $i+=4) {
		
		$current_pix = $p_pix_array[$i].','.$p_pix_array[$i+1].','.$p_pix_array[$i+2].','.$p_pix_array[$i+3].',';

		if (strpos($unique_pix_string, $current_pix)===false) {
			
			if ($i%100==0)
			{
				$unique_pix_string.='<br/>';
			}
			$unique_pix_string.=$current_pix;
		}
	}

	echo substr($unique_pix_string, 0, -1);

	echo ');';
}

//include('img_map/france.php');
include('img_map/mario_pixelise.php');
//include('img_map/joconde.php');
//include('img_map/landscape.php');
//include('img_map/mario.php');

//PixelsToUniquePixels($mario_individuals, "mario_unique");



//****************************************************************************************
//				On test si on peut regénérer les images après export
//*****************************************************************************************


function PixelArrayToPicture($p_width, $p_height, $p_pixels_tab)
{

	$new_pic = imagecreatetruecolor($p_width, $p_height);

	$nb_of_pixels = $p_width*$p_height;
	$current_pixel = 0;
	$new_image_j=0;

	for ($i=0; $i < $nb_of_pixels; $i+=4) { 

		$new_color = imagecolorallocatealpha($new_pic, $p_pixels_tab[$i], $p_pixels_tab[$i+1], $p_pixels_tab[$i+2], $p_pixels_tab[$i+3]);

		$new_image_i = $current_pixel%$p_width;
		$new_image_j = $new_image_i==0 && $i!=0 ? ($new_image_j+1) : $new_image_j;
		$current_pixel++;
		//imagesetpixel($new_pic, $new_image_j,$new_image_i, $new_color);
		imagesetpixel($new_pic, $new_image_i, $new_image_j, $new_color);
	}

	return $new_pic;
}


$width = $mario_pixelise_infos[0];
$height = $mario_pixelise_infos[1];


imagepng(PixelArrayToPicture($width, $height, $mario_pixelise_individuals));
/*$new_pic = imagecreatetruecolor(10,10);
$color = imagecolorallocatealpha($new_pic, 100,100,100,50);
imagesetpixel($new_pic, 0,0, $color);
imagepng($new_pic);*/

?>