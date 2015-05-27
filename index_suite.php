<?php

$population->evolve();

?>

<h3>Population finale : </h3>
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