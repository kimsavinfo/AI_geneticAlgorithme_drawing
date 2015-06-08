<?php

require_once('config.php');

// $file_test = $GLOBALS['DIR_UPLOADED_IMG']."france.png";
// $file_test = $GLOBALS['DIR_UPLOADED_IMG']."mario_pixelise.png";
// $file_test = $GLOBALS['DIR_UPLOADED_IMG']."joconde_little.png";
 $file_test = $GLOBALS['DIR_UPLOADED_IMG']."landscape_little.png";
// $file_test = $GLOBALS['DIR_UPLOADED_IMG']."mario_little.png";


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
evolve($pixels_genetic, $pixels_goal, $stats, $palette)
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>IA - Genetic Algorithm</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="css/main.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					Image de test : <img src="<?php echo $file_test; ?>" class="img-responsive" alt="Responsive image">
				</div>
				<div class="col-md-6">
					<p>
						Minimal differences accepted (all RGBA axes) : <?php echo $stats['min_fitting']; ?>
					</p>
					<p>
						Minimal picture's percentage difference accepted : 
						<?php echo $GLOBALS['MIN_FITTING_POURCENTAGE']; ?>
					</p>
					<p>
						Percentage odd a CROSSOVER happens : <?php echo $GLOBALS['CROSSOVER_ACTIVATE_THRESHOLD']; ?>
					</p>
					<p>
						Percentage odd a MUTATION happens : <?php echo $GLOBALS['MUTATION_ACTIVATE_THRESHOLD']; ?>
					</p>
					<p>
						Maximum iterations : <?php echo $GLOBALS['MAX_ITERATIONS']; ?>
					</p>
					<p>
						Starting date : <?php echo getDateHis($stats['microtime_start']); ?>
					</p>
					<p>
						Ending date : <?php echo getDateHis($stats['microtime_end']); ?>
					</p>
					<p>
						Duration : <?php echo getDurationHis($stats['microtime_start'], $stats['microtime_end']); ?>
					</p
				</div>
			</div>
			<hr/>
			<!--
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="5">
									Goal : <?php echo $nb_pixels; ?> pixels
									(<?php echo count($palette); ?> colours in the palette)
								</th>
								<th colspan="6">
									Genetic : 
									<?php echo $stats['fitting_total']; ?> total fitting
									for <?php echo $stats['nb_generations']; ?> generations
								</th>
							</tr>
							<tr>
								<th>Red</th>
								<th>Blue</th>
								<th>Green</th>
								<th>Alpha</th>
								<th>Colour</th>
								<th>Colour</th>
								<th>Fitting total</th>
								<th>Red</th>
								<th>Blue</th>
								<th>Green</th>
								<th>Alpha</th>
							</tr>
						</thead>
						<tbody>
<?php
/*
for ($iPixels = 0; $iPixels < $nb_pixels; $iPixels++)
{
	$pixel_goal = $pixels_goal[$iPixels];
	$pixel_genetic = $pixels_genetic[$iPixels];
*/
?>
							<tr>
								<td>
									<?php echo sprintf('%d',$pixel_goal[0]); ?>
								</td>
								<td>
									<?php echo sprintf('%d',$pixel_goal[1]); ?>
								</td>
								<td>
									<?php echo sprintf('%d',$pixel_goal[2]); ?>
								</td>
								<td>
									<?php echo sprintf('%.2f',$pixel_goal[3]); ?>
								</td>
								<td>
									<div class="main_colour_rectangle" 
										style="background-color: rgb(<?php echo getRGBStringCSS($pixel_goal); ?>);">
									</div>
								</td>
								<td>
									<div class="main_colour_rectangle" 
										style="background-color: rgb(<?php echo getRGBStringCSS($pixel_genetic); ?>);">
									</div>
								</td>
								<td>
									<?php echo sprintf('%.2f', getFittingPixel($pixel_goal, $pixel_genetic) ); ?>
								</td>
								<td>
									<?php echo sprintf('%d',$pixel_genetic[0]); ?>
									(<?php echo sprintf('%d', getFitting($pixel_genetic[0], $pixel_goal[0]) ); ?>)
								</td>
								<td>
									<?php echo sprintf('%d',$pixel_genetic[1]); ?>
									(<?php echo sprintf('%d', getFitting($pixel_genetic[1], $pixel_goal[1]) ); ?>)
								</td>
								<td>
									<?php echo sprintf('%d',$pixel_genetic[2]); ?>
									(<?php echo sprintf('%d', getFitting($pixel_genetic[2], $pixel_goal[2]) ); ?>)
								</td>
								<td>
									<?php echo sprintf('%d',$pixel_genetic[3]); ?>
									(<?php echo sprintf('%d', getFitting($pixel_genetic[3], $pixel_goal[3], true) ); ?>)
								</td>
							</tr>
<?php
/*
}
*/
?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		-->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>		
	</body>
</html>