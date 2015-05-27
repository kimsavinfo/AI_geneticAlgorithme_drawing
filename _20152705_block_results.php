<?php
$individuals_goals = array();
$unique_colours = array();

if(isset($_SESSION['upload_file']))
{
	$population_goal = new ImageGoal($_SESSION['upload_file'], 3);
	$individuals_goals = $population_goal->getIndividuals();
	$unique_colours = $population_goal->getUniqueColours();
}
?>

<!-- Image uploaded and genetic algorithm results -->
<div class="row">
	<div class="col-md-6" class="text-center">
		<h2>Testing the image :</h2>
		<img src="<?php echo $_SESSION['upload_file']; ?>" class="img-responsive" alt="Responsive image">
	</div>
	<div class="col-md-6" class="text-center">
		<h2>
			Step 1 : <?php echo count($unique_colours); ?> different colours
			<!-- Button trigger modal : rf index.php, js bottom section -->
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalUniqueColours">
				Details
			</button>
		</h2>

		<!-- Modal -->
		<div class="modal fade" id="modalUniqueColours" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">
							<?php echo count($unique_colours); ?> different colours
						</h4>
					</div>
					<div class="modal-body">
<?php
foreach ($unique_colours as $individual)
{
?>
						<div class="main_colour_rectangle" 
							style="background-color: rgb(<?php echo $individual->getRGBStringCSS(); ?>);">
						</div>
<?php
}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
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