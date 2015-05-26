<?php
// Set a default image
if(!isset($_SESSION['upload_file']))
{
	$_SESSION['upload_file'] = $_SESSION['upload_dir']."/france.png";
}

$individuals_goals = array();
$main_colours = array();

if(isset($_SESSION['upload_file']))
{
	$population_goal = new ImageGoal($_SESSION['upload_file'], 3);
	$individuals_goals = $population_goal->getIndividuals();
	$main_colours = $population_goal->getMainColours();
}
?>

<!-- Image uploaded and genetic algorithm results -->
<div class="row">
	<div class="col-md-6" class="text-center">
		<h2>Testing the image :</h2>
		<img src="<?php echo $_SESSION['upload_file']; ?>" class="img-responsive" alt="Responsive image">
	</div>
	<div class="col-md-6" class="text-center">
		<h2>Main colours :</h2>
		<!-- TODO : Espace pour les pixels générés par algo gen -->
<?php
foreach ($main_colours as $individual)
{
?>
		<div class="main_colour_rectangle" 
			style="background-color: rgb(<?php echo $individual->getRGBStringCSS(); ?>);">
		</div>
<?php
}
?>
	</div>
	
	<div class="col-md-6" class="text-center">
		<h2>Pixels : <?php echo count($individuals_goals); ?></h2>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Red</th>
					<th>Blue</th>
					<th>Green</th>
					<th>Alpha</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($individuals_goals as $individual)
{
?>
				<tr>
					<td><?php echo sprintf('%d',$individual->getRed()); ?></td>
					<td><?php echo sprintf('%d',$individual->getGreen()); ?></td>
					<td><?php echo sprintf('%d',$individual->getBlue()); ?></td>
					<td><?php echo sprintf('%.2f',$individual->getAlpha()); ?></td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
	</div>

</div>