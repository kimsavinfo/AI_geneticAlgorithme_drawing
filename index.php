<?php

require_once('genetic/Population.php');

ini_set('max_execution_time', 0); 

$file_test = "uploaded/france.png";
// $file_test = "uploaded/mario-pixelise.png";

$population = new Population($file_test);
$population->evolve();


$individuals_goal = $population->getImageGoal()->getIndividuals();
$unique_colours = $population->getImageGoal()->getUniqueColours();
$individuals = $population->getIndividuals();
$nb_individuals = count($individuals_goal);
$parameters = $population->getParameters();

$stringToGeneratePicture = $population->getRGBAStringPicture();
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
<?php
foreach ($parameters as $param) 
{
	echo "<p>".$param['legend']." : ".$param['value']."  ".$param['unity']."</p>";
}
?>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="5">
									Goal : <?php echo $nb_individuals; ?> pixels
									(<?php echo count($unique_colours); ?> unique colours)
								</th>
								<th colspan="6">
									Genetic : 
									<?php echo $population->getFitting(); ?> total fitting
									for <?php echo $population->getNbGenerations(); ?> generations
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
for ($iIndividual = 0; $iIndividual < $nb_individuals; $iIndividual++)
{
	$individual_goal = $individuals_goal[$iIndividual];
	$individual = $individuals[$iIndividual];
?>
							<tr>
								<td>
									<?php echo sprintf('%d',$individual_goal->getRed()->getColour()); ?>
								</td>
								<td>
									<?php echo sprintf('%d',$individual_goal->getGreen()->getColour()); ?>
								</td>
								<td>
									<?php echo sprintf('%d',$individual_goal->getBlue()->getColour()); ?>
								</td>
								<td>
									<?php echo sprintf('%.2f',$individual_goal->getAlpha()->getOpacity()); ?>
								</td>
								<td>
									<div class="main_colour_rectangle" 
										style="background-color: rgb(<?php echo $individual_goal->getRGBStringCSS(); ?>);">
									</div>
								</td>
								<td>
									<div class="main_colour_rectangle" 
										style="background-color: rgb(<?php echo $individual->getRGBStringCSS(); ?>);">
									</div>
								</td>
								<td>
									<?php echo sprintf('%.2f',$individual->getFitting()); ?>
								</td>
								<td>
									<?php echo sprintf('%d',$individual->getRed()->getColour()); ?>
									(<?php echo sprintf('%d',$individual->getRed()->getFitting()); ?>)
								</td>
								<td>
									<?php echo sprintf('%d',$individual->getGreen()->getColour()); ?>
									(<?php echo sprintf('%d',$individual->getGreen()->getFitting()); ?>)
								</td>
								<td>
									<?php echo sprintf('%d',$individual->getBlue()->getColour()); ?>
									(<?php echo sprintf('%d',$individual->getBlue()->getFitting()); ?>)
								</td>
								<td>
									<?php echo sprintf('%.2f',$individual->getAlpha()->getOpacity()); ?>
									(<?php echo sprintf('%d',$individual->getAlpha()->getFitting()); ?>)
								</td>
							</tr>
<?php
}
?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>		
		<script>
			$('#modalUniqueColours').on('shown.bs.modal', function () {
				$('#myInput').focus()
			})
		</scipt>
	</body>
</html>