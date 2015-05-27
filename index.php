<?php

require_once('genetic/Population.php');

$file_test = "uploaded/france.png";

$population = new Population($file_test);

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
			Image de test : <img src="<?php echo $file_test  ?>" class="img-responsive" alt="Responsive image">
			
			<div class="row">
				<div class="col-md-6" class="text-center">
					<h3>Population init : </h3>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Red</th>
								<th>Blue</th>
								<th>Green</th>
								<th>Alpha</th>
								<th>Copleur</th>
							</tr>
						</thead>
						<tbody>
					<?php
					$individuals = $population->getIndividuals();
					foreach ($individuals as $individual)
					{
					?>
							<tr>
								<td><?php echo sprintf('%d',$individual->getRed()); ?></td>
								<td><?php echo sprintf('%d',$individual->getGreen()); ?></td>
								<td><?php echo sprintf('%d',$individual->getBlue()); ?></td>
								<td><?php echo sprintf('%.2f',$individual->getAlpha()); ?></td>
								<td>
									<div class="main_colour_rectangle" 
										style="background-color: rgb(<?php echo $individual->getRGBStringCSS(); ?>);">
									</div>
								</td>
							</tr>
					<?php
					}
					?>
						</tbody>
					</table>
				</div>
				<div class="col-md-6" class="text-center">
					<?php require_once('index_suite.php'); ?>
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