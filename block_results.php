<?php
// Set a default image
if(!isset($_SESSION['upload_file']))
{
	$_SESSION['upload_file'] = $_SESSION['upload_dir']."/france.png";
}
if(isset($_SESSION['upload_file']))
{
	$population_goal = new ImageGoal($_SESSION['upload_file']);
	$individuals_goals = $population_goal->get_individuals();
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
		
	</div>
</div>
<div class="row">
	<div class="col-md-6" class="text-center">
		<h2>Pixels : <?php echo count($individuals_goals); ?></h2>
<?php 
if(isset($individuals_goals))
{
?>
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
					<td><?php echo sprintf('%d',$individual->get_red()); ?></td>
					<td><?php echo sprintf('%d',$individual->get_green()); ?></td>
					<td><?php echo sprintf('%d',$individual->get_blue()); ?></td>
					<td><?php echo sprintf('%.2f',$individual->get_alpha()); ?></td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
<?php
}
?>
	</div>
	<div class="col-md-6" class="text-center">
		<!-- TODO : Espace pour les pixels générés par algo gen -->
	</div>
</div>